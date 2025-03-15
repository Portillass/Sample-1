@extends('layouts.default')

@section('content')

    <h1>DERS - BÖLÜM ATAMALARI</h1>

    <div class="tools">
        <a href="{{ route('admin.lessons-departments.create') }}" class="btn btn-primary btn-sm">YENİ ATAMA EKLE</a>
    </div>

    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Dönem</th>
                    <th>Sınıf</th>
                    <th>Yarıyıl</th>
                    <th>Ders</th>
                    <th>Bölüm</th>
                    <th class="nowrap">Öğretim Görevlisi</th>
                    <th class="compress"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($lessonsDepartments as $lessonDepartment)
                    <tr>
                        <td>{{ $lessonDepartment->year }}</td>
                        <td>{{ $lessonDepartment->grade }}</td>
                        <td class="nowrap">{{ $lessonDepartment->semester }}</td>
                        <td>{{ $lessonDepartment->lesson->lesson_with_code }}</td>
                        <td>{{ $lessonDepartment->department->name }}</td>
                        <td class="nowrap">{{ $lessonDepartment->lesson->lecturer->fullname }}</td>
                        <td><a href="{{ route('admin.lessons-departments.destroy',$lessonDepartment->id) }}" data-destroy><i class="fa fa-times fa-fw"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {!! $lessonsDepartments->render() !!}




@stop