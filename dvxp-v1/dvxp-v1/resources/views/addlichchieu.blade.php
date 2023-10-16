@extends('layout')
@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Thêm lịch chiếu</h2>
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
                <form action="{{ url('themlichchieu') }}" method="post">
                    
                    @csrf
                    <label for="">Phòng</label>
                    <input type="text" name="idphong" class="form-control">
                    <label for="">Phim</label>
                    <input type="text" name="idphim" class="form-control">
                    <label for="">Ngày chiếu</label>
                    <input type="text" name="ngaychieu" class="form-control">
                    <label for="">Giờ chiếu</label>
                    <input type="text" name="giochieu" class="form-control">
                    <label for="">Giờ kết thúc</label>
                    <input type="text" name="gioketthuc" class="form-control">

                    @if (\Session::has('message'))
                        <div class="alert alert-success">
                        <strong>{!! \Session::get('message') !!}</strong>
                        </div>
                    @endif
                    @if (\Session::has('message2'))
                        <div class="alert alert-danger">
                        <strong>{!! \Session::get('message2') !!}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>

            </div>
        </div>

    </div>
</div>
</div>




<!-- /#page-content-wrapper -->    
@endsection