<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyemailUser extends Mailable
{
    use Queueable, SerializesModels;
    public $hoTen='';
    
    public $noiDung = ''; 
    public function __construct($ht, $nd)
    {
        $this->hoTen = $ht;
        $this->noiDung = $nd;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail liên hệ từ cửa hàng',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.send_reply',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
