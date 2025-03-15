@extends('layouts.default')

@section('content')

    <h1>BÖLÜMLER</h1>

    <div class="tools">
        <a href="{{ route('admin.departments.create') }}" class="btn btn-primary btn-sm">YENİ BÖLÜM EKLE</a>
    </div>

    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="compress nowrap">Kodu</th>
                    <th>Bölüm</th>
                    <th class="compress"></th>
                    <th class="compress"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->code }}</td>
                        <td>{{ $department->name }}</td>
                        <td><a href="{{ route('admin.departments.edit',$department->id) }}"><i class="fa fa-pencil fa-fw"></i></a></td>
                        <td><a href="{{ route('admin.departments.destroy',$department->id) }}" data-destroy><i class="fa fa-times fa-fw"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {!! $departments->render() !!}

@stop