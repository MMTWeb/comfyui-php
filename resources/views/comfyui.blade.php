@extends('layouts.main')
@section('content')
<div class="container py-5">

    <div class="col-md-12">

        <div class="card shadow rounded">

            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0 text-center">ComfyUI PHP</h4>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <span id="gpu-temp" class="p-2" style="font-weight:700; color:#757575; font-size:20px;"></span>

                    <div id="loader" class="text-center mt-4 d-none">

                    <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Generating your image...</p>
                    </div>

                    <div id="result" class="p-4 d-none text-center">
                        <img id="generated-image" src="" class="img-fluid rounded shadow border" />
                        <div class="mt-3">
                            <a id="download-link" href="#" class="btn btn-outline-secondary" download="generated-image.jpeg">Download Image</a>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                        
                    <div class="card-body">

                        <form id="generate-form" enctype="multipart/form-data" data-route="{{ route('comfyui.create') }}">

                            @csrf

                            <div class="mb-3">
                                <label for="prompt" class="form-label">Prompt</label>
                                <textarea class="form-control" id="prompt" name="prompt" rows="3" cols="50" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="height" class="form-label">Height</label>
                                    <input type="number" class="form-control" id="height" name="height" value="1024" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="width" class="form-label">Width</label>
                                    <input type="number" class="form-control" id="width" name="width" value="1024" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="steps" class="form-label">Steps</label>
                                    <input type="number" class="form-control" id="steps" name="steps" value="25" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="cfg" class="form-label">CFG (Guidance Scale)</label>
                                    <input type="number" step="0.1" class="form-control" id="cfg" name="cfg" value="1" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="seed" class="form-label">Seed (optional)</label>
                                    <input type="number" class="form-control" id="seed" name="seed">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="negative-prompt" class="form-label">Negative Prompt (optional)</label>
                                <input type="text" class="form-control" id="negative-prompt" name="negative-prompt" placeholder="e.g. watermark, text">
                            </div>

                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model" value="flux1-dev-fp8.safetensors" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="clip-one" class="form-label">Clip 1</label>
                                    <input type="text" class="form-control" id="clip-one" name="clip_one" value="t5xxl_fp8_e4m3fn.safetensors" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="clip-two" class="form-label">Clip 2</label>
                                    <input type="text" class="form-control" id="clip-two" name="clip_two" value="clip_l.safetensors" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div id="generate-button" class="text-start">
                                    <button type="submit" class="btn btn-success px-4">Generate</button>
                                </div>
                            </div>

                        </form>
                    
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection