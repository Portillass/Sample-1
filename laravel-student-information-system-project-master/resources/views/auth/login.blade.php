@extends('layouts.auth')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                {!! Form::open(['route'=>'auth.login']) !!}

                <div class="panel panel-default panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <img class="img-responsive" src="/assets/img/logo.png" alt>
                            </div>
                            <div class="col-xs-9">
                                <h2>ÇUKUROVA ÜNİVERSİTESİ</h2>
                                <h1>ÖĞRENCİ BİLGİ SİSTEMİ</h1>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        @if($errors->has())
                            <div class="alert alert-danger">
                                Kullanıcı adı ya da şifre hatalı
                            </div>
                        @endif

                        <div class="form-group">
                            {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Kullanıcı Adı']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::password('password',['class'=>'form-control','placeholder'=>'Şifre']) !!}
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('remember') !!} Beni Hatırla
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Giriş',['class'=>'btn btn-success']) !!}
                        </div>

                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@stop