<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>进销存测试</title>
</head>
<body>
<div style="float: left;width: 500px">

    <div>
        <h3>添加商品</h3>
        <form action="{{ route('goods.create') }}" method="post">
            @csrf
            <div>
                <span>商品名称：</span><input name="name" type="text">
            </div>

            <div>
                <input type="submit" value="保存">
            </div>
        </form>
    </div>

    <div>
        <h3>商品采购</h3>
        <form action="{{ route('goods.purchase') }}" method="post">
            @csrf
            <div>
                <span>采购商品：</span>
                <select name="good_id">
                    @foreach($goods as $good)
                        <option value={{ $good->id }}>{{ $good->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <span>采购数量：</span><input name="num" type="number" value="10">
            </div>

            <div>
                <input type="submit" value="提交">
            </div>
        </form>
    </div>

    <div>
        <h3>商品销售</h3>
        <form action="{{ route('goods.sale') }}" method="post">
            @csrf
            <div>
                <span>销售商品：</span>
                <select name="good_id">
                    @foreach($goods as $good)
                        <option value={{ $good->id }}>{{ $good->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <span>销售数量：</span><input name="num" type="number" value="10">
            </div>

            <div>
                <input type="submit" value="提交">
            </div>
        </form>
    </div>

    <div>
        <h3>采购退回</h3>
        <form action="{{ route('goods.return') }}" method="post">
            @csrf
            <div>
                <span>退回商品：</span>
                <select name="good_id">
                    @foreach($goods as $good)
                        <option value={{ $good->id }}>{{ $good->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <span>退回数量：</span><input name="num" type="number" value="10">
            </div>

            <div>
                <input type="submit" value="提交">
            </div>
        </form>
    </div>

</div>

<div>
    <div>
        <h3>商品库存</h3>
        <table border="1">
            <thead>
            <tr>
                <td>ID</td>
                <td>商品名称</td>
                <td>商品库存</td>
            </tr>
            </thead>
            <tbody>
            @foreach($good_stocks as $good_stock)
                <tr>
                    <td>{{ $good_stock->id }}</td>
                    <td>{{ $good_stock->good->name }}</td>
                    <td>{{ $good_stock->stock_num }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <h3>库存往来流水</h3>

        <table border="1">
            <thead>
            <tr>
                <td>ID</td>
                <td>商品名称</td>
                <td>业务类型</td>
                <td>数量</td>
            </tr>
            </thead>
            <tbody>
            @foreach($good_stock_flows as $good_stock_flow)
                <tr>
                    <td>{{ $good_stock_flow->id }}</td>
                    <td>{{ $good_stock_flow->good->name }}</td>
                    <td>{{ \App\Stock\Enums\GoodStockFlowTypeEnum::TYPE[$good_stock_flow->type] }}</td>
                    <td>{{ $good_stock_flow->num }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
<script>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    alert("{{ $error }}")
    @endforeach
    @endif

    @if(session('error'))
        @foreach(session('error')->get('message') as $message)
            alert("{{ $message }}")
        @endforeach
    @endif

</script>
</html>
