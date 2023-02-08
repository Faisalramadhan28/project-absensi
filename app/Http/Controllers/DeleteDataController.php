<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FilterDataController;

class DeleteDataController extends Controller
{
    //

    public function deleteUser(Request $request){
        info('controller DeleteDataController deleteUser ----------');

        $id = $request->input('deleteId');

        DB::table('tb_users')->where('id_user', '=', $id)->delete();

        return redirect('/data_users');
    }

    public function deleteMurid(Request $request){
        info('controller DeleteDataController deleteMurid ----------');

        $id = $request->input('deleteId');

        DB::table('tb_murid')->where('id_murid', '=', $id)->delete();

        return FilterDataController::filterMurid($request);
    }
    public function deleteKelas(Request $request){
        info('controller DeleteDataController deleteKelas ----------');

        $id = $request->input('deleteId');

        DB::table('tb_kelas')->where('id_kelas', '=', $id)->delete();

        return redirect('/data_kelas');
    }

    public function deleteGuru(Request $request){
        info('controller DeleteDataController deleteUser ----------');

        $id = $request->input('deleteId');

        DB::table('tb_guru')->where('id_guru', '=', $id)->delete();

        return redirect('/data_guru');
    }
}
