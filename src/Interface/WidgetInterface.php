<?php
namespace App\Interface;

interface WidgetInterface
{
    public function getPrice();
    public function getName();
    public function getDescription();
    public function getWidgetCode();
}