@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Название проекта: {{ $project->title }}</div>
                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Название задачи</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->status->title }}</td>
                                <td style="text-align:right;">
                                    <a href="/tasks/{{ $task->id }}/edit" class="btn btn-success">Edit</a>
                                    <form style="display: inline;" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <form action="{{ route('tasks.store') }}" method="POST">
                         {{ csrf_field() }}
                         <input type="hidden" name="project_id" value="{{ $project->id }}">
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Название задачи:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <strong>Статус задачи:</strong>
                                    {!! Form::select('status_id', $task_statuses, null, ['class' => 'form-control']) !!}
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
@endsection