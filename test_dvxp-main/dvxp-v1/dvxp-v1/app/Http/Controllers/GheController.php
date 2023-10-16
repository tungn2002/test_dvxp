<?php

namespace App\Http\Controllers;
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
        //lichcieu idpohng mà khac vs gheidphong la sai
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
