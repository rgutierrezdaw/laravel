@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="page-wrapper bg-dark p-t-100 p-b-50">
                    <div class="wrapper wrapper--w900">
                        <div class="card card-6">
                            @if(session()->exists('loadFail'))
                            <div class = "card-heading">
                                <h3>{{session('loadFail')}}}</h3>
                            </div>
                            @endif
                            <div class="card-heading">
                                <h2 class="title">Subir nuevo video</h2>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('load') }}" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="name">Título</div>
                                        <div class="value">
                                            <input class="input--style-6" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">Descripción</div>
                                        <div class="value">
                                            <div class="input-group">
                                                <textarea class="textarea--style-6" name="description" placeholder="Breve descripción del video" maxlength="255"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="name">Archivo de video</div>
                                        <div class="value">
                                            <div class="input-group js-input-file">
                                                <label for="video">Elegir archivo</label>
                                                <input type="file" class="form-control-file label--file" id="video" name="file">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="name">Miniatura</div>
                                        <div class="value">
                                            <div class="input-group js-input-file">
                                                <label for="imagen">Elegir imagen</label>
                                                <input type="file" class="form-control-file label--file" id="image" name="imagen">
                                            </div>
                                            <div class="label--desc">Escoge la miniatura que quieras añadir para la presentación (Opcional)</div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button class="btn btn--radius-2 btn--blue-2" type="submit">Cargar</button>
                                    </div>
                                    <input type = "hidden" name="_token" value="{{csrf_token()}}"/>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
