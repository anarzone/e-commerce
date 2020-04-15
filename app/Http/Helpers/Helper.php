<?php


namespace App\Http\Helpers;


class Helper
{
    public static function randomAppCodeGenarator(){
        return strtoupper(substr(md5(uniqid('')), 0, 9));
    }

}
