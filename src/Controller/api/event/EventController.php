<?php

namespace App\Controller\api\event;

use Symfony\Contracts\EventDispatcher\Event;

class EventController extends Event
{
    private string $message;

    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @psalm-api
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
