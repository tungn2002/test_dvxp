<?php
    $id = session()->get('id');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"> -->
</head>
<body>
    <div class="father" style="background-color: rgb(0, 0, 0);">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black; border-bottom: 3px solid rgb(31, 31, 31);">
                <a class="navbar-brand" href="/trangchu"><img src="{{ asset('images/logo2.png') }}" alt="" width="100" height="60"></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <div class="navbar-nav nav-c1">
                        <a class="nav-item nav-link ac" href="/trangchu">Trang chủ</a>
                        @if (isset($id))
                            <a class="nav-item nav-link" href="{{ url('thongtinchung/id='.$id) }}">Thông tin chung</a>
                        @else
                            <a class="nav-item nav-link" href="/dangnhap">Thông tin chung</a>
                        @endif
                    </div>
                    @if (isset($id))
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="/dangxuat">Đăng xuất!</a>
                        </div>
                    @else
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="/dangnhap">Đăng nhập/Đăng ký</a>
                        </div>
                    @endif

                </div>
            </nav>
            <style>
                .navbar-nav a{
                    color: white;
                }
                .navbar-nav a:hover:not(.active){
                    color: #ff55bb;
                }
                .navbar-nav .ac{
                    color: #ff55bb;
                }
            </style>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" style="background-color: red;">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if (\Session::has('message'))
                        <div class="alert alert-success">
                        <strong>{!! \Session::get('message') !!}</strong>
                        </div>
                    @endif
            <div class="row" style="height: 50px;"></div>

            <section class="d-flex justify-content-center" style="color: rgb(255, 255, 255); background-color: rgb(31, 31, 31); border-radius: 25px;">
                <div class="container" style="margin: 50px;">
                    <div class="row" style="display: flex; justify-content: center; flex-wrap: wrap;">
                        <div class="col-3">
                        </div>
                        <div class="col-8 tt" style="margin-left: 20px;">
                            <h4> Chọn ghế</h4>
                            <div style="height: 10px; border-bottom: 1px solid rgb(161, 161, 161);"></div>
                            @isset($ghe)
                            <div class="container">
                            <div class="row">
                                @php
                                $currentChar = '';
                                @endphp

                                @foreach ($ghe->sortBy('tenghe') as $item)

                                @php
                                    $firstChar = strtoupper(substr($item->tenghe, 0, 1));
                                @endphp

                                @if ($firstChar !== $currentChar)
                                    @php
                                    $currentChar = $firstChar;
                                    @endphp

                                    <div class="col-12">
                                    <h3>{{$currentChar}}</h3>
                                    </div>
                                @endif
                                
                                <div class="col-1 mb-2">
                                    <form action="{{ url('datve5') }}" method="post">
                                    @csrf
                                    <input name="idghe" type="text" class="form-control" value="{{$item->id}}" hidden>
                                    <input name="iduser" type="text" value="{{$id}}" hidden>
                                    @php
                                    $dem=0;
                                    @endphp

                                    @foreach ($ve as $item2)
                                    @if ($item2->idghe == $item->id)
                                    @php
                                    $dem++;
                                    @endphp
                                    @endif
                                    @endforeach
                                    
                                    @if($dem>0)
                                    <button type="submit" class="btn btn-danger" >{{$item->tenghe}}</button>
                                    @else
                                    <button type="submit" class="btn btn-primary">{{$item->tenghe}}</button>
                                    @endif
                                    </form>
                                </div>

                                @endforeach
                            </div>
                            </div>
                        @endisset
                        </div>
                    </div>

                </div>
            </section>
            <div class="row" style="height: 100px;"></div>
            <div class="row" style="height: 100px; border-top: 2px solid rgb(31, 31, 31);"></div>

<div class="row bottom text-white" style="background-color: rgb(31, 31, 31); border-radius: 25px;">
                <div class="col bottom-c1 text-white d-flex justify-content-center" style="background-color: black; margin: 20px; border-radius: 25px;">
                    <div style="margin: 20px; width: 200px;">
                        <div class="bt-c1-1"><p><b>VIE Việt Nam</b></p></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Giới thiệu</a></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Tiện ích online</a></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Thẻ quà tặng</a></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Tuyển dụng</a></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Liên hệ quảng cáo VIE</a></div>
                    </div>
                </div>
                <div class="col bottom-c1 text-white d-flex justify-content-center" style="background-color: black; margin: 20px; border-radius: 25px;">
                    <div style="margin: 20px; width: 200px;">
                        <div class="bt-c1-1"><p><b>Điều khoản sử dụng</b></p></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Điều khoản chung</a></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Điều khoản giao dịch</a></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Chính sách thanh toán</a></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Chính sách bảo mật</a></div>
                        <div class="bt-c1-1"><a class=" text-white" href="">Câu hỏi thường gặp</a></div>
                    </div>
                </div>
                <div class="col bottom-c1 text-white d-flex justify-content-center" style="background-color: black; margin: 20px; border-radius: 25px;">
                    <div style="margin: 20px; width: 200px;">
                        <div class="bt-c1-1"><p><b>Kết nối với chúng tôi</b></p></div>
                        <div class="test">
                            <a href=""><img src="{{ asset('images/fb.png') }}" alt="" style="width: 30px; margin: 3px;"></a>
                            <a href=""><img src="{{ asset('images/yt.png') }}" alt="" style="width: 30px; margin: 3px;"></a>
                            <a href=""><img src="{{ asset('images/ig.png') }}" alt="" style="width: 30px; margin: 3px;"></a>
                            <a href=""><img src="{{ asset('images/zl.png') }}" alt="" style="width: 30px; margin: 3px;"></a>
                        </div>
                    </div>
                </div>
                <div class="col bottom-c1 text-white d-flex justify-content-center" style="background-color: black; margin: 20px; border-radius: 25px;">
                    <div style="margin: 20px; width: 200px;">
                        <div class="bt-c1-1"><p><b>Chăm sóc khách hàng</b></p></div>
                        <div class="bt-c1-1">Hotline: 19006017</div>
                        <div class="bt-c1-1">Giờ làm việc: 8:00 - 22:00(tất cả các ngày bao gồm cả lễ tết)</div>
                        <div class="bt-c1-1">Email hỗ trợ: abc@gmail.com</div>
                    </div>
                </div>
            </div>
            <div class="row" style="height: 50px;"></div>
            <div class="row tail"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>    <script src="../../assets/js/main.js"></script>
</body>
</html>