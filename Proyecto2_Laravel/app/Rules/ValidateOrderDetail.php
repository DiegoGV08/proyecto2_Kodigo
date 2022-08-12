<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateOrderDetail implements Rule
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
        //
        foreach ($value as $detail) {

            if (!isset($detail['product_quantity']) || !isset($detail['id_product'])) {
                return false;
            }

            if (!is_numeric($detail['product_quantity']) || !is_numeric($detail['id_product'])) {
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
        return 'Validate request syntax';
    }
}
