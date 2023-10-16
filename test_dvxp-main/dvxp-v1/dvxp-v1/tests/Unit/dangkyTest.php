<?php

namespace Tests\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Tests\TestCase;
use App\Http\Controllers\GiaoDienController;

class dangkyTest extends TestCase
{

    public function testStore(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenuser' => 'Bùi Trường',
            'password' => '123123',
            'ngaysinh' => '2002-04-25',
            'gioitinh' => 'Nam',
            'diachi' => 'Hà Nội',
            'sdt' => '0123456789',
            'email' => 'abc@gmail.com',
        ]);

        // Tạo một đối tượng GiaoDienController
        $controller = new GiaoDienController();

        // Thực hiện gọi phương thức store trên đối tượng GiaoDienController với dữ liệu giả lập
        $response = $controller->xulydangky($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message');

        // Kiểm tra kết quả
        $this->assertEquals('Đăng ký thành công!', $message);

    }
    public function test_tesnuser(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenuser' => '',
            'password' => '123123',
            'ngaysinh' => '2002-04-25',
            'gioitinh' => 'Nam',
            'diachi' => 'Hà Nội',
            'sdt' => '0123456789',
            'email' => 'clonebuitruong@gmail.com',
        ]);

        // Tạo một đối tượng GiaoDienController
        $controller = new GiaoDienController();

        // Thực hiện gọi phương thức store trên đối tượng GiaoDienController với dữ liệu giả lập
        $response = $controller->xulydangky($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Họ tên không hợp lệ.', $message);
    }
    public function test_password(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenuser' => 'Bùi Trường',
            'password' => '123123@@',
            'ngaysinh' => '2002-04-25',
            'gioitinh' => 'Nam',
            'diachi' => 'Hà Nội',
            'sdt' => '0123456789',
            'email' => 'clonebuitruong@gmail.com',
        ]);

        // Tạo một đối tượng GiaoDienController
        $controller = new GiaoDienController();

        // Thực hiện gọi phương thức store trên đối tượng GiaoDienController với dữ liệu giả lập
        $response = $controller->xulydangky($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Mật khẩu không hợp lệ.', $message);

    }
    public function test_ngaysinh(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenuser' => 'Bùi Trường',
            'password' => '123123',
            'ngaysinh' => '31/02/2002',
            'gioitinh' => 'Nam',
            'diachi' => 'Hà Nội',
            'sdt' => '0123456789',
            'email' => 'clonebuitruong@gmail.com',
        ]);

        // Tạo một đối tượng GiaoDienController
        $controller = new GiaoDienController();

        // Thực hiện gọi phương thức store trên đối tượng GiaoDienController với dữ liệu giả lập
        $response = $controller->xulydangky($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Ngày sinh không hợp lệ.', $message);

    }
    public function test_gioitinh(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenuser' => 'Bùi Trường',
            'password' => '123123',
            'ngaysinh' => '2002-04-25',
            'gioitinh' => 'test',
            'diachi' => 'Hà Nội',
            'sdt' => '0123456789',
            'email' => 'clonebuitruong@gmail.com',
        ]);

        // Tạo một đối tượng GiaoDienController
        $controller = new GiaoDienController();

        // Thực hiện gọi phương thức store trên đối tượng GiaoDienController với dữ liệu giả lập
        $response = $controller->xulydangky($request);

        // Lấy thông báo từ session trong RedirectResponse

        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Giới tính không hợp lệ.', $message);

    }
    public function test_diachi(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenuser' => 'Bùi Trường',
            'password' => '123123',
            'ngaysinh' => '2002-04-25',
            'gioitinh' => 'Nam',
            'diachi' => '123123',
            'sdt' => '0123456789',
            'email' => 'clonebuitruong@gmail.com',
        ]);

        // Tạo một đối tượng GiaoDienController
        $controller = new GiaoDienController();

        // Thực hiện gọi phương thức store trên đối tượng GiaoDienController với dữ liệu giả lập
        $response = $controller->xulydangky($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Địa chỉ không hợp lệ.', $message);

    }
    public function test_sdt(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenuser' => 'Bùi Trường',
            'password' => '123123',
            'ngaysinh' => '2002-04-25',
            'gioitinh' => 'Nam',
            'diachi' => 'Hà Nội',
            'sdt' => 'abcxyz',
            'email' => 'clonebuitruong@gmail.com',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new GiaoDienController();

        // Thực hiện gọi phương thức store trên đối tượng GiaoDienController với dữ liệu giả lập
        $response = $controller->xulydangky($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Số điện thoại không hợp lệ.', $message);
    }

    public function test_email(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenuser' => 'Bùi Trường',
            'password' => '123123',
            'ngaysinh' => '2002-04-25',
            'gioitinh' => 'Nam',
            'diachi' => 'Hà Nội',
            'sdt' => '0123456789',
            'email' => 'clonebuitruong',
        ]);

        // Tạo một đối tượng GiaoDienController
        $controller = new GiaoDienController();

        // Thực hiện gọi phương thức store trên đối tượng GiaoDienController với dữ liệu giả lập
        $response = $controller->xulydangky($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Email không hợp lệ.', $message);
    }
    public function test_email_tontai(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenuser' => 'Bùi Trường',
            'password' => '123123',
            'ngaysinh' => '2002-04-25',
            'gioitinh' => 'Nam',
            'diachi' => 'Hà Nội',
            'sdt' => '0123456789',
            'email' => 'buitruongar13@gmail.com',
        ]);

        // Tạo một đối tượng GiaoDienController
        $controller = new GiaoDienController();

        // Thực hiện gọi phương thức store trên đối tượng GiaoDienController với dữ liệu giả lập
        $response = $controller->xulydangky($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message');

        // Kiểm tra kết quả
        $this->assertEquals('Email đã tồn tại!', $message);

    }
}
