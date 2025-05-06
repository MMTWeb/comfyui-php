<?php

namespace App\Helpers;

class WorkFlow
{
    
    public static function standardWorkFlow($datas)
    {

        $workflow = [

            "3" => [
                "class_type" => "KSampler",
                "inputs" => [
                    "seed" => $datas['seed'],
                    "steps" => $datas['steps'],
                    "cfg" => $datas['cfg'],
                    "sampler_name" => "euler",
                    "scheduler" => "normal",
                    "denoise" => 1,
                    "model" => ["4", 0],
                    "positive" => ["6", 0],
                    "negative" => ["7", 0],
                    "latent_image" => ["5", 0],
                ],
            ],

            "4" => [
                "class_type" => "CheckpointLoaderSimple",
                "inputs" => [
                    "ckpt_name" => $datas['model'],
                ],
            ],

            "5" => [
                "class_type" => "EmptyLatentImage",
                "inputs" => [
                    "width" => $datas['width'],
                    "height" => $datas['height'],
                    "batch_size" => 1,
                ],
            ],

            "6" => [
                "class_type" => "CLIPTextEncode",
                "inputs" => [
                    "text" => $datas['prompt'],
                    "clip" => ["11", 0],
                ],
            ],

            "7" => [
                "class_type" => "CLIPTextEncode",
                "inputs" => [
                    "text" => $datas['neg_prompt'],
                    "clip" => ["11", 0],
                ],
            ],
            "8" => [
                "class_type" => "VAEDecode",
                "inputs" => [
                    "samples" => ["3", 0],
                    "vae" => ["4", 2],
                ],
            ],

            "9" => [
                "class_type" => "SaveImage",
                "inputs" => [
                    "filename_prefix" => "ComfyUI",
                    "images" => ["8", 0],
                ],
            ],

            "11" => [
                "class_type" => "DualCLIPLoader",
                "inputs" => [
                    "clip_name1" =>  $datas['clip-one'],
                    "clip_name2" =>  $datas['clip-two'],
                    "type" => "flux",
                    "device" => "default",
                ],
            ],

        ];

        return $workflow;   

    }

}

?>