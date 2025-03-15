@extends('layouts.default')

@section('content')

    <h1>DERSLER</h1>

    <div class="tools">
        <a href="{{ route('admin.lessons.create') }}" class="btn btn-primary btn-sm">YENİ DERS EKLE</a>
    </div>

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
                    <th class="compress"></th>
                    <th class="compress"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->grade }}</td>
                        <td class="nowrap">{{ $lesson->code }}</td>
                        <td>{{ $lesson->name }}</td>
                        <td>{{ $lesson->credit }}</td>
                        <td>{{ $lesson->lecturer->fullname }}</td>
                        <td><a href="{{ route('admin.lessons.edit',$lesson->id) }}"><i class="fa fa-pencil fa-fw"></i></a></td>
                        <td><a href="{{ route('admin.lessons.destroy',$lesson->id) }}" data-destroy><i class="fa fa-times fa-fw"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {!! $lessons->render() !!}

@stop