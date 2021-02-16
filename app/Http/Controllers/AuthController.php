<?php
/**
 *  Title : Auth Controller  |   Honeypigman@gmail.com
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
use Hash;
use Session;

class AuthController extends BaseController
{
    public function index(Request $request)
    {
        if(Func::isSession($request)){
            return redirect('admin');
        }
        
        return view('index');
    }


    public function signin(Request $request)
    {
        unset($_DATA);
        $_DATA = Func::requestToData($request);
        $_DATA['request_id'] = $_DATA['email'];
        $_DATA['request_ip'] = $_SERVER['REMOTE_ADDR'];
        $_DATA['request_uri'] = $_SERVER['REQUEST_URI'];
        $_DATA['request_time'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        $_DATA['password'] = hash('sha512', $_POST['password'].env('APP_KEY'));

        // Valid Check
        Func::setValidation($request);

        // Login
        $tbl="usrlst";
        $isUser = DB::table($tbl)->where([
            ['email', '=', $_DATA['request_id']],
            ['pw', '=', $_DATA['password']],
            ])->count();
        if($isUser){
            // Via a request instance
            $request->session()->put('login_id', $_DATA['request_id']);
            $request->session()->put('login_time', date('Y-m-d H:i:s'));
            // Via the global helper
            //session(['key' => 'value']);
            
            return redirect('admin');
        }else{
            return redirect('/')
            ->withErrors('This information does not exist!');
        }
    }


    public function signout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
