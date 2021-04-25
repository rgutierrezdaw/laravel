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
                            <a class="nav-link nav-link-4" href="{{ route('home') }}">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row tm-mb-90 tm-gallery">
            <h2 class="col-12 tm-text-primary">
                Usuarios:
            </h2>

            @if($users != null)
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Id</th>
                    <th scope="col">Email</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                @foreach( $users as $user)
                    <tbody>
                      <tr>
                        <td>{{Str::ucfirst($user->name)}}</td>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-secondary"><a href={{route('dropUser/',$user->id)}}>Eliminar</a></button>
                            </div>
                        </td>
                      </tr>

                @endforeach
                </tbody>
               </table>
            @endif
        </div>
    </div>
@endsection
