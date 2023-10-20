<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

            <div class="row" style="height: 50px;"></div>

            <div class="row" style="height: 50px;"></div>
            <div class="row main" style="background-color: rgb(31, 31, 31); border-radius: 25px;">
                <section class="vh-100 gradient-custom" style="margin-bottom: 150px;">
                    <div class="container py-5 h-100">
                        <div class="row justify-content-center align-items-center h-100">
                            <div class="col-12 col-lg-9 col-xl-7">
                                <div class="card bg-dark text-white bg-opacity-25" style="border-radius: 15px;">
                                    <div class="card-body p-4 p-md-5">
                                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Đăng ký tài khoản</h3>
                                        <form method="POST" action="{{ route('xulydangky') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-4">

                                                    <div class="form-outline">
                                                        <label class="form-label" for="firstName">Họ tên</label>
                                                        <input type="text" name="tenuser" class="form-control form-control-lg" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="lastName">Mật khẩu</label>
                                                        <input type="password" name="password" class="form-control form-control-lg" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 d-flex align-items-center">
                                                    <div class="form-outline datepicker w-100">
                                                        <label for="birthdayDate" class="form-label">Sinh ngày</label>
                                                        <input type="date" name="ngaysinh" class="form-control form-control-lg"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <h6 class="mb-2 pb-1">Giới tính: </h6>
                                                    <select class="form-control form-control-lg" aria-label="Default select example" name="gioitinh">
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ">Nữ</option>
                                                        <option value="Khác">khác</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="emailAddress">Địa chỉ</label>
                                                        <input type="text" name="diachi" class="form-control form-control-lg" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="phoneNumber">Số điện thoại</label>
                                                        <input type="tel" name="sdt" class="form-control form-control-lg" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="emailAddress">Email</label>
                                                        <input type="email" name="email" class="form-control form-control-lg" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="mb-0">Do you already have an account? <a href=".\login.html" class="text-white-50 fw-bold">Log in</a></p>
                                            </div>
                                            <div class="mt-4 pt-2">
                                                <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Đăng ký" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

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
