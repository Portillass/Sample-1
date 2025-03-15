@extends('layouts.default')

@section('content')

    <h1>DERS NOTU İŞLEMLERİ</h1>

    <p>
        <span class="label label-primary">{{ config('obs.current.year') }}</span>
        <span class="label label-warning">{{ config('obs.current.semester') }}. YARIYIL</span>
    </p>




{!! Form::open(['route'=>'lecturer.scores.store','method'=>'POST']) !!}

    <div class="tools">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> KAYDET</button>
    </div>

    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="compress">Ö.No</th>
                    <th class="nowrap">Öğrenci Adı</th>
                    <th class="compress">Vize</th>
                    <th class="compress">Final</th>
                    <th class="compress"></th>
                    <th class="compress"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($scores as $score)
                    <tr>
                        <td>{{ $score->student->user->username }} {!! Form::hidden('student_id[]',$score->student_id) !!}</td>
                        <td>{{ $score->student->fullname }}</td>
                        <td>{!! Form::text('midterm_score[]',$score->midterm_score,['class'=>'form-control score-input']) !!}</td>
                        <td>{!! Form::text('final_score[]',$score->final_score,['class'=>'form-control score-input']) !!}</td>
                        <td>{{ $score->avarage_score }}</td>
                        <td>{{ $score->avarage_score_letter }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="tools">
        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> KAYDET</button>
    </div>

{!! Form::close() !!}

@stop