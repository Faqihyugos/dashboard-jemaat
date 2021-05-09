@extends('layouts.master')
@section('menu')
    @extends('sidebar.user')
@endsection
@section('title')| Add Akun @endsection
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

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
                    <h4 class="card-title">New Account</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" enctype="multipart/form-data"
                            action="{{ route('user.store') }}" method="POST">
                            @csrf

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Full Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control  {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                                    value="{{ old('name') }}" placeholder="Masukkan nama lengkap"
                                                    id="first-name-icon" name="name">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Photo</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <input type="file" class="form-control" name="avatar" id="avatar">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                                                    name="email" id="email" value="{{ old('email') }}"
                                                    placeholder="Masukkan Email">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Phone Number</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <input type="number"
                                                    class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
                                                    value="{{ old('phone') }}" placeholder="Masukkan nomor telepon"
                                                    name="phone">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Select Role Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <fieldset class="form-group">
                                            <select class="form-select @error('role_name') is-invalid @enderror"
                                                name="role_name" id="role_name">
                                                <option selected disabled>Select Role Name</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Super Admin">Super Admin</option>
                                            </select>
                                        </fieldset>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('role_name') }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                placeholder="Masukkan Password">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>COnfirm Password</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="Masukkan Konfirmasi Password">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button class="btn btn-primary shadow-lg mt-5">Save</button>
                                    </div>

                                </div>
                            </div>
                        </form>
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
