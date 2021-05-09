@extends('layouts.master')
@section('menu')
    @extends('sidebar.user')
@endsection
@section('title')| Detail User @endsection
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Users Control</h3>
                        <p class="text-subtitle text-muted">Akun information list</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Users Control</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dispay Information</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->name }}
                                </div>

                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->email }}
                                </div>

                                <div class="col-md-4">
                                    <label>Nomor Hp</label>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->phone_number }}
                                </div>

                                <div class="col-md-4">
                                    <label>Status</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="inline">
                                        @if ($user->status == 'Active')
                                            <span class="badge bg-success">{{ $user->status }}</span>
                                        @endif
                                        @if ($user->status == 'Disable')
                                            <span class="badge bg-danger">{{ $user->status }}</span>
                                        @endif
                                        @if ($user->status == null)
                                            <span class="badge bg-danger">{{ $user->status }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Role</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="inline">
                                        @if ($user->role_name == 'Admin')
                                            <span class="badge bg-success">{{ $user->role_name }}</span>
                                        @endif
                                        @if ($user->role_name == 'Super Admin')
                                            <span class="badge bg-info">{{ $user->role_name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('user.edit', [$user->id]) }}">
                                        <span class="btn btn-success me-1 mb-1">Update</span>
                                    </a>

                                    <a href="{{ route('user.index') }}"
                                        class="btn btn-light-secondary me-1 mb-1">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>{{ date('Y') }} &copy; Faqih</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="#">Faqih</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

@endsection
