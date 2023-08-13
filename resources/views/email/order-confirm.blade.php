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
            <h1>Order Confirmation</h1>
        </div>
        <div class="content">
            <p>Hello {{ $order->user->name }},</p>
            <p>We are pleased to inform you that your order with the following details has been successfully confirmed:
            </p>
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Items:</strong>
                @foreach ($order->products as $product)
                    {{ $product->pivot->quantity }}x {{ $product->name }} <br>
                @endforeach
            </p>
            <p><strong>Total Amount:</strong> &#8369;{{ number_format($total, 2) }}</p>
            <p>Thank you for choosing our services. Your order is now being processed, and we will notify you once it's
                ready for shipment.</p>
            <p>If you have any questions or need further assistance, feel free to contact our support team.</p>
            <p>Best regards,</p>
            <p>Your Company Name</p>
        </div>
    </div>
</body>

</html>
