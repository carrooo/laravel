<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function index()
    {
        $api = new \GuzzleHttp\Client();

        $provinsi2 = $api->get('https://api.kawalcorona.com/indonesia/provinsi');
        $provinsi1 = $provinsi2->getBody()->getContents();
        $provinsi = json_decode($provinsi1,false);

        $dunia2 = $api->get('https://corona.lmao.ninja/v2/all');
        $dunia1 = $dunia2->getBody()->getContents();
        $dunia = json_decode($dunia1,false);

        $negara2 = $api->get('https://corona.lmao.ninja/v2/countries/');
        $negara1 = $negara2->getBody()->getContents();
        $negara = json_decode($negara1,false);

        foreach ($negara as $key => $value) {
            $country[] = $value->country;
        }
        foreach ($provinsi as $key => $value) {
            $prov[] = $value->attributes;
        }
        return view('covid.covid',[
            'provinsi' => $prov,
            'negara' => $country,
            'dunia' => $dunia,
        ]);
    }
    public function coviddunia()
    {
        $api = new \GuzzleHttp\Client();

        $dunia2 = $api->get('https://corona.lmao.ninja/v2/all');
        $dunia1 = $dunia2->getBody()->getContents();
        $dunia = json_decode($dunia1,false);

        return view('covid.covid-dunia',[
            'dunia' => $dunia,
        ]);
    }
    public function covidnegara()
    {
        $api = new \GuzzleHttp\Client();

        $negara2 = $api->get('https://corona.lmao.ninja/v2/countries/');
        $negara1 = $negara2->getBody()->getContents();
        $negara = json_decode($negara1,false);

        foreach ($negara as $key => $value) {
            $country[] = $value->country;
        }

        return view('covid.covid-negara',[
            'negara' => $country,
        ]);
    }
    public function covidindoprov()
    {
        $api = new \GuzzleHttp\Client();

        $provinsi2 = $api->get('https://api.kawalcorona.com/indonesia/provinsi');
        $provinsi1 = $provinsi2->getBody()->getContents();
        $provinsi = json_decode($provinsi1,false);
        foreach ($provinsi as $key => $value) {
            $prov[] = $value->attributes;
        }
        return view('covid.covid-indoprov',[
            'provinsi' => $prov,
        ]);
    }
    public function getcovid($negara)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://corona.lmao.ninja/v2/countries/'.$negara);
        $response = $request->getBody()->getContents();
        $hasil = json_decode($response,false);
        //dd($hasil);
        return response()->json([
            'data' => $hasil, 
            'bendera' => $hasil->countryInfo->flag,
        ]);
    }
    public function line($info)
    {
        $api = new \GuzzleHttp\Client();

        $line2 = $api->get('https://corona.lmao.ninja/v2/historical/'.$info);
        $line1 = $line2->getBody()->getContents();
        $line = json_decode($line1,false);
        if($info=="all"){
            foreach ($line->cases as $key => $value) {
                $tanggal[] = $key;
                $valk[] = $value;
            }
            foreach ($line->deaths as $key => $value) {
                $valm[] = $value;
            }
            foreach ($line->recovered as $key => $value) {
                $vals[] = $value;
            }
        }else{
            foreach ($line->timeline->cases as $key => $value) {
                $tanggal[] = $key;
                $valk[] = $value;
            }
            foreach ($line->timeline->deaths as $key => $value) {
                $valm[] = $value;
            }
            foreach ($line->timeline->recovered as $key => $value) {
                $vals[] = $value;
            }
        }
        return response()->json([
            'tanggal' => $tanggal,
            'valuek' => $valk,
            'valuem' => $valm,
            'values' => $vals,
        ]);
    }
    
    
}
