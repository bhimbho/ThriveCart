<?php
namespace App\Class;

use App\Class\Widget;
use App\Enum\WidgetEnum;

class Product
{
    public static function getProducts(): array
    {
        return [
            new Widget(39.99, 'Red Widget', 'A red widget that does amazing things.', WidgetEnum::RED_WIDGET->value),
            new Widget(12.99, 'Blue Widget', 'A blue widget that does even more amazing things.', WidgetEnum::BLUE_WIDGET->value),
            new Widget(15.99, 'Green Widget', 'A green widget that does the most amazing things.', WidgetEnum::GREEN_WIDGET->value),
        ];
    }
}