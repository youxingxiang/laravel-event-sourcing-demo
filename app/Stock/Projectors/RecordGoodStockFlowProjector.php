<?php

namespace App\Stock\Projectors;

use App\Models\GoodStockFlow;
use App\Stock\Enums\GoodStockFlowTypeEnum;
use App\Stock\Events\PurchaseEvent;
use App\Stock\Events\ReturnEvent;
use App\Stock\Events\SaleEvent;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class RecordGoodStockFlowProjector extends Projector
{
    /**
     * @param PurchaseEvent $event
     * @param string $aggregateUuid
     */
    public function onPurchaseEvent(PurchaseEvent $event, string $aggregateUuid): void
    {
        GoodStockFlow::create([
            'good_id' => $event->good->id,
            'num'     => $event->num,
            'type'    => GoodStockFlowTypeEnum::PURCHASE
        ]);
    }

    /**
     * @param ReturnEvent $event
     * @param string $aggregateUuid
     */
    public function onReturnEvent(ReturnEvent $event, string $aggregateUuid): void
    {
        GoodStockFlow::create([
            'good_id' => $event->good->id,
            'num'     => $event->num,
            'type'    => GoodStockFlowTypeEnum::RETURN
        ]);
    }

    /**
     * @param SaleEvent $event
     * @param string $aggregateUuid
     */
    public function onSaleEvent(SaleEvent $event, string $aggregateUuid): void
    {
        GoodStockFlow::create([
            'good_id' => $event->good->id,
            'num'     => $event->num,
            'type'    => GoodStockFlowTypeEnum::SALE
        ]);
    }
}
