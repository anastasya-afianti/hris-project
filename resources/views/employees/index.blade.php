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
                    <h3>Employee</h3>
                    <p class="text-subtitle text-muted">Handle Employee Data or Profile</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Employees</li>
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
                        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3 ms-auto">Add New Employee</a>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>                              
                                <th>Role</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee -> id }}</td>
                                    <td>{{ $employee -> fullname }}</td>
                                    <td>{{ $employee -> email }}</td>
                                    <td>{{ $employee -> phone_number }}</td>    
                                    <td>{{ $employee -> role->name }}</td>   
                                    <td>{{ $employee -> department->name }}</td>
                                    
                                    <td>
                                        @if ($employee -> status == 'active')
                                             <span class="text-success">{{ $employee -> status }}</span>
            
                                        @else
                                            <span class="text-warning">{{ $employee -> status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $employee -> salary }}</td>
                                    <td>
                                        <a href="{{route('employees.show', $employee->id)}}" class="btn btn-info btn-sm" >Show</a>
                                        <a href="{{route('employees.edit', $employee->id)}}" class="btn btn-warning btn-sm" >Edit</a>
                                        <form action="{{route('employees.destroy', $employee->id)}}" method="POST" class="">
                                            @csrf
                                            @method('DELETE')
                                            <button class=" btn btn-danger btn-sm" onclick="return confirm('Are you sure delete this data?')">Delete</button>
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
