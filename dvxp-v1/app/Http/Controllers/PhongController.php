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
        $phong=new Phong;
        $phong->tenphong=$request->tenphong;
        $phong->save();
        //return redirect()->route('danhsachphong');
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
