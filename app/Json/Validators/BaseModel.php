<?php

namespace App\Json\Validators;

use App\Exceptions\JsonApiException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

abstract class BaseModel implements Rule
{
    /** string - class path for the (eloquent) model */
    protected const MODEL = null;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     * @throws JsonApiException
     */
    public function passes($attribute, $value)
    {
        if (empty($value['type']) || $value['type'] !== 'users') {
            throw new JsonApiException('invalid model type', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (empty($value['attributes']) || !is_array($value['attributes'])) {
            throw new JsonApiException('invalid attributes data', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->getModelSpecificValidator($value['attributes'])
            ->validate();

        return true;
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Validation\Validator
     */
    protected abstract function getModelSpecificValidator(array $attributes) : Validator;


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The ' . self::MODEL . ' model validation error!';
    }
}
