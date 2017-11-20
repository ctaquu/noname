<?php
/**
 * Created by PhpStorm.
 * User: ctaquu
 * Date: 11/17/17
 * Time: 4:16 PM
 */

namespace App\Json\Validators\User;


use App\Json\Validators\BaseModel;
use Illuminate\Support\Facades\Validator;

class Create extends BaseModel
{
    protected const MODEL = 'User';

    /**
     * @param array $attributes
     * @return \Illuminate\Validation\Validator
     */
    protected function getModelSpecificValidator(array $attributes): \Illuminate\Validation\Validator
    {
        return Validator::make($attributes, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|max:255',
        ]);
    }
}