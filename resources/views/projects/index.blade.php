@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Мои проекты</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></td>
                                <td style="text-align:right;">
                                    <a href="/projects/{{ $project->id }}/edit" class="btn btn-success">Ред.</a>
                                    <form style="display: inline;" action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br />
                    <a href="/projects/create" class="btn btn-success">Создать проект</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection