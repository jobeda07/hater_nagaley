<?php

namespace App\Http\Controllers\Backend\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class StendFastCourierController extends Controller
{
    private $base_url;
    public function __construct()
    {
        $this->base_url = "https://portal.packzy.com/api/v1";
    }
    public function bulkCreate($data)
    {
        $response = Http::withHeaders([
            'Api-Key' => env('STENDFAST_API_KEY'),
            'Secret-Key' => env('STENDFAST_SECRET_KEY'),
            'Content-Type' => 'application/json'

        ])->post($this->base_url . '/create_order/bulk-order', [
            'data' => $data,
        ]);
       // dd($response);
        return json_decode($response->getBody()->getContents());
    }
}
