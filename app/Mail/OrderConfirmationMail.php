<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Dompdf\Dompdf;
use Illuminate\Mail\Attachment;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $order;
    public $total;
    public function __construct($order)
    {
        $this->order = $order;
        $this->total = $order->products->map(function ($product) {
            return $product->price * $product->pivot->quantity;
        })->sum();
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        $pdf = $this->generatePdf();

        return $this->subject('Order Confirmation')
            ->from(config('mail.from.address'), "Ytable Pizza Shop")
            ->to($this->order->user->email, $this->order->user->name)
            ->view('email.order-confirm')
            ->attachData($pdf, 'order_confirmed.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    protected function generatePdf(): string
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pdf.order-attachment', [
            'order' => $this->order,
            'total' => $this->total,
        ]));
        $dompdf->setPaper('A4', 'portrait'); // Set paper size and orientation
        $dompdf->render();

        return $dompdf->output(); // Get the PDF content as a string
    }
}
