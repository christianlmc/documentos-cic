@extends('layouts.app')
@extends('layouts.includes')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3>Folgas e feriados
                {!! Form::submit('Adicionar folga/feriado a todos', ['class' => 'btn btn-success pull-right', 'onclick' => 'data_especial_todos()']) !!}
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
                                <td>{{$funcionario->lotacao->descricao}}</td>
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
