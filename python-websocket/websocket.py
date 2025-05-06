from flask import Flask, request, jsonify
import websocket
import urllib.request
import uuid
import json
import io
from PIL import Image
import base64

app = Flask(__name__)
server_address = "127.0.0.1:8188"  #change this according to your setup

@app.route('/generate', methods=['POST'])
def generate():
    try:
        # 1. Get the prompt from Laravel
        prompt = request.json
        client_id = str(uuid.uuid4())

        # 2. Add SaveImageWebsocket Workflow, in the workflow that we will use on PHP the id is 8
        prompt["save_image_websocket_node"] = {
            "class_type": "SaveImageWebsocket",
            "inputs": {
                "images": ["8", 0]
            }
        }

        # 3. Connect to WebSocket
        ws = websocket.WebSocket()
        ws.connect(f"ws://{server_address}/ws?clientId={client_id}")

        # 4. Queue prompt with client_id
        p = {"prompt": prompt, "client_id": client_id}
        req = urllib.request.Request(f"http://{server_address}/prompt", data=json.dumps(p).encode('utf-8'))
        prompt_id = json.loads(urllib.request.urlopen(req).read())["prompt_id"]

        current_node = ""
        image_data = None

        # 5. Listen for output
        while True:
            out = ws.recv()
            if isinstance(out, str):
                message = json.loads(out)
                if message['type'] == 'executing':
                    data = message['data']
                    if data['prompt_id'] == prompt_id:
                        if data['node'] is None:
                            break  # Execution done
                        else:
                            current_node = data['node']
            else:
                # Binary image from SaveImageWebsocket
                if current_node == 'save_image_websocket_node':
                    image_data = out[8:]  # skip header
                    break

        ws.close()

        # 6. Convert to base64
        if not image_data:
            return jsonify({"error": "No image received"}), 500

        image = Image.open(io.BytesIO(image_data))
        buffer = io.BytesIO()
        image.save(buffer, format='jpeg')
        base64_image = base64.b64encode(buffer.getvalue()).decode('utf-8')

        return jsonify({
            "base64_image": f"data:image/jpeg;base64,{base64_image}"
        })

    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(host="127.0.0.1", port=5000) #change this according to your setup
