@extends('layouts.default')

@section('content')

    <h1>DERSE YAZILMA</h1>

    <p>
        <span class="label label-primary">{{ config('obs.current.year') }}</span>
        <span class="label label-warning">{{ config('obs.current.semester') }}. YARIYIL</span>
    </p>

    <div class="row">
        <div class="col-sm-2">
            <div class="credit-left">
                <span>KALAN KREDİ</span>
                <span>{{ config('obs.total-credit') - $totalCredit }}</span>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Dönem</th>
                            <th>Yarıyıl</th>
                            <th>Ders</th>
                            <th>Kredi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessons as $lesson)
                            <?php
                            $selected = !in_array($lesson->lesson_id, $selectedLessonsIDListArray) ? false : true;
                            ?>
                            <tr @if($selected) class="success" @endif>
                                <td class="compress">
                                    @if(!$selected)
                                        <a href="{{ route('student.lesson-select.toggle',$lesson->lesson_id) }}">
                                            <i class="fa fa-toggle-off fa-lg"></i>
                                        </a>
                                    @else
                                        <a class="text-success"
                                           href="{{ route('student.lesson-select.toggle',$lesson->lesson_id) }}">
                                            <i class="fa fa-toggle-on fa-lg"></i>
                                        </a>
                                    @endif
                                </td>
                                <td class="compress nowrap">{{ $lesson->year }}</td>
                                <td class="compress">{{ $lesson->semester }}</td>
                                <td class="nowrap">{{ $lesson->lesson->lesson_with_code }}</td>
                                <td>{{ $lesson->lesson->credit }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>






@stop