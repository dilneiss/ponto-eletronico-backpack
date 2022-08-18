@extends('adminlte::page')

@section('title', 'Ponto Eletrônico')

@section('content_header')
    <div class="container-fluid">
        <h1>Usuários</h1>
        <a class="btn btn-success" href="{{route('users.create')}}" title="Cadastrar Usuário">
            <i class="fa fa-plus-circle"></i> Cadastrar Novo
        </a>
        @stop

        @section('content')
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
            @endif
            <table class="table table-bordered table-responsive-lg">
                <tr>
                    <th>Name</th>
                    <th>Nível</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->Role->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>

                            <form action="{{route('users.destroy', [$user->id])}}" method="POST">

                                <a href="{{route('users.edit', [$user->id])}}">
                                    <i class="fa fa-edit fa-lg"></i>
                                </a>

                                @csrf
                                @method('DELETE')
                                <button type="submit" title="delete"
                                        style="border: none; background-color:transparent;">
                                    <i class="fa fa-trash fa-lg text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

    {!! $users->links() !!}

@stop