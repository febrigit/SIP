<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Helpers extends Model
{
    public static function datetime_format($datetime, $view)
    {
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
                return $arr_date[2]." ".$result_month." ".$arr_date[0]." ".$arr_datetime[1];
            }elseif($view == "date"){
                return $arr_date[2]." ".$result_month." ".$arr_date[0];
            }
        }
    }
}
