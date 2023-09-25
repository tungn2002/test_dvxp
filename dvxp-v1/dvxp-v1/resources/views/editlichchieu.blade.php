@extends('layout')
@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Sửa lịch chiếu</h2>
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
                <form action="{{ url('capnhatlichchieu/id='.$lichchieu->id) }}" method="POST">
                @csrf
                    @method('PUT')
                    <label for="">Phòng</label>
                    <select name="idphong" class="form-select">
                    @isset($phong)
                            @foreach ($phong as $item)
                                @if($item->id===$lichchieu->idphong)
                                <option value="{{$item->id}}" selected="selected">{{$item->id}} - {{$item->tenphong}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->id}} - {{$item->tenphong}}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>
                    <label for="">Phim</label>
                    <select name="idphim" class="form-select">
                    @isset($phim)
                            @foreach ($phim as $item)
                                @if($item->id===$lichchieu->idphim)
                                <option value="{{$item->id}}" selected="selected">{{$item->id}} - {{$item->tenphim}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->id}} - {{$item->tenphim}}</option>

                                @endif
                            @endforeach
                        @endisset
                    </select>
                    <label for="">Ngày chiếu</label>
                    <input type="date" name="ngaychieu" value="{{$lichchieu->ngaychieu}}" class="form-control">
                    <label for="">Giờ chiếu</label>
                    <input type="text" name="giochieu" value="{{$lichchieu->giochieu}}" class="form-control">
                    <label for="">Giờ kết thúc</label>
                    <input type="text" name="gioketthuc" value="{{$lichchieu->gioketthuc}}" class="form-control">
                    
                    @if (\Session::has('message'))
                        <div class="alert alert-success">
                        <strong>{!! \Session::get('message') !!}</strong>
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
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>

            </div>
        </div>

    </div>
</div>
</div>


<!-- /#page-content-wrapper -->    
@endsection