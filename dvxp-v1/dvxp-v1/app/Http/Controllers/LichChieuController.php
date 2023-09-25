<?php

namespace App\Http\Controllers;
use App\Http\Illuminate\Pagination\LengthAwarePaginator;
use App\Models\LichChieu;
use App\Models\Phim;
use App\Models\Phong;
use Validate;

use Illuminate\Http\Request;

class LichChieuController extends Controller
{
    public function index(){
        $lichchieu=LichChieu::paginate(5);
        //$lichchieu=lichchieu::all();
        return view('danhsachlichchieu',['lichchieu'=>$lichchieu]);
    }
    public function create(){
        $phong=Phong::all();
        $phim=Phim::all();
        return view('addlichchieu',['phong'=>$phong,'phim'=>$phim]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idphong' => [
                'required',                                        // Không được bỏ trống
                'integer',                                         // Là số nguyên
                'digits_between:1,3',                              // Có độ dài từ 1 đến 3 chữ số
                'regex:/^[1-9][0-9]{0,2}$/',                        // Không chứa ký tự đặc biệt và không chứa a-z
                'exists:phong,id',
            ],
            'idphim' => [
                'required',                                        // Không được bỏ trống
                'integer',                                         // Là số nguyên
                'digits_between:1,3',                              // Có độ dài từ 1 đến 3 chữ số
                'regex:/^[1-9][0-9]{0,2}$/',                        // Không chứa ký tự đặc biệt và không chứa a-z
                'exists:phim,id',
            ],
            'ngaychieu' => 'required|date_format:Y-m-d',//ô nhập phải là mm/dd/yyyy
            'giochieu' => 'required|date_format:H:i',
            'gioketthuc' => 'required|date_format:H:i|after:giochieu',
        ],['idphong.required'=>'Mã phòng không được bỏ trống',
            'idphong.exists'=>'Không tồn tại phòng',
            'idphong.integer'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphong.digits_between'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphong.regex'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.required'=>'Mã phòng không được bỏ trống',
            'idphim.integer'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.digits_between'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.regex'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.exists'=>'Không tồn tại phim',
            'ngaychieu.required'=>'Ngày chiếu không được bỏ trống',
            'ngaychieu.date_format'=>'Ngày không hợp lệ',
            'giochieu.required'=>'Giờ chiếu không được bỏ trống',
            'gioketthuc.required'=>'Giờ kết thúc không được bỏ trống',
            'giochieu.date_format'=>'Giờ chiếu không hợp lệ',
            'gioketthuc.date_format'=>'Giờ kết thúc không hợp lệ',
            'gioketthuc.after'=>'Giờ chiếu phải nhỏ hơn giờ kết thúc',
    ]);
        $lichchieu = new LichChieu;
        $lichchieu->idphong = $request->idphong;
        $lichchieu->idphim = $request->idphim;
        $lichchieu->ngaychieu = $request->ngaychieu;
        $lichchieu->giochieu = $request->giochieu;
        $lichchieu->gioketthuc = $request->gioketthuc;
        
        // Kiểm tra trùng idphong và ngaychieu
        $existingRecords = LichChieu::where('idphong', $lichchieu->idphong)
            ->where('ngaychieu', $lichchieu->ngaychieu)
            ->get();
        
        $isValid = true;
        
        foreach ($existingRecords as $record) {
            if (($record->giochieu >= $lichchieu->giochieu && $record->giochieu <= $lichchieu->gioketthuc) ||
                ($record->gioketthuc >= $lichchieu->giochieu && $record->gioketthuc <= $lichchieu->gioketthuc) ||
                ($lichchieu->giochieu >= $record->giochieu && $lichchieu->giochieu <= $record->gioketthuc) ||
                ($lichchieu->gioketthuc >= $record->giochieu && $lichchieu->gioketthuc <= $record->gioketthuc)) {
                $isValid = false;
                break;
            }
        }
        
        if ($isValid) {
            $lichchieu->save();
            return redirect()->back()->with('message', 'Thêm thành công');
        } else {
            return redirect()->back()->with('message', 'Giờ chiếu không hợp lệ');
        }
        /*
        $lichchieu=new LichChieu;
        $lichchieu->idphong=$request->idphong;
        $lichchieu->idphim=$request->idphim;
        $lichchieu->ngaychieu=$request->ngaychieu;
        $lichchieu->giochieu=$request->giochieu;
        $lichchieu->gioketthuc=$request->gioketthuc;        
        $lichchieu->save();
        //return redirect()->route('danhsachlichchieu');
        return redirect()->back()->with('message', 'Thêm thành công');
        */
    }
    public function edit($id)
    {
        $phong=Phong::all();
        $phim=Phim::all();
        $lichchieu=LichChieu::find($id);
        return view('editlichchieu', ['lichchieu' => $lichchieu,'phong'=>$phong,'phim'=>$phim]);
    }
    public function update(Request $request,$id)
    {

          $validated = $request->validate([
            'idphong' => [
                'required',                                        // Không được bỏ trống
                'integer',                                         // Là số nguyên
                'digits_between:1,3',                              // Có độ dài từ 1 đến 3 chữ số
                'regex:/^[1-9][0-9]{0,2}$/',                        // Không chứa ký tự đặc biệt và không chứa a-z
                'exists:phong,id',
            ],
            'idphim' => [
                'required',                                        // Không được bỏ trống
                'integer',                                         // Là số nguyên
                'digits_between:1,3',                              // Có độ dài từ 1 đến 3 chữ số
                'regex:/^[1-9][0-9]{0,2}$/',                        // Không chứa ký tự đặc biệt và không chứa a-z
                'exists:phim,id',
            ],
            'ngaychieu' => 'required|date_format:Y-m-d',//ô nhập phải là mm/dd/yyyy
            'giochieu' => 'required|date_format:H:i',
            'gioketthuc' => 'required|date_format:H:i|after:giochieu',
        ],['idphong.required'=>'Mã phòng không được bỏ trống',
            'idphong.exists'=>'Không tồn tại phòng',
            'idphong.integer'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphong.digits_between'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphong.regex'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.required'=>'Mã phòng không được bỏ trống',
            'idphim.integer'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.digits_between'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.regex'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.exists'=>'Không tồn tại phim',
            'ngaychieu.required'=>'Ngày chiếu không được bỏ trống',
            'ngaychieu.date_format'=>'Ngày không hợp lệ',
            'giochieu.required'=>'Giờ chiếu không được bỏ trống',
            'gioketthuc.required'=>'Giờ kết thúc không được bỏ trống',
            'giochieu.date_format'=>'Giờ chiếu không hợp lệ',
            'gioketthuc.date_format'=>'Giờ kết thúc không hợp lệ',
            'gioketthuc.after'=>'Giờ chiếu phải nhỏ hơn giờ kết thúc',
    ]);
        
        $lichchieu = LichChieu::find($id);
        $lichchieu->idphong=$request->idphong;
        $lichchieu->idphim=$request->idphim;
        $lichchieu->ngaychieu=$request->ngaychieu;
        $lichchieu->giochieu=$request->giochieu;
        $lichchieu->gioketthuc=$request->gioketthuc;  
        
        // Kiểm tra trùng idphong và ngaychieu
        $existingRecords = LichChieu::where('idphong', $lichchieu->idphong)
        ->where('ngaychieu', $lichchieu->ngaychieu)
        ->whereNotIn('id', [$id])
        ->get();
        
        $isValid = true;
        
        foreach ($existingRecords as $record) {
            if (($record->giochieu >= $lichchieu->giochieu && $record->giochieu <= $lichchieu->gioketthuc) ||
                ($record->gioketthuc >= $lichchieu->giochieu && $record->gioketthuc <= $lichchieu->gioketthuc) ||
                ($lichchieu->giochieu >= $record->giochieu && $lichchieu->giochieu <= $record->gioketthuc) ||
                ($lichchieu->gioketthuc >= $record->giochieu && $lichchieu->gioketthuc <= $record->gioketthuc)) {
                $isValid = false;
                break;
            }
        }
        
        if ($isValid) {
            $lichchieu->update();
            return redirect()->route('danhsachlichchieu')->with('message', 'Sửa thành công');
        } else {
            return redirect()->back()->with('message', 'Giờ chiếu không hợp lệ');
        }
        /*
        $lichchieu = LichChieu::find($id);
        $lichchieu->idphong=$request->idphong;
        $lichchieu->idphim=$request->idphim;
        $lichchieu->ngaychieu=$request->ngaychieu;
        $lichchieu->giochieu=$request->giochieu;
        $lichchieu->gioketthuc=$request->gioketthuc;  
        $lichchieu->update();
        return redirect()->route('danhsachlichchieu')->with('message', 'Sửa thành công');
        //return redirect()->back()->with('message2', 'thongbao');
        */
    }
    public function destroy(Request $request,$id)
    {
       
        $lichchieu = LichChieu::find($id);
        if($lichchieu){
            $lichchieu->delete();
            return redirect()->route('danhsachlichchieu')->with('message', 'Xóa thành công');

        }else{
            return redirect()->route('danhsachlichchieu')->with('message', 'Lịch chiếu không tồn tại');

        }
        

        //return redirect()->back()->with('message2', 'thongbao');
    }
}
