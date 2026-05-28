```blade id="0x5x7t"
<!DOCTYPE html>
<html>
<head>
    <title>Incoming Orders</title>
</head>
<body>

    <h1>Incoming Orders</h1>

    @foreach ($orders as $order)

        <hr>

        <p>
            Customer:
            {{ $order->customer_name }}
        </p>

        <p>
            Status:
            {{ $order->status }}
        </p>

        <form action="{{ route('orders.update', $order->id) }}" method="POST">

            @csrf
            @method('PUT')

            <select name="status">

                <option value="pending">
                    Pending
                </option>

                <option value="processing">
                    Processing
                </option>

                <option value="done">
                    Done
                </option>

            </select>

            <button type="submit">
                Update Status
            </button>

        </form>

    @endforeach

</body>
</html>
```
