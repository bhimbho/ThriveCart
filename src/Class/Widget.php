<?php
namespace App\Class;

use App\Enum\WidgetEnum;
use App\Interface\WidgetInterface;

class Widget implements WidgetInterface
{
    public function __construct(private float $price, private string $name, private string $description, private string $widgetCode)
    {
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getWidgetCode(): string
    {
        return $this->widgetCode;
    }

    public function isRedWidget(): bool
    {
        return $this->widgetCode === WidgetEnum::RED_WIDGET->value;
    }
}