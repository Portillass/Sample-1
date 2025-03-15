@extends('layouts.default')

@section('content')

    <h1>YENİ BÖLÜM EKLE</h1>

    {!! Form::open(['route'=>'admin.departments.store','method'=>'POST']) !!}

    <div class="tools">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> KAYDET</button>
        <a href="{{ route('admin.departments.index') }}" class="btn btn-default btn-sm">VAZGEÇ</a>
    </div>

    <div class="form-group">
        {!! Form::label('name','BÖLÜM ADI') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('code','BÖLÜM KODU') !!}
        {!! Form::text('code',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::close() !!}

@stop