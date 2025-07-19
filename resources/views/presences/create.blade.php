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
                    <h3>Presences</h3>
                    <p class="text-subtitle text-muted">Add new data presences</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presences</a></li>
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
                        <h3>Add New Presences</h3>
                        <p>Please fill out the form below</p>
                    </div>

                    <form action="{{ route('presences.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="employee_id" class="form-label"><b>Employee</b></label>
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


                       <div class="mb-4">
                        <label for="check_in" class="form-label"><b>Check In</b></label>
                        <input type="time" name="check_in" id="check_in"
                            class="form-control @error('check_in') is-invalid @enderror"
                            value="{{ old('check_in') }}" required>
                        @error('check_in')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="check_out" class="form-label"><b>Check Out</b></label>
                        <input type="time" name="check_out" id="check_out"
                            class="form-control @error('check_out') is-invalid @enderror"
                            value="{{ old('check_out') }}" required>
                        @error('check_out')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="mb-4">
                        <label for="date" class="form-label"><b>Date</b></label>
                        <input type="date" name="date" id="date"
                            class="form-control @error('date') is-invalid @enderror"
                            value="{{ old('date') }}" required>
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                        <div class="mb-4">
                            <label for="status" class="form-label"><b>Status</b></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                                required>
                                <option value="present" {{ old('status') == 'active' ? 'selected' : '' }}>Present</option>
                                <option value="absent" {{ old('status') == 'non-active' ? 'selected' : '' }}>Absen
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>




                        <button type="submit" class="btn btn-primary">Create New Presences</button>
                        <a href="{{ route('presences.index') }}" class="btn btn-secondary">Back To List</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
