<?php
class Guairaca_Example_Model_Observer
{
    public function catalogProductSaveAfter()
    {
        Mage::log('observer exemplo guairaca', null,'guairaca.log');
    }
}