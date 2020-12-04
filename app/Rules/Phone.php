<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class Phone
 *
 * @package App\Rules
 */
class Phone implements Rule
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
        return $this->checkPhone($value);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Вы ввели не корректный номер телефона, номер должен начинаться с +7 или +9';
    }

    /**
     * Проверяем телефон на кореектность
     * @param $value
     * @return bool
     */
    private function checkPhone($value)
    {
        $value = preg_replace('#[^0-9\+]#', '', $value);
        return (bool)preg_match('#^[\+7|+9]\d+$#', $value);
    }

}
