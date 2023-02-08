<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditDataController extends Controller
{
    //

    public function editUser(Request $request){
        info('controller EditDataController editUSer ----------');

        $id = $request->input('editId');
        $nama = $request->input('editNama');
        $level = $request->input('editLevel');
        $username = $request->input('editUsername');
        $password = $request->input('editPassword');

        DB::table('tb_users')->where('id_user', $id)->update(['nama' => $nama, 'level' => $level, 'username' => $username, 'password' => $password]);

        return redirect('/data_users');
    }

    public function editKelas(Request $request){
        info('controller EditDataController editKelas ----------');

        $id = $request->input('id');
        $kelas = $request->input('kelas');
        $guru = $request->input('guru');
        $id_guru = DB::table('tb_guru')->where('nama', $guru)->get('id_guru');

        DB::table('tb_kelas')->where('id_kelas', $id)->update(['kelas' => $kelas, 'id_guru' => $id_guru[0]->id_guru]);

        return redirect('/data_kelas');
    }

    public function editGuru(Request $request){
        info('controller EditDataController editGuru ----------');

        $id = $request->input('id');
        $nama = $request->input('nama');
        $mapel = $request->input('mapel');
        $id_mapel = '';

        foreach($mapel as $x){
            $dbMapel = DB::table('tb_mapel')->where('mapel', $x)->get('id_mapel');
            $id_mapel .= $dbMapel[0]->id_mapel . '|';
        }

        DB::table('tb_guru')->where('id_guru', $id)->update(['nama' => $nama, 'id_mapel' => $id_mapel]);

        return redirect('/data_guru');
    }

    public function editJadwalPelajaran(Request $request){
        info('controller EditDataController editJadwalPelajaran ----------');

        if(!$request->has(['ruang', 'hari', 'start', 'end', 'guru', 'mapel', 'kelas'])){
            return redirect('/setting_jadwal');
        }

        $namaRuang = $request->input('ruang');
        $hari = $request->input('hari');
        $start = $request->input('start');
        $end = $request->input('end');
        $guru = $request->input('guru');
        $mapel = $request->input('mapel');
        $kelas = $request->input('kelas');

        $id_ruang = DB::table('tb_ruang')->where('nama', $namaRuang)->get('id_ruang')[0]->id_ruang;
        $id_guru = DB::table('tb_guru')->where('nama', $guru)->get('id_guru')[0]->id_guru;
        $id_mapel = DB::table('tb_mapel')->where('mapel', $mapel)->get('id_mapel')[0]->id_mapel;
        $id_kelas = DB::table('tb_kelas')->where('kelas', $kelas)->get('id_kelas')[0]->id_kelas;

        $dbJadwal = DB::table('tb_ruang')->where('id_ruang', $id_ruang)->get($hari)[0]->$hari;
        $jadwal = json_decode($dbJadwal, true);

        foreach($jadwal as $x => $valx){
            if($x >= $start && $x <= $end){
                $jadwal[$x]['jadwal_masuk'] = $start;
                $jadwal[$x]['jadwal_keluar'] = $end;
                $jadwal[$x]['id_guru'] = $id_guru;
                $jadwal[$x]['id_mapel'] = $id_mapel;
                $jadwal[$x]['id_kelas'] = $id_kelas;
            }
        }

        DB::table('tb_ruang')->where('id_ruang', $id_ruang)->update([$hari => json_encode($jadwal)]);

        return redirect('/setting_jadwal');
    }

    public function editAbsensi(Request $request){
        info('controller EditDataController editAbsensi ----------');

        $id = $request->input('id');
        $status = $request->input('status');
        $allowedStatus = array('Hadir', 'Tidak Hadir', 'Izin', 'Sakit');

        if(!in_array($status, $allowedStatus)){
            return back();
        }

        DB::table('tb_absensi')->where('id_absensi', $id)->update(['status' => $status]);

        return back();
    }
}
