<?php
/**
 *  Title : Board Controller | Honeypigman@gmail.com
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

class BoardController extends BaseController
{
    public function action(Request $request)
    {
        unset($_DATA);
        $_DATA = Func::requestToData($request);

       if($_DATA['action'] == "Save"){
            $_DATA['sort'] = 1;
            $_DATA['w_id'] = $_DATA['email'];
            $_DATA['w_time'] = date('Y-m-d H:i:s');
            $_DATA['m_id'] = $_DATA['email'];
            $_DATA['m_time'] = date('Y-m-d H:i:s');
            $_DATA['status'] = 'Y';

            $tbl="brdsim";
            DB::table($tbl)->insert([ 
                Func::setRecords($tbl, $_DATA)
            ]);

            $_RS['result'] = true;
        }

        else if($_DATA['action'] == "Edit"){
            $_DATA['m_id'] = Session::get('login_id');
            $_DATA['m_time'] = date('Y-m-d H:i:s');
    
            $tbl="brdsim";
            DB::table($tbl)
                ->where('no',$_DATA['bno'])
                ->update(
                    Func::setRecords($tbl, $_DATA)
                );

            $_RS['result'] = true;
        }

        else if($_DATA['action'] == "Delete"){
            $_DATA['bno'] = $_POST['bno'];
            $_DATA['status'] = 'N';
            $_DATA['d_id'] = Session::get('login_id');
            $_DATA['d_time'] = date('Y-m-d H:i:s');
    
            $tbl="brdsim";
            DB::table($tbl)
                ->where('no',$_DATA['bno'])
                ->update(
                    Func::setRecords($tbl, $_DATA)
                );
            $_RS['result'] = true;
        }

        else if($_DATA['action'] == "View"){
            $tbl="brdsim";
            $list = DB::table($tbl)->select(DB::raw('no, title, content, status'))
            ->where([
                ['no', '=', $_DATA['bno']]
            ])->get();
    
            $_RS['result'] = true;
            $_RS['result_data'] = $list;
        }

        else if($_DATA['action'] == "List"){
            
            //setPage
            $tbl="brdsim";
            $page = Array();
            $page['limit']=env('PER_PAGE');
            $page['offset']=($_DATA['current_page']>1?(($_DATA['current_page']-1)*env('PER_PAGE')):0);
            $page['totalCnt'] = DB::table($tbl)->where('status',$_DATA['list_status'])->count();
            $page['totalPage'] = ceil($page['totalCnt']/$page['limit']);
            $page['current_page'] = $_DATA['current_page'];

            $list = DB::table($tbl)
            ->where('status',$_DATA['list_status'])
            ->orderByRaw('no desc')
            ->offset($page['offset'])->limit($page['limit'])->get();
            //->orderByRaw('no desc')->paginate(env('PER_PAGE'));
            //->limit(env('PER_PAGE'))->get();
            
            $setList = "";
            foreach($list as $k=>$rs){
                $setList.= "<tr style='vertical-align:middle; cursor:pointer; height:40px;' class='boardView' id='no_".$rs->no."'>";
                $setList.= "<td><input class='form-check-input' type='checkbox' value='' id='flexCheckDefault'></td>";
                $setList.= "<td>".$rs->no."</td>";
                $setList.= "<td>".$rs->sort."</td>";
                $setList.= "<td>".$rs->title."</td>";
                $setList.= "<td>".$rs->m_id."<br/>".$rs->m_time."</td>";
                $setList.= "<td style='".($rs->status=='Y'?'color:blue;':'color:gray;')."'>".$rs->status."</td>";
                $setList.= "</tr>";
            }
            
            $_RS['result'] = true;
            $_RS['result_list'] = $setList;
            $_RS['result_page'] = $page;
        }else{
            $_RS['result'] = false;
        }

        return json_encode($_RS);
    }
}
