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


    public function setting(Request $request, $action=null){
        // Category
        $tbl = 'catprt';
        $cateory_parent = DB::table($tbl)
        ->select('category','remark','status')
        ->orderByRaw('status, category')
        ->get();

        if($action){
            // Code List
            $tbl = 'catcod';
            $list = DB::table($tbl)
            ->select('category','code','name', 'sort')
            ->where('category','=',$_POST['category'])
            ->orderByRaw('sort')
            ->get();

            $setList = "";
            foreach($list as $k=>$rs){
                $setList.= "<tr>";
                $setList.= "<td>".$rs->sort."</td>";
                $setList.= "<td>".$rs->code."</td>";
                $setList.= "<td>".$rs->name."</td>";
                $setList.= "</tr>";
            }

            $_RS['result'] = true;
            $_RS['result_list'] = $setList;

            return json_encode($_RS);
        }else{            
            return view('admin/setting')->with('PARENT', $cateory_parent);
        }        
    }

}
