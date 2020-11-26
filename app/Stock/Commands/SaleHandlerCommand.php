<?php


namespace App\Stock\Commands;


use App\Contract\Command;
use App\Contract\Handler;
use App\Stock\AggregateRoot\StockRoot;

class SaleHandlerCommand implements Handler
{
    private StockRoot $stockRoot;

    public function __construct(StockRoot $stockRoot)
    {
        $this->stockRoot = $stockRoot;
    }

    public function handle(Command $command): void
    {
        $this->stockRoot->retrieveRoot($command->good->uuid)->sale($command->good, $command->num)->persist();
    }


}
