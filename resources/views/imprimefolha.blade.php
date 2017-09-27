@extends('layouts.app')
@extends('layouts.includes')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3>Folhas de Ponto
                {!! Form::submit('Imprimir multiplos', ['class' => 'btn btn-success pull-right', 'onclick' => 'escolherFolhas()']) !!}
                </h3>
                </div>

                <div class="panel-body">
                    @if (count($funcionarios) > 0)
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Lotação</th>
                                <th>Cargo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($funcionarios as $funcionario)
                            <tr id="{{$funcionario->id}}">
                                <td>{{$funcionario->nome}}</td>
                                <td>{{$funcionario->lotacao->sigla}}</td>
                                <td>{{$funcionario->cargo->descricao}}</td>
                                <td>
                                    {{-- @if($funcionario->cargo->descricao == 'Estagiário')
                                    <button type="button" onclick="window.location.href='/imprimefolha/estagiario/{{$funcionario->id}}'" class="btn btn-warning">Imprimir</button>
                                    @elseif($funcionario->cargo->descricao == 'Servidor')
                                    <button type="button" onclick="window.location.href='/imprimefolha/servidor/{{$funcionario->id}}'" class="btn btn-warning">Imprimir</button>
                                    @elseif($funcionario->cargo->descricao == 'Professor')
                                    <button type="button" onclick="window.location.href='/imprimefolha/professor/{{$funcionario->id}}'" class="btn btn-warning">Imprimir</button>
                                    @endif --}}
                                    @if($funcionario->cargo->descricao == 'Estagiário')
                                        <button type="button" onclick="selecionarMes({{$funcionario->id}},'{{$funcionario->cargo->descricao}}')" class="btn btn-warning">Imprimir</button>
                                    @elseif($funcionario->cargo->descricao == 'Servidor')
                                        <button type="button" onclick="selecionarMes({{$funcionario->id}},'{{$funcionario->cargo->descricao}}')" class="btn btn-warning">Imprimir</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-info">
                            O banco de dados não possui nenhum funcionário
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $.noConflict();
    
    $('#table').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
        },
    });
});

function selecionarMes($funcionario_id, $cargo){
    $.confirm({
        title: 'Selecione o mês:',
        content: `
        <div class="form-group{{ $errors->has('mes') ? ' has-error' : '' }}">
            {!! Form::label('mes', 'Mês de Referência') !!}
            {!! Form::select('mes', $meses, date('m-Y', strtotime("-1 months")), ['id' => 'mes', 'class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('mes') }}</small>
        </div>
        `,
        buttons:{
            'escolher':{
                text: 'Escolher',
                btnClass: 'btn-success',
                action: function(){
                    $cargo = RemoveAccents($cargo).toLowerCase();
                    window.location.href='/imprimefolha/' + $cargo + '/' + $funcionario_id + '/' + $("#mes").val();
                }
            },
            'cancel':{
                text: 'Cancelar',
                btnClass: 'btn-danger',
                action: function(){
                }
            },
        },
        backgroundDismiss: true,
        }
    );
}

function escolherFolhas (){
    $.confirm({
        columnClass: 'medium',
        title: 'Escolher por:',
        content: `
        `,
        buttons:{
            'supervisor':{
                text: 'Supervisor',
                btnClass: 'btn-dark',
                action: function(){
                    porSupervisor();
                }
            },
            'lotacao':{
                text: 'Lotação',
                btnClass: 'btn-dark',
                action: function(){
                    porLotacao();
                }
            },
            'cargo':{
                text: 'Cargo',
                btnClass: 'btn-dark',
                action: function(){
                    porCargo();
                }
            },
            'cancel':{
                text: 'Cancelar',
                btnClass: 'btn-danger',
                action: function(){
                }
            },
        },
        backgroundDismiss: true,
    });
}


