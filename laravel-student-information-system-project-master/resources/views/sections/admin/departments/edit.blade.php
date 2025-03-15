@extends('layouts.default')

@section('content')

    <h1>BÖLÜM DÜZENLE <small>{{ $department->name }}</small></h1>

    {!! Form::open(['route'=>['admin.departments.update', $department->id],'method'=>'PUT']) !!}

    <div class="tools">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> KAYDET</button>
        <a href="{{ route('admin.departments.index') }}" class="btn btn-default btn-sm">VAZGEÇ</a>
    </div>

    <div class="form-group">
        {!! Form::label('name','BÖLÜM ADI') !!}
        {!! Form::text('name',$department->name,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('code','KODU') !!}
        {!! Form::text('code',$department->code,['class'=>'form-control']) !!}
    </div>
    {!! Form::hidden('id',$department->id) !!}
    {!! Form::close() !!}

@stop