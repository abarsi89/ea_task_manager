@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Feladat') }}</div>

                <div class="card-body">

                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Feladat neve') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $task->name ?? '' }}" required autocomplete="name" autofocus disabled>

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
                                <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ $task->due_date ?? '' }}" required autocomplete="due_date" disabled>

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
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" disabled>{{ $task->description ?? '' }}</textarea>

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
                                <input id="priority_id" class="form-control @error('priority_id') is-invalid @enderror" name="priority_id" value="{{ App\Models\Priority::find($task->priority_id ?? '')->priority }}" required autocomplete="priority_id" disabled>

                                @error('priority_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="state_id" class="col-md-4 col-form-label text-md-end">{{ __('Állapot') }}</label>

                            <div class="col-md-6">
                                <input id="state_id" class="form-control @error('state_id') is-invalid @enderror" name="state_id" value="{{ App\Models\State::find($task->state_id)->state }}" required autocomplete="state_id" disabled>

                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="assigned_to" class="col-md-4 col-form-label text-md-end">{{ __('Hozzárendelve') }}</label>

                            <div class="col-md-6">
                                <input id="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror" name="assigned_to" value="{{ $task->assigned_to ?? '' }}" required autocomplete="assigned_to" disabled>

                                @error('assigned_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ route( 'tasks.index' ) }}"><button type="button" class="btn btn-secondary">
                                    {{ __('Vissza') }}
                                </button></a>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
