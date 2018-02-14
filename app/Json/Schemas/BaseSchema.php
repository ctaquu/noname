<?php
/**
 * Created by PhpStorm.
 * User: ctaquu
 * Date: 11/16/17
 * Time: 3:55 PM
 */

namespace App\Json\Schemes;


use Neomerx\JsonApi\Schema\SchemaProvider;

abstract class BaseSchema extends SchemaProvider
{
    public function getId($model)
    {
        /** @var $model */
        return $model->id;
    }
}
