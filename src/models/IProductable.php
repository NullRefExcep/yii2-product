<?php

namespace nullref\product\models;

/**
 * @author    Dmytro Karpovych
 * @copyright 2015 NRE
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface IProduct
{
    public function getId();

    public function getPrice();
}