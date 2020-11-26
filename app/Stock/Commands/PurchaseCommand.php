<?php


namespace App\Stock\Commands;


use App\Contract\Command;
use App\Models\Good;

class PurchaseCommand implements Command
{

    public Good $good;

    public int $num;

    public function __construct(int $goodId,int $num)
    {
        $this->num = $num;
        $this->good = Good::findOrFail($goodId);
    }


}
