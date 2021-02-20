<?php
/**
 *  Title : Code | Honeypigman@gmail.com
 *  Date : 2021.02.19
 * 
 */

namespace App\Func;

USE DB;

class Code
{
    /**
     * Category
     */
    static function get($category=null){
        unset($_RS);
        $tbl="catcod";
        $list = DB::table($tbl)
        ->select('category','code','name')
        ->where([
            ['status','=','Y']
        ])
        ->orderByRaw('sort')
        ->get();

        foreach($list as $k=>$v){
            if( $category ){
                if( $category == $v->category ){
                    $_RS[$v->code]=$v->name;    
                }
            }else{
                $_RS[$v->category][$v->code]=$v->name;
            }
        }
        return $_RS;
    }
}