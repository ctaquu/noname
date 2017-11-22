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
    public function __construct($data, $status = Response::HTTP_OK, array $headers = array())
    {
        $content = $data;

        // format models to JsonApi format
        if ($data instanceof \Eloquent) {

            $modelClass = (new ReflectionClass($data))->getName();

            // format to JsonAPI format
            $encoder = Encoder::instance([
                $modelClass => SchemaMap::getForModel($modelClass),
            ], new EncoderOptions(JSON_PRETTY_PRINT, env('APP_URL') . '/api/v1'));

            $content = $encoder->encodeData($data);
        }

        parent::__construct($content, $status, ['Content-Type' => 'application/vnd.api+json']);
    }

}