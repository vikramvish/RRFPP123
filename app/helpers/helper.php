<?php
namespace App\Helpers;

class Helper
{
    public static function IDGenerator($model,$trow,$lenght=10,$prefix){
        $data = $model::orderBy('id','desc')->first();
        if(!$kh_data)
        {
        $kh_length = $lenght;
        $last_number = '';
        }else{
            $code_kh = substr($kh_data->$trow,strlen($prefix)+1);
            $kh_last_number = ($code_kh/1)*1;
            $increment_last_number = $kh_last_number+1;
            $last_number_length = strlen( $increment_last_number);
            $kh_length = $length - $last_number_length;
            $last_number_length = $increment_last_number;
        }
        $khmer = "";
        for($i=0;$i<$kh_length;$i++)
        {
            $khmer.="0";
        }
        return $prefix.'-'.$khmer.$last_number;
    }
}


?>