<?php
use PHPUnit\Framework\TestCase;
use App\Class\Basket;
use App\Class\DeliveryRules;
use App\Class\Offer;
use App\Class\Widget;
use App\Enum\WidgetEnum;

class BasketTest extends TestCase
{
    private array $products;
    private DeliveryRules $deliveryRules;
    private Offer $offers;

    protected function setUp(): void
    {
        $this->products = [
            new Widget(10.00, 'red_widget','', WidgetEnum::RED_WIDGET->value),
            new Widget(15.00, 'green_widget','', WidgetEnum::GREEN_WIDGET->value),
            new Widget(20.00, 'blue_widget','', WidgetEnum::BLUE_WIDGET->value),
        ];

        $this->deliveryRules = (new DeliveryRules())
            ->add(50, 4.95)
            ->add(90, 2.95);

        $this->offers = new Offer();
        $this->offers->add('red_widget_offer', 0.5);
    }

    public function testAddItem()
    {
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $basket->add(WidgetEnum::RED_WIDGET->value);
        $this->assertCount(1, $basket->getItems());
    }

    public function testTotalWithNoItems()
    {
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $this->assertEquals(0.0, $basket->total());
    }

    public function testTotalWithSingleItem()
    {
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $basket->add(WidgetEnum::RED_WIDGET->value);
        $this->assertEquals(10.00, $basket->total());
    }

    public function testTotalWithMultipleItems()
    {
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $basket->add(WidgetEnum::RED_WIDGET->value)
               ->add(WidgetEnum::GREEN_WIDGET->value);
        $this->assertEquals(25.00, $basket->total());
    }

    public function testTotalWithRedWidgetOffer()
    {
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $basket->add(WidgetEnum::RED_WIDGET->value)
               ->add(WidgetEnum::RED_WIDGET->value)
               ->add(WidgetEnum::RED_WIDGET->value);
        $this->assertEquals(25.00, $basket->total());
    }

    public function testExceptionOnInvalidProduct()
    {
        $this->expectException(\Exception::class);
        $basket = new Basket($this->products, $this->deliveryRules, $this->offers);
        $basket->add('invalid_widget_code');
        $basket->total();
    }
}