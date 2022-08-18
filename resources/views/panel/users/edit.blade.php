@extends('adminlte::page')

@section('title', 'Ponto Eletrônico')

@section('adminlte_js')
    <script src="{{ asset('js/find_cep.js') }}"></script>
@stop

@section('content_header')
    <div class="container-fluid">
        <div class="pull-left">
            <h1>Editar Usuário</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{route('users.index')}}" title="Voltar"> <i
                        class="fa fa-backward "></i></a>
        </div>
        @stop

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif

        @section('content')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', [$user->id]) }}" method="POST">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>E-mail:</strong>
                            <input class="form-control" name="email" placeholder="Email"
                                   value="{{old('email', $user->email)}}">
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Nome:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Nome"
                                   value="{{old('name', $user->name)}}">
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>CPF:</strong>
                            <input type="text" name="cpf" class="form-control" placeholder="Cpf"
                                   value="{{old('cpf', $user->cpf)}}">
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Data de Nascimento:</strong>
                            <input type="date" name="birhdate" class="form-control" placeholder="Data de Nascimento"
                                   value="{{old('birhdate', $user->birhdate->format('Y-m-d'))}}">
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>Cep:</strong>
                            <input type="text" name="zip_code" class="form-control" placeholder="Cep"
                                   onblur="buscaCep(this)" maxlength="8" value="{{old('zip_code', $user->zip_code)}}">
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5">
                        <div class="form-group">
                            <strong>Cidade:</strong>
                            <input type="text" name="city" class="form-control city" placeholder="Cidade"
                                   value="{{old('city', $user->city)}}">
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>Estado:</strong>
                            <input type="text" name="uf" class="form-control uf" placeholder="Estado"
                                   value="{{old('uf', $user->uf)}}">
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>Bairro:</strong>
                            <input type="text" name="district" class="form-control district" placeholder="Bairro"
                                   value="{{old('district', $user->district)}}">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Logradouro:</strong>
                            <input type="text" name="address" class="form-control address" placeholder="Logradouro"
                                   value="{{old('address', $user->address)}}">
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>Número:</strong>
                            <input type="text" name="address_number" class="form-control" placeholder="Nº"
                                   value="{{old('address_number', $user->address_number)}}">
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Complemento:</strong>
                            <input type="text" name="complement" class="form-control" placeholder="Complemento"
                                   value="{{old('complement', $user->complement)}}">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Alterar Senha: (Informe se estiver alterando a senha)</strong>
                            <input type="password" name="senha" class="form-control" placeholder="Senha">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Confirmação de Senha:</strong>
                            <input type="password" name="confirmacao_senha" class="form-control"
                                   placeholder="Confirme a Senha">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>

            </form>

@stop