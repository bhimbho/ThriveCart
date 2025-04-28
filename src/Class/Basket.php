<?php
namespace App\Class;

use App\Enum\WidgetEnum;

class Basket
{
    private array $items = [];
    private float $deliveryCost = 0;
    public function __construct(private array $products, private DeliveryRules $deliveryRules, public Offer $offers)
    {
    }

    public function add(string $widgetCode): self
    {
        $this->items[] = $widgetCode;
        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getDeliveryCost(): float
    {
        return $this->deliveryCost;
    }

    public function total(): float
    {
        $total = 0;
        $redDiscountCount = 0;
        foreach ($this->items as $item) {
            $matchedProduct = array_filter($this->products, function (Widget $product) use ($item) {
                return $product->getWidgetCode() === $item;
            });
            $matchedProduct = reset($matchedProduct);
            if (!$matchedProduct) {
                throw new \Exception('Product not found');
            }
            
            if ($matchedProduct->isRedWidget()) {
                $redDiscountCount++;
            }

            if ($redDiscountCount == 2 && $matchedProduct->isRedWidget()) {
                $total += ($this->offers->getOffers()['red_widget_offer'] * $matchedProduct->getPrice());
                $redDiscountCount = 0;
            } else {
                $total += $matchedProduct->getPrice();
            }
        }
        $this->deliveryCost = $this->deliveryRules->getDeliveryCost($total);
        return $total;
    }
}

