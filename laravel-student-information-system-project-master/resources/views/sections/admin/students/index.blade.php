@extends('layouts.default')

@section('content')

    <h1>ÖĞRENCİLER</h1>

    <div class="tools">
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary btn-sm">YENİ ÖĞRENCİ EKLE</a>
    </div>

    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Adı</th>
                    <th>Soyadı</th>
                    <th>Bölümü</th>
                    <th class="compress"></th>
                    <th class="compress"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->user->username }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->surname }}</td>
                        <td>{{ $student->department->name }}</td>
                        <td><a href="{{ route('admin.students.edit',$student->id) }}"><i class="fa fa-pencil fa-fw"></i></a></td>
                        <td><a href="{{ route('admin.students.destroy',$student->user_id) }}" data-destroy><i class="fa fa-times fa-fw"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {!! $students->render() !!}

@stop