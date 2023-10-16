<?php

namespace App\Http\Controllers;
use App\Http\Illuminate\Pagination\LengthAwarePaginator;
use App\Models\ChucVu;
use Illuminate\Http\Request;
use Validate;
class ChucVuController extends Controller
{
    public function index(){
        $chucvu=ChucVu::paginate(5);
        //$chucvu=ChucVu::all();
        return view('danhsachchucvu',['chucvu'=>$chucvu]);
    }
    
    public function create(){
    
        return view('addchucvu');
    }
    public function store(Request $request)
    {
        $chucvu=new ChucVu;
        $chucvu->tenchucvu=$request->tenchucvu;
        $chucvu->save();
        //return redirect()->route('danhsachchucvu');
        return redirect()->back()->with('message', 'Thêm thành công');

    }
    public function edit($id)
    {
        $chucvu=ChucVu::find($id);
        return view('editchucvu', ['chucvu' => $chucvu]);
    }
    public function update(Request $request,$id)
    {
        $chucvu = ChucVu::find($id);
        $chucvu->tenchucvu=$request->tenchucvu;
        $chucvu->update();
        return redirect()->route('danhsachchucvu')->with('message', 'Sửa thành công');
        //return redirect()->back()->with('message2', 'thongbao');
    }
    public function destroy(Request $request,$id)
    {
        $chucvu = ChucVu::find($id);
        $chucvu->delete();
        return redirect()->route('danhsachchucvu')->with('message', 'Xóa thành công');


        //return redirect()->back()->with('message2', 'thongbao');
    }
}
