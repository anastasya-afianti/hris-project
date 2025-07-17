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
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{route ('tasks.create')}}" class="btn btn-primary mb-3 ms-auto">Add New Task</a>
                </div>
                @if (session('success'))
                <div class="alert alert-success">{{session ('success')}}</div>

                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Assigned To</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{{$task -> id}}</td>
                            <td>{{$task -> title}}</td>
                            <td>{{$task -> description}}</td>
                            <td>{{$task -> employee -> fullname}}</td>
                            <td>{{$task -> due_date}}</td>
                            <td>
                                @if ($task -> status == 'pending')
                                <span class="text-warning">Pending</span>
                                @elseif ($task -> status == 'done')
                                <span class="text-success">Done</span>
                                @else
                                <span class="text-info">{{$task -> status}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">View</a>
                                @if ($task -> status == 'pending')
                                <a href="" class="btn btn-success btn-sm">Mark ad Done</a>
                                @else
                                <a href="" class="btn btn-warning btn-sm">Mark as Pending</a>
                                @endif
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this task?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection