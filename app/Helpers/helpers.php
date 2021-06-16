<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;


if (! function_exists('setActive')){
    //mengecek apakah route tertentu sedang aktif atau tidak
    //menambah class active pada tag html
    function setActive($path)
    {
        return Request::is($path.'*') ? 'active' : '';
    }
}

if(! function_exists('TanggalID')){
    //mengubah format tanggal menjadi bentuk Indonesia
    function TanggalID($tanggal)
    {
        $value = Carbon::parse($tanggal);
        $parse = $value->locale('id');

        return $parse->translatedFormat('l, d F Y');
    }
}
?>
