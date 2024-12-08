<form action="{{ route('stocks') }}" method="get" name="stockForm">
    <h2>Склады</h2>
    <input type="text" name="dateFrom" id="dateFrom" value="{{ now()->format('Y-m-d') }}">
    <button type="submit">Получить</button>
</form>

<form action="{{ route('incomes') }}" method="get" name="incomeForm">
    <h2>Доходы</h2>
    <input type="text" name="dateFrom" id="dateFrom" value="2024-01-01">
    <input type="text" name="dateTo" id="dateTo" value="{{ now()->format('Y-m-d') }}">
    <button type="submit">Получить</button>
</form>

<form action="{{ route('sales') }}" method="get" name="saleForm">
    <h2>Продажи</h2>
    <input type="text" name="dateFrom" id="dateFrom" value="2024-01-01">
    <input type="text" name="dateTo" id="dateTo" value="{{ now()->format('Y-m-d') }}">
    <button type="submit">Получить</button>
</form>

<form action="{{ route('orders') }}" method="get" name="orderForm">
    <h2>Заказы</h2>
    <input type="text" name="dateFrom" id="dateFrom" value="2024-01-01">
    <input type="text" name="dateTo" id="dateTo" value="{{ now()->format('Y-m-d') }}">
    <button type="submit">Получить</button>
</form>
