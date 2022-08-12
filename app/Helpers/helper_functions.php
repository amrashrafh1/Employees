<?php

use Illuminate\Support\Facades\Storage;

if(!function_exists('upload_image')) {
    function upload_image($image, $path)
    {
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($path, $image, $image_name);
        return $path . '/' . $image_name;
    }
}