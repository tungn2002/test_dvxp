@extends('layout')
@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Sửa ghế</h2>
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
                <form action="{{ url('capnhatghe/id='.$ghe->id) }}" method="POST">
                @csrf
                    @method('PUT')
                    <label for="">Tên ghế</label>
                    <input name="tenghe" type="text" class="form-control" value="{{$ghe->tenghe}}">

                    <label for="">Phòng</label>
                    <select name="idphong" class="form-select">
                    @isset($phong)
                            @foreach ($phong as $item)
                                @if($item->id===$ghe->idphong)
                                <option value="{{$item->id}}" selected="selected">{{$item->id}} - {{$item->tenphong}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->id}} - {{$item->tenphong}}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>

                    <label for="">Lịch chiếu</label>
                    <select name="idlichchieu" class="form-select">
                    @isset($lichchieu)
                            @foreach ($lichchieu as $item)
                            @if($item->id===$ghe->idlichchieu)
                            <option value="{{$item->id}}" selected="selected">{{$item->id}} - IDphong:{{$item->idphong}}</option>

                            @else
                            <option value="{{$item->id}}">{{$item->id}} - IDphong:{{$item->idphong}}</option>

                            @endif
                            @endforeach
                        @endisset
                    </select>
                    <label for="">Giá ghế</label>
                    <input name="giaghe" type="text" class="form-control" value="{{$ghe->giaghe}}">

                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>

            </div>
        </div>

    </div>
</div>
</div>


<!-- /#page-content-wrapper -->    
@endsection