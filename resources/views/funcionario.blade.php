@extends('layouts.app')
@extends('layouts.includes')

@section('content')
<script>
$(document).ready(function(){
    $.noConflict();
    // $('#periodo_inicio').datepicker({
    //     format: "dd/mm/yyyy",
    //     language: "pt-BR",
    // });

    $('#periodo_inicio').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR"
    });
    
});


function inserir(){
    $.confirm({
    title: 'Inserir Funcionário',
    content: `
        {!! Form::open(['method' => 'POST', 'url' => 'funcionario', 'id' => 'form']) !!}
            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Fulano de tal']) !!}
                <small class="text-danger">{{ $errors->first('nome') }}</small>
            </div>
            <div class="form-group{{ $errors->has('matricula_fub') ? ' has-error' : '' }}">
                {!! Form::label('matricula_fub', 'Matrícula FUB') !!}
                {!! Form::text('matricula_fub', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('matricula_fub') }}</small>
            </div>
            <div class="form-group{{ $errors->has('matricula_siape') ? ' has-error' : '' }}">
                {!! Form::label('matricula_siape', 'Matrícula SIAPE') !!}
                {!! Form::text('matricula_siape', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('matricula_siape') }}</small>
            </div>
            <div class="form-group{{ $errors->has('periodo_inicio') ? ' has-error' : '' }}">
                {!! Form::label('periodo_inicio', 'Periodo Início') !!}
                {!! Form::text('periodo_inicio', null, ['class' => 'form-control', 'data-provide' => 'datepicker' ]) !!}
                <small class="text-danger">{{ $errors->first('periodo_inicio') }}</small>
            </div>
            <div class="form-group{{ $errors->has('periodo_fim') ? ' has-error' : '' }}">
                {!! Form::label('periodo_fim', 'Período Fim') !!}
                {!! Form::text('periodo_fim', null, ['class' => 'form-control', 'data-provide' => 'datepicker' ]) !!}
                <small class="text-danger">{{ $errors->first('periodo_fim') }}</small>
            </div>
            <div class="form-group{{ $errors->has('hora_inicio') ? ' has-error' : '' }}">
                {!! Form::label('hora_inicio', 'Hora Início') !!}
                {!! Form::number('hora_inicio', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('hora_inicio') }}</small>
            </div>
            <div class="form-group{{ $errors->has('hora_fim') ? ' has-error' : '' }}">
                {!! Form::label('hora_fim', 'Hora Fim') !!}
                {!! Form::number('hora_fim', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('hora_fim') }}</small>
            </div>
            <div class="form-group{{ $errors->has('lotacao') ? ' has-error' : '' }}">
                {!! Form::label('lotacao', 'Lotação') !!}
                {!! Form::select('lotacao',$lotacoes, null, ['id' => 'lotacao', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('lotacao') }}</small>
            </div>
            <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                {!! Form::label('cargo', 'Cargo') !!}
                {!! Form::select('cargo',$cargos, null, ['id' => 'cargo', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('cargo') }}</small>
            </div>
            <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
                {!! Form::label('supervisor', 'Supervisor') !!}
                {!! Form::select('supervisor',$funcionarios, null, ['id' => 'supervisor', 'class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('supervisor') }}</small>
            </div>
        {!! Form::close() !!}
        `,
        onContentReady: function() {
            $('#periodo_inicio').datepicker({
                format: "dd/mm/yyyy",
                language: "pt-BR"
            });

            $('#periodo_fim').datepicker({
                format: "dd/mm/yyyy",
                language: "pt-BR"
            });

        },
    buttons:{
        submit:{
            text: 'Inserir',
            btnClass: 'btn-success',
            action: function(){
                $("#form").submit();          
            }
        },
        cancel:{
            text: 'Cancelar',
            btnClass: 'btn-danger',
            action: function(){

            }
        },
    }
});
}
</script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3>Funcionários
                {!! Form::submit('Inserir Funcionário', ['class' => 'btn btn-success pull-right', 'onclick' => 'inserir()']) !!}
                </h3>
                </div>

                <div class="panel-body">
                    @if (count($errors) > 0) {{-- Caso tenha erro ao inserir funcionário--}}
                        <div class="alert alert-danger">
                            <h4>Erro ao inserir funcionário:</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @foreach($funcionarios as $funcionario)
                        {{$funcionario}}
                    @endforeach
                    <div class="span5 col-md-5" id="sandbox-container">
                        <input type="text" class="form-control" id="periodo_inicio">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
