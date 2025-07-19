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
                    <h3>Payroll</h3>
                    <p class="text-subtitle text-muted">Handle Presences Data </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payroll</li>
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
                        <a href="{{ route('payrolls.create') }}" class="btn btn-primary mb-3 ms-auto">Add New
                            Payroll</a>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Salary</th>
                                <th>Bonuses</th>
                                <th>Deductions</th>
                                <th>Net Salary</th>
                                <th>Pay Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($payrolls as $payroll)
                                <tr>
                                    <td>{{ $payroll->id }}</td>
                                    <td>{{ $payroll->employee->fullname }}</td>
                                    <td>{{ $payroll->salary }}</td>
                                    <td>{{ $payroll->bonuses }}</td>
                                    <td>{{ $payroll->deductions }}</td>
                                    <td>{{ $payroll->net_salary }}</td>
                                    <td>{{ $payroll->pay_date }}</td>
                                    

                                    <td class="d-flex gap-1">
                                        <a href="{{route('payrolls.show', $payroll->id)}}" class="btn btn-info btn-sm" >Salary Slip</a>
                                        <a href="{{ route('payrolls.edit', $payroll->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST"
                                            class="">
                                            @csrf
                                            @method('DELETE')
                                            <button class=" btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure delete this data?')">Delete</button>
                                        </form>
                                    </td>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
