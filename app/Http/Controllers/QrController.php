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

        $qr = \QrCode::format('png');
        $qr->size($qr_size);
        $qr->errorCorrection($qr_correction);
        $qr->style($qr_style)->eye($qr_eye);
        $qr->merge('../public/logo.png', .3, true);
        $qr->generate($body, '../public/qr_images/' . $slug);

        $QR = \QrCode::generate($body);
        return back()->with([
            'status' => "QR Generated successfully",
            'QR' => $QR,
            'slug' => $slug
        ]);
    }
}

