@extends('layout')
@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Sửa phim</h2>
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
                <form action="{{ url('capnhatphim/id='.$phim->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                    @method('PUT')
                    @isset($phim)

                    <div>
                        <label for="">Tên phim</label>
                        <input name="tenphim" type="text" class="form-control" value="{{$phim->tenphim}}">
                    </div>
                    <div>
                        <label for="">Thể loại</label>
                        <input name="theloai" type="text"  class="form-control" value="{{$phim->tenphim}}">
                    </div>
                    <div>
                        <label for="">Nội dung</label>
                        <input name="noidung" type="text" class="form-control" value="{{$phim->noidung}}">
                    </div>
                    <div>
                        <label for="">Đạo diễn</label>
                        <input name="daodien" type="text" class="form-control" value="{{$phim->daodien}}">
                    </div>
                    <div>
                        <label for="">Ảnh</label>
                        <input name="image" type="file" class="form-control" value="{{$phim->image}}">
                    </div>
                    @endisset

                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Sửa vé</button>
                </form>
            </div>
        </div>

    </div>
</div>
</div>


<!-- /#page-content-wrapper -->    
@endsection