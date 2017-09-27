@extends('layouts.app')
@extends('layouts.includes')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3>Folgas e feriados
                {!! Form::submit('Adicionar folga/feriado a todos', ['class' => 'btn btn-success pull-right', 'onclick' => 'addDataEspecial()']) !!}
                </h3>
                </div>

                <div class="panel-body">
                    @if (count($errors) > 0) {{-- Caso tenha erro ao inserir funcionário--}}
                        <div class="alert alert-danger">
                            <h4>Erro ao adicionar data especial:</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                                    <button type="button" class="btn btn-primary" onclick="window.location.href='/datasespeciais/{{$funcionario->id}}'">Editar folgas/feriados</button>
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
function addDataEspecial(){
    $.confirm({
        title: 'Adicionar folga/feriado a todos',
        content: `
        {!! Form::open(['method' => 'POST', 'url' => '/datasespeciais/', 'id' => 'form']) !!}
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

function datas_funcionario($funcionarioId){
    $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        ServerSide: true,
        Processing: true,
        dataType: "json",
        type: 'GET',
        url:'/datasespeciais/' + $funcionarioId,
        success:function(funcionario){
            $.confirm({
                title: 'Editar folgas e feriados:',
                content: `` + funcionario.nome + `
                `,
                buttons:{
                    'alterar':{
                        text: 'Alterar',
                        btnClass: 'btn-green',
                        action: function(){
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
        },
        error:function(error){
            alert("Houve um erro, favor tentar novamente mais tarde.");
            console.log("ERRO:"+ error);
        }
    })
    
}


</script>

@endsection
