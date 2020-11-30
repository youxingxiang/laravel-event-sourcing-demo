<?php

namespace Tests\Stock\AggregateRoot;

use App\Models\Good;
use App\Stock\AggregateRoot\StockRoot;
use App\Stock\Events\NumTooLargeWarnEvent;
use App\Stock\Events\PurchaseEvent;
use App\Stock\Events\ReturnEvent;
use App\Stock\Events\SaleEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class StockRootTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_purchase_retun_sale()
    {
        $good = Good::create([
            'name' => '测试商品',
            'uuid' => (string)Uuid::uuid4(),
            
        ]);
        //$this->expectException(CanNotWarehouseOutException::class);
        StockRoot::fake($good->uuid)
            ->given([new PurchaseEvent($good, 1000)])
            ->when(function (StockRoot $stockRoot) use ($good) {
                $stockRoot->return($good, 200);
                return $stockRoot->stock_num;
            })
            ->then(function (int $stock_num) {
                return $stock_num === 800;
            })
            ->assertRecorded([new ReturnEvent($good, 200), new NumTooLargeWarnEvent($good, 200)])
            ->aggregateRoot()
            ->persist();


        StockRoot::fake($good->uuid)
            ->when(function (StockRoot $stockRoot) use ($good) {
                $stockRoot->sale($good, 100);
                return $stockRoot->stock_num;
            })
            ->then(function (int $stock_num) {
                return $stock_num === 700;
            })
            ->assertRecorded(new SaleEvent($good, 100))
            ->aggregateRoot()
            ->persist();

    }

    public function testAsss()
    {
        $this->assertTrue(true);
    }
}
