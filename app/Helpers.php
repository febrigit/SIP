<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\RolePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Helpers extends Model
{
    public static function dateTimeFormat($datetime, $view = 'datetime')
    {
        if ($datetime == null) return '';
        if($datetime == "0000-00-00 00:00:00")
        {
            return "0000-00-00 00:00:00";
        }else{
            $arr_datetime = explode(" ", $datetime);

            $arr_date = explode("-", $arr_datetime[0]);
            $month = [
                '01'=>"Januari",
                '02'=>"Februari",
                '03'=>"Maret",
                '04'=>"April",
                '05'=>"Mei",
                '06'=>"Juni",
                '07'=>"Juli",
                '08'=>"Agustus",
                '09'=>"September",
                '10'=>"Oktober",
                '11'=>"November",
                '12'=>"Desember",
            ];
            $result_month = $month[$arr_date[1]];

            if($view == "datetime")
            {
                return $arr_date[2]." ".$result_month." ".$arr_date[0]." ".substr($arr_datetime[1], 0, 5);
            }elseif($view == "date"){
                return $arr_date[2]." ".$result_month." ".$arr_date[0];
            }
        }
    }

    public static function strToKebab ($str) {
        return Str::kebab($str);
    }

    public static function kebabToTitle ($str) {
        $str = str_replace('-',' ',$str);
        return Str::title($str);
    }

    public static function checkPermission($param) {
        $datas = RolePermission::whereRoleId(Auth::user()->role_id)->get();
        $arr = [];
        foreach ($datas as $val) {
            $arr[] = $val->permission->slug;
        }

        if (in_array($param, $arr)) return true;
        else return false;
    }    
}
