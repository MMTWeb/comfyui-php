  <h1>🚀 Laravel-ComfyUI Bridge</h1>

  <p>This Laravel app connects to <a href="https://github.com/comfyanonymous/ComfyUI" target="_blank">ComfyUI</a> using a WebSocket bridge written in Python. It allows you to generate images via Laravel by sending instructions to ComfyUI.</p>

  <hr>

  <h2>📦 Requirements</h2>
  <ul>
    <li>PHP 8.1+</li>
    <li>Laravel 10.x</li>
    <li>Node.js & NPM</li>
    <li>Composer</li>
    <li>Python 3.x (for WebSocket bridge)</li>
    <li>ComfyUI installed and running</li>
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
  
  <h3>5. Generate App Key</h3>
  <pre><code>php artisan key:generate</code></pre>

  <h3>6. Run Laravel Migrations (if any)</h3>
  <pre><code>php artisan migrate</code></pre>

  <h3>7. Start the Laravel App</h3>
  <pre><code>php artisan serve</code>, (e.g., <code>http://localhost/public</code>) or (e.g., <code>http://localhost:3000</code>) </pre>

  <hr>

  <h2>🔌 WebSocket Bridge (Python)</h2>
  <p>Make sure your WebSocket server is running to connect Laravel with ComfyUI. You can find it in:</p>
  <pre><code>/path-to-your-project/ws-server.py</code></pre>

  <p>Start it with:</p>
  <pre><code>python3 ws-server.py</code></pre>

  <p>Make sure the URL matches what's defined in your <code>.env</code> file (e.g., <code>WS_SERVER_URL=ws://localhost:8765</code>).</p>

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
