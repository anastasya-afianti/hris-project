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
                    <h3>Leave Request</h3>
                    <p class="text-subtitle text-muted">Handle Leave Request Data </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Leave Request</li>
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
                        <a href="{{ route('leave-requests.create') }}" class="btn btn-primary mb-3 ms-auto">Add New
                            Leave Request</a>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                 @if (Auth::user()->employee?->role_id == '1')
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($leaveRequest as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->employee->fullname }}</td>
                                    <td>{{ $request->leave_type }}</td>
                                    <td>{{ $request->start_date }}</td>
                                    <td>{{ $request->end_date }}</td>
                                    <td>
                                        @if ($request->status == 'reject')
                                            <span class="text-danger">{{ ucfirst($request->status) }}</span>
                                        @elseif ($request->status == 'pending')
                                            <span class="text-warning">{{ ucfirst($request->status) }}</span>
                                        @elseif ($request->status == 'confirm')
                                            <span class="text-success">{{ ucfirst($request->status) }}</span>
                                        @endif
                                    </td>


                                    <td>
                                        @if (Auth::user()->employee?->role_id == '1')
                                            @if ($request->status == 'pending')
                                                <a href="{{ route('leave-requests.confirm', $request->id) }}"
                                                    class="btn btn-success btn-sm">Confirmed</a>
                                            @elseif ($request->status == 'confirm')
                                                <a href="{{ route('leave-requests.reject', $request->id) }}"
                                                    class="btn btn-danger btn-sm">Reject</a>
                                            @elseif ($request->status == 'reject')
                                                <a href="{{ route('leave-requests.pending', $request->id) }}"
                                                    class="btn btn-warning btn-sm">Pending</a>
                                            @endif
                                            <a href="{{ route('leave-requests.edit', $request->id) }}"
                                                class="btn btn-info btn-sm">Edit</a>

                                            <form action="{{ route('leave-requests.destroy', $request->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure want to delete this task?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
