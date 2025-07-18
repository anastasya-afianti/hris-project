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
                <h3>Employees</h3>
                <p class="text-subtitle text-muted">Add new data employees</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
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

                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="form-label"><b>Fullname</b></label>
                        <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                            name="fullname" id="fullname" value="{{ old('fullname') }}" required>
                        @error('fullname')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label"><b>Email</b></label>
                        <input type="text" name="email" id="email" class="form-control" required>
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>                            
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone_number" class="form-label"><b>Phone Number</b></label>
                        <input type="text" name="phone_number" id="phone_number"
                            class="form-control @error('phone_number') is-invalid @enderror"
                            value="{{ old('phone_number') }}" required>
                        @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label"><b>Address</b></label>
                        <textarea name="address" id="address" rows="5"
                            class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="birth_date" class="form-label">Birth Date</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control date" required>
                        @error('birth_date')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    
                    <div class="mb-4">
                        <label for="hire_date" class="form-label">Hire Date</label>
                        <input type="date" name="hire_date" id="hire_date" class="form-control date" required>
                        @error('hire_date')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="department_id" class="form-label"><b>Department</b></label>
                        <select name="department_id" id="department_id"
                            class="form-control @error('department_id') is-invalid @enderror" required>
                            <option value="">-- Select Department --</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}" >
                                {{ $department->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="role_id" class="form-label"><b>Role</b></label>
                        <select name="role_id" id="role_id"
                            class="form-control @error('role_id') is-invalid @enderror" required>
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" >
                                {{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label"><b>Status</b></label>
                        <select name="status" id="status"
                            class="form-control @error('status') is-invalid @enderror" required>
                            <option value="">-- Select Status --</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="non-active " {{ old('status') == 'non-active ' ? 'selected' : '' }}>Non Active </option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="mb-4">
                        <label for="salary" class="form-label"><b>Salary</b></label>
                        <input type="text" name="salary" id="salary" class="form-control" required>
                        @error('salary')
                        <div class="invalid-feedback">{{$message}}</div>                            
                        @enderror
                    </div>

                  

                    <button type="submit" class="btn btn-primary">Create New Task</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back To List</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection