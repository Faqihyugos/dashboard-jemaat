@extends('layouts.master')
@section('menu')
    @extends('sidebar.user')
@endsection
@section('title')| Akun @endsection
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
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        List Akun
                        <div class="text-end">
                            <a href="{{ route('user.create') }}">
                                <span class="btn btn-light-secondary btn-sm">New Account</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Profile</th>
                                    <th>Email</th>
                                    <th>Nomor Hp</th>
                                    <th>Status</th>
                                    <th>Role Name</th>
                                    <th class="text-center">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td class="id">{{ ++$key }}</td>
                                        <td class="name">{{ $item->name }}</td>
                                        <td class="name">
                                            <div class="avatar avatar-xl">
                                                @if ($item->avatar)
                                                    <img src="{{ asset('storage/' . $item->avatar) }}"
                                                        alt="{{ $item->avatar }}">
                                                @else
                                                    <img src="{{ asset('assets\images\faces\profile.jpg') }}" />
                                                @endif
                                            </div>
                                        </td>
                                        <td class="email">{{ $item->email }}</td>
                                        <td class="phone_number">{{ $item->phone_number }}</td>
                                        @if ($item->status == 'Active')
                                            <td class="status"><span class="badge bg-success">{{ $item->status }}</span>
                                            </td>
                                        @endif
                                        @if ($item->status == 'Disable')
                                            <td class="status"><span class="badge bg-danger">{{ $item->status }}</span>
                                            </td>
                                        @endif
                                        @if ($item->status == null)
                                            <td class="status"><span class="badge bg-danger">{{ $item->status }}</span>
                                            </td>
                                        @endif
                                        @if ($item->role_name == 'Admin')
                                            <td class="role_name"><span
                                                    class="badge bg-success">{{ $item->role_name }}</span></td>
                                        @endif
                                        @if ($item->role_name == 'Super Admin')
                                            <td class="role_name"><span
                                                    class="badge bg-info">{{ $item->role_name }}</span></td>
                                        @endif
                                        <td class="text-center">


                                            <a href="{{ route('user.edit', [$item->id]) }}">
                                                <span class="btn btn-primary btn-sm">Update</span>
                                            </a>

                                            <form onsubmit="return confirm('Are you sure to want to delete it?')"
                                                class="d-inline" action="{{ route('user.destroy', [$item->id]) }}"
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
