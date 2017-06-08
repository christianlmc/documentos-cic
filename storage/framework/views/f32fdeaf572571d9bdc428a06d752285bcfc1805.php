<?php $__env->startSection('content'); ?>
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
        <?php echo Form::open(['method' => 'POST', 'url' => 'funcionario', 'id' => 'form']); ?>

            <div class="form-group<?php echo e($errors->has('nome') ? ' has-error' : ''); ?>">
                <?php echo Form::label('nome', 'Nome'); ?>

                <?php echo Form::text('nome', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Fulano de tal']); ?>

                <small class="text-danger"><?php echo e($errors->first('nome')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('matricula_fub') ? ' has-error' : ''); ?>">
                <?php echo Form::label('matricula_fub', 'Matrícula FUB'); ?>

                <?php echo Form::text('matricula_fub', null, ['class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('matricula_fub')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('matricula_siape') ? ' has-error' : ''); ?>">
                <?php echo Form::label('matricula_siape', 'Matrícula SIAPE'); ?>

                <?php echo Form::text('matricula_siape', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('matricula_siape')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('periodo_inicio') ? ' has-error' : ''); ?>">
                <?php echo Form::label('periodo_inicio', 'Periodo Início'); ?>

                <?php echo Form::text('periodo_inicio', null, ['class' => 'form-control', 'data-provide' => 'datepicker' ]); ?>

                <small class="text-danger"><?php echo e($errors->first('periodo_inicio')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('periodo_fim') ? ' has-error' : ''); ?>">
                <?php echo Form::label('periodo_fim', 'Período Fim'); ?>

                <?php echo Form::text('periodo_fim', null, ['class' => 'form-control', 'data-provide' => 'datepicker' ]); ?>

                <small class="text-danger"><?php echo e($errors->first('periodo_fim')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('hora_inicio') ? ' has-error' : ''); ?>">
                <?php echo Form::label('hora_inicio', 'Hora Início'); ?>

                <?php echo Form::number('hora_inicio', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('hora_inicio')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('hora_fim') ? ' has-error' : ''); ?>">
                <?php echo Form::label('hora_fim', 'Hora Fim'); ?>

                <?php echo Form::number('hora_fim', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('hora_fim')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('lotacao') ? ' has-error' : ''); ?>">
                <?php echo Form::label('lotacao', 'Lotação'); ?>

                <?php echo Form::select('lotacao',$lotacoes, null, ['id' => 'lotacao', 'class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('lotacao')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('cargo') ? ' has-error' : ''); ?>">
                <?php echo Form::label('cargo', 'Cargo'); ?>

                <?php echo Form::select('cargo',$cargos, null, ['id' => 'cargo', 'class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('cargo')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('supervisor') ? ' has-error' : ''); ?>">
                <?php echo Form::label('supervisor', 'Supervisor'); ?>

                <?php echo Form::select('supervisor',$funcionarios, null, ['id' => 'supervisor', 'class' => 'form-control', 'required' => 'required']); ?>

                <small class="text-danger"><?php echo e($errors->first('supervisor')); ?></small>
            </div>
        <?php echo Form::close(); ?>

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
                <?php echo Form::submit('Inserir Funcionário', ['class' => 'btn btn-success pull-right', 'onclick' => 'inserir()']); ?>

                </h3>
                </div>

                <div class="panel-body">
                    <?php if(count($errors) > 0): ?> 
                        <div class="alert alert-danger">
                            <h4>Erro ao inserir funcionário:</h4>
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($funcionario); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="span5 col-md-5" id="sandbox-container">
                        <input type="text" class="form-control" id="periodo_inicio">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.includes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>