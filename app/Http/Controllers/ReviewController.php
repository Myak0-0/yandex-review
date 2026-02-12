<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class ReviewController extends Controller
{
    public function test() {
        $service = new \App\Services\YandexParserService();
        print_r($service->parseReviews('https://yandex.ru/maps/46/kirov/?ll=49.653042%2C58.604155&mode=poi&poi%5Bpoint%5D=49.671920%2C58.610844&poi%5Buri%5D=ymapsbm1%3A%2F%2Forg%3Foid%3D1004752317&tab=reviews&z=14'));
    }
    
    public function index() {
        $url = Setting::where('key', 'yandex_map_url')->value('value');
        if (!$url) return response()->json(['error' => 'Настройте ссылку'], 422);

        $data = (new \App\Services\YandexParserService())->parseReviews($url);
        return response()->json($data);
    }
}
