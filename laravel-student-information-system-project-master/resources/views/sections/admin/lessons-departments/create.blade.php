@extends('layouts.default')

@section('content')

    <h1>YENİ DERS - BÖLÜM ATAMASI EKLE</h1>

    {!! Form::open(['route'=>'admin.lessons-departments.store','method'=>'POST']) !!}

    <div class="tools">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> KAYDET</button>
        <a href="{{ route('admin.lessons-departments.index') }}" class="btn btn-default btn-sm">VAZGEÇ</a>
    </div>

    <div class="form-group">
        {!! Form::label('year','DÖNEM') !!}
        {!! Form::select('year',config('obs.years'),config('obs.current.year'),['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('semester','YARIYIL') !!}
        {!! Form::select('semester',config('obs.semesters'),config('obs.current.semester'),['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('lesson_id','DERS') !!}
        {!! Form::select('lesson_id',\App\Lesson::all()->lists('lesson_with_code','id'),null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('department_id','BÖLÜM') !!}
        {!! Form::select('department_id',\App\Department::lists('name','id'),null,['class'=>'form-control']) !!}
    </div>

    {!! Form::close() !!}

@stop