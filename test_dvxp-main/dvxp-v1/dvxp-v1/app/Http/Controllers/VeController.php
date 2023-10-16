<?php

namespace App\Http\Controllers;
use App\Http\Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Ghe;
use App\Models\User;
use App\Models\Ve;
use Validate;

use Illuminate\Http\Request;

class VeController extends Controller
{
    public function index(){
        $ve=Ve::paginate(5);
        //$ve=ve::all();
        return view('danhsachve',['ve'=>$ve]);
    }

    public function create(){
        $user=User::all();
        $ghe = Ghe::whereNotIn('id', function ($query) {
            $query->select('idghe')
                  ->from('ve');
        })->get();
        return view('addve',['user'=>$user,'ghe'=>$ghe]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idghe' => 'required|not_in:0',
            'ngaymua' => 'required|date_format:Y-d-m',
        ], [
            'idghe.required' => 'Mã ghế không hợp lệ.',
            'idghe.not_in' => 'Ghế đã được mua bởi người khác.',
            'ngaymua.required' => 'Ngày mua không hợp lệ.',
            'ngaymua.date_format' => 'Ngày mua không hợp lệ.',
        ]);
        $ve=new Ve;
        $ve->iduser=$request->iduser;
        $ve->idghe=$request->idghe;
        $ve->ngaymua=$request->ngaymua;

        $ve->save();
        //return redirect()->route('danhsachve');
        return redirect()->back()->with('message', 'Thêm thành công');

    }
    public function edit($id)
    {
        $user=User::all();
        $ghe = Ghe::whereNotIn('id', function ($query) {
            $query->select('idghe')
                  ->from('ve');
        })->get();
        $ve=Ve::find($id);
        return view('editve', ['ve' => $ve,'user'=>$user,'ghe'=>$ghe]);
    }
    public function update(Request $request,$id)
    {
        $ve = Ve::find($id);
        $ve->iduser=$request->iduser;
        $ve->idghe=$request->idghe;
        $ve->ngaymua=$request->ngaymua;
        $ve->update();
        return redirect()->route('danhsachve')->with('message', 'Sửa thành công');
        //return redirect()->back()->with('message2', 'thongbao');
    }
    public function destroy(Request $request,$id)
    {
        $ve = Ve::find($id);
        $ve->delete();
        return redirect()->route('danhsachve')->with('message', 'Xóa thành công');


        //return redirect()->back()->with('message2', 'thongbao');
    }
}
