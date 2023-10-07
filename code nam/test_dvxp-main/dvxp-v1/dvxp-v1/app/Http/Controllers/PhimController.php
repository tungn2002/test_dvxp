<?php

namespace App\Http\Controllers;
use App\Http\Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Phim;
use App\Models\LichChieu;
use App\Models\Ghe;
use App\Models\Ve;
use Validate;

use Carbon\Carbon;

use Illuminate\Http\Request;

class PhimController extends Controller
{
    public function index(){
        $phim=Phim::paginate(5);
        //$phim=phim::all();
        return view('danhsachphim',['phim'=>$phim]);
    }
    
    public function create(){
    
        return view('addphim');
    }
    public function store(Request $request)
    {
        if ($request->tenphim == "" || $request->theloai == "" || $request->noidung == "" || $request->daodien == "" || $request->image == "") {
            return redirect()->back()->with('message2', 'Phải nhập đủ thông tin');
        }
        if (!preg_match('/^[A-Za-z0-9\sÀ-ỹ]+$/u', $request->theloai)) {
            return redirect()->back()->with('message2', 'Thể loại không hợp lệ');
        }
        if (!preg_match('/^[A-Za-z0-9\sÀ-ỹ]+$/u', $request->noidung)) {
            return redirect()->back()->with('message2', 'Nội dung không hợp lệ');
        }
        if (!preg_match('/^[A-Za-z0-9\sÀ-ỹ]+$/u', $request->daodien)) {
            return redirect()->back()->with('message2', 'Đạo diễn không hợp lệ');
        }
    
        $image = $request->file('image');
    
        if ($image !== null) {
            // Kiểm tra xem trường 'image' có phải là một tệp ảnh
            if ($image->isValid() && in_array($image->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif'])) {
                // Trường 'image' chứa một tệp ảnh hợp lệ với định dạng JPEG, PNG, JPG hoặc GIF
    
                // Lưu tệp ảnh vào thư mục lưu trữ hoặc thực hiện xử lý khác dựa trên nó
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
    
                // Lưu tên tệp ảnh hoặc thực hiện xử lý khác
                $savedImageName = 'uploads/' . $imageName;
    
                // Tạo đối tượng phim và gán các giá trị
                $phim = new Phim;
                $phim->tenphim = $request->tenphim;
                $phim->theloai = $request->theloai;
                $phim->noidung = $request->noidung;
                $phim->daodien = $request->daodien;
                $phim->image = $savedImageName;
    
                // Kiểm tra sự tồn tại của 'tenphim'
                $existingPhim = Phim::where('tenphim', $request->tenphim)->first();
    
                if ($existingPhim) {
                    return redirect()->back()->with('message', 'Phim đã tồn tại');
                } else {
                    // Lưu đối tượng phim vào cơ sở dữ liệu
                    $phim->save();
                    return redirect()->back()->with('message', 'Thêm thành công');
                }
            } else {
                // Trường 'image' không hợp lệ về định dạng hoặc tính hợp lệ của tệp
                return redirect()->back()->with('error', 'Tệp ảnh không hợp lệ. Chỉ chấp nhận định dạng JPEG, PNG, JPG hoặc GIF.');
            }
        } else {
            // Trường 'image' không tồn tại
            return redirect()->back()->with('error', 'Trường ảnh bị thiếu. Vui lòng chọn một tệp ảnh để tải lên.');
        }
    }

    public function edit($id)
    {
        $phim=Phim::find($id);
        return view('editphim', ['phim' => $phim]);
        
    }
    public function update(Request $request,$id)
    {
        if ($request->tenphim == "" || $request->theloai == "" || $request->noidung == "" || $request->daodien == "" || $request->image == "") {
            return redirect()->back()->with('message2', 'Phải nhập đủ thông tin');
        }
        if (!preg_match('/^[A-Za-z0-9\sÀ-ỹ]+$/u', $request->theloai)) {
            return redirect()->back()->with('message2', 'Thể loại không hợp lệ');
        }
        if (!preg_match('/^[A-Za-z0-9\sÀ-ỹ]+$/u', $request->noidung)) {
            return redirect()->back()->with('message2', 'Nội dung không hợp lệ');
        }
        if (!preg_match('/^[A-Za-z0-9\sÀ-ỹ]+$/u', $request->daodien)) {
            return redirect()->back()->with('message2', 'Đạo diễn không hợp lệ');
        }
    
        $image = $request->file('image');
    
        if ($image !== null) {
            // Kiểm tra xem trường 'image' có phải là một tệp ảnh
            if ($image->isValid() && in_array($image->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif'])) {
                // Trường 'image' chứa một tệp ảnh hợp lệ với định dạng JPEG, PNG, JPG hoặc GIF
    
                // Lưu tệp ảnh vào thư mục lưu trữ hoặc thực hiện xử lý khác dựa trên nó
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
    
                // Lưu tên tệp ảnh hoặc thực hiện xử lý khác
                $savedImageName = 'uploads/' . $imageName;
    
                // Tạo đối tượng phim và gán các giá trị
                $phim = new Phim;
                $phim->tenphim = $request->tenphim;
                $phim->theloai = $request->theloai;
                $phim->noidung = $request->noidung;
                $phim->daodien = $request->daodien;
                $phim->image = $savedImageName;
    
                // Kiểm tra sự tồn tại của 'tenphim'
                $existingPhim = Phim::where('tenphim', $request->tenphim)->first();
    
                if ($existingPhim) {
                    return redirect()->back()->with('message', 'Phim đã tồn tại');
                } else {
                    // Lưu đối tượng phim vào cơ sở dữ liệu
                    $phim->save();
                    return redirect()->back()->with('message', 'Thêm thành công');
                }
            } else {
                // Trường 'image' không hợp lệ về định dạng hoặc tính hợp lệ của tệp
                return redirect()->back()->with('error', 'Tệp ảnh không hợp lệ. Chỉ chấp nhận định dạng JPEG, PNG, JPG hoặc GIF.');
            }
        } else {
            // Trường 'image' không tồn tại
            return redirect()->back()->with('error', 'Trường ảnh bị thiếu. Vui lòng chọn một tệp ảnh để tải lên.');
        }
    }
    public function destroy(Request $request,$id)
    {
        $phim = Phim::find($id);
    
        if ($phim) {
            $phim->delete();
            return redirect()->route('danhsachphim')->with('message', 'Xóa thành công');
        } else {
            return redirect()->route('danhsachphim')->with('message2', 'Phim không tồn tại');
        }
    }
    public function datve($id)
    {
        $phim=Phim::find($id);
        return view('datve', ['phim' => $phim]);
    }
    public function datve1($id)
    {//ngaychieu
        $lichchieu = LichChieu::where('idphim', $id)->get();
        return view('datve1', ['lichchieu' => $lichchieu,'idphim'=>$id]);
    }
    public function datve2(Request $request)
    {//giochieu
        $idphim=$request->idphim;
        $ngaychieu=$request->ngaychieu;
        $lichchieu = LichChieu::where('idphim', $idphim)
                          ->where('ngaychieu', $ngaychieu)
                          ->get();
        return view('datve2', ['lichchieu' => $lichchieu,'idphim'=>$idphim,'ngaychieu'=>$ngaychieu]);
    }
    public function datve3(Request $request)
    {//phong
        $idphim=$request->idphim;
        $ngaychieu=$request->ngaychieu;
        $giochieu=$request->giochieu;
        $lichchieu = LichChieu::where('idphim', $idphim)
                          ->where('ngaychieu', $ngaychieu)
                          ->where('giochieu', $giochieu)
                          ->get();

        return view('datve3', ['lichchieu' => $lichchieu,'idphim'=>$idphim,'ngaychieu'=>$ngaychieu,'giochieu'=>$giochieu]);
    }
    public function datve4(Request $request)
    {//ghe
        $idphim=$request->idphim;
        $ngaychieu=$request->ngaychieu;
        $giochieu=$request->giochieu;
        $idphong=$request->idphong;

        $lichchieu = LichChieu::where('idphim', $idphim)
                          ->where('ngaychieu', $ngaychieu)
                          ->where('giochieu', $giochieu)
                          ->where('idphong', $idphong)
                          ->get();
        $firstLichChieu = $lichchieu->first();
        $idlichchieu = $firstLichChieu->id;

        $ghe = Ghe::where('idlichchieu', $idlichchieu)
            ->where('idphong', $idphong)
            ->orderBy('tenghe')
            ->get();
        $ve=ve::all();

        return view('datve4', ['ghe' => $ghe,'ve'=>$ve]);
    }
    public function datve5(Request $request)
    {

        $ve = Ve::where('idghe',$request->idghe)->first();
        if ($ve) {
            return redirect()->route('trangchu')->with('message', 'Ghế đã có người ngồi');

        }else{
            $currentDate = Carbon::now();
            $ve=new Ve;
            $ve->iduser=$request->iduser;
            $ve->idghe=$request->idghe;
            $ve->ngaymua= $currentDate;
            $ve->save();
            return redirect()->route('trangchu');
        }
       

    }
}
