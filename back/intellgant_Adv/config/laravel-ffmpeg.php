<?php

return [
    'default_disk' => 'public_out',

    'ffmpeg' => [
        'binaries' => env('FFMPEG_BINARIES', 'D:/home/site/wwwroot/bin/ffmpeg.exe'),
        'threads' => 12,
    ],

    'ffprobe' => [
        'binaries' => env('FFPROBE_BINARIES', 'D:/home/site/wwwroot/bin/ffprobe.exe'),
    ],
    
   

    'timeout' => 3600,
];
