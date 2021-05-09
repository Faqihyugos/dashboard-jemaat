@extends('layouts.master')
@section('menu')
    @extends('sidebar.user')
@endsection
@section('title')| Edit User @endsection
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
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Information</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" enctype="multipart/form-data"
                                action="{{ route('user.update', [$data[0]->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" value="PUT" name="_method">

                                <div class="col-md-4">
                                    <label>Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') ? old('name') : $data[0]->name }}"
                                                placeholder="Masukkan nama lengkap" id="first-name-icon" name="name">
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <label>Email Address</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') ? old('email') : $data[0]->email }}"
                                                placeholder="Enter email" id="first-name-icon" name="email">
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
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                value="{{ old('phone_number') ? old('phone_number') : $data[0]->phone_number }}"
                                                placeholder="Enter phone number" name="phone_number">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Status</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group position-relative mb-4">
                                        <fieldset class="form-group">
                                            <select class="form-select" name="status" id="status">
                                                <option value="{{ $data[0]->status }}"
                                                    {{ $data[0]->status == $data[0]->status ? 'selected' : '' }}>
                                                    {{ $data[0]->status }}
                                                </option>
                                                @foreach ($userStatus as $key => $value)
                                                    <option value="{{ $value->type_name }}"> {{ $value->type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Role Name</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group position-relative mb-4">
                                        <fieldset class="form-group">
                                            <select class="form-select" name="role_name" id="role_name">
                                                <option value="{{ $data[0]->role_name }}"
                                                    {{ $data[0]->role_name == $data[0]->role_name ? 'selected' : '' }}>
                                                    {{ $data[0]->role_name }}
                                                </option>
                                                @foreach ($roleName as $key => $value)
                                                    <option value="{{ $value->role_type }}"> {{ $value->role_type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Photo</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            @if ($data[0]->avatar)
                                                <img src="{{ asset('storage/' . $data[0]->avatar) }}" width="120px" />
                                            @else
                                                <img src="{{ asset('assets\images\faces\profile.jpg') }}"
                                                    width="120px" />
                                            @endif
                                            <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                                name="avatar" id="avatar">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                    <a href="{{ route('user.editPassword', [$data[0]->id]) }}"
                                        class="btn btn-light-secondary me-1 mb-1">Ganti
                                        Password</a>
                                    <a href="{{ route('user.index') }}"
                                        class="btn btn-light-secondary me-1 mb-1">Back</a>
                                </div>
                        </div>
                    </div>
                    </form>
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
