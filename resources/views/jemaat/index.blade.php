@extends('layouts.master')
@section('menu')
    @extends('sidebar.jemaatView')
@endsection
@section('title')| List Jemaat @endsection
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
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        Jemaat list
                    </div>
                    <div class="card-body">
                        <form action="{{ route('search') }}" method="POST">
                            @csrf
                            <br>
                            <div class="container">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="form-group row">
                                            <label for="date" class="col-form-label col-sm-2">Date Of Birth From</label>
                                            <div class="col-sm-3">
                                                <input type="date" class="form-control input-sm" id="fromDate"
                                                    name="fromDate" />
                                            </div>
                                            <label for="date" class="col-form-label col-sm-2">Date Of Birth To</label>
                                            <div class="col-sm-3">
                                                <input type="date" class="form-control input-sm" id="toDate"
                                                    name="toDate" />
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn" name="search" title="Search"><i
                                                        class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </form>
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Phone Number</th>
                                    <th>Pelkat</th>
                                    <th class="text-center">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td class="id">{{ ++$key }}</td>
                                        <td class="name">{{ $item->name }}</td>
                                        <td class="gender">{{ $item->gender }}</td>
                                        <td class="placeofbirth">{{ $item->placeofbirth }}</td>
                                        <td class="dateofbirth">
                                            {{ \Carbon\Carbon::createFromTimestamp(strtotime($item->dateofbirth))->format('d/m/Y') }}
                                        </td>
                                        <td class="phone">{{ $item->phone }}</td>
                                        <td class="pelkat">{{ $item->pelkat }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('jemaat.show', [$item->id]) }}">
                                                <span class="btn btn-info btn-sm">Detail</span>
                                            </a>
                                            <a href="{{ route('jemaat.edit', [$item->id]) }}">
                                                <span class="btn btn-success btn-sm">Update</span>
                                            </a>

                                            <form onsubmit="return confirm('Are you sure to want to delete it?')"
                                                class="d-inline" action="{{ route('jemaat.destroy', [$item->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">

                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
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
