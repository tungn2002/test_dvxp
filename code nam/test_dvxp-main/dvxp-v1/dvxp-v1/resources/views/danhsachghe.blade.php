@extends('layout')
@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Quản lý ghế</h2>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
            <i class="fas fa-user me-2"></i>
            <li class="nav-item">Admin</li>
          </ul>
        </div>

    </nav>

    <div class="container-fluid px-4">
        <div class="row my-5">
            <div class="col">
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">id</th>
                            <th scope="col">Tên ghế</th>
                            <th scope="col">Phòng</th>
                            <th scope="col">Giá ghế</th>
                            <th scope="col">Tùy chọn</th>

                        </tr>
                    </thead>
                    <tbody>
                    @isset($ghe)
                            @foreach ($ghe as $item)
                           <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->tenghe}}</td>
                                <td>{{$item->idphong}}</td>
                                <td>{{$item->giaghe}}</td>
                                <td>
                                    <a href="{{ url('suaghe/id='.$item->id) }}" class="btn btn-primary">Sửa</a>

                                    <form action="{{ url('xoaghe/id='.$item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        @endisset


                    </tbody>
                </table><form class="d-flex justify-content-end" action="{{ url('themmoighe') }}" method="get">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                </form>

            </div>
            @if (\Session::has('message'))
                        <div class="alert alert-success">
                        <strong>{!! \Session::get('message') !!}</strong>
                        </div>
                    @endif
        </div>
        @isset($ghe)
    <div class="container-footer-kt">
            <nav aria-label="Page navigation example" class="ml-5 footer-kt">
                {{ $ghe->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    @endisset
    </div>
</div>
</div>


<!-- /#page-content-wrapper -->
@endsection