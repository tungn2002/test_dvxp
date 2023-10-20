<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Ghe;
use App\Models\Phong;
use App\Models\LichChieu;
use Validate;

use Illuminate\Http\Request;

class GheController extends Controller
{
    public function index(){
        $ghe=Ghe::paginate(5);
        //$ghe=ghe::all();
        return view('danhsachghe',['ghe'=>$ghe]);
    }

    public function create(){

        $phong=Phong::all();
        $lichchieu=LichChieu::all();

        return view('addghe',['phong'=>$phong,'lichchieu'=>$lichchieu]);
    }
    public function store(Request $request)
    {
        if ($request->tenghe=="") {
            return redirect()->back()->with('message2', 'Tên ghế không được bỏ trống.');
        } elseif (!preg_match('/^[a-z0-9]+$/', $request->tenghe)) {
            return redirect()->back()->with('message2', 'Tên ghế chỉ chứa các ký tự a-z và 0-9.');
        }
        
        // Validate idphong
        if ($request->idphong=='') {
            return redirect()->back()->with('message2', 'Mã phòng không được bỏ trống.');   
        } elseif ( !is_int((int) $request->idphong) || $request->idphong<1|| $request->idphong>999) {
            return redirect()->back()->with('message2', 'Mã phòng phải là một số nguyên dương trong khoảng từ 1 đến 999.');
        }
        
        // Validate idlichchieu
        if ($request->idlichchieu=='') {
            return redirect()->back()->with('message2', 'Mã lịch chiếu không được bỏ trống.');
        } elseif (!is_int((int) $request->idlichchieu) || $request->idlichchieu < 1 || $request->idlichchieu > 999) {
            return redirect()->back()->with('message2', 'Mã lịch chiếu phải là một số nguyên dương trong khoảng từ 1 đến 999.');
        }
        
        // Validate giaghe
        if ($request->giaghe=='') {
            return redirect()->back()->with('message2', 'Giá ghế không được bỏ trống.');
        } elseif (!is_numeric($request->giaghe) || $request->giaghe < 1 || $request->giaghe > 999999) {
            return redirect()->back()->with('message2', 'Giá ghế phải là một số nguyên dương trong khoảng từ 1 đến 999999.');
        }
        $totalSeats = DB::table('ghe')->sum('tenghe');
        if($totalSeats>=40){
            return redirect()->back()->with('message', 'Ghế trong phòng đã đủ.');
        }
        $ghe=new Ghe;
        $ghe->tenghe=$request->tenghe;
        $ghe->idphong=$request->idphong;
        $ghe->idlichchieu=$request->idlichchieu;
        $ghe->giaghe=$request->giaghe;

        $ghe->save();
        //return redirect()->route('danhsachghe');
        return redirect()->back()->with('message', 'Thêm thành công');

    }
    public function edit($id)
    {
        $phong=Phong::all();
        $lichchieu=LichChieu::all();

        $ghe=Ghe::find($id);
        return view('editghe', ['ghe' => $ghe,'phong'=>$phong,'lichchieu'=>$lichchieu]);
    }
    public function update(Request $request,$id)
    {
        $ghe = Ghe::find($id);
        $ghe->tenghe=$request->tenghe;
        $ghe->idphong=$request->idphong;
        $ghe->idlichchieu=$request->idlichchieu;
        $ghe->giaghe=$request->giaghe;
        $ghe->update();
        return redirect()->route('danhsachghe')->with('message', 'Sửa thành công');
        //return redirect()->back()->with('message2', 'thongbao');
    }
    public function destroy(Request $request,$id)
    {
        $ghe = Ghe::find($id);
        $ghe->delete();
        return redirect()->route('danhsachghe')->with('message', 'Xóa thành công');
        

        //return redirect()->back()->with('message2', 'thongbao');
    }
}
