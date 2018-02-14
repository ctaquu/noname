<?php
/**
 * Created by PhpStorm.
 * User: ctaquu
 * Date: 11/16/17
 * Time: 4:11 PM
 */

namespace App\Json\Schemas;


use App\Json\Schemes\BaseSchema;

class UserSchema extends BaseSchema
{
    protected $resourceType = 'users';

    public function getAttributes($model)
    {
        return [
            'name' => $model->name,
            'email'  => $model->email,
        ];
    }
}