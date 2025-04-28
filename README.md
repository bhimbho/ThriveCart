# Project README

## Overview

This project is a PHP-based shopping cart system that includes functionality for managing products, delivery rules, and promotional offers. The code is organized into classes, enums, and interfaces to maintain a clean architecture.

## Prerequisites

Docker

```bash
docker compose up --build
```
or with deamon
```bash
docker compose up --build -d
```
### Step 5: Run Composer Install

After building the image, you can run Composer to install the dependencies:

```bash
composer install
```

### Step 6: Run the Tests

To execute the tests defined in your project, run:

```bash
./vendor/bin/phpunit tests
```


### Step 7: Accessing the Container

If you need to access the container's shell for debugging or other purposes, you can run:

```bash
docker-compose run app bash
```

## Major Code Components

### 1. **Basket Class**
The `Basket` class manages the items added to the shopping cart. It allows adding products and calculating the total cost, including any applicable discounts and delivery costs.

- **Key Methods:**
  - `add(string $widgetCode)`: Adds a product to the basket using its widget code.
  - `getItems()`: Returns the list of items in the basket.
  - `getDeliveryCost()`: Returns the calculated delivery cost.
  - `total()`: Calculates the total price of items in the basket, applying discounts for red widgets and determining the delivery cost based on the total.

### 2. **DeliveryRules Class**
The `DeliveryRules` class defines the rules for delivery costs based on the total price of items in the basket.

- **Key Methods:**
  - `add(float $threshold, float $deliveryCost)`: Adds a delivery rule with a price threshold and corresponding delivery cost.
  - `getDeliveryRules()`: Returns all defined delivery rules.
  - `getDeliveryCost(float $total)`: Determines the delivery cost based on the total price of items.

### 3. **Offer Class**
The `Offer` class manages promotional offers that can be applied to products in the basket.

- **Key Methods:**
  - `add(string $name, float $discount)`: Adds a new offer with a name and discount value.
  - `getOffers()`: Returns all available offers.

### 4. **Product Class**
The `Product` class provides a static method to retrieve a list of available products, which are instances of the `Widget` class.

- **Key Method:**
  - `getProducts()`: Returns an array of `Widget` instances representing the available products.

### 5. **Widget Class**
The `Widget` class represents individual products with properties such as price, name, description, and widget code.

- **Key Methods:**
  - `getPrice()`: Returns the price of the widget.
  - `getName()`: Returns the name of the widget.
  - `getDescription()`: Returns the description of the widget.
  - `getWidgetCode()`: Returns the unique code for the widget.
  - `isRedWidget()`: Checks if the widget is a red widget, which may have special discount rules.

### 6. **WidgetEnum Enum**
The `WidgetEnum` enum defines the different types of widgets available in the system, such as red, green, and blue widgets.

### 7. **WidgetInterface Interface**
The `WidgetInterface` interface defines the methods that any widget class must implement, ensuring a consistent API for interacting with widget objects.

## Assumptions
- The system assumes that each product has a unique widget code.
- Discounts for red widgets are applied only when two red widgets are added to the basket.
- Delivery costs are determined based on predefined rules that can be added dynamically.
