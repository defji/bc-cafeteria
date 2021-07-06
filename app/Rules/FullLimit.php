<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FullLimit implements Rule
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
        $fullLimit = request('fullLimit');
        $sum = 0;
        foreach ($value as $key => $val) {
            foreach ($val as $am) {
                $sum += $am;
            }

        }

        return $fullLimit >= $sum;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The full limit is maximum '.request('fullLimit');
    }
}
