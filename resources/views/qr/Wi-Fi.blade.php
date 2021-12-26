@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('QR Builder') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-8">
                                <form method="post" action="{{route('wifi.builder')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="ssid">WiFi ssid</label>
                                            <input id="ssid" class="form-control" type="text" name="ssid"
                                                   placeholder="ssid"
                                                   value="{{old('ssid')}}"/>
                                            @error('ssid')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password">WiFi password</label>
                                            <input id="password" class="form-control" type="text" name="password"
                                                   placeholder="password"
                                                   value="{{old('password')}}"/>
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="hidden"
                                               id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Hidden WiFi</label>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="qr_size">QR Size</label>
                                                <select class="form-control" id="qr_size" required name="qr_size">
                                                    <option value="200">200x200</option>
                                                    <option value="250">250x250</option>
                                                    <option value="300">300x300</option>
                                                </select>
                                                @error('qr_size')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="qr_style">QR Style</label>
                                                <select class="form-control" id="qr_style" required name="qr_style">
                                                    <option value="square">square</option>
                                                    <option value="round">round</option>
                                                    <option value="dot">dot</option>
                                                </select>
                                                @error('qr_style')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="qr_shape">QR Style</label>
                                                <select class="form-control" id="qr_shape" required name="qr_shape">
                                                    <option value="square">square</option>
                                                    <option value="circle">circle</option>
                                                </select>
                                                @error('qr_shape')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-primary">Generate QR Code
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                @if (session('QR'))
                                    {!! session('QR') !!}
                                @endif
                            </div>
                        </div>
                        {{--{!! QrCode::generate('https://business.mrtechnawy.com'); !!}
                        <br>
                        <br>
                        <br>
                        {!! QrCode::generate('Make me into a QrCode!'); !!}
                        <br>
                        <br>
                        <br>
                        {!!
                            QrCode::eye('circle')->format('png')->mergeString(asset('logo.png'))->wiFi([
                            'ssid' => 'Te-A',
                            'encryption' => 'WPA',
                            'password' => '033818645mgahed'
                            ]);
                        !!}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
