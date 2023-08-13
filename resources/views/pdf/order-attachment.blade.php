<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmed</h1>
        </div>
        <div class="content">
            <p>Hello {{ $order->user->name }},</p>
            <p>We are pleased to inform you that your order with the following details has been successfully confirmed:
            </p>
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Items:</strong></p>
            <ul>
                @foreach ($order->products as $product)
                    <li>{{ $product->name }} (Quantity: {{ $product->pivot->quantity }})</li>
                @endforeach
            </ul>
            <p><strong>Total Amount:</strong> ${{ number_format($total, 2) }}</p>
            <p>Thank you for choosing our services. Your order is now being processed, and we will notify you once it's
                ready for shipment.</p>
            <p>If you have any questions or need further assistance, feel free to contact our support team.</p>
            <p>Best regards,</p>
            <p>Ytable Pizza Shop</p>
        </div>
        <div class="footer">
            <p>This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>

</html>
