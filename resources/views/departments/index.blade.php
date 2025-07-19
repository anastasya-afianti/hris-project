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
                    <h3>Department</h3>
                    <p class="text-subtitle text-muted">Handle Department Data </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Department</li>
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
                        <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3 ms-auto">Add New Department</a>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Option</th>                              
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $department -> id }}</td>
                                    <td>{{ $department -> name }}</td>
                                    <td>{{ $department -> description }}</td>
                                     <td class="d-flex gap-1">
                                        <a href="{{route('departments.show', $department->id)}}" class="btn btn-info btn-sm" >Show</a>
                                        <a href="{{route('departments.edit', $department->id)}}" class="btn btn-warning btn-sm" >Edit</a>
                                        <form action="{{route('departments.destroy', $department->id)}}" method="POST" class="">
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
