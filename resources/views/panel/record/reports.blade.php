@extends('adminlte::page')

@section('title', 'Ponto Eletrônico')

@section('content_header')
    <div class="container-fluid">
        <h1>Relatório de Pontos</h1>
        @stop

        @section('content')

            <div class="row">
                <div class="col-md-12">

                    {!!  Form::open(['url'=>'reports', 'method' => 'get']) !!}

                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <input type="date" name="date_start" class="form-control" value="{{request('date_start')}}">
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <input type="date" name="date_end" class="form-control" value="{{request('date_end')}}">
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1">
                        {!! Form::submit('Filtrar', ['class'=> 'btn btn-success']) !!}
                    </div>

                    {!!  Form::close() !!}

                    <div class="text-center">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered" style="background-color: #fff;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Idade</th>
                                    <th>Nome do Gestor</th>
                                    <th>Data Registro</th>
                                    <th>Tipo de Ponto</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->role_name}}</td>
                                        <td>{{\Carbon\Carbon::parse($user->birthdate)->diffInYears()}}</td>
                                        <td>{{$user->owner_name ?  : '-'}}</td>
                                        <td>{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y - H:i:s')}}</td>
                                        <td>{{\App\Enum\RecordTypeEnum::getName($user->type)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>

@stop