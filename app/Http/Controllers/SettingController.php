<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function update(Request $request) {
        Setting::updateOrCreate(['key' => 'yandex_map_url'], ['value' => $request->url]);
    }
}
