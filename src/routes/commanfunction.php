<?php

function getDMYDate($date) {
    if (empty($date))
        return $date;
    $dateParts = explode('-', $date);
    $DMYDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
    return $DMYDate;
}

function getYMDDate($date) {
    if (empty($date))
        return $date;
    $dateParts = explode('-', $date);
    $YMDDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
    return $YMDDate;
}

function CatchError($err, $line, $name) {
    $time = date('Y-m-d H:i:s.');
    $sql = "INSERT INTO `ncrm`.`elogs`(`time`,`message`,`file`,`line`) VALUES('" . $time . "','" . $err . "','" . $name . "','" . $line . "')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        return;
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
}
