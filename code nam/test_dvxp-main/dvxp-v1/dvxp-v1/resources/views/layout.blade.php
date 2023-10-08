<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('styles.css') }}">

    <title>webdatve</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>Admin</div>
            <div class="list-group list-group-flush my-3">
     <!-- fw-bold -->
                <a href="{{ url('danhsachphim') }}" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-project-diagram me-2"></i>Quản lý phim</a>

                <a href="{{ url('danhsachlichchieu') }}" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-paperclip me-2"></i>Quản lý lịch chiếu</a>
                <a href="{{ url('danhsachphong') }}" class="list-group-item list-group-item-action bg-transparent second-text active border-bottom"><i class="fas fa-person-booth"></i> Quản lý phòng</a>
                <a href="{{ url('danhsachghe') }}" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-chair"></i> Quản lý ghế</a>
                <a href="{{ url('danhsachve') }}" class="list-group-item list-group-item-action bg-transparent second-text active"><i class="fas fa-ticket-alt"></i> Quản lý vé</a>
                <a href="{{ url('danhsachphim') }}" class="list-group-item list-group-item-action bg-transparent text-danger active"><i class="fas fa-power-off me-2"></i>Đăng xuất</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
    @yield('content')
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('app.js') }}"></script>

</body>
</html>
