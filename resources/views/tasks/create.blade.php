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
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Task</li>
                            <li class="breadcrumb-item active" aria-current="page">Index</li>
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
                        <h3>Add Form Task</h3>
                        <p>Please input the field</p>
                    </div>

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="" class="form-label"><b>title</b></label>
                            <input type="text" class="form-control" name="title" required>
                            @error('title')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="" class="form-label"><b>Description</b></label>
                            <textarea name="description" class="form-control @error('description') is-invalid
                            @enderror"
                                id="" cols="30" rows="10"></textarea>
                            @error('description')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="" class="form-label"><b>Due Date</b></label>
                            <input type="datetime-local"
                                class="form-control @error('due_date') is-invalid
                            @enderror"
                                name="due_date" value="{{ @old('due_date') }}" required>
                            @error('due_date')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="" class="form-label"><b>Status</b></label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid
                            @enderror"
                                required>
                                <option value="done">Done</option>
                                <option value="pending">Pending</option>
                                <option value="on progress">On Progress</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="" class="form-label"><b>Employee</b></label>
                            <select name="assigned_to"
                                class="form-control @error('assigned_to') is-invalid
                            @enderror"required>
                                <option value="">Select an Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create New Task</button>
                        <a href="{{ route('tasks.index') }}" class="btn - btn-secondary">Back To List</a>
                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
