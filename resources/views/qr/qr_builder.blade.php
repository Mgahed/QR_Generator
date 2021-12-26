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
                                <form method="post" action="{{route('qr.builder')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">QR Name</label>
                                        <input id="name" class="form-control" type="text" name="name"
                                               placeholder="ex: MrTechnawy Link"
                                               value="{{old('name')}}"/>
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="body">QR Content</label>
                                        <input id="body" class="form-control" type="text" name="body"
                                               placeholder="ex: https://mrtechnawy.com"
                                               value="{{old('body')}}"/>
                                        @error('body')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
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
                                @if (session('slug'))
                                    {!! session('QR') !!}
                                    {{--<a target="_blank" href="{{asset('qr_images/'.session('slug'))}}">
                                        <img style="width:100%;" src="{{asset('qr_images/'.session('slug'))}}"
                                             alt="{{session('slug')}}">
                                    </a>--}}
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
