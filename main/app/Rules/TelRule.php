<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class TelRule implements Rule
{

    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        return preg_match("/^0[0-9]{10}$/" , $value ) ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans("validation.tel");
    }
}
