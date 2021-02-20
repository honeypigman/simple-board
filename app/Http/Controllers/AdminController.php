<?php
/**
 *  Title : Admin Controller | Honeypigman@gmail.com
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
use Code;

class AdminController extends BaseController
{
    public function main(Request $request)
    {
        Code::get();
        return view('admin.index');
    }

}
