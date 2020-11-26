<?php

namespace App\Stock\Reactors;


use App\Stock\Events\NumTooLargeWarnEvent;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;

class WarnReactor extends Reactor
{

    public function onNumTooLargeWarnEvent(NumTooLargeWarnEvent $event): void
    {
        // todo 发邮件通知
//        dd('出库时量太大预警');
    }

}
