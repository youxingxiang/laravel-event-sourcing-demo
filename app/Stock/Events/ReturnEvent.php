<?php
namespace App\Stock\Events;

use App\Models\Good;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ReturnEvent extends ShouldBeStored
{
    public int $num;

    public Good $good;

    public function __construct(Good $good,int $num)
    {
        $this->good = $good;
        $this->num = $num;
    }
}
