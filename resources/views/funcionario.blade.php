@extends('layouts.app')
@extends('layouts.includes')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3>Funcionários
                {!! Form::submit('Inserir Funcionário', ['class' => 'btn btn-success pull-right', 'onclick' => 'escolheCargo()']) !!}
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
                    @if (session('warning'))
                        <div class="alert alert-danger">
                        <h4>Erro ao inserir funcionário:</h4>
                            <p>{{ session('warning') }}</p>
                            aqui
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
                                    <button type="button" class="btn btn-warning" onclick="window.location.href='/ocorrencias/{{$funcionario->id}}'">+ Ocorrencia</button>
                                    <button type="button" class="btn btn-primary" onclick="updateFuncionarioById({{$funcionario->id}})">Editar</button>
                                    <button type="button" class="btn btn-danger" onclick="deleteFuncionarioById({{$funcionario->id}},'{{$funcionario->nome}}')">Excluir</button>
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

@include('scriptFormularios')
@endsection
