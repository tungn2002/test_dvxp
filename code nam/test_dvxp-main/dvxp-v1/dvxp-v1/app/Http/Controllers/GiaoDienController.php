<?php

namespace App\Http\Controllers;
use App\Http\Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Phim;
use Illuminate\Http\Request;
use Validate;

class GiaoDienController extends Controller
{
    public function index(){
        $phim=Phim::paginate(4);
        //$ghe=ghe::all();
        return view('trangchu',['phim'=>$phim]);
    }
    public function login(){
        return view('dangnhap');
    }
    public function signup(){
        return view('dangki');
    }
    public function dangxuat(){
        session()->forget('id');
        $phim=Phim::paginate(4);
        //$ghe=ghe::all();
        return view('trangchu',['phim'=>$phim]);
    }
    public function thongtinchung($id){
        $user = User::find($id);
        return view('thongtinchung',['user'=>$user]);

    }
    public function doimk(){
        return view('doimatkhau');
    }
    public function xulydangnhap(Request $request)
    {
        $users = User::all();
        foreach($users as $user){
            if($user->email == $request->email && $user->password == $request->password){
                Session::put('id', $user->id);
                return redirect()->route('trangchu')->with('message','Đăng nhập thành công!');
            }
        }
        return redirect()->route('dangnhap')->with('message','Tài khoản hoặc mật khẩu không chính xác!');
    }
    public function xulydangky(Request $request)
    {
        $user = new User;
        $user->tenuser = $request->tenuser;
        $user->gioitinh = $request->gioitinh;
        $user->ngaysinh = $request->ngaysinh;
        $user->diachi = $request->diachi;
        $user->sdt = $request->sdt;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect()->route('dangnhap')->with('message','Đăng ký thành công!');
    }
    public function xulydoimatkhau(Request $request, $id)
    {
        $user = User::find($id);
        $password_old = $request->password_old;
        $password_new = $request->password_new;
        $re_password = $request->re_password;
        if($user->password == $password_old && $password_new == $re_password){
            $user->password = $password_new;
            $user->save();
            return redirect()->route('trangchu')->with('message','Đổi mật khẩu thành công!');
        }
        return redirect()->back()->with('message','Đổi mật khẩu thất bại!');
    }
}
