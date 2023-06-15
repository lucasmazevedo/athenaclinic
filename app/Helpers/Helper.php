<?php

// namespace App\Helpers;

// class Helper
// {

    function onlyNumber($value) {
        $number = preg_replace('/[^0-9]/','', $value);
        return $number;
    }

    function dataMysql($value) {
        $data = \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        return $data;
    }

    function dataPtbr($value) {
        $data = \Carbon\Carbon::parse($value)->format('d/m/Y');
        return $data;
    }

    function showDoc($value) {
        if (! $value) {
            return '';
        }
        if (strlen($value) == 11) {
            return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9);
        }elseif(strlen($value) == 14) {
            return substr($value, 0, 2) . '.' . substr($value, 2, 3) . '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4) . '-' . substr($value, 12, 2);
        }
        return $value;
    }

    function fone($fone) {
        if (! $fone) {
            return '';
        }
        if (strlen($fone) == 10) {
            return '(' . substr($fone, 0, 2) . ')' . substr($fone, 2, 4) . '-' . substr($fone, 6);
        }

        if (strlen($fone) == 11) {
            return '(' . substr($fone, 0, 2) . ')' . substr($fone, 2, 5) . '-' . substr($fone, 7);
        }
        return $fone;
    }

// }
