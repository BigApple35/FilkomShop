<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Incoming Orders
    </title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #202124;
        }

        .order-card {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .order-info {
            margin-bottom: 15px;
            color: #444;
        }

        .status {
            font-weight: bold;
            color: #1a73e8;
        }

        select {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        button {
            background-color: #1a73e8;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1558b0;
        }

        .success-message {
            background-color: #d7f5dd;
            color: #256029;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

    <div class="container">

        <h1 class="title">
            Incoming Orders
        </h1>

        @if (session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif

        @foreach ($orders as $order)

            <div class="order-card">

                <div class="order-info">

                    <p>
                        <strong>Customer:</strong>
                        {{ $order->customer_name }}
                    </p>

                    <p>
                        <strong>Status:</strong>

                        <span class="status">
                            {{ $order->status }}
                        </span>
                    </p>

                </div>

                <form
                    action="{{ route('orders.update', $order->id) }}"
                    method="POST"
                >

                    @csrf
                    @method('PUT')

                    <select name="status">

                        <option
                            value="pending"
                            {{ $order->status == 'pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="processing"
                            {{ $order->status == 'processing' ? 'selected' : '' }}
                        >
                            Processing
                        </option>

                        <option
                            value="done"
                            {{ $order->status == 'done' ? 'selected' : '' }}
                        >
                            Done
                        </option>

                    </select>

                    <button type="submit">
                        Update Order
                    </button>

                </form>

            </div>

        @endforeach

    </div>

</body>

</html>