<?php

use App\Http\Controllers\CoachsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/







Route::get('test', function () {

    $array =
        [
            'username'=>'ابوالفضل هادی پور',

            'phoneNumber'=>'09353096075',

            'روز اول' => [
                'پرس پا ماشین' => '4*3',
                'پرس بالا سینه' => '4*3',
                'پرس سینه' => '4*3',
                'فلای' => '4*3',
                'شنا سوِئدی' => '4*3',
                'اسکوات' => '4*3',
                'جلو بازو لاری' => '4*3',
                'فیله کمر' => '4*3',
                'پرس سرشانه' => '4*12'
            ],
            'روز دوم' => [
                'پرس پا ماشین' => '4*3',
                'پرس بالا سینه' => '4*3',
                'پرس سینه' => '4*3',
                'فلای' => '4*3',
                'شنا سوِئدی' => '4*3',
                'اسکوات' => '4*3',
                'جلو بازو لاری' => '4*3',
                'فیله کمر' => '4*3',
                'پرس سرشانه' => '4*12'
            ],
            'روز سوم' => [
                'پرس پا ماشین' => '4*3',
                'پرس بالا سینه' => '4*3',
                'پرس سینه' => '4*3',
                'فلای' => '4*3',
                'شنا سوِئدی' => '4*3',
                'اسکوات' => '4*3',
                'جلو بازو لاری' => '4*3',
                'فیله کمر' => '4*3',
                'پرس سرشانه' => '4*12'
            ]
        ];



    //save program file

    // $jsonString = json_encode($array);

    // $filePath=storage_path('app/public/programs/array.json');

    // File::put($filePath,$jsonString);

    // echo 'true';






















    //encode
    // $json=json_encode($array);
    // $json=gzdeflate($json);
    // $encode=base64_encode($json);
    // dd($encode);

    //q1YqSS0uUbJSMtEyVtJRiik1MDNPBZHGhmDSWAFEGVmASXMQaWICYStA5EFkcjJYwgxMmhMyjHw9UCETJMcg6zc0UqoFAA==

    //jVBBDoMwDPvKlOPEgSYpZXsLF1SNH+w08XdEXKkpbGIXS3Fix8mHpnc/pNeOEgzlVilOVmhEYX3dMWfjB3qS3oW6XzY8VqWqsxTxNobpyuxSo8HvwXAzgPDQNkHUcsbeGmgvX/TlBSaZH1UInud2ONc0Op7eIewaPjNuPmzW4G6HJfKXGBHK/15YKLezeWdgWjc=

    //decode
    // $base64=base64_decode('q1YqSS0uUbJSMtEyVtJRiik1MDNPBZHGhmDSWAFEGVmASXMQaWICYStA5EFkcjJYwgxMmhMyjHw9UCETJMcg6zc0UqoFAA==');
    // $gzinflate=gzinflate($base64);
    // $json=json_decode($gzinflate);
    // dd($json);
});
