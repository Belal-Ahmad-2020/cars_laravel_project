<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // attribute is the column name 
        // value is the paramater thar user passes to that specific column
        $data = strtoupper($attribute) === $value;
        return $data;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // print an error message
        return 'The :attribute must be uppercase';
    }
}
