<?php

namespace App\Func;

USE DB;
use Func;
use Session;

class Board
{
    static function template($tbl){
        unset($_SET);
        $_SET['TABLE'] = $tbl;

        switch( $tbl ) {
            // Simple Board
            case 'brdsim':
                $_SET['TAB']['used'] = true;
                $_SET['TAB']['object'] = ['Active', 'Delete'];
                
                $_SET['SEARCH']['used'] = true;
                
                $_SET['BTN']['used'] = true;    
                $_SET['BTN']['excel'] = true;
                $_SET['BTN']['write'] = true;
                
                $_SET['TITLE']['object'] = [['no',3], ['sort',3], ['title', 20], ['info', 15], ['status', 5]];
                break;
            case 'usrlst':
                $_SET['TAB']['used'] = true;
                $_SET['TAB']['object'] = ['Active', 'Delete'];
                
                $_SET['SEARCH']['used'] = true;
                
                $_SET['BTN']['used'] = true;    
                $_SET['BTN']['excel'] = true;
                $_SET['BTN']['write'] = true;
                
                $_SET['TITLE']['object'] = [['no',3], ['sort',3], ['title', 25], ['info', 15], ['status', 5]];
                break;
            default:
                $_SET['TAB']['used'] = false;
                $_SET['TAB']['object'] = ['Active', 'Delete'];
                
                $_SET['SEARCH']['used'] = false;
                
                $_SET['BTN']['used'] = false;

                $_SET['TITLE']['object'] = [['no',3], ['sort',3], ['title', 20], ['info', 15], ['status', 5]];
        }
        return $_SET;
    }

    static function board(Request $request){
        /**
         *  PARAM[1] : table name
         */
        $_SET = $this->template('brdsim');
        return view('admin.board')->with('set', $_SET);
    }

    static function action($tbl)
    {
        unset($_DATA);
        $_DATA = $_POST;

       if($_DATA['action'] == "Save"){
            $_DATA['sort'] = 1;
            $_DATA['w_id'] = $_DATA['email'];
            $_DATA['w_time'] = date('Y-m-d H:i:s');
            $_DATA['m_id'] = $_DATA['email'];
            $_DATA['m_time'] = date('Y-m-d H:i:s');
            $_DATA['status'] = 'Y';

            DB::table($tbl)->insert([ 
                Func::setRecords($tbl, $_DATA)
            ]);

            $_RS['result'] = true;
        }

        else if($_DATA['action'] == "Edit"){
            $_DATA['m_id'] = Session::get('login_id');
            $_DATA['m_time'] = date('Y-m-d H:i:s');
    
            DB::table($tbl)
                ->where('no',$_DATA['bno'])
                ->update(
                    Func::setRecords($tbl, $_DATA)
                );

            $_RS['result'] = true;
        }

        else if($_DATA['action'] == "Delete"){
            unset($_DATA);
            $_DATA['bno'] = $_POST['bno'];
            $_DATA['status'] = 'N';
            $_DATA['d_id'] = Session::get('login_id');
            $_DATA['d_time'] = date('Y-m-d H:i:s');
    
            DB::table($tbl)
                ->where('no',$_DATA['bno'])
                ->update(
                    Func::setRecords($tbl, $_DATA)
                );
            $_RS['result'] = true;
        }

        else if($_DATA['action'] == "View"){
            $list = DB::table($tbl)->select(DB::raw('no, title, content, status'))
            ->where([
                ['no', '=', $_DATA['bno']]
            ])->get();
    
            $_RS['result'] = true;
            $_RS['result_data'] = $list;
        }

        else if($_DATA['action'] == "List"){
            
            //setPage
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