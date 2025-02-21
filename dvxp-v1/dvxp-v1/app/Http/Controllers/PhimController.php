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
        $imageName = $request->file('image')->store('images');

        $phim=new Phim;
        $phim->tenphim=$request->tenphim;
        $phim->theloai=$request->theloai;
        $phim->noidung=$request->noidung;
        $phim->daodien=$request->daodien;
        $phim->image=$imageName;
        $phim->thoiluong=$request->thoiluong;
        $phim->save();
        //return redirect()->route('danhsachphim');
        return redirect()->back()->with('message', 'Thêm thành công');

    }
    public function edit($id)
    {
        $phim=Phim::find($id);
        return view('editphim', ['phim' => $phim]);
    }
    public function update(Request $request,$id)
    {
        $imageName = $request->file('image')->store('images');
        $phim = Phim::find($id);
        $phim->tenphim=$request->tenphim;
        $phim->theloai=$request->theloai;
        $phim->noidung=$request->noidung;
        $phim->daodien=$request->daodien;
        $phim->image=$imageName;
        $phim->thoiluong=$request->thoiluong;
        $phim->update();
        return redirect()->route('danhsachphim')->with('message', 'Sửa thành công');
        //return redirect()->back()->with('message2', 'thongbao');
    }
    public function destroy(Request $request,$id)
    {
        $phim = Phim::find($id);
        $phim->delete();
        return redirect()->route('danhsachphim')->with('message', 'Xóa thành công');


        //return redirect()->back()->with('message2', 'thongbao');
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
