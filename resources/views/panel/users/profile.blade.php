@extends('adminlte::page')

@section('title', 'Ponto Eletrônico')

@section('content_header')
    <div class="container-fluid">
        <h1>Trocar Senha</h1>
        @stop

        @section('content')

            <div class="row">
                <div class="col-md-12">
                    <div>
                        <div class="panel-body">
                            @if(session()->has('message'))
                                <p class="alert alert-success"> {{ session()->get('message') }}</p>
                            @endif
                            {!! Form::open(['route' => ['profile.changePassword']]) !!}
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha Atual</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="senha_atual"
                                           autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Nova Senha</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="nova_senha"
                                           autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Confirmação de
                                    Senha</label>

                                <div class="col-md-6">
                                    <input id="confirmacao_senha" type="password" class="form-control"
                                           name="confirmacao_senha" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Atualizar Senha
                                    </button>
                                </div>
                            </div>
                            {!!  Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

@stop

