<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/number-one', function () {
    $text = str_split('aaabbcccddeddbzaa');
    $temp = [];
    foreach($text as $item){
        if(array_key_exists($item, $temp)){
            $temp[$item] += 1;
        }else{
            array_push($temp, $item);
        }
    }
    return $temp;
});
Route::post('/number-two', function () {
    $arrayList = collect([9, 3, 7, 8, 2, 6, 1, 4, 10, 2, 2, 3])->sort()->toArray();
    return [...$arrayList];
});
Route::post('/number-three', function (Request $request) {
    $data = [
        'A' => 99900,
        'B' => 49900,
    ];
    $price = $data[$request->type];
    $discount = 0;
    if($request->type == 'A'){
        if($request->day == 'Senin' || $request->day == 'Kamis'){
            $discount += 10;
        }
        if($request->qty > 50){
            $discount += 5;
        }
    }else{
        if($request->day == 'Jumat'){
            $discount += 5;
        }
        if($request->qty > 100){
            $discount += 10;
        }
    }
    $totalPrice = $price * $request->qty * $discount / 100;
    return ['totalPrice' => $totalPrice];
});
