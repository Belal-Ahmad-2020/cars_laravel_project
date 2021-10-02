<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Uppercase;

class CreateValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // when it is true it will check the data and authorize it 
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uppercase = new Uppercase;
        return [
            'name' => $uppercase, ["required"],
            'founded' => 'required|min:1990|max:2021|integer',
            'description' => 'required'            
        ];
    }
}
