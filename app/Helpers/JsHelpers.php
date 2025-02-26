<?php

namespace App\Helpers;

class JsHelpers
{
    public static function closeModal($livewireComponent, $modalId)
    {
        return $livewireComponent->js('$("#'.$modalId.'").modal("hide");');
    }
}