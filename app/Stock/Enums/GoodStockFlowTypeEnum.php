<?php

namespace App\Stock\Enums;

class GoodStockFlowTypeEnum
{
    const PURCHASE = 0;
    const RETURN = 1;
    const SALE = 2;

    const TYPE = [
        self::PURCHASE => '采购',
        self::RETURN => '退货',
        self::SALE => '销售',
    ];
}
