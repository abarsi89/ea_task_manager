@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Feladat') }}</div>

                <div class="card-body">

                    @if (Route::current()->getName() == 'tasks.create')
                    <form method="POST" action="{{ route('tasks.store') }}">
                    @else
                    <form method="POST" action="{{ route('tasks.update', ['task' => $task->id]) }}">
                        {{ method_field('PUT') }}
                    @endif

                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Feladat neve') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $task->name ?? '' }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="due_date" class="col-md-4 col-form-label text-md-end">{{ __('Határidő') }}</label>

                            <div class="col-md-6">
                                <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ $task->due_date ?? '' }}" required autocomplete="due_date">

                                @error('due_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Leírás') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ $task->description ?? '' }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="priority_id" class="col-md-4 col-form-label text-md-end">{{ __('Prioritás') }}</label>

                            <div class="col-md-6">
                                <select id="priority_id" class="form-select @error('priority_id') is-invalid @enderror" name="priority_id" value="{{ $task->priority ?? '' }}" required autocomplete="priority_id">
                                    @foreach($priorities as $priority)
                                        <option value="{{ $priority->id }}"
                                            @if (isset($task) && $priority->id == $task->priority_id)
                                                selected
                                            @endif
                                        >{{ $priority->priority}}</option>
                                    @endforeach
                                </select>

                                @error('priority_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if (Route::current()->getName() == 'tasks.edit')
                        <div class="row mb-3">
                            <label for="state_id" class="col-md-4 col-form-label text-md-end">{{ __('Állapot') }}</label>

                            <div class="col-md-6">
                                <select id="state_id" class="form-select @error('state_id') is-invalid @enderror" name="state_id" required autocomplete="state_id">
                                    @foreach($states as $state)
                                        @if ($state->id >= $task->state_id)
                                        <option value="{{ $state->id }}"
                                            @if ($state->id == $task->state_id)
                                                selected
                                            @endif
                                        >{{ $state->state}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="row mb-3">
                            <label for="assigned_to" class="col-md-4 col-form-label text-md-end">{{ __('Hozzárendelve') }}</label>

                            <div class="col-md-6">
                                <select id="assigned_to" class="form-select @error('assigned_to') is-invalid @enderror" multiple name="assigned_to[]" required autocomplete="assigned_to">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                            @if (isset($task) && in_array($user->id, explode(',', $task->assigned_to)))
                                                selected
                                            @endif
                                        >{{ $user->name}}</option>
                                    @endforeach
                                </select>

                                @error('assigned_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if (Route::current()->getName() == 'tasks.edit')
                        <div class="row mb-3">
                            <label for="created_by" class="col-md-4 col-form-label text-md-end">{{ __('Létrehozta') }}</label>

                            <div class="col-md-6">
                                <input id="created_by" type="text" readonly="readonly" class="form-control @error('created_by') is-invalid @enderror" name="created_by" value="{{ App\Models\User::find($task->created_by ?? '')->name }}" required autocomplete="created_by" autofocus disabled>

                                @error('created_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Mentés') }}
                                </button>
                                <a href="{{ route( 'tasks.index' ) }}"><button type="button" class="btn btn-secondary">
                                    {{ __('Vissza') }}
                                </button></a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
