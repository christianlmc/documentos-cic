@extends('layouts.app')
@extends('layouts.includes')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3>
                    Ocorrências de {{$funcionario->nome}}
                    {!! Form::submit('Adicionar ocorrência', ['class' => 'btn btn-success pull-right', 'onclick' => 'addOcorrencia()']) !!}
                </h3>
                </div>


                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($errors) > 0) {{-- Caso tenha erro ao adicionar ocorrência--}}
                        <div class="alert alert-danger">
                            <h4>Erro ao adicionar ocorrência:</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (count($ocorrencias) > 0)
                        <table id="table" class="table">
                            <thead>
                                <tr>
                                    <th>Tipo de ocorrencia</th>
                                    <th>Data de inicio</th>
                                    <th>Data de fim</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ocorrencias as $ocorrencia)
                                <tr id="{{$ocorrencia->id}}">
                                    <td>{{$ocorrencia->tipo_Ocorrencia->descricao}}</td>
                                    <td>{{$ocorrencia->data_inicio}}</td>
                                    <td>{{$ocorrencia->data_fim}}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="deleteOcorrenciaById({{$ocorrencia->id}})">Excluir</button>
                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            Não há ocorrencias para este usuário
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
    $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
    });
    $('#table').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
        }
    });
})


function addOcorrencia(){
    $.confirm({
        title: 'Adicionar ocorrência',
        content: `
            {!! Form::open(['method' => 'POST', 'url' => '/ocorrencias', 'id' => 'form', 'data-disable' => "false"]) !!}
                <div class="form-group{{ $errors->has('tipo_ocorrencia') ? ' has-error' : '' }}">
                    {!! Form::label('tipo_ocorrencia', 'Selecione o tipo de ocorrencia') !!}
                    {!! Form::select('tipo_ocorrencia', $tipo_Ocorrencia, null, ['id' => 'tipo_ocorrencia', 'class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                    <small class="text-danger help-block with-errors">{{ $errors->first('tipo_ocorrencia') }}</small>
                </div>
                {!! Form::label('periodo', 'Selecione o período de ocorrencia') !!}
                <div class="input-group input-daterange">
                    <div class="form-group">
                        {!! Form::text('data_inicio', null, ['class' => 'form-control', 'id' => 'data_inicio','required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                    </div>
                    <div class="input-group-addon">até</div>
                    <div class="form-group">
                        {!! Form::text('data_fim', null, ['class' => 'form-control', 'id' => 'data_fim', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                    </div>
                </div>
                {!! Form::hidden('funcionario_id', $funcionario->id) !!}
            {!! Form::close() !!}
        `,
        buttons: {
            salvar: {
                btnClass: 'btn-green',
                action: function (){
                    $('#form').submit();
                }
            },

            cancelar: function () {
            },
        },
        onContentReady: function() {
            $('#form').validator();

            $('#data_inicio').mask('d0/mM/0000',{
                'translation': {
                    d: {pattern: /([0-3])/},
                    m: {pattern: /([0-1])/},
                    M: {pattern: /[0-9]/},
                }
            });
            $('#data_fim').mask('d0/mM/0000',{
                'translation': {
                    d: {pattern: /([0-3])/},
                    m: {pattern: /([0-1])/},
                    M: {pattern: /[0-9]/},
                }
            });
        },
        backgroundDismiss: true,
    });
}

function deleteOcorrenciaById($id){
    $.confirm({
        title: 'Alerta',
        content: `Deletar a ocorrência?`,
        type: 'orange',
        theme: 'modern',
        typeAnimated: true,
        buttons: {
            Sim: {
                btnClass: 'btn-red',
                action: function(){
                    $.ajax({
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        ServerSide: true,
                        Processing: true,
                        dataType: "json",
                        type: 'DELETE',
                        url:'/ocorrencias/' + $id,
                        success:function(data){
                            console.log(data.data_inicio);
                            $("#" + $id).remove();
                            $.confirm({
                                title: 'A ocorrência foi deletada',
                                content: ``,
                                type: 'blue',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'Ok',
                                        btnClass: 'btn-green',
                                        action: function(){
                                        },
                                    },
                                },
                                backgroundDismiss: true,
                            });
                        },
                        error:function(error){
                            alert("Houve um erro, favor tentar novamente mais tarde.");
                            console.log("ERRO:"+ error);
                        }
                    })
                }
            },
            Não: {
                action: function(){
                }
            }
        },
        backgroundDismiss: true,
    });
}

</script>
@endsection