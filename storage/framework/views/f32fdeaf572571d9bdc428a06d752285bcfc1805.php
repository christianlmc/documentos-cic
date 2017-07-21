<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3>Funcionários
                <?php echo Form::submit('Inserir Funcionário', ['class' => 'btn btn-success pull-right', 'onclick' => 'escolheCargo()']); ?>

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
                    <?php if(session('warning')): ?>
                        <div class="alert alert-danger">
                        <h4>Erro ao inserir funcionário:</h4>
                            <p><?php echo e(session('warning')); ?></p>
                            aqui
                        </div>
                    <?php endif; ?>
                    <?php if(count($funcionarios) > 0): ?>
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
                            <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="<?php echo e($funcionario->id); ?>">
                                <td><?php echo e($funcionario->nome); ?></td>
                                <td><?php echo e($funcionario->lotacao->descricao); ?></td>
                                <td><?php echo e($funcionario->cargo->descricao); ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" onclick="window.location.href='/ocorrencias/<?php echo e($funcionario->id); ?>'">+ Ocorrencia</button>
                                    <button type="button" class="btn btn-primary" onclick="updateFuncionarioById(<?php echo e($funcionario->id); ?>)">Editar</button>
                                    <button type="button" class="btn btn-danger" onclick="deleteFuncionarioById(<?php echo e($funcionario->id); ?>,'<?php echo e($funcionario->nome); ?>')">Excluir</button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <div class="alert alert-info">
                            O banco de dados não possui nenhum funcionário
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('scriptFormularios', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.includes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>