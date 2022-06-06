<?php

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * Pegar os parametros da URL sem os filtros
 */
function _url(): String
{
    return str_replace([request()->getQueryString(), '?'], '', request()->getPathInfo());
}

/**
 * Makes translation fall back to specified value if definition does not exist
 *
 * @param string $key
 * @param null|string $fallback
 * @param null|string $locale
 * @param array|null $replace
 *
 * @return array|\Illuminate\Contracts\Translation\Translator|null|string
 */
function __trans($key = '', ?string $fallback = null, ?string $locale = null, ?array $replace = [])
{
    if (\Illuminate\Support\Facades\Lang::has($key, $locale) && !empty($key)) {
        return trans($key, $replace, $locale);
    }

    return $key;
}

function _mix($path)
{
    return env('APP_ENV')  == 'production' ? url(asset(mix($path))) : asset($path);
}

/**
 * Implode em um chave especifica Transformar o array em uma chave só 
 *
 * @param string $glue - o separador
 * @param array $array 
 * @param string $key - a chave do array
 *
 * @return array|\Illuminate\Contracts\Translation\Translator|null|string
 */

function implodeKey($array, $key, $glue = ',')
{
    $arr2 = [];
    foreach ($array as $f) {
        if (!isset($f[$key])) continue;
        $arr2[] = $f[$key];
    }
    return implode($glue, $arr2);
}

/**
 * Transformar a data em minutos para ler como humano
 * Ex: 3 min ago
 */
function dateTournamentForHumans($date = null)
{
    if ($date) {
        $dateForForHuman = new Carbon($date, 'America/Sao_paulo');
        return $dateForForHuman->diffForHumans([
            'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
            'options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS,
        ]);
    }
}

function token($size = 10, $charsAlphabetic = true)
{
    $chars = "0123456789";
    if ($charsAlphabetic) {
        $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz';
        $chars .= date("Y-m-d H:i:s");
    } else {
        $chars .= date("H:i:s");
    }

    $randomString = '';
    for ($i = 0; $i < $size; $i = $i + 1) {
        $randomString .= $chars[mt_rand(0, strlen($chars) - 5)];
    }

    return substr(uniqid(clear($randomString)), 0, $size);
}

function clear($variavel, $troca = "")
{
    return strtolower(preg_replace("/[^a-zA-Z0-9-]/", "$troca", strtr(utf8_decode(trim($variavel)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
}

function number($number = 0, $lang = 'en', $casasDecimais = 2)
{
    list($p, $f) = $lang == 'br' ? ['.', ','] : ['.', ''];

    if (empty($number)) {
        return 0;
    }

    $number = str_replace(['R$', '&nbsp', chr(194) . chr(160)], '', $number);

    $number = ltrim($number, "\xC2\xA0");

    if (!is_numeric($number)) {
        $number = str_replace(',', '.', str_replace('.', '', $number));
    }

    return number_format($number, $casasDecimais, $p, $f);
}

function titleCase($string)
{
    $string = mb_strtolower($string, 'UTF-8');
    $explode = explode(" ", $string);
    $in = '';
    foreach ($explode as $str) {
        if (strlen($str) > 2) {
            $in .= mb_convert_case($str, MB_CASE_TITLE, "UTF-8") . ' ';
        } else {
            $in .= $str . ' ';
        }
    }
    return trim(ucfirst($in));
}

function uuid()
{
    return Str::uuid();
}

function slug($value, $caracter = '_')
{
    return Str::slug(mb_strtolower($value, 'UTF-8'), $caracter);
}

function limit($text, $limit = 30)
{
    return Str::limit($text, $limit, '...');
}
