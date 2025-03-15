@extends('layouts.default')

@section('content')

    <h1>ÖĞRETİM GÖREVLİLERİ</h1>

    <div class="tools">
        <a href="{{ route('admin.lecturers.create') }}" class="btn btn-primary btn-sm">YENİ ÖĞRETİM GÖREVLİSİ EKLE</a>
    </div>

    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Adı</th>
                    <th>Soyadı</th>
                    <th>Bölümü</th>
                    <th>Email</th>
                    <th class="compress"></th>
                    <th class="compress"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($lecturers as $lecturer)
                    <tr>
                        <td>{{ $lecturer->name }}</td>
                        <td>{{ $lecturer->surname }}</td>
                        <td>{{ $lecturer->department->name }}</td>
                        <td>{{ $lecturer->user->username }}</td>
                        <td><a href="{{ route('admin.lecturers.edit',$lecturer->id) }}"><i class="fa fa-pencil fa-fw"></i></a></td>
                        <td><a href="{{ route('admin.lecturers.destroy',$lecturer->user_id) }}" data-destroy><i class="fa fa-times fa-fw"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {!! $lecturers->render() !!}

@stop