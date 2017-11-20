<?php
/**
 * Created by PhpStorm.
 * User: ctaquu
 * Date: 11/16/17
 * Time: 4:11 PM
 */

namespace App\Json\Schemas;


use Neomerx\JsonApi\Schema\SchemaProvider;

class UserSchema extends SchemaProvider
{
    protected $resourceType = 'users';

    public function getId($model)
    {
        /** @var $model */
        return $model->id;
    }

    public function getAttributes($model)
    {
        return [
            'name' => $model->name,
            'email'  => $model->email,
        ];
    }
}