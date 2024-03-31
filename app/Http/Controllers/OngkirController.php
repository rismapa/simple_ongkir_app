<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('RAJAONGKIR_APIKEY');
        $this->baseUrl = env('RAJAONGKIR_BASEURL');
    }

    public function index() {
        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get($this->baseUrl.'city');

        $cities = $response['rajaongkir']['results'];

        return view('index', [
            'cities' => $cities,
            'ongkir' => ''
        ]);
    }

    public function store(Request $request) {

        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get($this->baseUrl.'city');

        $responseCost = Http::withHeaders([
            'key' => $this->apiKey,
            ])->post($this->baseUrl.'cost', [
                'origin' => $request->origin,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => $request->courier,
            ]);
            $cities = $response['rajaongkir']['results'];
            $ongkir = $responseCost['rajaongkir']['results'];
            // dd($ongkir);
        return view('index', [
            'ongkir' => $ongkir,
            'cities' => $cities
        ]);
    }
}
