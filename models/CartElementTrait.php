<?php

namespace app\models;

trait CartElementTrait
{
    public function getCartId()
    {
        return $this->id;
    }

    public function getCartName()
    {
        return $this->title;
    }

    public function getCartPrice()
    {
        return $this->price;
    }

    public function getCartOptions()
    {
        //product variants
        return [];
    }
}
