<?php

namespace App\Traits;

trait AsJsonTrait
{
    /**
     * Для cast json
     *
     * @param mixed $value
     * @return false|string
     */
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
