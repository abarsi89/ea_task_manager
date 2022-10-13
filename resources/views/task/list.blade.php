@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Feladatok') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route( 'tasks.create' ) }}"><button type="button" class="btn btn-success">
                        {{ __('Új feladat') }}
                    </button></a>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">{{ __('Feladat neve') }}</th>
                            <th scope="col">{{ __('Határidő') }}</th>
                            <th scope="col">{{ __('Leírás') }}</th>
                            <th scope="col">{{ __('Prioritás') }}</th>
                            <th scope="col">{{ __('Állapot') }}</th>
                            <th scope="col">{{ __('Hozzárendelve') }}</th>
                            <th scope="col">{{ __('Létrehozta') }}</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td><a href="{{ route('tasks.show', $task->id) }}" title="@lang('messages.detail')">{{ $task->name }}</a></td>
                                    <td>{{ $task->due_date }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ App\Models\Priority::find($task->priority_id)->priority }}</td>
                                    <td>{{ App\Models\State::find($task->state_id)->state }}</td>
                                    <td>
                                        @foreach ($task->users as $assignedUser)
                                        {{ $assignedUser->name.', ' }}
                                        @endforeach
                                    </td>
                                    <td>{{ App\Models\User::find($task->created_by)->name }}</td>
                                    <td>
                                        <a href="{{ route( 'tasks.edit', ['task' => $task->id] ) }}"><button type="button" data-toggle="tooltip" title="{{ __('Szerkesztés') }}" class="btn btn-primary float-left">
                                            {{ __('Szerkesztés') }}
                                        </button></a>
                                        <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit" data-toggle="tooltip" title="{{ __('Törlés') }}" class="btn btn-danger float-left">
                                                {{ __('Törlés') }}
                                            </button>
                                        </form>
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
