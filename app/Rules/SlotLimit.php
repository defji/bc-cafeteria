<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SlotLimit implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    /**
     * @var null
     */
    public $slot = '';

    public function __construct()
    {

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
        $slotLimit = request('slotLimit');
        $slots = array_keys($value);
        foreach ($slots as $slot) {
            $sum = 0;
            foreach ($value[$slot] as $am) {
                $sum += $am;

            }
            if ($sum > $slotLimit) {
                $this->slot = $slot;
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The sum of slot  "'.$this->slot.'" is greater than '.request('slotLimit');
    }
}
