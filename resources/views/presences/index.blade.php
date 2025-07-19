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
                    <p class="text-subtitle text-muted">Handle Presences Data </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Presences</li>
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
                        <a href="{{ route('presences.create') }}" class="btn btn-primary mb-3 ms-auto">Add New
                            Presences</a>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($presences as $presence)
                                <tr>
                                    <td>{{ $presence->id }}</td>
                                    <td>{{ $presence->employee->fullname }}</td>
                                    <td>{{ $presence->check_in }}</td>
                                    <td>{{ $presence->check_out }}</td>
                                    <td>{{ $presence->date }}</td>
                                    <td>
                                        @if ($presence->status == 'present')
                                            <span class="text-success">{{ ucfirst($presence->status) }}</span>
                                        @else
                                            <span class="text-warning">{{ ucfirst($presence->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="{{ route('presences.edit', $presence->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('presences.destroy', $presence->id) }}" method="POST"
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
