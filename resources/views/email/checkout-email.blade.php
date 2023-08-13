<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>New Order Arrival Notification</h1>
        </div>
        <div class="content">
            <p>Hello Admin,</p>
            <p>A new order has arrived and is awaiting your attention.</p>
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>User:</strong> {{ $order->user->name }}</p>
            <p>Please log in to the admin panel to view the order details and process it accordingly.</p>
            <p>If you have any questions or need assistance, please don't hesitate to reach out.</p>
            <p>Best regards,</p>
            <p>Ytable Pizza Shop</p>
            <a class="btn btn-success btn-sm" href="{{ url('/order/confirm/' . $order->id) }}">Confirm</a>
        </div>
    </div>
</body>

</html>
