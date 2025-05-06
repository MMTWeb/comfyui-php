<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/** API */
use GuzzleHttp\Client;
/** Helpers */
use App\Helpers\WorkFlow;

class ComfyUiController extends Controller
{
    public function index()
    {

        return view('comfyui');

    }

    public function create(Request $request)
    {

        $comfyUIWebSocker = env('ComfyUIWebSocket');

        $client = new Client(['base_uri' => $comfyUIWebSocker ]); 

        $datas = array(
            
            'seed' => $request->input('seed') !== null ? (int) $request->input('seed') : random_int(0, PHP_INT_MAX),
            'steps' => (int) $request->input('steps'),
            'cfg' =>  (float) $request->input('cfg'),
            'model' => $request->input('model') ?? "flux1-dev-fp8.safetensors",
            'clip-one' => $request->input('clip-one') ?? "t5xxl_fp8_e4m3fn.safetensors",
            'clip-two' => $request->input('clip-two') ?? "clip_l.safetensors",
            'width' => $request->input('width'),
            'height' =>  $request->input('height'),
            'prompt' => $request->input('prompt'),
            'neg_prompt' => $request->input('negative-prompt') ?? "watermark, text",
            
        );

        $workflow = WorkFlow::standardWorkFlow($datas);

        $response = $client->post('/generate', [
            'json' => $workflow
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return response()->json([
            'base64_image' => $data['base64_image']
        ]);

    }


}
