<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Название проекта: <?php echo e($project->title); ?></div>
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
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($task->title); ?></td>
                                <td><?php echo e($task->status->title); ?></td>
                                <td style="text-align:right;">
                                    <a href="/tasks/<?php echo e($task->id); ?>/edit" class="btn btn-success">Edit</a>
                                    <form style="display: inline;" action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <form action="<?php echo e(route('tasks.store')); ?>" method="POST">
                         <?php echo e(csrf_field()); ?>

                         <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Название задачи:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <strong>Статус задачи:</strong>
                                    <?php echo Form::select('status_id', $task_statuses, null, ['class' => 'form-control']); ?>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Добавить задачу</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>