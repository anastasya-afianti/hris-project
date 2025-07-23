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
                    <p class="text-subtitle text-muted">View Payroll Detail</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payrolls</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                {{-- <div class="card-header">
                    <h5 class="card-title">Show Data Payroll</h5>
                </div> --}}
                <div class="mt-4 mb-0" style="padding-left: 20px;">
                    <h1 class="mb-0" style="font-size: 2rem;">PT. Contoh Sukses Selalu</h1>
                    <p class="mb-1">Jl. Merdeka No. 123, Banyuwangi, Jawa Timur</p>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label><b>Employee Name</b></label>
                            <p>{{ $payroll->employee->fullname ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><b>Salary</b></label>
                            <p>{{ number_format($payroll->salary, 0, ',', '.') }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label><b>Bonuses</b></label>
                            <p>{{ number_format($payroll->bonuses, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><b>Deductions</b></label>
                            <p>{{ number_format($payroll->deductions, 0, ',', '.') }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label><b>Net Salary</b></label>
                            <p>{{ number_format($payroll->net_salary, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><b>Payroll Date</b></label>
                            <p>{{ \Carbon\Carbon::parse($payroll->pay_date)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                    <a href="{{ route('payrolls.pdf', $payroll->id) }}" class="btn btn-danger mt-3">Download PDF</a>

                </div>
            </div>
        </section>
    </div>
@endsection
