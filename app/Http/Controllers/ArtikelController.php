<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ArtikelController extends Controller
{
    public function healthNews()
    {
        $country = "id";
        $category = "health";
        $apiKey = "8b674514515b4cdbbab8b073868b5bce";
        $url = "https://newsapi.org/v2/top-headlines?country={$country}&category={$category}&apiKey={$apiKey}";

        try {
            $response = Http::get($url);
            if ($response->failed()) {
                return response()->json(['error' => 'Unable to access API'], 500);
            }
            $dataBerita = $response->json();
            if ($dataBerita['status'] === "ok") {
                return response()->json(['articles' => $dataBerita['articles']], 200);
            } else {
                return response()->json(['error' => 'Unable to retrieve article data'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
