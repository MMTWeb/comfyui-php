  <h1>🚀 Laravel-ComfyUI Bridge</h1>

  <p>
    This Laravel application connects to ComfyUI through a Python-based WebSocket bridge.
    It allows you to trigger image generation from Laravel using the ComfyUI backend.
  </p>

  <hr />

  <h2>📦 Requirements</h2>
  <ul>
    <li>PHP 8.1+</li>
    <li>Laravel 10.x</li>
    <li>Node.js & NPM</li>
    <li>Composer</li>
    <li>Python 3.x (used through ComfyUI’s embedded version on Windows)</li>
    <li>ComfyUI (Portable version recommended)</li>
  </ul>

  <hr />

  <h2>🛠️ Installation</h2>

  <h3>1. Clone the Repository</h3>
  <pre><code>git clone git@github.com:your-username/comfyui-php.git
cd comfyui-php</code></pre>

  <h3>2. Install Composer Dependencies</h3>
  <pre><code>composer install</code></pre>

  <h3>3. Install NPM Dependencies</h3>
  <pre><code>npm install</code></pre>

  <h3>4. Environment Configuration</h3>
  <pre><code>cp .env.example .env</code></pre>
  <p>Edit the <code>.env</code> file and set the following:</p>
  <ul>
    <li><code>ComfyUIWebSocket=your_websocket_host:your_port</code></li>
    <li>Comment out: <code>#APP_MAINTENANCE_STORE=database</code></li>
    <li>Set: <code>APP_MAINTENANCE_DRIVER=file</code></li>
    <li>Set: <code>DB_CONNECTION=null</code></li>
  </ul>

  <h3>5. Generate App Key</h3>
  <pre><code>php artisan key:generate</code></pre>

  <h3>6. Run Laravel Migrations (if needed)</h3>
  <pre><code>php artisan migrate</code></pre>

  <h3>7. Start the Laravel Development Server</h3>
  <pre><code>php artisan serve</code></pre>
  <p>Visit: <code>http://localhost:8000</code> or set up your web server to point to <code>/public</code>.</p>

  <hr />

  <h2>🪟 Python WebSocket Setup on Windows (ComfyUI Portable)</h2>

  <p>
    If you're using the ComfyUI portable version on Windows, it includes an embedded Python interpreter. You can use it to run the WebSocket bridge without installing Python system-wide.
  </p>

  <h3>1. Install Required Packages</h3>
  <pre><code>.\python.exe -m pip install websocket-client flask</code></pre>
  <p>(Run from <code>ComfyUI/python_embeded</code> directory)</p>

  <h3>2. Move the WebSocket Folder</h3>
  <p>Place the <code>websocket</code> directory next to the main ComfyUI folder, like this:</p>
  <pre><code>D:\ComfyUI\websocket</code></pre>

  <h3>3. Start the WebSocket Server</h3>
  <pre><code>cd D:\ComfyUI
.\python_embeded\python.exe websocket\websocket.py</code></pre>
  <p>This starts the server Laravel will communicate with.</p>

  <hr />

  <h2>💡 Why Use a Python WebSocket Instead of Direct PHP API Calls?</h2>

  <p>
    Connecting directly from Laravel to ComfyUI's REST API isn't ideal because PHP cannot easily detect when ComfyUI has finished generating an image.
  </p>

  <p>
    Polling the <code>/history</code> endpoint with timeouts is inefficient and unreliable. PHP's synchronous nature makes it a poor fit for such real-time workflows.
  </p>

  <p>
    The WebSocket bridge solves this by listening for completion events from ComfyUI and sending the result back to Laravel asynchronously.
  </p>

  <blockquote>
    If you know a better or more efficient way to handle this, contributions are welcome!
  </blockquote>

  <hr />

  <h2>📂 Notes</h2>
  <ul>
    <li>The <code>.env</code> file is included but stripped of secrets.</li>
    <li><code>vendor/</code> and <code>node_modules/</code> directories are excluded. Use <code>composer install</code> and <code>npm install</code> after cloning.</li>
  </ul>

  <hr />

  <h2>🤝 Contributing</h2>
  <p>Feel free to open issues or submit pull requests. Any help is appreciated!</p>

  <hr />

  <h2>📝 License</h2>
  <p>This project is open-source and freely available for use and modification.</p>
