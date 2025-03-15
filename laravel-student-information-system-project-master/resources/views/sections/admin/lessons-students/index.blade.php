@extends('layouts.default')

@section('content')

    <h1>DERS - ÖĞRENCİ ATAMALARI</h1>

    <div class="tools">
        <a href="{{ route('admin.lessons-students.create') }}" class="btn btn-primary btn-sm">YENİ ATAMA EKLE</a>
    </div>

    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Sömestır</th>
                    <th>Bölüm</th>
                    <th>Ö.No</th>
                    <th>Öğrenci</th>
                    <th>Ders</th>
                    <th>Kredi</th>
                    <th>ÖG</th>
                    <th class="compress"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($lessonsStudents as $lessonStudent)
                    <tr>
                        <td class="nowrap">{{ $lessonStudent->semester }}</td>
                        <td class="nowrap">{{ $lessonStudent->department->name }}</td>
                        <td class="nowrap">{{ $lessonStudent->student->user->username }}</td>
                        <td class="nowrap">{{ $lessonStudent->student->fullname }}</td>
                        <td class="nowrap">{{ $lessonStudent->lesson->lesson_with_code }}</td>
                        <td>{{ $lessonStudent->lesson->credit }}</td>
                        <td class="nowrap">{{ $lessonStudent->lesson->lecturer->fullname }}</td>
                        <td><a href="{{ route('admin.lessons-students.destroy',$lessonStudent->id) }}" data-destroy><i class="fa fa-times fa-fw"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {!! $lessonsStudents->render() !!}




@stop