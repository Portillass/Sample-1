<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/vendor/vex/css/vex.css">
    <link rel="stylesheet" href="/assets/vendor/vex/css/vex-theme-wireframe.css">
    <link rel="stylesheet" href="/assets/css/app.css">

    <title>ÖBS - Öğrenci Bilgi Sistemi</title>

    <!--[if lt IE 9]>
    <script type="text/javascript">
        window.location = "http://browsehappy.com/";
    </script>
    <![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/assets/vendor/jquery/jquery-2.1.4.min.js"><\/script>')</script>

    <script>
        var _token = '{{ csrf_token() }}';
    </script>


</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Menü</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ÖBS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                @if(Auth::user()->is('admin'))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">TANIMLAMALAR <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.departments.index') }}">BÖLÜMLER</a></li>
                            <li><a href="{{ route('admin.students.index') }}">ÖĞRENCİLER</a></li>
                            <li><a href="{{ route('admin.lecturers.index') }}">ÖĞRETİM GÖRV. (ÖG)</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">DERS İŞLEMLERİ <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.lessons.index') }}">DERSLER</a></li>
                            <li><a href="{{ route('admin.lessons-departments.index') }}">DERS-BÖLÜM ATAMALARI</a></li>
                            <li><a href="{{ route('admin.lessons-students.index') }}">DERS-ÖĞRENCİ ATAMALARI</a></li>
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->is('student'))
                    <li><a href="{{ route('student.lessons.index') }}">Dersler</a></li>
                    <li><a href="{{ route('student.lesson-select.index') }}">Derse Yazılma</a></li>
                @endif

                @if(Auth::user()->is('lecturer'))

                @endif

                @if(Auth::user()->is('secretary'))

                @endif

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-wrench"></i></a></li>
                <li><a href="{{ url('auth/logout') }}"><i class="fa fa-power-off"></i></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {!! Session::get('success') !!}
                </div>
            @endif

            @yield('content')


        </div>
    </div>

    <hr>

    <div class="footer">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-left-note">
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object" src="/assets/img/logo.png" alt="Logo">
                        </div>
                        <div class="media-body">
                            <strong>ÖBS</strong> <span>ÖĞRENCİ BİLGİ SİSTEMİ</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-right-note">
                    REYYAN BÜŞRA ARIK<br>
                    <small>ÇUKUROVA ÜNİVERSİTESİ MÜHENDİSLİK MİMARLIK FAKÜLTESİ<br>
                        BİLGİSAYAR MÜHENDİSLİĞİ 4. SINIF
                    </small>
                    2015
                </div>
            </div>
        </div>
    </div>

</div>

<script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/vendor/vex/js/vex.combined.min.js"></script>
@yield('scripts')
<script src="/assets/js/app.js"></script>
</body>
</html>