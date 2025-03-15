@extends('layouts.default')

@section('content')

    <h1>YENİ DERS EKLE</h1>

    {!! Form::open(['route'=>'admin.lessons.store','method'=>'POST']) !!}

    <div class="tools">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> KAYDET</button>
        <a href="{{ route('admin.lessons.index') }}" class="btn btn-default btn-sm">VAZGEÇ</a>
    </div>

    <div class="form-group">
        {!! Form::label('grade','SINIF') !!}
        {!! Form::select('grade',config('obs.grades'),null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('semester','YARIYIL') !!}
        {!! Form::select('semester',config('obs.semesters'),config('obs.current.semester'),['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('name','DERS ADI') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('code','DERS KODU') !!}
        {!! Form::text('code',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('credit','KREDİ') !!}
        {!! Form::text('credit',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('lecturer_id','ÖĞRETİM GÖREVLİSİ') !!}
        {!! Form::select('lecturer_id',\App\Lecturer::all()->lists('fullname','id'),null,['class'=>'form-control']) !!}
    </div>

    {!! Form::close() !!}

@stop