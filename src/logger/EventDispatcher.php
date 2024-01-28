<?php

namespace App\logger;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $eventDispatcher;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param LoggerInterface $logger
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, LoggerInterface $logger)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    /**
     * @psalm-api
     * @param object $event
     * @return object
     */
    public function dispatch(object $event): object
    {
        $this->logger->info($event->getMessage());

        return $this->eventDispatcher->dispatch($event);
    }
}