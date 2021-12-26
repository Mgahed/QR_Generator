<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QrController extends Controller
{
    public function index()
    {
        return view('qr.qr_builder');
    }

    public function qr_builder(Request $request)
    {
        $rules = [
            'name' => 'required',
            'body' => 'required',
            'qr_size' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $name = $request->name;
        $body = $request->body;
        $qr_size = $request->qr_size;
        $qr_style = $request->qr_style;
        $qr_eye = $request->qr_shape;
        $qr_correction = 'H';
        /*$qr_color = $request->qr_color;*/
        /*$qr_encoding = 'UTF-8';*/

        $slug = \Str::slug($name) . '.png';

//        $qr = \QrCode::format('png');
//        $qr = \QrCode::size($qr_size);
//        $qr->errorCorrection($qr_correction);
//        $qr->style($qr_style)->eye($qr_eye);
//        $qr->merge('../public/logo.png', .3, true);
//        $qr->generate($body, '../public/qr_images/' . $slug);

//        $QR = \QrCode::generate($body);
        return back()->with([
            'status' => "QR Generated successfully",
            'QR' => \QrCode::size($qr_size)->errorCorrection($qr_correction)->style($qr_style)->eye($qr_eye)->generate($body),
            'slug' => $slug
        ]);
    }

    public function wifi_view()
    {
        return view('qr.Wi-Fi');
    }

    public function wifi_builder(Request $request)
    {
        $rules = [
            'ssid' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $ssid = $request->ssid;
        $password = $request->password;
        $hidden = $request->hidden;
        $qr_size = $request->qr_size;
        $qr_style = $request->qr_style;
        $qr_eye = $request->qr_shape;
        $qr_correction = 'H';

        $qr = \QrCode::size($qr_size);
        $qr->errorCorrection($qr_correction);
        $qr->style($qr_style)->eye($qr_eye);
        $qr->merge('../public/logo.png', .3, true);
        $body = $qr->wiFi([
            'encryption' => 'WPA/WEP',
            'ssid' => $ssid,
            'password' => $password,
            'hidden' => $hidden !== NULL ? 'true' : 'false'
        ]);

        return back()->with([
            'status' => "QR Generated successfully",
            'QR' => $body,
        ]);
    }
}

