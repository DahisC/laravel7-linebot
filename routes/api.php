<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/line', function (Request $request) {
    $log = json_encode($request->all()['events'][0]['message']['text']);
    error_log($log);

    $replyToken = $request->all()['events'][0]['replyToken'];
    Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => "Bearer vkrdeC+NEFx+PP3wACGtkPLW6jp8IhemWWi+SJMQAtFvhZWRFiG2ffqftj2T8vU7+dTjthXL632bF4Gp4igWwleU1hQxyCQSR+H/swmyIO7J7DGl6WxQKFN/R1b7DqwOl/tJibmgkwLp0UG9N8uiYAdB04t89/1O/w1cDnyilFU="
    ])->post('https://api.line.me/v2/bot/message/reply', [
        'replyToken' => $replyToken,
        "messages" => [
            [
                "type" => "text",
                "text" => "Hello, user"
            ]
        ]
    ]);
    return response('OK', 200);
});
