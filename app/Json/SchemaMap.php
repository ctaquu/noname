<?php
/**
 * Created by PhpStorm.
 * User: ctaquu
 * Date: 11/17/17
 * Time: 3:54 PM
 */

namespace App\Json;

use App\Exceptions\JsonApiException;

class SchemaMap
{
    private const MAP = [
        'App\User' => 'App\Json\Schemas\UserSchema',
    ];

    public static function getForModel($model)
    {
        if (key_exists($model, self::MAP)) {
            return self::MAP[$model];
        }

        throw new JsonApiException("JsonApi schema not defined for model: '$model' !");
    }
}