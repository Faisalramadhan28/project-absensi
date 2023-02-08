<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddDataController extends Controller
{
    //

    public function addUser(Request $request){
        info('controller AddDataController addUser ----------');

        $nama = $request->input('nama');
        $level = $request->input('level');
        $username = $request->input('username');
        $password = $request->input('password');

        DB::table('tb_users')->insert(['nama' => $nama, 'level' => $level, 'username' => $username, 'password' => $password]);

        return redirect('/data_users');
    }

    public function addKelas(Request $request){
        info('controller AddDataController addKelas ----------');

        $kelas = $request->input('kelas');
        $guru = $request->input('guru');
        $id_guru = DB::table('tb_guru')->where('nama', $guru)->get('id_guru');

        DB::table('tb_kelas')->insert(['kelas' => $kelas, 'id_guru' => $id_guru[0]->id_guru]);

        return redirect('/data_kelas');
    }

    public function addGuru(Request $request){
        info('controller AddDataController addKelas ----------');

        $nama = $request->input('nama');
        $mapel = $request->input('mapel');
        $id_mapel = '';

        foreach($mapel as $x){
            $dbMapel = DB::table('tb_mapel')->where('mapel', $x)->get('id_mapel');
            $id_mapel .= $dbMapel[0]->id_mapel . '|';
        }

        DB::table('tb_guru')->insert(['nama' => $nama, 'id_mapel' => $id_mapel]);

        return redirect('/data_guru');
    }
}
