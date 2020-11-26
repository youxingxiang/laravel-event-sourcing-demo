<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\ReturnRequest;
use App\Http\Requests\SaleRequest;
use App\Models\Good;
use App\Models\GoodStock;
use App\Models\GoodStockFlow;
use App\Stock\Commands\PurchaseCommand;
use App\Stock\Commands\PurchaseHandlerCommand;
use App\Stock\Commands\ReturnCommand;
use App\Stock\Commands\ReturnHandlerCommand;
use App\Stock\Commands\SaleCommand;
use App\Stock\Commands\SaleHandlerCommand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Ramsey\Uuid\Uuid;

class StockController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $goods            = Good::latest()->get();
        $good_stocks      = GoodStock::with('good')->latest()->get();
        $good_stock_flows = GoodStockFlow::with('good')->latest()->get();
        return view('welcome', compact('goods', 'good_stocks', 'good_stock_flows'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createGood(Request $request): RedirectResponse
    {
        Good::create([
            'name' => $request->post('name'),
            'uuid' => (string)Uuid::uuid4()
        ]);
        return back();
    }

    /**
     * @param Request $request
     * @param PurchaseHandlerCommand $purchaseHandlerCommand
     * @return RedirectResponse
     */
    public function purchase(PurchaseRequest $request, PurchaseHandlerCommand $purchaseHandlerCommand): RedirectResponse
    {
        $params          = $request->validated();
        $purchaseCommand = new PurchaseCommand($params['good_id'], $params['num']);
        $purchaseHandlerCommand->handle($purchaseCommand);
        return back();
    }

    /**
     * @param ReturnRequest $request
     * @param ReturnHandlerCommand $returnHandlerCommand
     * @return RedirectResponse
     */
    public function return(ReturnRequest $request, ReturnHandlerCommand $returnHandlerCommand): RedirectResponse
    {
        $params        = $request->validated();
        $returnCommand = new ReturnCommand($params['good_id'], $params['num']);
        $returnHandlerCommand->handle($returnCommand);
        return back();
    }

    /**
     * @param SaleRequest $request
     * @param SaleHandlerCommand $saleHandlerCommand
     * @return RedirectResponse
     */
    public function sale(SaleRequest $request, SaleHandlerCommand $saleHandlerCommand): RedirectResponse
    {
        $params        = $request->validated();
        $saleCommand = new SaleCommand($params['good_id'], $params['num']);
        $saleHandlerCommand->handle($saleCommand);
        return back();
    }
}
