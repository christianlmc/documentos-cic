@extends('layouts.app')
@extends('layouts.includes')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3>
                    {!! Form::submit('Adicionar', ['class' => 'btn btn-success pull-right', 'onclick' => 'addDataEspecial()']) !!}
                    Folgas, feriados e férias de {{$funcionario->nome}} <br>
                </h3>
                
                </div>


                <div class="panel-body">
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
                    @if (count($funcionario->datas_especiais) > 0)
                        <table id="table" class="table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Ocorrencia</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            @foreach($funcionario->datas_especiais as $datas_especiais)
                                <tr id="{{$datas_especiais->id}}">
                                    <td>{{$datas_especiais->data}}</td>
                                    <td>{{$datas_especiais->tipo_ocorrencia->descricao}}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="deleteDatasEspeciaisById({{$datas_especiais->id}})">Excluir</button>
                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            Não há folgas, feriados e/ou férias registradas para este usuário
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
    $.fn.dataTable.moment('DD/MM/YYYY');
    $('#table').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
        },
        "order": [[ 0, "desc" ]]
    });
})

function addDataEspecial(){
    $.confirm({
        title: 'Adicionar folga/feriado',
        content: `
        {!! Form::open(['method' => 'POST', 'url' => '/datasespeciais/' . $funcionario->id, 'id' => 'form']) !!}
        <div class="form-group{{ $errors->has('data_tipo') ? ' has-error' : '' }}">
            {!! Form::label('data_tipo', 'Selecione o tipo:') !!}
            {!! Form::select('data_tipo', $tipos_de_data, null, ['id' => 'data_tipo', 'class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger ">{{ $errors->first('data_tipo') }}</small>
        </div>
        <div class="form-group{{ $errors->has('data') ? ' has-error' : '' }}">
            {!! Form::label('data', 'Digite a data:') !!}
            {!! Form::text('data', null, ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
            <small class="text-danger help-block with-errors">{{ $errors->first('data') }}</small>
        </div>
        {!! Form::hidden('funcionarioId', $funcionario->id) !!}
        {!! Form::close() !!}
        `,
        buttons:{
            'add':{
                text: 'Adicionar',
                btnClass: 'btn-green',
                action: function(){
                    $('#form').submit();
                }
            },
            'cancel':{
                text: 'Cancelar',
                btnClass: 'btn-danger',
                action: function(){
                }
            },
        },
        onContentReady: function() {
            $('#form').validator();

            $('#data').mask('d0/mM/0000',{
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

function deleteDatasEspeciaisById($datasEspecialId)
{
    $.confirm({
        title: 'Alerta',
        content: `Tem certeza de que deseja deletar a ocorrência?`,
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
                        url:'/datasespeciais/' + $datasEspecialId,
                        success:function(data){
                            $("#" + $datasEspecialId).remove();
                            $.confirm({
                                title: 'Informação',
                                content: `A folga/feriado foi deletada com sucesso`,
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