<?php
/**
 *  Title : Function Board Comman  | Honeypigman@gmail.com
 *  Date : 2021.02.17
 * 
 */

namespace App\Func;

USE DB;
use Func;
use Session;

class Board
{
    /**
     * Board Template 
     * Param[1] : Table Name
     * Param[2] : Select Object - MODAL, COLUMN, TAB ..
     */
    static function template($tbl, $obj=null){
        unset($_SET);
        $_SET['TABLE'] = $tbl;

        switch( $tbl ) {
            // User
            case 'usrlst':
                $_SET['MODAL']['used'] = true;
                $_SET['TAB']['used'] = true;
                $_SET['TAB']['object'] = ['Active', 'Delete'];
                $_SET['SEARCH']['used'] = true;                
                $_SET['BTN']['used'] = true;    
                $_SET['BTN']['excel'] = false;
                $_SET['BTN']['write'] = true;                    
                $_SET['COLUMN']['object'] = [['no',3], ['email',25], ['sign_in', 15], ['sign_out', 15], ['status', 3]];
                break;

            // Access Log
            case 'acclog':
                $_SET['MODAL']['used'] = false;
                $_SET['TAB']['used'] = false;
                $_SET['SEARCH']['used'] = false;                
                $_SET['BTN']['used'] = false;    
                $_SET['COLUMN']['object'] = [['login_id',10], ['ip',10], ['request_uri', 25], ['request_time', 15]];
                break;
            
            // Simple Board
            default:
                $_SET['MODAL']['used'] = true;
                $_SET['TAB']['used'] = true;
                $_SET['TAB']['object'] = ['Active', 'Delete'];
                $_SET['SEARCH']['used'] = true;                
                $_SET['BTN']['used'] = true;    
                $_SET['BTN']['excel'] = true;
                $_SET['BTN']['write'] = true;                
                $_SET['COLUMN']['object'] = [['no',3], ['title', 40], ['w_id', 5], ['w_time', 10], ['m_id', 5], ['m_time', 10], ['status', 3]];
        }
        if($obj){
            return $_SET[$obj];
        }else{
            return $_SET;
        }
    }

    /**
     * Board MODEL
     * Param[1] : Query Command - Count, List ..
     * Param[2] : Table Name
     * Param[3] : get Data
     * Param[4] : page info
     */
    static function model($query, $tbl, $_DATA, $page=null){
        unset($_RS);
        switch( $tbl ) {
            // User
            case 'usrlst':
                $_RS['COUNT'] = DB::table($tbl)->where('status',$_DATA['list_status'])->count();
                $_RS['LIST'] = DB::table($tbl)
                ->select(DB::raw(Board::setColumns($tbl)))
                ->where('status',$_DATA['list_status'])
                ->orderByRaw('no desc')
                ->offset($page['offset'])
                ->limit($page['limit'])
                ->get();    
                break;

            // Access Log
            case 'acclog':
                $_RS['COUNT'] = DB::table($tbl)->count();
                $_RS['LIST'] = DB::table($tbl)
                ->select(DB::raw(Board::setColumns($tbl)))
                ->orderByRaw('request_time desc')
                ->offset($page['offset'])
                ->limit($page['limit'])
                ->get();     
                break;

            // Simple Board
            default:
                $_RS['COUNT'] = DB::table($tbl)->where('status',$_DATA['list_status'])->count();
                $_RS['LIST'] = DB::table($tbl)
                ->select(DB::raw(Board::setColumns($tbl)))
                ->where('status',$_DATA['list_status'])
                ->orderByRaw('no desc')
                ->offset($page['offset'])
                ->limit($page['limit'])
                ->get();            
        }

        return $_RS[$query];
    }

    /**
     * Board Action
     * Param[1] : Table Name
     */
    static function action($tbl)
    {
        unset($_DATA, $_COLUMN);
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
            $page['totalCnt'] = Board::model('COUNT', $tbl, $_DATA);
            $page['totalPage'] = ceil($page['totalCnt']/$page['limit']);
            $page['current_page'] = $_DATA['current_page'];
            $list = Board::model('LIST', $tbl, $_DATA, $page);
            
            $setList = "";
            foreach($list as $k=>$rs){
                $rs_array = array_keys((array)$rs);
                $setId = (Board::template($tbl, 'MODAL')['used']?"no_".$rs->no:"no");
                $setList.= "<tr style='vertical-align:middle; cursor:pointer; height:40px;' class='boardView' id='".$setId."'>";
                foreach($rs_array as $k=>$v){
                    $setList.= "<td>".$rs->{$rs_array[$k]}."</td>";
                }
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

    /**
     * DB Select Columns Setting
     * Param[1] : Table Name
     */
    static function setColumns($tbl){
        unset($_COLUMNS);
        $_COLUMNS = Board::template($tbl, 'COLUMN');
        $columns = "";
        foreach($_COLUMNS['object'] as $column){
            $columns.=$column[0].",";
        }
        return substr($columns, 0,-1);
    }
}