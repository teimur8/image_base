<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class Phone
 *
 * @package App\Rules
 */
class Npa implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = preg_replace('#[^0-9\+]#', '', $value);
        return (bool)preg_match('#\d{7,10}#', $value);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Вы ввели не корректный номер НПА, нужно 7 или 10 цифр';
    }



}
