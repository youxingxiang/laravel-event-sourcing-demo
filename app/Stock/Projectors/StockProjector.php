<?php
namespace App\Stock\Projectors;

use App\Models\GoodStock;
use App\Stock\Events\PurchaseEvent;
use App\Stock\Events\ReturnEvent;
use App\Stock\Events\SaleEvent;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class StockProjector extends Projector
{
    /**
     * @param PurchaseEvent $event
     * @param string $aggregateUuid
     */
    public function onPurchaseEvent(PurchaseEvent $event, string $aggregateUuid): void
    {
        $goodStock = GoodStock::where('good_id',$event->good->id)->first();

        $goodStock ? $goodStock->increment('stock_num',$event->num) : GoodStock::create([
            'good_id' => $event->good->id,
            'stock_num' => $event->num,
        ]);
    }

    /**
     * @param ReturnEvent $event
     * @param string $aggregateUuid
     */
    public function onReturnEvent(ReturnEvent $event,string $aggregateUuid): void
    {
        GoodStock::where('good_id',$event->good->id)->decrement('stock_num',$event->num);
    }

    /**
     * @param SaleEvent $event
     * @param string $aggregateUuid
     */
    public function onSaleEvent(SaleEvent $event,string $aggregateUuid): void
    {
        GoodStock::where('good_id',$event->good->id)->decrement('stock_num',$event->num);
    }
}
