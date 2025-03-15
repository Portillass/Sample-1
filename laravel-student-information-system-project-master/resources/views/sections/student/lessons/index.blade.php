@extends('layouts.default')

@section('content')

    <h1>DERSLER</h1>

    <p>
        <span class="label label-primary">{{ config('obs.current.year') }}</span>
        <span class="label label-warning">{{ config('obs.current.semester') }}. YARIYIL</span>
    </p>

    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="compress">Sınıf</th>
                    <th class="compress nowrap">Kodu</th>
                    <th>Ders</th>
                    <th>Kredi</th>
                    <th>ÖG</th>
                    <th class="compress">Vize</th>
                    <th class="compress">Final</th>
                    <th class="compress">Not</th>
                    <th class="compress"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->grade }}</td>
                        <td class="nowrap">{{ $lesson->lesson->code }}</td>
                        <td>{{ $lesson->lesson->name }}</td>
                        <td>{{ $lesson->lesson->credit }}</td>
                        <td>{{ $lesson->lesson->lecturer->fullname }}</td>
                        <td>{{ $lesson->score->midterm_score }}</td>
                        <td>{{ $lesson->score->final_score }}</td>
                        <td><strong class="text-primary">{{ $lesson->score->avarage_score }}</strong></td>
                        <td>{{ $lesson->score->avarage_score_letter }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



@stop