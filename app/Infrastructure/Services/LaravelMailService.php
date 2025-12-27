<?php

namespace App\Infrastructure\Services;

use App\Application\Services\MailServiceInterface;
use Illuminate\Support\Facades\Mail;

class LaravelMailService implements MailServiceInterface
{
    public function send(string $to, string $subject, string $body): void
    {
        
    }
}