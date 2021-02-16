<?php
/**
 *  Title : Admin Controller  |   Honeypigman@gmail.com
 *  Date : 2020.12.30
 * 
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use DB;
use Func;
use Session;

class AdminController extends BaseController
{
    public function main(Request $request)
    {
        return view('admin.index');
    }

    public function users(Request $request)
    {
        unset($_DATA);
        $tbl="usrlst";
        $list = DB::table($tbl)->select(
            DB::raw('no, email, sign_in, sign_out, status, (select request_time from acclog where email = email order by request_time desc limit 1) as last_access_time')
        )->orderByRaw('no desc')->get();
        
        return view('admin.users')->with('result', $list);
    }

    public function accessLog(Request $request)
    {
        unset($_DATA);

        $tbl="acclog";
        $list = DB::table($tbl)->orderByRaw('request_time desc')->get();

        return view('admin.access')->with('result', $list);
    }
}
