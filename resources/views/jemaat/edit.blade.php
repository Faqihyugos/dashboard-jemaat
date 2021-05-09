@extends('layouts.master')
@section('menu')
    @extends('sidebar.jemaatView')
@endsection
@section('title')| Update Jemaat @endsection
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
                        <h3>View Table</h3>
                        <p class="text-subtitle text-muted">Jemaat information list</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Table</li>
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
                                action="{{ route('jemaat.update', [$jemaat->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" value="PUT" name="_method">



                                <div class="col-md-4">
                                    <label>Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') ? old('name') : $jemaat->name }}"
                                                placeholder="Masukkan nama lengkap" id="first-name-icon" name="name">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label>Tempat dan Tanggal Lahir</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <input type="text"
                                                    class="form-control @error('placeofbirth') is-invalid @enderror"
                                                    value="{{ old('placeofbirth') ? old('placeofbirth') : $jemaat->placeofbirth }}"
                                                    placeholder="Masukkan tempat lahir" id="first-placeofbirth-icon"
                                                    name="placeofbirth">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="position-relative">
                                                <input type="date"
                                                    class="form-control date @error('dateofbirth') is-invalid @enderror"
                                                    value="{{ old('dateofbirth') ? old('dateofbirth') : $jemaat->dateofbirth }}"
                                                    placeholder="" id="first-dateofbirth-icon datetimepicker"
                                                    name="dateofbirth">
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
                                            <select class="form-select" name="gender" @error('gender') is-invalid @enderror>
                                                <option>Pilih Jenis kelamin</option>
                                                <option value="Laki-laki"
                                                    {{ $jemaat->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="Perempuan"
                                                    {{ $jemaat->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Status Perkawinan</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <select class="form-select" name="status" @error('status') is-invalid @enderror>
                                                <option>Pilih Status</option>
                                                <option value="Belum Kawin"
                                                    {{ $jemaat->status == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin
                                                </option>
                                                <option value="Kawin" {{ $jemaat->status == 'Kawin' ? 'selected' : '' }}>
                                                    Kawin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Mobile Number</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone') ? old('phone') : $jemaat->phone }}"
                                                placeholder="Enter phone number" name="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Address</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            <textarea type="textarea"
                                                class="form-control @error('address') is-invalid @enderror"
                                                name="address">{{ old('address') ? old('address') : $jemaat->address }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Photo</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="position-relative">
                                            @if ($jemaat->avatar)
                                                <img src="{{ asset('storage/' . $jemaat->avatar) }}" width="120px" />
                                            @else
                                                <img src="{{ asset('assets\images\faces\profile.jpg') }}"
                                                    width="120px" />
                                            @endif
                                            <input type="file" class="form-control @error('address') is-invalid @enderror"
                                                name="avatar" id="avatar">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                    <a href="{{ route('jemaat.index') }}"
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
