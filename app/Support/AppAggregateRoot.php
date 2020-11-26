<?php


namespace App\Support;

use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class AppAggregateRoot extends AggregateRoot
{
    public function retrieveRoot($aggregateId): self
    {
        return static::retrieve($aggregateId);
    }
}
