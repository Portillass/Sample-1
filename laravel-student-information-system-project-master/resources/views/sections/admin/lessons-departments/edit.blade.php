@extends('layouts.default')

@section('content')

    <h1>DERS - BÖLÜM ATAMASI DÜZENLE</h1>

    {!! Form::open(['route'=>['admin.lessons-departments.update',$lessonDepartment->id],'method'=>'PUT']) !!}

    <div class="tools">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> KAYDET</button>
        <a href="{{ route('admin.lessons-departments.index') }}" class="btn btn-default btn-sm">VAZGEÇ</a>
    </div>

    <div class="form-group">
        {!! Form::label('semester','SÖMESTIR') !!}
        {!! Form::select('semester',\App\Helpers\Semester::get(),\App\Helpers\Semester::get($lessonDepartment->semester),['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('lesson_id','DERS') !!}
        {!! Form::select('lesson_id',\App\Lesson::all()->lists('lesson_with_code','id'),$lessonDepartment->lesson_id,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('department_id','BÖLÜM') !!}
        {!! Form::select('department_id',\App\Department::lists('name','id'),$lessonDepartment->department_id,['class'=>'form-control']) !!}
    </div>

    {!! Form::hidden('id',$lessonDepartment->id) !!}
    {!! Form::close() !!}

@stop