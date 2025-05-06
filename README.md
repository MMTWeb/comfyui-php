  <h1>🚀 Laravel-ComfyUI Bridge</h1>

  <p>This Laravel app connects to <a href="https://github.com/comfyanonymous/ComfyUI" target="_blank">ComfyUI</a> using a WebSocket bridge written in Python. It allows you to generate images via Laravel by sending instructions to ComfyUI.</p>

  <hr>

  <h2>📦 Requirements</h2>
  <ul>
    <li>PHP 8.1+</li>
    <li>Laravel 10.x</li>
    <li>Node.js & NPM</li>
    <li>Composer</li>
    <li>Python 3.x (for WebSocket bridge) (In this readme I use python_embeded of ComfyUI)</li>
    <li>ComfyUI installed and running (In this readme I use ComfyUI Portable version)</li>
  </ul>

  <hr>

  <h2>🛠️ Installation</h2>

  <h3>1. Clone the Repository</h3>
  <pre><code>git clone git@github.com:your-username/comfyui-php.git
cd comfyui-php</code></pre>

  <h3>2. Install Composer Dependencies</h3>
  
  <pre><code>composer install</code></pre>

  <h3>3. Install NPM Dependencies</h3>
  
  <pre><code>npm install</code></pre>

  <h3>4. Configure Environment and disable database usage</h3>
  
  <pre><code>cp .env.example .env</code></pre>
  <pre>Add the following line : <code>ComfyUIWebSocket=yourwebsocketaddress:yourwebsocketport</code></pre>
  <pre>Comment : <code># APP_MAINTENANCE_STORE=databaset</code></pre>
  <pre>Set <code>APP_MAINTENANCE_DRIVER= to APP_MAINTENANCE_DRIVER=file</code></pre>
  <pre>Set <code>DB_CONNECTION= to DB_CONNECTION=null</code></pre>
  
  <h3>5. Generate App Key</h3>
  
  <pre><code>php artisan key:generate</code></pre>

  <h3>6. Run Laravel Migrations (if any)</h3>
  
  <pre><code>php artisan migrate</code></pre>

  <h3>7. Start the Laravel App</h3>
  
  <pre><code>php artisan serve</code>, (e.g., <code>http://localhost/public</code>) or (e.g., <code>http://localhost:3000</code>) </pre>

  <hr>

    <h2>🪟 Python WebSocket Setup on Windows with ComfyUI Portable Version</h2>

    <p>If you're using the <strong>portable version of ComfyUI</strong> on Windows, it comes with an embedded Python interpreter. You can use this to run the WebSocket bridge without installing Python globally.</p>

  <h3>1. Install Required Packages</h3>
  <p>Run these commands from the <code>ComfyUI\python_embeded</code> directory:</p>
  <pre><code>.\python.exe -m pip install websocket-client flask</code></pre>

  <p>Optionally, verify installation:</p>
  <pre><code>.\python.exe -m pip show websocket-client</code></pre>

  <h3>2. Move the WebSocket Directory</h3>
  <p>Move the <code>websocket</code> folder (containing <code>websocket.py</code>) to the parent directory of ComfyUI, for example:</p>
  <pre><code>D:\ComfyUI\websocket</code></pre>

  <h3>3. Run the WebSocket Server</h3>
  <p>From the ComfyUI folder, run the bridge with:</p>
  <pre><code>cd D:\ComfyUI
.\python_embeded\python.exe websocket\websocket.py</code></pre>

  <p>This starts the WebSocket server which Laravel will communicate with.</p>

  <hr>

  <h2>💡 Why Use a Python WebSocket?</h2>

  <p>The main reason I use a Python WebSocket bridge instead of connecting Laravel directly to the ComfyUI API is because it’s not feasible to reliably know when ComfyUI has finished generating an image.</p>

  <p>While PHP could technically send a request and poll the <code>/history</code> endpoint with a timeout, this approach is inefficient and not well-suited for PHP’s synchronous nature. It may lead to unstable behavior or timeouts.</p>

  <p>Instead, the WebSocket server listens for ComfyUI's generation completion event and notifies Laravel in real time. This asynchronous communication model is much more robust and scalable.</p>

  <blockquote>
    If anyone has a better or more elegant solution, feel free to share it — contributions and ideas are welcome!
  </blockquote>

  <hr>

  <h2>📂 Notes</h2>
  <ul>
    <li><code>vendor/</code> and <code>node_modules/</code> are not included — run <code>composer install</code> and <code>npm install</code> after cloning.</li>
    <li><code>.env</code> is included without sensitive data — configure it manually.</li>
    <li>The Laravel app uses a Python WebSocket bridge to trigger ComfyUI workflows.</li>
  </ul>

  <hr>

  <h2>🤝 Contributing</h2>
  <p>Pull requests and improvements are welcome!</p>

  <hr>

  <h2>📝 License</h2>
  <p>This project is open-source and available under the <a href="LICENSE">MIT license</a>.</p>
