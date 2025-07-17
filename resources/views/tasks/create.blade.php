@extends('layouts.dashboard')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Task</h3>
                <p class="text-subtitle text-muted">Handle Employee Task</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Task</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h3>Add New Task</h3>
                    <p>Please fill out the form below</p>
                </div>

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="form-label"><b>Title</b></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            name="title" id="title" value="{{ old('title') }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label"><b>Description</b></label>
                        <textarea name="description" id="description" rows="5"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="due_date" class="form-label"><b>Due Date</b></label>
                        <input type="datetime-local" name="due_date" id="due_date"
                            class="form-control @error('due_date') is-invalid @enderror"
                            value="{{ old('due_date') }}" required>
                        @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label"><b>Status</b></label>
                        <select name="status" id="status"
                            class="form-control @error('status') is-invalid @enderror" required>
                            <option value="">-- Select Status --</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="on progress" {{ old('status') == 'on progress' ? 'selected' : '' }}>On Progress</option>
                            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="assigned_to" class="form-label"><b>Employee</b></label>
                        <select name="assigned_to" id="assigned_to"
                            class="form-control @error('assigned_to') is-invalid @enderror" required>
                            <option value="">-- Select Employee --</option>
                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('assigned_to') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->fullname }}
                            </option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create New Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back To List</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection