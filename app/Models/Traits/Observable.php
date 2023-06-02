<?php

namespace App\Models\Traits;

trait Observable
{
    public static function bootObservable()
    {
        $observer = '\\App\\Observers\\' . class_basename(static::class) . 'Observer';

        if (!class_exists($observer)) {
            return;
        }
        (new static)->registerObserver($observer);
    }
}