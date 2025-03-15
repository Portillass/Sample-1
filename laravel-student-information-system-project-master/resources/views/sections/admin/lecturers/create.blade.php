@extends('layouts.default')

@section('content')

    <h1>YENİ ÖĞRETİM GÖREVLİSİ EKLE</h1>

    {!! Form::open(['route'=>'admin.lecturers.store','method'=>'POST']) !!}

    <div class="tools">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> KAYDET</button>
        <a href="{{ route('admin.lecturers.index') }}" class="btn btn-default btn-sm">VAZGEÇ</a>
    </div>

    <div class="form-group">
        {!! Form::label('department_id','BÖLÜM') !!}
        {!! Form::select('department_id',\App\Department::lists('name','id'),null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('name','ADI') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('surname','SOYADI') !!}
        {!! Form::text('surname',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('username','EMAIL') !!}
        {!! Form::email('username',null,['class'=>'form-control']) !!}
        <span class="help-block">Kullanıcı adı olarak kullanılacak</span>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('password','ŞİFRE') !!}
                {!! Form::password('password',['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('password_confirmation','ŞİFRE TEKRAR') !!}
                {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
            </div>
        </div>
    </div>




    {!! Form::close() !!}

@stop