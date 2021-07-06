<?php

namespace App\Http\Requests;

use App\Rules\CafDataRule;
use App\Rules\FullLimit;
use App\Rules\SlotLimit;
use Illuminate\Foundation\Http\FormRequest;

class CafeteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "slotLimit" => "required|numeric",
            "fullLimit" => "required|numeric",
            "cafData"   => ['required', new FullLimit(), new SlotLimit()],
        ];

    }
}
