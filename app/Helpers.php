<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Permission;
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

    public static function colorStatus($status)
    {
        if ($status == 'OPEN') return 'secondary';        
        if ($status == 'REQUESTED') return 'warning';        
        if ($status == 'APPROVED') return 'primary';
        if ($status == 'CANCELED') return 'danger';

        if ($status == 'WAITING') return 'secondary';
        if ($status == 'PROCESS') return 'primary';
        if ($status == 'CLOSE') return 'success';
        return 'secondary';
    }

    public static function iconStatus($status)
    {
        if ($status == 'OPEN') return 'fa-solid fa-circle';        
        if ($status == 'REQUESTED') return 'fa fa-clock';        
        if ($status == 'APPROVED') return 'fa-solid fa-check-to-slot';
        if ($status == 'CANCELED') return 'fa-solid fa-circle-xmark';
        return 'fa-solid fa-circle';
    }


	public static function say ($nilai) {
		$that = new Helpers; 
        $tempNilai = $nilai;
		$nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } elseif ($nilai <20) {
            $temp = $that->say($nilai - 10). " Belas";
        } elseif ($nilai < 100) {
            $temp = $that->say($nilai/10)." Puluh". $that->say($nilai % 10);
        } elseif ($nilai < 200) {
            $temp = " Seratus" . $that->say($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $that->say($nilai/100) . " Ratus" . $that->say($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . $that->say($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $that->say($nilai/1000) . " Ribu" . $that->say($nilai % 1000);
        } else if ($nilai < 1000000000) {
              $temp = $that->say($nilai/1000000) . " Juta" . $that->say($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $that->say($nilai/1000000000) . " Milyar" . $that->say(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $that->say($nilai/1000000000000) . " Trilyun" . $that->say(fmod($nilai,1000000000000));
		}    
        if ($tempNilai < 0) 'Minus '.$temp;
		return $temp;
	}

    public static function generateCode($prefix = 'JDV', $data, $lastData = null) {
		$that = new Helpers; 
        $program = DB::table('programs')->where('id', $data->program_id)->first();
        if (!$lastData) {
            $num = 1;
        } else {
            $num = explode('/', $lastData->code)[3] + 1;
        }

        if ($num < 10) {
            $num = '00'.$num;
        } else if ($num < 100) {
            $num = '0'.$num;
        }
        $program_code = $program->code ?? '00';
        $num = $prefix.'/'.$program_code.'/'.$that->numberToRoman(date('m')).'/'.$num;

        return $num;
    }

    function numberToRoman($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public static function romawi($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public static function initPermission() {
        // $datas = Permission::get();
        $arr = [];
        // foreach ($datas as $val) {
            // $arr[$val->name] = json_decode($val->value);
        // }
        return $arr;
    }

    public static function strToKebab ($str) {
        return Str::kebab($str);
    }
}
