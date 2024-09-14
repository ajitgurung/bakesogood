<?php

namespace App;

class ModelHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function get_max_order($model)
    {
        $order = $model::max('order');
        $order++;

        return $order;
    }
}
