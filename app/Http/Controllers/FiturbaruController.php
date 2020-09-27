<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FiturbaruController extends Controller
{
    public function aritmatika()
    {
        return view('Fiturbaru.aritmatika');
    }
    public function aritmatika_cari(Request $request)
    {
        $suku1 = $request->suku1;
        $suku2 = $request->suku2;
        $suku3 = $request->suku3;
        $nilaisuku1 = $request->nilaisuku1;
        $nilaisuku2 = $request->nilaisuku2;
        $nilaisuku3 = $request->nilaisuku3;
        $b = $request->selisih;
        $unn = $request->un;
        $jumlah=0;
        for ($i=1; $i < $unn+1 ; $i++) { 
            $urutan[] = $i;
        }
        $type = $request->type;
        foreach ($urutan as $key => $value) {
                if ($type==1){
                    //cari Un
                    $sukux = $value - $suku1;
                    $ux = $sukux * $b;
                    $unr = $nilaisuku1 + $ux; 
                    //cari U1
                    $sukux1 = 1 - $suku1;
                    $ux1 = $sukux1 * $b;
                    $u1 = $nilaisuku1 + $ux1;
                    //rumus
                    $rumus1 = $b * -1;
                    $rumus2 = $b."n";
                    $rumus3 = $u1 + $rumus1;
                    $rumus = $rumus2."+(".$rumus3.")";
                    $jumlah += $unr;
                }elseif ($type==2){
                    //cari selisih
                    $sukub = $suku2 - $suku1;
                    $nilaisukub = $nilaisuku2 - $nilaisuku1;
                    $b = $nilaisukub/$sukub;
                    //cari un 
                    $sukux = $value - $suku1;
                    $ux = $sukux * $b;
                    $unr = $nilaisuku1 + $ux;
                    // cari u1
                    $sukux1 = 1 - $suku1;
                    $ux1 = $sukux1 * $b;
                    $u1 = $nilaisuku1 + $ux1;
                    //rumus
                    $rumus1 = $b * -1;
                    $rumus2 = $b."n";
                    $rumus3 = $u1 + $rumus1;
                    $rumus = $rumus2."+(".$rumus3.")";
                    $jumlah += $unr;
                }elseif ($type==3) {
                    //tingkat1
                    $tingkat1a = $nilaisuku2 - $nilaisuku1;
                    $tingkat1b = $nilaisuku3 - $nilaisuku2;
                    $tingkat2 = $tingkat1b - $tingkat1a;
                    //cari a dan b
                    $u1 = $tingkat2/2;
                    $rb1 = 3 * $u1;
                    $b = $tingkat1a - $rb1;
                    // cari jawaban un
                    $unx = pow($value,2);  //ben ga lali pow iku pangkat oeke
                    $un1 = $u1 * $unx;
                    $un2 = $b * $value;
                    $unr = $un1 + $un2;
                    //cari rumusnya
                    $jumlah += $unr;
                    $rumus = "an<sup>2</sup>+bn";
                }
        }
        return response()->json([
            'rumus' => $rumus, 
            'un' => $unr,
            'u1' => $u1,
            'unn'=> $unn,
            'b' => $b,
            'sn' => $jumlah
        ]);
    }
    public function geometri()
    {
        return view('Fiturbaru.geomtri');
    }
    public function geometri_cari(Request $request)
    {
        $suku1 = $request->suku1;
        $suku2 = $request->suku2;
        $nilaisuku1 = $request->nilaisuku1;
        $nilaisuku2 = $request->nilaisuku2;
        $unn = $request->un;
        $rasio = $request->rasio;
        $type = $request->type;
        $jumlah=0;
        for ($i=1; $i < $unn+1 ; $i++) { 
            $urutan[] = $i;
        }
        foreach ($urutan as $key => $value) {
            if ($type==1) {
                //rumus
                $rumus="un = ar<sup>n-1</sup>";
                //mencari r
                $sukux = $suku2-$suku1;
                $nilaix = $nilaisuku2/$nilaisuku1;
                $r = pow($nilaix,1/$sukux);
                //mencari un
                $unx = $value-$suku2;
                $unx1 = pow($r,$unx);
                $unr = $nilaisuku2 *$unx1;
                //cari u1
                $ux = 1-$suku2;
                $ux1 = pow($r,$ux);
                $u1 = $nilaisuku2 *$ux1;
                //jumlah
                $jumlah += $unr;
            }
            elseif($type==2){
                //rumus
                $rumus="un = ar<sup>n-1</sup>";
                //raasio
                $r = $rasio;
                //mencari un
                $unx = $value-$suku1;
                $unx1 = pow($r,$unx);
                $unr = $nilaisuku1 *$unx1;
                //cari u1
                $ux = 1-$suku1;
                $ux1 = pow($rasio,$ux);
                $u1 = $nilaisuku1 *$ux1;
                //jumlah
                $jumlah += $unr;

            }
        }
        return response()->json([
            'rumus' => $rumus, 
            'un' => $unr,
            'u1' => $u1,
            'unn'=> $unn,
            'b' => $r,
            'sn' => $jumlah,
        ]);
    }
    public function cek()
    {
        $oke = '/indonesia/provinsi' ;
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://api.kawalcorona.com'.$oke);
        $response = $request->getBody()->getContents();

        $h = json_decode($response,true);
        foreach ($h as $key => $value) {
            $u[] = array(
                "provinsi"=>$value['attributes']['Provinsi'],
            );
        }
        dd($u);
    }
}
