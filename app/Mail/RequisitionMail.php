<?php

namespace App\Mail;

use App\Models\Requisition;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
class RequisitionMail extends Mailable
{
    use Queueable, SerializesModels;

    private Requisition $requisition;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Requisition $requisition)
    {
        $this->requisition = $requisition;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = Pdf::loadView('email_pdf', ['requisition' => $this->requisition]);

        return $this->view('mails.mail')
            ->attachData(
                $pdf->output(),
                'requisitions.pdf',
                [
                    'mime' => 'application/pdf'
                ]
            );
    }
}
