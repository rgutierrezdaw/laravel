@extends('layouts.app')

@section('content')

    <div class="container">

        <div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            {{ __('You are logged in!') }}
            @if(session()->exists('loadDone'))
                <div class = "card-heading">
                    <h3>{{session('loadDone')}}</h3>
                </div>
            @endif
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link nav-link-4" href="{{ route('addVideo') }}">Subir video</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link nav-link-4" href="{{ route('home') }}">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row tm-mb-90 tm-gallery">
            <h2 class="col-12 tm-text-primary">
                Tus vídeos:
            </h2>

            @if($data != null)
                @foreach( $data as $video)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                        <figure class="effect-ming tm-video-item">
                            <img src="../img/img-06.jpg" alt="Image" class="img-fluid">
                            <figcaption class="d-flex align-items-center justify-content-center">
                                <h2>{{$video->title}}</h2>
                                <a href="{{route('viewVideo/',$video->id)}}">Reproducir</a>
                            </figcaption>
                        </figure>
                        <div class="d-flex justify-content-between tm-text-gray">
                            <span>Fecha de subida: {{$video->created_at}}</span>
                        </div>
                        <button class="form-file-button bg-danger"><a href="{{route('delete/',$video->id)}}">Borrar</a></button>
                    </div>
                @endforeach
            @else
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5"
                <div class="d-flex justify-content-between tm-text-gray">
                    <span>No hay videos publicados :(</span>
                </div>
            @endif
        </div>
    </div>
@endsection
