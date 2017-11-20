<?php

namespace App\Http\Responses;

use App\Json\SchemaMap;
use Illuminate\Http\Response;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Encoder\EncoderOptions;
use ReflectionClass;

/**
 * Created by PhpStorm.
 * User: ctaquu
 * Date: 11/17/17
 * Time: 3:39 PM
 */

class JsonApiResponse extends Response
{
    public function __construct($model, $status = Response::HTTP_OK, array $headers = array())
    {
        $modelClass = (new ReflectionClass($model))->getName();

        // format to JsonAPI format
        $encoder = Encoder::instance([
            $modelClass => SchemaMap::getForModel($modelClass),
        ], new EncoderOptions(JSON_PRETTY_PRINT, env('APP_URL') . '/api/v1'));

        parent::__construct($encoder->encodeData($model), $status, ['Content-Type' => 'application/vnd.api+json']);
    }

}