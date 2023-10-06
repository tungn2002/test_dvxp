<?php

namespace App\Http\Controllers;
use App\Http\Illuminate\Pagination\LengthAwarePaginator;
use App\Models\LichChieu;
use App\Models\Phim;
use App\Models\Phong;
use Validate;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
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
        if($request->idphong==""||$request->idphim==""||$request->ngaychieu==""||$request->giochieu==""||$request->gioketthuc==""){
            return redirect()->back()->with('message2', 'Phải nhập đủ thông tin');
        }
        
        if ( !is_int((int) $request->idphong) || $request->idphong<1|| $request->idphong>999) {
            return redirect()->back()->with('message2', 'Mã phòng phải là số nguyên dương từ 1-999');
        }
        if (!is_int((int) $request->idphim) || $request->idphim<1|| $request->idphim>999) {
            return redirect()->back()->with('message2', 'Mã phim phải là số nguyên dương từ 1-999');
        }
        $phong = LichChieu::find($request->idphong);
        $phim = LichChieu::find($request->idphim);
        if(!$phong||!$phim){
            return redirect()->back()->with('message2', 'Phòng hoặc phim không tồn tại.');

        }
        if (!preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{4}$/', $request->ngaychieu)) {
            return redirect()->back()->with('message2', 'Ngày không hợp lệ');
        }

        if (!preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/', $request->giochieu) || !preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/', $request->gioketthuc)) {
            return redirect()->back()->with('message2', 'Giờ chiếu hoặc giờ kết thúc không hợp lệ');
        }

        if ( $request->giochieu >=  $request->gioketthuc) {
            return redirect()->back()->with('message2', 'Giờ chiếu phải nhỏ hơn giờ kết thúc');
        }
        $existingRecords = LichChieu::where('idphong', $request->idphong)->where('ngaychieu', $request->ngaychieu)
        ->where(function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('giochieu', '>=', $request->giochieu)
                    ->where('giochieu', '<=', $request->gioketthuc);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('gioketthuc', '>=', $request->giochieu)
                    ->where('gioketthuc', '<=', $request->gioketthuc);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('giochieu', '<=', $request->giochieu)
                    ->where('gioketthuc', '>=', $request->giochieu);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('giochieu', '<=', $request->gioketthuc)
                    ->where('gioketthuc', '>=', $request->gioketthuc);
            });
        })->get();
        if ($existingRecords->isEmpty()) { 
            $lichchieu = new LichChieu;
            $lichchieu->idphong = $request->idphong;
            $lichchieu->idphim = $request->idphim;
            $lichchieu->ngaychieu = date('Y-m-d', strtotime(str_replace('/', '-', $request->ngaychieu)));
            $lichchieu->giochieu = $request->giochieu;
            $lichchieu->gioketthuc = $request->gioketthuc;
            $lichchieu->save();
            return redirect()->back()->with('message', 'Thêm thành công');
        } else {
            return redirect()->back()->with('message2', 'Phòng đang được sử dụng vào thời gian này');
        }
    } 
 /*$request->validate([
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
    ]);*/
/* Kiểm tra trùng idphong và ngaychieu
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
        */
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
    public function edit($id)
    {
        $phong=Phong::all();
        $phim=Phim::all();
        $lichchieu=LichChieu::find($id);
        return view('editlichchieu', ['lichchieu' => $lichchieu,'phong'=>$phong,'phim'=>$phim]);
    }
    public function update(Request $request,$id)
    {
        $rules = [
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
            'ngaychieu' => 'required',
            'giochieu' => 'required|date_format:H:i',
            'gioketthuc' => 'required|date_format:H:i|after:giochieu',
        ];
        
        $messages = [
            'idphong.required'=>'Phải nhập đủ thông tin',
            'idphong.exists'=>'Phòng hoặc phim không tồn tại.',
            'idphong.integer'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphong.digits_between'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphong.regex'=>'Mã phòng phải là số nguyên dương từ 1-999',

            'idphim.required'=>'Phải nhập đủ thông tin',
            'idphim.integer'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.digits_between'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.regex'=>'Mã phòng phải là số nguyên dương từ 1-999',
            'idphim.exists'=>'Phòng hoặc phim không tồn tại.',

            'ngaychieu.required'=>'Phải nhập đủ thông tin',
            
            'giochieu.required'=>'Phải nhập đủ thông tin',
            'gioketthuc.required'=>'Phải nhập đủ thông tin',
            'giochieu.date_format'=>'Giờ chiếu hoặc giờ kết thúc không hợp lệ',
            'gioketthuc.date_format'=>'Giờ chiếu hoặc giờ kết thúc không hợp lệ',
            'gioketthuc.after'=>'Giờ chiếu phải nhỏ hơn giờ kết thúc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Xử lý khi validate không thành công
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{4}$/', $request->ngaychieu)) {
            return redirect()->back()->with('message2', 'Ngày không hợp lệ');
        }
        /*
          $request->validate([
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
    ]);*/
        
        $lichchieu = LichChieu::find($id);
        $lichchieu->idphong=$request->idphong;
        $lichchieu->idphim=$request->idphim;
        $lichchieu->ngaychieu=date('Y-m-d', strtotime(str_replace('/', '-', $request->ngaychieu)));
        $lichchieu->giochieu=$request->giochieu;
        $lichchieu->gioketthuc=$request->gioketthuc;  
        
        /* Kiểm tra trùng idphong và ngaychieu
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
        */
        $existingRecords = LichChieu::where('idphong', $lichchieu->idphong)
        ->where('ngaychieu', $lichchieu->ngaychieu)
        ->whereNotIn('id', [$id])
        ->where(function ($query) use ($lichchieu) {
            $query->where(function ($q) use ($lichchieu) {
                $q->where('giochieu', '>=', $lichchieu->giochieu)
                    ->where('giochieu', '<=', $lichchieu->gioketthuc);
            })
            ->orWhere(function ($q) use ($lichchieu) {
                $q->where('gioketthuc', '>=', $lichchieu->giochieu)
                    ->where('gioketthuc', '<=', $lichchieu->gioketthuc);
            })
            ->orWhere(function ($q) use ($lichchieu) {
                $q->where('giochieu', '<=', $lichchieu->giochieu)
                    ->where('gioketthuc', '>=', $lichchieu->giochieu);
            })
            ->orWhere(function ($q) use ($lichchieu) {
                $q->where('giochieu', '<=', $lichchieu->gioketthuc)
                    ->where('gioketthuc', '>=', $lichchieu->gioketthuc);
            });
        })
        ->get();
        if ($existingRecords->isEmpty()) {
            $lichchieu->update();
            return redirect()->route('danhsachlichchieu')->with('message', 'Sửa thành công');
        } else {
            return redirect()->back()->with('message2', 'Phòng đang được sử dụng vào thời gian này');
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
    }
}
