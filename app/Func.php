<?php

namespace App;

USE DB;

class Func
{
    /**
     * Request > parameter To Data
     *  PARAM[1] : Requests
     */
    static function requestToData($request){
        unset($_DATA);
        foreach($request->request as $k=>$v){
            $_DATA[$k]=$v;
        }

        return $_DATA;
    }

    /**
     * Set Column Record
     *  PARAM[1] : Table name
     *  PARAM[2] : DATAS
     */
    static function setRecords($tbl, $_DATA){
        $_RS = Array();
        // Table Column ListUP
        if($colums =  DB::getSchemaBuilder()->getColumnListing($tbl)){            
            foreach($colums as $k=>$v){
                if(array_key_exists($v, $_DATA)){
                    
                    $columType =  DB::getSchemaBuilder()->getColumnType($tbl, $v);
                    // if($columType!='integer'){
                    //     $_DATA[$v]="'".$_DATA[$v]."'";
                    // }

                    $_RS[$v]=$_DATA[$v];
                }
            }
        }
        return $_RS;
    }

    /**
     * Set Validtaion
     *  PARAM[1] : $request
     */
    static function setValidation($request){
        unset($_RS);
        $messages = [
            'email.min' => 'The Email minimum length is 5 digits!',
            'email.email' => 'Invalid Email Format!',
            'email.required' => 'Enter Your Email!',
            'password.required' => 'Enter Your password!',
            'password.min' => 'The Password minimum length is 8 digits!',
        ];

        $_RS = $request->validate([
            'email' => 'required|email|min:5',
            'password' => 'required|min:8'
        ], $messages);

        return $_RS;
    }

    /**
     * Set Validtaion
     *  PARAM[1] : $request
     */
    static function isSession($request){
        $_RS = false;
        if($request->session()->get('login_id')){
            $_RS = true;
        }
        return $_RS;
    }
    
    /**
     * Write Access Log
     *  PARAM[1] : $request
     */
    static function accLog($request){
        unset($_DATA);
        $_DATA['ip'] = $request->server('REMOTE_ADDR');
        $_DATA['login_id'] = $request->session()->get('login_id');
        $_DATA['request_uri'] = $request->server('REQUEST_URI');
        $_DATA['request_time'] = date('Y-m-d H:i:s');

        $tbl="acclog";
        DB::table($tbl)->insert([ 
            Func::setRecords($tbl, $_DATA)
        ]);
    }
}