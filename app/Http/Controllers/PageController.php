<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GetDataController;

class PageController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
    */

    public function withSidebar($page){
        info('controller PageController withSidebar ----------');

        if(!view()->exists($page)){
            $content = view('404');
            return view('main', ['content' => $content]);
        }

        $content = view($page);
        return view('main', ['content' => $content]);
    }

    public static function includeSidebar($content){
        info('controller PageController includeSidebar ----------');

        return view('main', ['content' => $content]);
    }

    public function viewRoom($name){
        info('controller PageController viewRoom ----------');

        $data = GetDataController::getAbsensiRoom($name);
        if($data == false){
            info('controller PageController viewRoom return false----------');
            $content = view('404');
        }
        else{
            $content = view('ruang', ['data' => $data]);
        }

        return $this->includeSidebar($content);
    }

    public function withFilter(){
        info('controller PageController withFilter ----------');

        if(session()->missing('filtered')){
            $content = view('404');
            return view('main', ['content' => $content]);
        }

        return session()->get('filtered');
    }
}
