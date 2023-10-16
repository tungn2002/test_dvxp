<?php

namespace Tests\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Tests\TestCase;
use App\Http\Controllers\LichchieuController;

class LichchieuTest extends TestCase
{

    public function testStore(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'idphong' => '1',
            'idphim' => '1',
            'ngaychieu' => '01/01/2023',
            'giochieu' => '09:00',
            'gioketthuc' => '10:00',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new LichchieuController();

        // Thực hiện gọi phương thức store trên đối tượng LichchieuController với dữ liệu giả lập
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
            'idphong' => '',
            'idphim' => '1',
            'ngaychieu' => '01/01/2023',
            'giochieu' => '09:00',
            'gioketthuc' => '10:00',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new LichchieuController();

        // Thực hiện gọi phương thức store trên đối tượng LichchieuController với dữ liệu giả lập
        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Phải nhập đủ thông tin', $message);

    }
    public function test_InvalidIdPhong(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'idphong' => 'abc',
            'idphim' => '1',
            'ngaychieu' => '01/01/2023',
            'giochieu' => '09:00',
            'gioketthuc' => '10:00',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new LichchieuController();

        // Thực hiện gọi phương thức store trên đối tượng LichchieuController với dữ liệu giả lập
        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Mã phòng phải là số nguyên dương từ 1-999', $message);

    }
    public function test_InvalidIdPhim(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'idphong' => '1',
            'idphim' => 'abc',
            'ngaychieu' => '01/01/2023',
            'giochieu' => '09:00',
            'gioketthuc' => '10:00',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new LichchieuController();

        // Thực hiện gọi phương thức store trên đối tượng LichchieuController với dữ liệu giả lập
        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Mã phim phải là số nguyên dương từ 1-999', $message);

    }
    public function test_ExistPhongOrPhim(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'idphong' => '60',
            'idphim' => '1',
            'ngaychieu' => '01/01/2023',
            'giochieu' => '09:00',
            'gioketthuc' => '10:00',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new LichchieuController();

        // Thực hiện gọi phương thức store trên đối tượng LichchieuController với dữ liệu giả lập
        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Phòng hoặc phim không tồn tại.', $message);

    }
    public function test_InvalidNgaychieu(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'idphong' => '1',
            'idphim' => '1',
            'ngaychieu' => 'abc',
            'giochieu' => '09:00',
            'gioketthuc' => '10:00',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new LichchieuController();

        // Thực hiện gọi phương thức store trên đối tượng LichchieuController với dữ liệu giả lập
        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Ngày không hợp lệ', $message);

    }
    public function test_InvalidGiochieuOrGioketthuc(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'idphong' => '1',
            'idphim' => '1',
            'ngaychieu' => '01/01/2023',
            'giochieu' => 'abc',
            'gioketthuc' => '10:00',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new LichchieuController();

        // Thực hiện gọi phương thức store trên đối tượng LichchieuController với dữ liệu giả lập
        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Giờ chiếu hoặc giờ kết thúc không hợp lệ', $message);
    }

    public function test_InvalidGiochieuAndGioketthuc(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'idphong' => '1',
            'idphim' => '1',
            'ngaychieu' => '01/01/2023',
            'giochieu' => '12:00',
            'gioketthuc' => '10:00',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new LichchieuController();

        // Thực hiện gọi phương thức store trên đối tượng LichchieuController với dữ liệu giả lập
        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Giờ chiếu phải nhỏ hơn giờ kết thúc', $message);
    }
    public function test_TrungGiochieu(): void
    {
        // Chuẩn bị dữ liệu giả lập
        $request = new Request([
            'idphong' => '1',
            'idphim' => '1',
            'ngaychieu' => '01/01/2023',
            'giochieu' => '09:00',
            'gioketthuc' => '10:00',
        ]);

        // Tạo một đối tượng LichchieuController
        $controller = new LichchieuController();

        // Thực hiện gọi phương thức store trên đối tượng LichchieuController với dữ liệu giả lập
        $response = $controller->store($request);

        // Lấy thông báo từ session trong RedirectResponse
        $message = $response->getSession()->get('message2');

        // Kiểm tra kết quả
        $this->assertEquals('Phòng đang được sử dụng vào thời gian này', $message);

    }
}
