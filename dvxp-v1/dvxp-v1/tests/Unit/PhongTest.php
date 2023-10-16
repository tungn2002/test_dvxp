<?php

namespace Tests\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Tests\TestCase;
use App\Http\Controllers\PhongController;

class PhongTest extends TestCase
{

    public function testStore(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenphong' => 'Phong J',
            'loaiphong' => '3D',
            'soghe' => '40',
        ]);

        $controller = new PhongController();

        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message');

        // Kiểm tra kết quả
        $this->assertEquals('Thêm thành công', $message);

    }
    
    public function test_Empty(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenphong' => '',
            'loaiphong' => '',
            'soghe' => '',
        ]);

        $controller = new PhongController();

        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Phải nhập đủ thông tin', $message);

    }
    public function test_InvalidTenPhong(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenphong' => '#@#@',
            'loaiphong' => '3D',
            'soghe' => '40',
        ]);

        $controller = new PhongController();

        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Tên phòng phải là chữ từ a-z,A-Z và số 0-9', $message);

    }
    public function test_InvalidLoaiPhong(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenphong' => 'Phong O',
            'loaiphong' => '#@!#@!',
            'soghe' => '40',
        ]);

        $controller = new PhongController();

        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Loại phòng phải là chữ từ a-z,A-Z và số 0-9', $message);

    }

    public function test_InvalidSoGhe(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'tenphong' => 'Phong O',
            'loaiphong' => '3D',
            'soghe' => '#@!@#',
        ]);

        $controller = new PhongController();

        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Số ghế phải là số nguyên dương', $message);

    }
    
}
