@extends('layouts.default')

@section('content')

    <h1>DERS DÜZENLE
        <small>{{ $lesson->name }}</small>
    </h1>

    {!! Form::open(['route'=>['admin.lessons.update', $lesson->id],'method'=>'PUT']) !!}

    <div class="tools">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> KAYDET</button>
        <a href="{{ route('admin.departments.index') }}" class="btn btn-default btn-sm">VAZGEÇ</a>
    </div>

    <div class="form-group">
        {!! Form::label('grade','SINIF') !!}
        {!! Form::select('grade',[1=>1,2=>2,3=>3,4=>4],$lesson->grade,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('semester','YARIYIL') !!}
        {!! Form::select('semester',[1=>'Güz',2=>'Bahar'],$lesson->semester,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('name','BÖLÜM ADI') !!}
        {!! Form::text('name',$lesson->name,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('code','KODU') !!}
        {!! Form::text('code',$lesson->code,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('credit','KREDİ') !!}
        {!! Form::text('credit',$lesson->credit,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('lecturer_id','ÖĞRETİM GÖREVLİSİ') !!}
        {!! Form::select('lecturer_id',\App\Lecturer::all()->lists('fullname','id'),$lesson->lecturer_id,['class'=>'form-control']) !!}
    </div>

    {!! Form::hidden('id',$lesson->id) !!}
    {!! Form::close() !!}

@stop