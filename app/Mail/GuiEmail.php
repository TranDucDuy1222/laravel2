<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuiEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $hoTen='';
    public $email = '';
    public $noiDung = ''; 
    public function __construct($ht, $email, $nd)
    {
        $this->hoTen = $ht;
        $this->email = $email;
        $this->noiDung = $nd;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail liên hệ từ khách hàng',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.mail_lien_he',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
