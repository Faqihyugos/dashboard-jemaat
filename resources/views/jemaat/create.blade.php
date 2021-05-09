@extends('layouts.master')
@section('menu')
    @extends('sidebar.jemaatInput')
@endsection
@section('title')| Input Jemaat @endsection
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
                    <h3>Form Jemaat</h3>
                    <p class="text-subtitle text-muted">form information</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Input Jemaat</li>
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
                    <h4 class="card-title">Input data</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" enctype="multipart/form-data"
                            action="{{ route('jemaat.store') }}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <label>Nama Lengkap</label>
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
                                        <label>Tempat dan Tanggal Lahir</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control {{ $errors->first('placeofbirth') ? 'is-invalid' : '' }}"
                                                    value="{{ old('placeofbirth') }}" placeholder="Masukkan tempat lahir"
                                                    id="first-placeofbirth-icon" name="placeofbirth">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('placeofbirth') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <input type="date"
                                                    class="form-control {{ $errors->first('dateofbirth') ? 'is-invalid' : '' }}"
                                                    value="{{ old('dateofbirth') }}" placeholder=""
                                                    id="first-dateofbirth-icon datetimepicker" name="dateofbirth">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('dateofbirth') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Jenis Kelamin</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <select
                                                    class="form-select {{ $errors->first('gender') ? 'is-invalid' : '' }}"
                                                    name="gender">
                                                    <option selected>Pilih Jenis kelamin</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('gender') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Status Perkawinan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <select
                                                    class="form-select {{ $errors->first('status') ? 'is-invalid' : '' }}"
                                                    name="status">
                                                    <option selected>Pilih Status</option>
                                                    <option value="Belum Kawin">Belum Kawin</option>
                                                    <option value="Kawin">Kawin</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('status') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Mobile Number</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <input type="number"
                                                    class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
                                                    value="{{ old('phone') }}" placeholder="Enter phone number"
                                                    name="phone">
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <textarea type="textarea" class="form-control"
                                                    name="address">{{ old('address') }}</textarea>
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


                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
