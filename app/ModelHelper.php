<?php

namespace App;
use App\Models\Order;

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

    public static function get_order_number()
    {
        $count = Order::all()->count();

        if($count == 0)
        {
            return 9000;
        } else {
            return $model::max('order_number') + 1;
        }
    }
}
