<?php
namespace App\Class;

class Offer
{
    private array $offers = [];

    public function add(string $name, float $discount): self
    {
        if (array_key_exists($name, $this->offers)) {
            throw new \InvalidArgumentException('Offer already exists.');
        }

        $this->offers[$name] = $discount;
        return $this;
    }

    public function getOffers(): array
    {
        return $this->offers;
    }
}