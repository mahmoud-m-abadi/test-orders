<?php

namespace App\Interfaces\Models;

use App\Interfaces\Traits\HasCountInterface;
use App\Interfaces\Traits\HasFoodIdInterface;
use App\Interfaces\Traits\HasIdInterface;
use App\Interfaces\Traits\HasPriceInterface;
use App\Interfaces\Traits\HasStatusInterface;
use App\Interfaces\Traits\HasTotalPriceInterface;
use App\Interfaces\Traits\HasUserIdInterface;

interface OrderInterface extends
    HasIdInterface,
    HasUserIdInterface,
    HasFoodIdInterface,
    HasPriceInterface,
    HasTotalPriceInterface,
    HasCountInterface,
    HasStatusInterface

{
    const TABLE = "orders";
}
