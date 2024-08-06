<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQuotationEmailAck extends Mailable
{
    use Queueable, SerializesModels;

    public $dArr;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dArr, $subject)
    {
        $this->dArr = $dArr;
        $this->subject = $subject;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->view('email.quotation_ack')->with('dArr', $this->dArr)->subject($this->subject);

    }
}
