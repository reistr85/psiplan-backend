<?php

use Illuminate\Contracts\Hashing\Hasher;
use Hashids\Hashids;


if (!function_exists('encode')) {
    function encode($val)
    {
        return app(Hashids::class)->encode($val);
    }
}

if (!function_exists('decode')) {
    function decode($val)
    {
        return app(Hashids::class)->decode($val)[0];
    }
}

if (!function_exists('mask')) {
    function mask($mask, $val)
    {
        if(!is_null($val)) {
            $str = str_replace(" ", "", $val);

            for ($i = 0; $i < strlen($str); $i++) {
                $mask[strpos($mask, "#")] = $str[$i];
            }

            return $mask;
        }

        return '';
    }
}

if(!function_exists('getNameMonth')){
    function getNameMonth($month)
    {
        if(!is_null($month)) {
            $dateObj = DateTime::createFromFormat('m', $month);
            $dateObj->setTimezone(new DateTimeZone('America/Sao_Paulo'));
            $monthName = strftime('%B', $dateObj->getTimestamp());

            return ucfirst($monthName);
        }

        return '';
    }
}

if(!function_exists('checkCPF')){
    function checkCPF($cpf = null)
    {
        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }
}

if(!function_exists('onlyNumber')){
    function onlyNumber($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }
}

if(!function_exists('dateEN')){
    function dateEN($date)
    {
        return substr($date, 6, 4)."-".substr($date, 3, 2)."-".substr($date, 0, 2);
    }
}

if(!function_exists('maskPhone')){
    function maskPhone($phone)
    {
        return "(".substr($phone, 0, 2).")".substr($phone, 2, 5)."-".substr($phone, 7, 4);
    }
}

if(!function_exists('checkPIS')){
    function checkPIS($pis)
    {
        $pis = str_pad( onlyNumber($pis), 11, '0', STR_PAD_LEFT);

        if (strlen($pis) != 11 || intval($pis) == 0) {

            return false;

        } else {

            for ($d = 0, $p = 3, $c = 0; $c < 10; $c++) {

                $d += $pis{$c} * $p;

                $p = ($p < 3) ? 9 : --$p;

            }

            $d = ((10 * $d) % 11) % 10;

            return ($pis{$c} == $d) ? true : false;

        }
    }
}

