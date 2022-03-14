<?php

namespace App\Models;

use App\Base\BaseModel;
use App\Interfaces\Models\OrderInterface;
use App\Traits\HasCountTrait;
use App\Traits\HasFoodIdTrait;
use App\Traits\HasPriceTrait;
use App\Traits\HasStatusTrait;
use App\Traits\HasTotalPriceTrait;
use App\Traits\HasUserIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends BaseModel implements OrderInterface
{
    use HasFactory;
    use HasUserIdTrait;
    use HasFoodIdTrait;
    use HasPriceTrait;
    use HasTotalPriceTrait;
    use HasCountTrait;
    use HasStatusTrait;
}
