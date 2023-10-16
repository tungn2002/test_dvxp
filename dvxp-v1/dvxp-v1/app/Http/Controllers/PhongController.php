<?php

namespace App\Http\Controllers;
use App\Http\Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Phong;
use Illuminate\Http\Request;
use Validate;

class PhongController extends Controller
{
    public function index(){
        $phong=Phong::paginate(5);
        //$phong=phong::all();
        return view('danhsachphong',['phong'=>$phong]);
    }
    
    public function create(){
    
        return view('addphong');
    }
    public function store(Request $request)
    {
        if($request->tenphong==""||$request->loaiphong==""||$request->soghe==""){
            return redirect()->back()->with('message2', 'Phải nhập đủ thông tin');
        }
        if(validator()->make($request->all(), ['tenphong' => [ 'regex:/^[a-zA-Z0-9 ]+$/']
        ])->fails()){
            return redirect()->back()->with('message2', 'Tên phòng phải là chữ từ a-z,A-Z và số 0-9');
        }
        if(validator()->make($request->all(), ['loaiphong' => [ 'regex:/^[a-zA-Z0-9 ]+$/']
        ])->fails()){
            return redirect()->back()->with('message2', 'Loại phòng phải là chữ từ a-z,A-Z và số 0-9');
        }
        if(validator()->make($request->all(), ['soghe' => [ 'numeric','integer','min:1']
        ])->fails()){
            return redirect()->back()->with('message2', 'Số ghế phải là số nguyên dương');
        }
        $phong=new Phong;
        $phong->tenphong=$request->tenphong;
        $phong->loaiphong=$request->loaiphong;
        $phong->soghe=$request->soghe;
        $phong->save();
        return redirect()->back()->with('message', 'Thêm thành công');
    }
    public function edit($id)
    {
        $phong=Phong::find($id);
        return view('editphong', ['phong' => $phong]);
    }
    public function update(Request $request,$id)
    {
        $phong = Phong::find($id);
        $phong->tenphong=$request->tenphong;
        $phong->loaiphong=$request->loaiphong;
        $phong->soghe=$request->soghe;
        $phong->update();
        return redirect()->route('danhsachphong')->with('message', 'Sửa thành công');
        //return redirect()->back()->with('message2', 'thongbao');
    }
    public function destroy(Request $request,$id)
    {
        $phong = Phong::find($id);
        $phong->delete();
        return redirect()->route('danhsachphong')->with('message', 'Xóa thành công');


        //return redirect()->back()->with('message2', 'thongbao');
    }
}
