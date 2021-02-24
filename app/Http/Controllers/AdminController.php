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

        //  Category List
        if( $_POST['div'] == 'CATEGORY' ){

            $tbl = 'catprt';
            if( $action == 'List' ){
                $list = DB::table($tbl)
                ->select('category','remark')
                ->where([
                    ['status','=','Y']
                ])
                ->orderByRaw('status, category')
                ->get();
                
                $key = "";
                $setList = "";
                if(count($list)>0){
                    foreach($list as $k=>$rs){
                        $key = $rs->category;
                        $setList.= "<tr id='".$rs->category."' class='categoryList' style='cursor:pointer'>";
                        $setList.= "<td>".$rs->category."</td>";
                        $setList.= "<td id='remark_".$key."'>".$rs->remark."</td>";
                        $setList.= "<td>
                                    <span class='categoryLock text-secondary d-inline' data-feather='lock' id='lock_".$key."'></span>
                                    <span class='categoryUnLock text-success d-none' data-feather='unlock' id='unlock_".$key."'></span>
                                    <span class='categoryDelete text-danger d-none' data-feather='trash-2' id='delete_".$key."'></span>
                                    </td>";
                        $setList.= "</tr>";
                    }                        
                }else{
                    $setList.= "<tr>";
                    $setList.= "<td colspan='3' align=center class='text-secondary'>The data does not exist.</td>";
                    $setList.= "</tr>";
                }

                $_RS['result_list'] = $setList;
            }

            else if( $action == 'Update' ){
                $_DATA['remark'] = $_POST['remark'];

                $update = DB::table($tbl)
                ->where('category',$_POST['category'])
                ->update(
                    Func::setRecords($tbl, $_DATA)
                );
            }

            else if( $action == 'Delete' ){
                $_DATA['status'] = 'N';
                $_DATA['d_id'] = Session::get('login_id');
                $_DATA['d_time'] = date('Y-m-d H:i:s');
                $delete = DB::table($tbl)
                ->where([
                    ['category','=',$_POST['category']]
                ])
                ->update(
                    Func::setRecords($tbl, $_DATA)
                );
            }

            else if( $action == 'Save' ){
                $_DATA['status'] = 'Y';
                $_DATA['w_id'] = Session::get('login_id');
                $_DATA['w_time'] = date('Y-m-d H:i:s');
                $_DATA['category'] = $_POST['category'];
                $_DATA['remark'] = $_POST['remark'];
                
                DB::table($tbl)->insert([ 
                    Func::setRecords($tbl, $_DATA)
                ]);
            }

        }
        // Code
        else{
            $tbl = 'catcod';

            if( $action == 'List' ){
                $list = DB::table($tbl)
                ->select('category','code','name', 'sort')
                ->where([
                    ['status','=','Y'],
                    ['category','=',$_POST['category']],
                ])
                ->orderByRaw('sort')
                ->get();

                $key = "";
                $setList = "";
                if(count($list)>0){
                    foreach($list as $k=>$rs){
                        $key = $rs->category."_".$rs->code;
                        $setList.= "<tr style='cursor:pointer'>";
                        $setList.= "<td id='sort_".$key."'>".$rs->sort."</td>";
                        $setList.= "<td id='code_".$key."'>".$rs->code."</td>";
                        $setList.= "<td id='name_".$key."'>".$rs->name."</td>";
                        $setList.= "<td>
                                    <span class='categoryCodeLock text-secondary d-inline' data-feather='lock' id='lock_".$key."'></span>
                                    <span class='categoryCodeUnLock text-success d-none' data-feather='unlock' id='unlock_".$key."'></span>
                                    <span class='categoryCodeDelete text-danger d-none' data-feather='trash-2' id='delete_".$key."'></span>
                                    </td>";
                        $setList.= "</tr>";
                    }
                }else{
                    $setList.= "<tr>";
                    $setList.= "<td colspan='4' align=center class='text-secondary'>The data does not exist.</td>";
                    $setList.= "</tr>";
                }

                $_RS['result_list'] = $setList;
            }

            else if( $action == 'Update' ){
                $_DATA['sort'] = $_POST['sort'];
                $_DATA['name'] = $_POST['name'];
    
                $update = DB::table($tbl)
                ->where([
                    ['category','=',$_POST['category']],
                    ['code','=',$_POST['code']]
                ])
                ->update(
                    Func::setRecords($tbl, $_DATA)
                );
            }

            else if( $action == 'Delete' ){
                $_DATA['status'] = 'N';
                $_DATA['d_id'] = Session::get('login_id');
                $_DATA['d_time'] = date('Y-m-d H:i:s');
                $delete = DB::table($tbl)
                ->where([
                    ['category','=',$_POST['category']],
                    ['code','=',$_POST['code']]
                ])
                ->update(
                    Func::setRecords($tbl, $_DATA)
                );   
            }

            else if( $action == 'Save' ){
                $_DATA['status'] = 'Y';
                $_DATA['w_id'] = Session::get('login_id');
                $_DATA['w_time'] = date('Y-m-d H:i:s');
                $_DATA['category'] = $_POST['category'];
                $_DATA['sort'] = $_POST['sort'];
                $_DATA['code'] = $_POST['code'];
                $_DATA['name'] = $_POST['name'];
                
                DB::table($tbl)->insert([ 
                    Func::setRecords($tbl, $_DATA)
                ]);
            }
        }

        $_RS['result'] = true;
        return json_encode($_RS);
    }
}
