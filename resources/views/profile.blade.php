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
                    @if(Auth::user()->hasRole('loader'))
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link nav-link-4" href="{{ route('addVideo') }}">Subir video</a>
                        </li>
                    </ul>
                    @endif
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
            @if(Auth::user()->hasRole('loader'))
            <h2 class="col-12 tm-text-primary">
                Tus vídeos:
            </h2>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <div class="d-flex justify-content-between tm-text-gray">
                    <span>No hay videos publicados :(</span>
                </div>
            </div>
            @elseif (Auth::user()->hasRole('user') || Auth::user()->hasRole('guest') )
            <div class=" col-md-6 col-sm-6 col-12 mb-5">
                <div class="d-flex justify-content-between tm-text-primary">
                    <h3>¿Quieres subir vídeos?</h3>
                </div>
                <br>
                <div class="d-flex justify-content-between text-dark">
                  <h4>Modifica tu cuenta y hazte loader de timewaster!</h4>
                </div>

            </div>
        @endif
        <div class="row justify-content-around col-md-12">
            <h2 class="col-12 tm-text-primary">
                Tus datos de usuario:
            </h2>
            <br><br>
            <form method="POST" action="{{ route('modify') }}" class="rounded border border-info col-md-4">
                <br>
                <h3 class="col-12 tm-text-dark">Modificación de datos:</h3>
                <br>
                <div class="form-group col-md-8">
                    <label for="inputPassword6">Nombre de usuario</label>
                    <input type="text" name="newname" id="inputPassword6" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                    <small id="passwordHelpInline" class="text-muted">
                        Nuevo nombre de usuario.
                    </small>
                </div>
                <div class="form-group col-md-8">
                    <label for="inputPassword6">Email</label>
                    <input type="text" name="newmail" id="inputPassword6" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                    <small id="passwordHelpInline" class="text-muted">
                        Nuevo correo.
                    </small>
                </div>
                <div class="form-group col-md-8">
                  <label for="inputPassword6">Password</label>
                  <input type="password" name="newpassword" id="inputPassword6" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                  <small id="passwordHelpInline" class="text-muted">
                    Nuevo password.
                  </small>
                </div>
                <div class="form-group col-md-8">
                    <label for="inlineFormCustomSelect">Rol de usuario</label>
                        <select name="role" class="form-control mx-sm-3 custom-select col-md-8" id="inlineFormCustomSelect">
                            <option value="user">User</option>
                            <option value="loader">Loader</option>
                        </select>
                </div>
                <div class="form-group col-md-8">
                    <input type="submit" class="btn btn-primary my-1" value="Modificar">
                </div>
                <input type = "hidden" name="_token" value="{{csrf_token()}}"/>
            </form>
            <div class="column justify-content-center col-md-6">
                @if (isset($newData))
                @foreach ($newData as $userData )

                @endforeach
                    @if ($userData->role_id = 2)
                        {{$role = 'User'}}
                        @else
                        {{$role = 'Loader'}}
                    @endif
                        <h3>Has modificado tus datos:</h3>
                        <p>Nombre: {{$userData->name}}</p>
                        <p>Correo: {{$userData->email}}</p>
                        <p>Tipo de usuario: {{$role}} </p>

                @endif
            </div>
        </div>

            @if(isset($data) && $data != null  )
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

            @endif
        </div>
    </div>
@endsection
