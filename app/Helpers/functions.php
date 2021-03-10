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

if(!function_exists('getNameMonthPT')){
    function getNameMonthPT($month)
    {
        if(!is_null($month)) {
            $dateObj = DateTime::createFromFormat('m', $month);
            $dateObj->setTimezone(new DateTimeZone('America/Sao_Paulo'));
            $monthName = strftime('%B', $dateObj->getTimestamp());

            if($monthName === 'January'){
                return 'Janeiro';
            }else if($monthName === 'February'){
                return 'Fevereiro';
            }else if($monthName === 'March'){
                return 'Março';
            }else if($monthName === 'April'){
                return 'Abril';
            }else if($monthName === 'May'){
                return 'Maio';
            }else if($monthName === 'June'){
                return 'Junho';
            }else if($monthName === 'July'){
                return 'Julho';
            }else if($monthName === 'August'){
                return 'Agosto';
            }else if($monthName === 'September'){
                return 'Setembro';
            }else if($monthName === 'October'){
                return 'Outubro';
            }else if($monthName === 'November'){
                return 'Novembro';
            }else if($monthName === 'December'){
                return 'Dezembro';
            }
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

if(!function_exists('dateInFull')){
    function dateInFull($date)
    {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);


        return $day." de ".getNameMonthPT($month)." de ".$year." (".weekDayPT("{$year}-{$month}-{$day}").")";

    }
}

if(!function_exists('weekDayPT')){
    function weekDayPT($date)
    {
        $week_day = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado');
        $week_day_number = date('w', strtotime($date));

        return  $week_day[$week_day_number];

    }
}

if(!function_exists('hour')){
    function hour($date)
    {
        return  substr($date, 11, 5);

    }
}

