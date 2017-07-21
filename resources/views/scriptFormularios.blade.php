<script>
$(document).ready(function(){
    $.noConflict();
    $('#table').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
        }
    });
});

function escolheCargo(){
    $.confirm({
        columnClass: 'medium',
        title: 'Selecione o cargo do funcionário',
        content: `
        `,
        buttons:{
            @foreach($cargos as $cargo_id => $cargo)

            '{{$cargo}}':{
                text: '{{$cargo}}',
                btnClass: 'btn-dark',
                action: function(){
                    inserir('{{$cargo}}','{{$cargo_id}}');
                }
            },

            @endforeach            
        },
        backgroundDismiss: true,
    });
}

function deleteFuncionarioById($id, $nome){
    $.confirm({
        title: 'Alerta',
        content: `Tem certeza de que deseja deletar o funcionário ` + $nome + `?`,
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
                        url:'/funcionario/' + $id,
                        success:function(data){
                            $("#" + $id).remove();
                            $.confirm({
                                title: 'O usuário foi deletado',
                                content: data.nome + ` foi deletado com sucesso`,
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

function updateFuncionarioById($id){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        ServerSide: true,
        Processing: true,
        type: 'GET',
        url:'/funcionario/' + $id,
        success:function(funcionario){
            switch(parseInt(funcionario.fk_cargo)) {
                case 1: //Professor - 60h
                $.confirm({
                    title: 'Editar funcionário',
                    content: `
                        {!! Form::open(['method' => 'PUT', 'url' => 'funcionario/`+funcionario.id+`', 'id' => 'form']) !!}

                            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                {!! Form::label('nome', 'Nome') !!}
                                {!! Form::text('nome', '`+funcionario.nome+`', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Fulano de tal', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('nome') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('matricula_fub') ? ' has-error' : '' }}">
                                {!! Form::label('matricula_fub', 'Matrícula FUB') !!}
                                {!! Form::text('matricula_fub', '`+funcionario.matricula_fub+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('matricula_fub') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('matricula_siape') ? ' has-error' : '' }}">
                                {!! Form::label('matricula_siape', 'Matrícula SIAPE') !!}
                                {!! Form::text('matricula_siape', '`+funcionario.matricula_siape+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('matricula_siape') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('periodo_inicio') ? ' has-error' : '' }}">
                                {!! Form::label('periodo_inicio', 'Periodo Início') !!}
                                {!! Form::text('periodo_inicio', '`+funcionario.periodo_inicio+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('periodo_inicio') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('periodo_fim') ? ' has-error' : '' }}">
                                {!! Form::label('periodo_fim', 'Período Fim') !!}
                                {!! Form::text('periodo_fim', '`+funcionario.periodo_fim+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('periodo_fim') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('hora_inicio') ? ' has-error' : '' }}">
                                {!! Form::label('hora_inicio', 'Hora Início') !!}
                                {!! Form::text('hora_inicio', '`+funcionario.hora_inicio+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('hora_inicio') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('hora_fim') ? ' has-error' : '' }}">
                                {!! Form::label('hora_fim', 'Hora Fim') !!}
                                {!! Form::text('hora_fim', '`+funcionario.hora_fim+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('hora_fim') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('lotacao') ? ' has-error' : '' }}">
                                {!! Form::label('lotacao', 'Lotação') !!}
                                {!! Form::select('lotacao',$lotacoes, null, ['id' => 'lotacao', 'class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('lotacao') }}</small>
                            </div>

                            <input type="hidden" name="is_supervisor" value="0" />

                            <input id="cargo" name="cargo" type="hidden" value="` + funcionario.fk_cargo +`">

                            <div class="form-group">
                                <div class="checkbox{{ $errors->has('is_supervisor') ? ' has-error' : '' }}">
                                    <label for="is_supervisor">
                                        {!! Form::checkbox('is_supervisor', '`+funcionario.is_supervisor+`', '`+funcionario.is_supervisor+`', ['id' => 'is_supervisor']) !!} É supervisor
                                    </label>
                                </div>
                                <small class="text-danger">{{ $errors->first('is_supervisor') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
                                {!! Form::label('supervisor', 'Supervisor') !!}
                                {!! Form::select('supervisor',$supervisores, null, ['id' => 'supervisor', 'class' => 'form-control', 'placeholder' => 'Selecione o supervisor']) !!}
                                <small class="text-danger">{{ $errors->first('supervisor') }}</small>
                            </div>
                        {!! Form::close() !!}
                        `,
                    onContentReady: function() {
                        $('#form').validator();

                        $('#periodo_inicio').mask('d0/mM/0000',{
                            'translation': {
                                d: {pattern: /([0-3])/},
                                m: {pattern: /([0-1])/},
                                M: {pattern: /[0-9]/},
                            }
                        });
                        $('#periodo_fim').mask('d0/mM/0000',{
                            'translation': {
                                d: {pattern: /([0-3])/},
                                m: {pattern: /([0-1])/},
                                M: {pattern: /[0-9]/},
                            }
                        });
                        $('#hora_inicio').mask('H0:M0',{
                            'translation': {
                                H: {pattern: /[0-2]/},
                                M: {pattern: /[0-5]/},
                            }
                        });
                        $('#hora_fim').mask('H0:M0',{
                            'translation': {
                                H: {pattern: /[0-2]/},
                                M: {pattern: /[0-5]/},
                            }
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
                    },
                    backgroundDismiss: true,
                });
                break;

                case 2: //Estagiário 30hrs
                $.confirm({
                    title: 'Editar funcionário',
                    content: `
                        {!! Form::open(['method' => 'PUT', 'url' => 'funcionario/`+funcionario.id+`', 'id' => 'form']) !!}

                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            {!! Form::label('nome', 'Nome') !!}
                            {!! Form::text('nome', '`+funcionario.nome+`', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Fulano de tal', 'data-error' => 'Este campo é obrigatório']) !!}
                            <small class="text-danger help-block with-errors">{{ $errors->first('nome') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('periodo_inicio') ? ' has-error' : '' }}">
                            {!! Form::label('periodo_inicio', 'Periodo Início') !!}
                            {!! Form::text('periodo_inicio', '`+funcionario.periodo_inicio+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                            <small class="text-danger help-block with-errors">{{ $errors->first('periodo_inicio') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('periodo_fim') ? ' has-error' : '' }}">
                            {!! Form::label('periodo_fim', 'Período Fim') !!}
                            {!! Form::text('periodo_fim', '`+funcionario.periodo_fim+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                            <small class="text-danger help-block with-errors">{{ $errors->first('periodo_fim') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('hora_inicio') ? ' has-error' : '' }}">
                            {!! Form::label('hora_inicio', 'Hora Início') !!}
                            {!! Form::text('hora_inicio', '`+funcionario.hora_inicio+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                            <small class="text-danger help-block with-errors">{{ $errors->first('hora_inicio') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('hora_fim') ? ' has-error' : '' }}">
                            {!! Form::label('hora_fim', 'Hora Fim') !!}
                            {!! Form::text('hora_fim', '`+funcionario.hora_fim+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                            <small class="text-danger help-block with-errors">{{ $errors->first('hora_fim') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('lotacao') ? ' has-error' : '' }}">
                            {!! Form::label('lotacao', 'Lotação') !!}
                            {!! Form::select('lotacao',$lotacoes, null, ['id' => 'lotacao', 'class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('lotacao') }}</small>
                        </div>

                        <input id="cargo" name="cargo" type="hidden" value="` + funcionario.fk_cargo +`">

                        <input type="hidden" name="is_supervisor" value="0" />

                        <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
                            {!! Form::label('supervisor', 'Supervisor') !!}
                            {!! Form::select('supervisor',$supervisores, null, ['id' => 'supervisor', 'class' => 'form-control', 'placeholder' => 'Selecione o supervisor']) !!}
                            <small class="text-danger">{{ $errors->first('supervisor') }}</small>
                        </div>

                        {!! Form::close() !!}
                    `,
                    onContentReady: function() {
                        $('#form').validator();

                        $('#periodo_inicio').mask('d0/mM/0000',{
                            'translation': {
                                d: {pattern: /([0-3])/},
                                m: {pattern: /([0-1])/},
                                M: {pattern: /[0-9]/},
                            }
                        });
                        $('#periodo_fim').mask('d0/mM/0000',{
                            'translation': {
                                d: {pattern: /([0-3])/},
                                m: {pattern: /([0-1])/},
                                M: {pattern: /[0-9]/},
                            }
                        });
                        $('#hora_inicio').mask('H0:M0',{
                            'translation': {
                                H: {pattern: /[0-2]/},
                                M: {pattern: /[0-5]/},
                            }
                        });
                        $('#hora_fim').mask('H0:M0',{
                            'translation': {
                                H: {pattern: /[0-2]/},
                                M: {pattern: /[0-5]/},
                            }
                        });

                    },
                    buttons:{
                        submit:{
                            text: 'Salvar',
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
                    },
                    backgroundDismiss: true,
                });
                break;
                case 3: //Servidor - 40h
                $.confirm({
                    title: 'Editar funcionário',
                    content: `
                        {!! Form::open(['method' => 'PUT', 'url' => 'funcionario/`+funcionario.id+`', 'id' => 'form']) !!}
                            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                {!! Form::label('nome', 'Nome') !!}
                                {!! Form::text('nome', '`+funcionario.nome+`', ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Fulano de tal', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('nome') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('matricula_fub') ? ' has-error' : '' }}">
                                {!! Form::label('matricula_fub', 'Matrícula FUB') !!}
                                {!! Form::text('matricula_fub', '`+funcionario.matricula_fub+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('matricula_fub') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('matricula_siape') ? ' has-error' : '' }}">
                                {!! Form::label('matricula_siape', 'Matrícula SIAPE') !!}
                                {!! Form::text('matricula_siape', '`+funcionario.matricula_siape+`', ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('matricula_siape') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('lotacao') ? ' has-error' : '' }}">
                                {!! Form::label('lotacao', 'Lotação') !!}
                                {!! Form::select('lotacao',$lotacoes, null, ['id' => 'lotacao', 'class' => 'form-control', 'required' => 'required']) !!}
                                <small class="text-danger help-block with-errors">{{ $errors->first('lotacao') }}</small>
                            </div>

                            <input type="hidden" name="is_supervisor" value="0" />

                            <input id="cargo" name="cargo" type="hidden" value="` + funcionario.fk_cargo +`">

                            <div class="form-group">
                                <div class="checkbox{{ $errors->has('is_supervisor') ? ' has-error' : '' }}">
                                    <label for="is_supervisor">
                                        {!! Form::checkbox('is_supervisor', '1', '`+funcionario.is_supervisor+`', ['id' => 'is_supervisor']) !!} É supervisor
                                    </label>
                                </div>
                                <small class="text-danger">{{ $errors->first('is_supervisor') }}</small>
                            </div>

                            <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
                                {!! Form::label('supervisor', 'Supervisor') !!}
                                {!! Form::select('supervisor',$supervisores, null, ['id' => 'supervisor', 'class' => 'form-control', 'placeholder' => 'Selecione o supervisor']) !!}
                                <small class="text-danger">{{ $errors->first('supervisor') }}</small>
                            </div>
                        {!! Form::close() !!}
                    `,
                    onContentReady: function() {
                        $('#form').validator();
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
                    },
                    backgroundDismiss: true,
                });
                break;
                default:
                    console.log('O cargo não existe');
            }
        },
        error: function(error){
            alert("Houve um erro, favor tentar novamente mais tarde.");
            console.log("ERRO:"+ error);
        }
    });
}

function inserir($cargo, $cargo_id){
    switch(parseInt($cargo_id)) {
        case 1: //Professor - 60h
 			formulario_professor($cargo, $cargo_id);
            break;

        case 2: //Estagiário - 30h
        	formulario_estagiario($cargo, $cargo_id);
            break;

        case 3: //Servidor - 40h
            formulario_servidor($cargo, $cargo_id);
            break;

        default:
            console.log($cargo + ' errou');
    }
}

function formulario_professor($cargo, $cargo_id){
    $.confirm({
        title: 'Inserir ' + $cargo,
        content: `
            {!! Form::open(['method' => 'POST', 'url' => 'funcionario', 'id' => 'form']) !!}
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Fulano de tal', 'data-error' => 'Este campo é obrigatório']) !!}
                    <small class="text-danger help-block with-errors">{{ $errors->first('nome') }}</small>
                </div>
                <div class="form-group{{ $errors->has('matricula_fub') ? ' has-error' : '' }}">
                    {!! Form::label('matricula_fub', 'Matrícula FUB') !!}
                    {!! Form::text('matricula_fub', null, ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                    <small class="text-danger help-block with-errors">{{ $errors->first('matricula_fub') }}</small>
                </div>
                <div class="form-group{{ $errors->has('matricula_siape') ? ' has-error' : '' }}">
                    {!! Form::label('matricula_siape', 'Matrícula SIAPE') !!}
                    {!! Form::text('matricula_siape', null, ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                    <small class="text-danger">{{ $errors->first('matricula_siape') }}</small>
                </div>
                <div class="form-group{{ $errors->has('periodo_inicio') ? ' has-error' : '' }}">
                    {!! Form::label('periodo_inicio', 'Periodo Início') !!}
                    {!! Form::text('periodo_inicio', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('periodo_inicio') }}</small>
                </div>
                <div class="form-group{{ $errors->has('periodo_fim') ? ' has-error' : '' }}">
                    {!! Form::label('periodo_fim', 'Período Fim') !!}
                    {!! Form::text('periodo_fim', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('periodo_fim') }}</small>
                </div>
                <div class="form-group{{ $errors->has('hora_inicio') ? ' has-error' : '' }}">
                    {!! Form::label('hora_inicio', 'Hora Início') !!}
                    {!! Form::text('hora_inicio', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('hora_inicio') }}</small>
                </div>
                <div class="form-group{{ $errors->has('hora_fim') ? ' has-error' : '' }}">
                    {!! Form::label('hora_fim', 'Hora Fim') !!}
                    {!! Form::text('hora_fim', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('hora_fim') }}</small>
                </div>
                


                <div class="form-group{{ $errors->has('lotacao') ? ' has-error' : '' }}">
                    {!! Form::label('lotacao', 'Lotação') !!}
                    {!! Form::select('lotacao',$lotacoes, null, ['id' => 'lotacao', 'class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('lotacao') }}</small>
                </div>

                <input id="cargo" name="cargo" type="hidden" value="` + $cargo_id +`">
                <input type="hidden" name="is_supervisor" value="0" />
                <div class="form-group">
                    <div class="checkbox{{ $errors->has('is_supervisor') ? ' has-error' : '' }}">
                        <label for="is_supervisor">
                            {!! Form::checkbox('is_supervisor', '1', null, ['id' => 'is_supervisor']) !!} É supervisor
                        </label>
                    </div>
                    <small class="text-danger">{{ $errors->first('is_supervisor') }}</small>
                </div>

                <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
                    {!! Form::label('supervisor', 'Supervisor') !!}
                    {!! Form::select('supervisor',$supervisores, null, ['id' => 'supervisor', 'class' => 'form-control', 'placeholder' => 'Selecione o supervisor']) !!}
                    <small class="text-danger">{{ $errors->first('supervisor') }}</small>
                </div>
            {!! Form::close() !!}
            `,
        onContentReady: function() {
            $('#form').validator();

            $('#periodo_inicio').mask('d0/mM/0000',{
                'translation': {
                    d: {pattern: /([0-3])/},
                    m: {pattern: /([0-1])/},
                    M: {pattern: /[0-9]/},
                }
            });
            $('#periodo_fim').mask('d0/mM/0000',{
                'translation': {
                    d: {pattern: /([0-3])/},
                    m: {pattern: /([0-1])/},
                    M: {pattern: /[0-9]/},
                }
            });
            $('#hora_inicio').mask('H0:M0',{
                'translation': {
                    H: {pattern: /[0-2]/},
                    M: {pattern: /[0-5]/},
                }
            });
            $('#hora_fim').mask('H0:M0',{
                'translation': {
                    H: {pattern: /[0-2]/},
                    M: {pattern: /[0-5]/},
                }
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
        },
        backgroundDismiss: true,
    });
}
function formulario_estagiario($cargo, $cargo_id){
    $.confirm({
        title: 'Inserir ' + $cargo,
        content: `
            {!! Form::open(['method' => 'POST', 'url' => 'funcionario', 'id' => 'form']) !!}
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::text('nome', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Fulano de tal', 'data-error' => 'Este campo é obrigatório']) !!}
                    <small class="text-danger help-block with-errors">{{ $errors->first('nome') }}</small>
                </div>
                <div class="form-group{{ $errors->has('periodo_inicio') ? ' has-error' : '' }}">
                    {!! Form::label('periodo_inicio', 'Periodo Início') !!}
                    {!! Form::text('periodo_inicio', null, ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                    <small class="text-danger help-block with-errors">{{ $errors->first('periodo_inicio') }}</small>
                </div>
                <div class="form-group{{ $errors->has('periodo_fim') ? ' has-error' : '' }}">
                    {!! Form::label('periodo_fim', 'Período Fim') !!}
                    {!! Form::text('periodo_fim', null, ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                    <small class="text-danger help-block with-errors">{{ $errors->first('periodo_fim') }}</small>
                </div>
                <div class="form-group{{ $errors->has('hora_inicio') ? ' has-error' : '' }}">
                    {!! Form::label('hora_inicio', 'Hora Início') !!}
                    {!! Form::text('hora_inicio', null, ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                    <small class="text-danger help-block with-errors">{{ $errors->first('hora_inicio') }}</small>
                </div>

                <div class="form-group{{ $errors->has('hora_fim') ? ' has-error' : '' }}">
                    {!! Form::label('hora_fim', 'Hora Fim') !!}
                    {!! Form::text('hora_fim', null, ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
                    <small class="text-danger help-block with-errors">{{ $errors->first('hora_fim') }}</small>
                </div>
                <div class="form-group{{ $errors->has('lotacao') ? ' has-error' : '' }}">
                    {!! Form::label('lotacao', 'Lotação') !!}
                    {!! Form::select('lotacao',$lotacoes, null, ['id' => 'lotacao', 'class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger help-block with-errors">{{ $errors->first('lotacao') }}</small>
                </div>

                <input id="cargo" name="cargo" type="hidden" value="` + $cargo_id +`">
                <input type="hidden" name="is_supervisor" value="0" />

                <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
                    {!! Form::label('supervisor', 'Supervisor') !!}
                    {!! Form::select('supervisor',$supervisores, null, ['id' => 'supervisor', 'class' => 'form-control', 'placeholder' => 'Selecione o supervisor']) !!}
                    <small class="text-danger">{{ $errors->first('supervisor') }}</small>
                </div>
            {!! Form::close() !!}
            `,
        onContentReady: function() {
            $('#form').validator();

            $('#periodo_inicio').mask('d0/mM/0000',{
                'translation': {
                    d: {pattern: /([0-3])/},
                    m: {pattern: /([0-1])/},
                    M: {pattern: /[0-9]/},
                }
            });
            $('#periodo_fim').mask('d0/mM/0000',{
                'translation': {
                    d: {pattern: /([0-3])/},
                    m: {pattern: /([0-1])/},
                    M: {pattern: /[0-9]/},
                }
            });
            $('#hora_inicio').mask('H0:M0',{
                'translation': {
                    H: {pattern: /[0-2]/},
                    M: {pattern: /[0-5]/},
                }
            });
            $('#hora_fim').mask('H0:M0',{
                'translation': {
                    H: {pattern: /[0-2]/},
                    M: {pattern: /[0-5]/},
                }
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
        },
        backgroundDismiss: true,
    })
}

function formulario_servidor($cargo, $cargo_id){
	$.confirm({
	    title: 'Inserir ' + $cargo,
	    content: `
	        {!! Form::open(['method' => 'POST', 'url' => 'funcionario', 'id' => 'form']) !!}
	            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
	                {!! Form::label('nome', 'Nome') !!}
	                {!! Form::text('nome', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Fulano de tal', 'data-error' => 'Este campo é obrigatório']) !!}
	                <small class="text-danger help-block with-errors">{{ $errors->first('nome') }}</small>
	            </div>
	            <div class="form-group{{ $errors->has('matricula_fub') ? ' has-error' : '' }}">
	                {!! Form::label('matricula_fub', 'Matrícula FUB') !!}
	                {!! Form::text('matricula_fub', null, ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
	                <small class="text-danger help-block with-errors">{{ $errors->first('matricula_fub') }}</small>
	            </div>
	            <div class="form-group{{ $errors->has('matricula_siape') ? ' has-error' : '' }}">
	                {!! Form::label('matricula_siape', 'Matrícula SIAPE') !!}
	                {!! Form::text('matricula_siape', null, ['class' => 'form-control', 'required' => 'required', 'data-error' => 'Este campo é obrigatório']) !!}
	                <small class="text-danger help-block with-errors">{{ $errors->first('matricula_siape') }}</small>
	            </div>
	            <div class="form-group{{ $errors->has('lotacao') ? ' has-error' : '' }}">
	                {!! Form::label('lotacao', 'Lotação') !!}
	                {!! Form::select('lotacao',$lotacoes, null, ['id' => 'lotacao', 'class' => 'form-control', 'required' => 'required']) !!}
	                <small class="text-danger help-block with-errors">{{ $errors->first('lotacao') }}</small>
	            </div>

	            <input id="cargo" name="cargo" type="hidden" value="` + $cargo_id +`">
	            <input type="hidden" name="is_supervisor" value="0" />
	            <div class="form-group">
	                <div class="checkbox{{ $errors->has('is_supervisor') ? ' has-error' : '' }}">
	                    <label for="is_supervisor">
	                        {!! Form::checkbox('is_supervisor', '1', null, ['id' => 'is_supervisor']) !!} É supervisor
	                    </label>
	                </div>
	                <small class="text-danger">{{ $errors->first('is_supervisor') }}</small>
	            </div>

	            <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
	                {!! Form::label('supervisor', 'Supervisor') !!}
	                {!! Form::select('supervisor',$supervisores, null, ['id' => 'supervisor', 'class' => 'form-control', 'placeholder' => 'Selecione o supervisor']) !!}
	                <small class="text-danger">{{ $errors->first('supervisor') }}</small>
	            </div>
	        {!! Form::close() !!}
	    `,
	    onContentReady: function() {
	        $('#form').validator();
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
	    },
	    backgroundDismiss: true,
	});
}
</script>