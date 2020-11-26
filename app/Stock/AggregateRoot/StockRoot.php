<?php

namespace App\Stock\AggregateRoot;

use App\Models\Good;
use App\Stock\Events\NumTooLargeWarnEvent;
use App\Stock\Events\PurchaseEvent;
use App\Stock\Events\ReturnEvent;
use App\Stock\Events\SaleEvent;
use App\Stock\Exceptions\CanNotWarehouseOutException;
use App\Support\AppAggregateRoot;

class StockRoot extends AppAggregateRoot
{
    /**
     * @var int 库存数量
     */
    public int $stock_num;
    /**
     * @var int 扣减库存数量预警数量
     */
    public int $warn_num = 100;

    public function purchase(Good $good, int $num): self
    {
        return $this->recordThat(new PurchaseEvent($good, $num));
    }

    public function return(Good $good, int $num): self
    {
        $this->recordThat(new ReturnEvent($good, $num));

        if (!$this->hasEnoughInventory($num)) {
            CanNotWarehouseOutException::throwIt('库存不够');
        }

        if ($num > $this->warn_num) {
            $this->recordThat(new NumTooLargeWarnEvent($good, $num));
        }

        return $this;
    }

    public function applyReturnEvent(ReturnEvent $event): void
    {
        $this->stock_num = $event->good->stock->stock_num ?? 0;
    }


    public function sale(Good $good, int $num): self
    {
        $this->recordThat(new SaleEvent($good, $num));

        if (!$this->hasEnoughInventory($num)) {
            CanNotWarehouseOutException::throwIt('库存不够');
        }

        if ($num > $this->warn_num) {
            $this->recordThat(new NumTooLargeWarnEvent($good, $num));
        }

        return $this;
    }

    public function applySaleEvent(SaleEvent $event): void
    {
        $this->stock_num = $event->good->stock->stock_num ?? 0;
    }

    public function hasEnoughInventory(int $num): bool
    {
        return $this->stock_num >= $num;
    }
}
