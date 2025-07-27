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
                    <p class="text-subtitle text-muted">Add new data leave request</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('leave-requests.index') }}">Leave Request</a></li>
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
                        <h3>Add New Request</h3>
                        <p>Please fill out the form below</p>
                    </div>

                    <form action="{{ route('leave-requests.store') }}" method="POST">
                        @csrf

                        @if (Auth::user()->employee?->role_id == '1')
                            
                             <div class="mb-4">
                            <label for="employee_id" class="form-label"><b>Employee Name</b></label>
                            <select name="employee_id" id="employee_id"
                                class="form-control @error('employee_id') is-invalid @enderror" required>
                                <option value="">-- Select Employee --</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->fullname }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
                       
                       <div class="mb-4">
                        <label for="leave_type" class="form-label"><b>Leave Type</b></label>
                        <input type="text" name="leave_type" id="leave_type"
                            class="form-control @error('leave_type') is-invalid @enderror"
                            value="{{ old('leave_type') }}" required>
                        @error('leave_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="form-label"><b>Start Date</b></label>
                        <input type="date" name="start_date" id="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') }}" required>
                        @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="form-label"><b>End Date</b></label>
                        <input type="date" name="end_date" id="end_date"
                            class="form-control @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date') }}" required>
                        @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (Auth::user()->employee?->role_id == '1')
                        <div class="mb-4">
                            <label for="status" class="form-label"><b>Status</b></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                                required>
                                 <option value="">-- Select Status --</option>
                                <option value="confirm" {{ old('status') == 'confirm' ? 'selected' : '' }}>Confirm</option>
                                <option value="reject" {{ old('status') == 'reject' ? 'selected' : '' }}>Reject
                                </option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    @endif
                        

                        <button type="submit" class="btn btn-primary">Create New Requests</button>
                        <a href="{{ route('leave-requests.index') }}" class="btn btn-secondary">Back To List</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
