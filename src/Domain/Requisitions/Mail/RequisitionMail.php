<?php

namespace Domain\Requisitions\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Domain\Requisitions\Models\Requisition;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequisitionMail extends Mailable
{
    use Queueable, SerializesModels;

    private Requisition|Model $requisition;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Requisition|Model $requisition)
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
