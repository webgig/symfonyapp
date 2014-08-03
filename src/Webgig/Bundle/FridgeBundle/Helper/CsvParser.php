<?php

namespace Webgig\FridgeBundle\Helper;



class CsvParser
{
    public function parse($data,$sep=',',$newline="\n")
    {
        // Exit early if no data is passed
        if(!$data) return false;

        // Extract array of each line of csv data
        $newlineXploded = explode($newline,$data);

        if(is_array($newlineXploded)){
            foreach ($newlineXploded as  $data )
                $commaXplodedArr[] =  explode(",",$data);

            return $commaXplodedArr;
        }
    }
}
