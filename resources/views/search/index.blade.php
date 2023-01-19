@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form>
                        <strong>Текст для поиска:</strong>
                        <input type="text" name="title" placeholder="введите запрос">
                        <strong>Статус задачи:</strong>
                        {!! Form::select('status_id', $task_statuses, null, ['placeholder' => '-- все --']) !!}  
                        <input type="submit">      
                    <form>        
                </div>
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
                            <th>Проект</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->status->title }}</td>
                                <td>
                                    <a target="_blank" href="/projects/{{ $task->project->id }}">{{ $task->project->title }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection