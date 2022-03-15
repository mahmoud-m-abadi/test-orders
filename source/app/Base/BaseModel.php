<?php

namespace App\Base;

use App\Interfaces\Models\BaseModelInterface;
use App\Traits\HasIdTrait;
use App\Traits\MagicMethodsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model implements BaseModelInterface
{
    use HasFactory;
    use HasIdTrait;
    use MagicMethodsTrait;
}
