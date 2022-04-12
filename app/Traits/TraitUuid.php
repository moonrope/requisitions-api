<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait TraitUuid
{
    /**
     * Override the boot function from Laravel so that
     * we give the model a new UUID when we create it.
     */
    protected static function boot()
    {
        parent::boot();

        $uuid = static::$uuidFieldName ?? 'uuid';
        $creationCallback = function ($model) use($uuid) {
            if (empty($model->{$uuid}))
            {
                $model->{$uuid} = Str::uuid()->toString();
            }
        };

        static::creating($creationCallback);
    }
}
