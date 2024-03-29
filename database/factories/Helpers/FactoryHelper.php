<?php
namespace Database\Factories\Helpers;

class FactoryHelper
{
    public static function getRandomModelId(string $model)
    {
        $count = $model::query()->count();
        if (!$count) {
            return $model::factory()->create()->id;
        } else {
            return rand(1, $count);
        }
    }
}
