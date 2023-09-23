<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use GuzzleHttp\Client;

class CheckController extends Controller
{
    public function showForm()
    {
        $client = new Client();
        $base_url = "https://api.rajaongkir.com/starter/";
        $url_provinsi = $base_url . "province";

        $headers = [
            'key' => env('RAJAONGKIR_API_KEY')
        ];

        $provinsi = $client->request('GET', $url_provinsi, [
            // 'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);

        $decodeprovinsi = json_decode($provinsi->getBody());
        $dataprovinsi = $decodeprovinsi->rajaongkir->results;

        return view('input', compact('dataprovinsi'));
    }

    public function getKota($id)
    {
        $client = new Client();
        $base_url = "https://api.rajaongkir.com/starter/city?province=";
        $url_kota = $base_url . $id;


        $headers = [
            'key' => env('RAJAONGKIR_API_KEY')
        ];

        $kota = $client->request('GET', $url_kota, [
            // 'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);

        $decodekota = json_decode($kota->getBody());
        $datakota = $decodekota->rajaongkir->results;

        return response()->json($datakota);
    }

    public function check(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kota_asal'     => 'required',
                'provinsi_tujuan'     => 'required',
                'kota_tujuan'     => 'required',
                'berat'     => 'required|numeric',
                'kurir'     => 'required',
            ],
            [
                'kota_asal.required' => 'Kota Asal Tidak Valid.',
                'provinsi_tujuan.required' => 'Provinsi Tujuan Tidak Valid.',
                'kota_tujuan.required' => 'Kota Tujuan Tidak Valid.',
                'berat.required' => 'Berat Barang Tidak Valid.',
                'berat.numeric' => 'Berat Barang Tidak Valid.',
                'kurir.required' => 'Kurir Tidak Valid.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $client = new Client();
        $base_url = "https://api.rajaongkir.com/starter/cost";

        $headers = [
            'key' => env('RAJAONGKIR_API_KEY')
        ];

        $data = [
            'origin' => $request->kota_asal,
            'destination' => $request->kota_tujuan,
            'weight' => $request->berat,
            'courier' => $request->kurir,
        ];

        $biaya = $client->request('POST', $base_url, [
            'json' => $data,
            'headers' => $headers,
            'verify'  => false,
        ]);

        $decodebiaya = json_decode($biaya->getBody());
        $databiaya = $decodebiaya->rajaongkir;
        // dd($databiaya);

        return view('list', compact('databiaya'));
    }
}
