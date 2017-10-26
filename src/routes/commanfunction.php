<?php
function getDMYDate($date)
    {
        if(empty($date)) return $date;
        $dateParts=explode('-',$date);
        $DMYDate=$dateParts[2].'-'.$dateParts[1].'-'.$dateParts[0];
        return $DMYDate;
    }
    function getYMDDate($date)
    {
        if(empty($date)) return $date;
        $dateParts=explode('-',$date);
        $YMDDate=$dateParts[2].'-'.$dateParts[1].'-'.$dateParts[0];
        return $YMDDate;
    }
