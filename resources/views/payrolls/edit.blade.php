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
                <h3>Payrolls</h3>
                <p class="text-subtitle text-muted">Handle Payrolls Data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payrolls</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                    <h3>Edit Payrolls</h3>
                    <p>Update the fields below</p>
                </div>

                <form action="{{ route('payrolls.update', $payroll->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="employee_id" class="form-label"><b>Employee</b></label>
                        <select name="employee_id" id="employee_id"
                            class="form-control @error('employee_id') is-invalid @enderror" required>
                            <option value="">-- Select Employee --</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('employee_id', $payroll->employee_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="salary" class="form-label"><b>Salary</b></label>
                        <input type="text" name="salary" id="salary"
                            class="form-control @error('salary') is-invalid @enderror"
                            value="{{ old('salary', $payroll->salary) }}" required>
                        @error('salary')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                      <div class="mb-4">
                        <label for="bonuses" class="form-label"><b>Bonuses</b></label>
                        <input type="text" name="bonuses" id="bonuses"
                            class="form-control @error('bonuses') is-invalid @enderror"
                            value="{{ old('bonuses', $payroll->bonuses) }}" required>
                        @error('bonuses')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deductions" class="form-label"><b>Deductions</b></label>
                        <input type="text" name="deductions" id="deductions"
                            class="form-control @error('deductions') is-invalid @enderror"
                            value="{{ old('deductions', $payroll->deductions) }}" required>
                        @error('deductions')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="net_salary" class="form-label"><b>Net Salary</b></label>
                        <input type="text" name="net_salary" id="net_salary"
                            class="form-control @error('net_salary') is-invalid @enderror"
                            value="{{ old('net_salary', $payroll->net_salary) }}" required>
                        @error('net_salary')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="mb-4">
                        <label for="pay_date" class="form-label"><b>pay_date</b></label>
                        <input type="date" name="pay_date" id="pay_date"
                            class="form-control @error('pay_date') is-invalid @enderror"
                            value="{{ old('pay_date', $payroll->pay_date) }}" required>
                        @error('pay_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
        
                    <button type="submit" class="btn btn-primary">Update Payroll</button>
                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back To List</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
