<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

define('API_KEY', '5dcae344235fe58b91af0f0ec41c6aab');

class CurrencyController extends Controller
{
    public function apiGet(){
        $client = new Client();

        $url = 'http://api.currencylayer.com/list?access_key='.API_KEY;

        $response = $client->request('GET', $url);

        $currencies = json_decode($response->getBody())->currencies;

        return view('index', compact('currencies'));
    }

    public function apiPost(Request $request){
        $client = new Client();

        $url = 'http://api.currencylayer.com/live?access_key='.API_KEY;
        $response = $client->request('GET', $url);
        $values = json_decode($response->getBody())->quotes;

        $to = $request["secondCur"];
        $toVal = $request["secondCurrency"];

        $from = $request["firstCur"];
        $fromVal = $request["firstCurrency"];
        $message = "";
        if ($fromVal <= 0) $message = "The number must be greater than zero!";

        $url = 'http://api.currencylayer.com/list?access_key='.API_KEY;
        $response = $client->request('GET', $url);
        $currencies = json_decode($response->getBody())->currencies;

        return view('index', compact('currencies', 'values', 'from', 'to', 'fromVal', 'toVal', 'message'));

    }
}
