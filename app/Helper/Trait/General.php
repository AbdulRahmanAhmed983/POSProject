<?php
namespace App\Helper\Trait;

Trait General
{
    function uploadImage($folder,$img){
        $img->store('/',$folder);
        $filename = $img->hashName();
        $path =  $folder . '/' . $filename;

        return $path;
    }


 

    



}











?>