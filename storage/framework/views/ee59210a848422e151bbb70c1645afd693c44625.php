<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form>
                        <strong>Текст для поиска:</strong>
                        <input type="text" name="title" placeholder="введите запрос">
                        <strong>Статус задачи:</strong>
                        <?php echo Form::select('status_id', $task_statuses, null, ['placeholder' => '-- все --']); ?>  
                        <input type="submit">      
                    <form>        
                </div>
                <div class="panel-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Название задачи</th>
                            <th>Статус</th>
                            <th>Проект</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($task->title); ?></td>
                                <td><?php echo e($task->status->title); ?></td>
                                <td>
                                    <a target="_blank" href="/projects/<?php echo e($task->project->id); ?>"><?php echo e($task->project->title); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>