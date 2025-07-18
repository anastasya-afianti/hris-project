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
                <p class="text-subtitle text-muted">View Employee Detail</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Show</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Show Data Employee</h5>
            </div>
            <div class="card-body">
               <div class="mb-3">
                <label for="">Fullname</label>
                <p>{{$employee->fullname}}</p>
               </div>

               <div class="mb-3">
                <label for="">Email</label>
                <p>{{$employee->email}}</p>
               </div>

               <div class="mb-3">
                <label for="">Phone Number</label>
                <p>{{$employee->phone_number}}</p>
               </div>

              <div class="mb-3">
                <label for="">Role</label>
                <p>{{$employee->role->name}}</p>
               </div>

               <div class="mb-3">
                <label for="">Department</label>
                <p>{{$employee->department->name}}</p>
               </div>

               <div class="mb-3">
                <label for="">Status</label>
                <p>
                    @if ($employee -> status == 'active')
                    <span class="text-success">{{ucfirst($employee->status)}}</span>
                    @else
                     <span class="text-warning">{{ucfirst($employee->status)}}</span>
                                 
                    @endif
                </p>
               </div>

                 <div class="mb-3">
                <label for="">Salary</label>
                <p>{{$employee->salary}}</p>
               </div>         

               <a href="{{route('employees.index')}}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </section>
</div>
@endsection