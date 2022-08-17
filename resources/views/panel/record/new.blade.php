@extends('adminlte::page')

@section('title', 'Ponto Eletrônico')

@section('content_header')
    <div class="container-fluid">
        <h1>Registrar Ponto</h1>
        @if($lastRecord)
            @if($lastRecord->type == \App\Enum\RecordTypeEnum::POINT_START)
                <small>Ponto iniciado em: {{$lastRecord->created_at->format('d/m/Y H:i:s')}}</small>
            @else
                <small>Último Ponto Encerrado em: {{$lastRecord->created_at->format('d/m/Y H:i:s')}}</small>
            @endif
        @endif
        @stop

        @section('content')

            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <div class="panel-body">
                            <h1>{{ Carbon\Carbon::now()->format('d/m/Y - H:i:s') }}</h1>
                            {!!  Form::open(['url'=>'record']) !!}
                            {!! Form::hidden('type',$type) !!}
                            <div class="form-group">
                                {!! Form::submit($buttonText, ['class'=> $buttonClass]) !!}
                            </div>
                            {!!  Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
    </div>

@stop

