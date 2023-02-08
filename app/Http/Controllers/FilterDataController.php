<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\PageController;

class FilterDataController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */

    public static function filterMurid(Request $request){
        info('controller FilterDataController filterMurid ----------');

        if($request->input('kelas') == 'All' || $request->input('jurusan') == 'All'){
            $kelas = " ";
            session(['filter_murid' => "$kelas"]);
        }
        else if($request->has('kelas') || $request->has('jurusan')){
            $kelas = $request->input('kelas') . ' ' . $request->input('jurusan');
            session(['filter_murid' => "$kelas"]);
        }
        else if(session()->has('filter_murid')){
            $kelas = session()->get('filter_murid');
        }
        else{
            return redirect('/data_murid');
        }

        $dataMurid = GetDataController::getMurid($kelas);
        $dataKelas = GetDataController::getKelas();
        $data = array('murid' => $dataMurid, 'kelas' => $dataKelas);

        $content = view('data_murid', ['data' => $data]);
        $fullPage = PageController::includeSidebar($content);

        session(['filtered' => "$fullPage"]);

        return redirect('/filter/data_murid');
    }

    public static function filterJadwalPelajaran(Request $request){
        info('controller FilterDataController filterJadwalPelajaran ----------');

        if($request->has('ruang')){
            $ruang = $request->input('ruang');
        }
        else{
            return redirect('/jadwal_pelajaran');
        }

        $id_ruang = DB::table('tb_ruang')->where('nama', $ruang)->get('id_ruang');

        $jadwal = GetDataController::getJadwalRuang($id_ruang[0]->id_ruang);
        $content = view('jadwal_pelajaran', ['jadwal' => $jadwal, 'ruang' => $ruang]);
        $fullPage = PageController::includeSidebar($content);

        session(['filtered' => "$fullPage"]);

        return redirect('/filter/jadwal_pelajaran');
    }

    public static function filterRekapAbsensi(Request $request){
        info('controller FilterDataController filterRekapAbsensi ----------');

        if(!$request->has(['rekap', 'kelas'])){
            return redirect('/rekap_absensi');
        }

        $rekap = $request->input('rekap');
        $listKelas = GetDataController::getKelas();
        $kelas = $request->input('kelas');
        $id_kelas = -1;
        $tanggal = date('Y/m/d');

        foreach($listKelas as $x){
            if($kelas == $x['kelas']){
                $id_kelas = $x['id_kelas'];
            }
        }

        if($rekap == 'Per 1 Minggu'){
            $rTanggal = date_format(date_modify(date_create($tanggal), '-7 days'), 'Y/m/d');
        }
        else if($rekap == 'Per 2 Minggu'){
            $rTanggal = date_format(date_modify(date_create($tanggal), '-14 days'), 'Y/m/d');
        }
        else if($rekap == 'Per 3 Minggu'){
            $rTanggal = date_format(date_modify(date_create($tanggal), '-21 days'), 'Y/m/d');
        }
        else if($rekap == 'Per Bulan'){
            $rTanggal = date_format(date_modify(date_create($tanggal), '-30 days'), 'Y/m/d');
        }
        else{
            $rTanggal = date_format(date_modify(date_create($tanggal), '-9999 days'), 'Y/m/d');
        }
        info($rTanggal);

        $dbAbsensi = DB::table('tb_absensi')->where('id_kelas', $id_kelas)->whereBetween('tanggal', [$rTanggal, $tanggal])->get('*');
        if(count($dbAbsensi) == 0){
            info('0 data');
            return back();
        }

        info($dbAbsensi);

        return back();
    }

}
