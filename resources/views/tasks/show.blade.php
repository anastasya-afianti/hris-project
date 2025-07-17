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
                <p class="text-subtitle text-muted">View Task Detail</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Task</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Show</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h3>Task Details</h3>
                    <p>Task data overview</p>
                </div>

                <form>
                    <div class="mb-4">
                        <label for="title" class="form-label"><b>Title</b></label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="{{ $task->title }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label"><b>Description</b></label>
                        <textarea class="form-control" id="description" rows="5" disabled>{{ $task->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="due_date" class="form-label"><b>Due Date</b></label>
                        <input type="datetime-local" class="form-control" id="due_date"
                            value="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label"><b>Status</b></label>
                        <input type="text" class="form-control" id="status" value="{{ $task->status }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="assigned_to" class="form-label"><b>Assigned Employee</b></label>
                        <input type="text" class="form-control" id="assigned_to"
                            value="{{ $task->employee->fullname ?? 'N/A' }}" disabled>
                    </div>

                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back To List</a>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit Task</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection