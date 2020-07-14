<?php

namespace App\Http\Traits;

use Intervention\Video\Facades\Image;
use Pbmedia\LaravelFFMpeg\FFMpegFacade as FFMpeg;

trait VideoTrait
{
    function upload_video($file)
    {
        $filename = time().'.'.$file->getclientoriginalextension();
        $path = public_path().DIRECTORY_SEPARATOR.'videos';
        $file->move($path, $filename);
        return url('videos') .'/'. $filename;
    }
}
