<?php
namespace App\Class;

class DeliveryRules
{
    private array $rules = [];

    public function add(float $threshold, float $deliveryCost): self
    {
        $key = (string)$threshold;

        if (array_key_exists($key, $this->rules)) {
            throw new \InvalidArgumentException('Max order price already exists.');
        }

        $this->rules[$threshold] = $deliveryCost;
        return $this;
    }

    public function getDeliveryRules(): array
    {
        return $this->rules;
    }

    public function getDeliveryCost(float $total): float
    {
        $offerThreshold = array_filter(
            array_keys($this->rules),
            fn(float $threshold) => $total <= $threshold
        );

        if ($offerThreshold) {
            return $this->rules[max($offerThreshold)];
        }

        return 0.0;
    }
}