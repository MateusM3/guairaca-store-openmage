<?php
class Guairaca_Example_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
//        die('Hello World! Magento');

        (new Guairaca_Example_Service_PagSeguro())->sendOrder();
    }
}