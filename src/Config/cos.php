<?php
return [
    'root' => env('COS_ROOT', "./public/"),
    'bucket' => env('COS_BUCKET'),
    'region' => env('COS_REGION'),
    'app_id' => env('COS_APP_ID'),
    'secret_id' => env('COS_SECRET_ID'),
    'secret_key' => env('COS_SECRET_KEY'),
];