function porSupervisor(){
    $.confirm({
        columnClass: 'medium',
        title: 'Selecione o supervisor:',
        content: `
        <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
            {!! Form::label('supervisor', 'Supervisor') !!}
            {!! Form::select('supervisor', $supervisores , null, ['id' => 'supervisor', 'class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('supervisor') }}</small>
        </div>
        <b>Cargo dos funcionários</b>
        <div id='radio-group'>
            @foreach($cargos as $id => $descricao)
            <div class="radio{{ $errors->has('cargo') ? ' has-error' : '' }}">
                <label for='radio_{{$id}}'>
                    {!! Form::radio('cargo', $descricao,  true, ['id' => 'radio_'.$id ]) !!} {{$descricao}}
                </label>
                <small class="text-danger">{{ $errors->first('cargo') }}</small>
            </div>
            @endforeach
        </div>
        <div class="form-group{{ $errors->has('mes') ? ' has-error' : '' }}">
            {!! Form::label('mes', 'Mês de Referência') !!}
            {!! Form::select('mes', $meses, date('m-Y', strtotime("-1 months")), ['id' => 'mes', 'class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('mes') }}</small>
        </div>
        `,
        buttons:{
            'escolher':{
                text: 'Escolher',
                btnClass: 'btn-success',
                action: function(){
                    var $cargo = $('input[name=cargo]:checked', '#radio-group').val().split(" ");
                    $cargo = RemoveAccents($cargo[0]).toLowerCase();
                    window.location.href='/imprimefolha/' + $cargo + '/supervisor/' + $("#supervisor").val() + '/' + $("#mes").val();
                }
            },
            'cancel':{
                text: 'Cancelar',
                btnClass: 'btn-danger',
                action: function(){
                }
            },
        },
        backgroundDismiss: true,
    });
}


function porLotacao(){
     $.confirm({
        columnClass: 'medium',
        title: 'Selecione a lotação:',
        content: `
        <div class="form-group{{ $errors->has('lotacao') ? ' has-error' : '' }}">
            {!! Form::label('lotacao', 'Lotação') !!}
            {!! Form::select('lotacao', $lotacoes, null, ['id' => 'lotacao', 'class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('lotacao') }}</small>
        </div>
        <b>Cargo dos funcionários</b>
        <div id='radio-group'>
            @foreach($cargos as $id => $descricao)
            <div class="radio{{ $errors->has('cargo') ? ' has-error' : '' }}">
                <label for='radio_{{$id}}'>
                    {!! Form::radio('cargo', $descricao,  true, ['id' => 'radio_'.$id ]) !!} {{$descricao}}
                </label>
                <small class="text-danger">{{ $errors->first('cargo') }}</small>
            </div>
            @endforeach
        </div>
        <div class="form-group{{ $errors->has('mes') ? ' has-error' : '' }}">
            {!! Form::label('mes', 'Mês de Referência') !!}
            {!! Form::select('mes', $meses, date('m-Y', strtotime("-1 months")), ['id' => 'mes', 'class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('mes') }}</small>
        </div>
        `,
        buttons:{
            'escolher':{
                text: 'Escolher',
                btnClass: 'btn-success',
                action: function(){
                    var $cargo = $('input[name=cargo]:checked', '#radio-group').val().split(" ");
                    $cargo = RemoveAccents($cargo[0]).toLowerCase();
                    window.location.href='/imprimefolha/'+ $cargo + '/lotacao/' + $("#lotacao").val() + '/' + $("#mes").val();
                }
            },
            'cancel':{
                text: 'Cancelar',
                btnClass: 'btn-danger',
                action: function(){
                }
            },
        },
        backgroundDismiss: true,
    });
}

function porCargo(){
    $.confirm({
        columnClass: 'medium',
        title: 'Selecione o cargo:',
        content: `
        <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
            {!! Form::label('cargo', 'Cargo') !!}
            {!! Form::select('cargo', $cargos, null, ['id' => 'cargo', 'class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('cargo') }}</small>
        </div>
        <div class="form-group{{ $errors->has('mes') ? ' has-error' : '' }}">
            {!! Form::label('mes', 'Mês de Referência') !!}
            {!! Form::select('mes', $meses, date('m-Y', strtotime("-1 months")), ['id' => 'mes', 'class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('mes') }}</small>
        </div>
        `,
        buttons:{
            'escolher':{
                text: 'Escolher',
                btnClass: 'btn-success',
                action: function(){
                    window.location.href='/imprimefolha/cargo/' + $("#cargo").val() + '/' + $("#mes").val();
                }
            },
            'cancel':{
                text: 'Cancelar',
                btnClass: 'btn-danger',
                action: function(){
                }
            },
        },
        backgroundDismiss: true,
    });
}

function RemoveAccents(str) {
    var accents    = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
    var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz";
    str = str.split('');
    var strLen = str.length;
    var i, x;
    for (i = 0; i < strLen; i++) {
        if ((x = accents.indexOf(str[i])) != -1) {
            str[i] = accentsOut[x];
        }
    }
    return str.join('');
}
</script>

@endsection
