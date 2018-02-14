<?php
/**
 * Created by PhpStorm.
 * User: ctaquu
 * Date: 11/28/17
 * Time: 12:47 PM
 */

namespace App\Http;


class Helper
{
    /**
     * checks if given string is formatted as JSON
     *
     * @param string $string
     * @return bool
     */
    public function isJson(string $string): bool
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * converts passed data to JSON format
     *
     * @param $data
     * @return string
     */
    public function toJson($data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}