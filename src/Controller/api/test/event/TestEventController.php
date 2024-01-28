<?php

namespace App\Controller\api\test\event;

use App\Controller\api\event\EventController;
use App\logger\EventDispatcher;
use phpDocumentor\Reflection\PseudoTypes\NonEmptyString;
use phpDocumentor\Reflection\PseudoTypes\StringValue;
use phpDocumentor\Reflection\Types\String_;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @psalm-api
 */
class TestEventController extends AbstractController
{
    /**
     * @param Request $request
     * @param EventDispatcherInterface $eventDispatcher
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    #[Route('/api/test/event', name: 'test_event')]
    public function index(Request $request, EventDispatcherInterface $eventDispatcher, LoggerInterface $logger): JsonResponse
    {
        /** @var string $message * */
        $message = $request->query->get('message', 'Сообщение не передано');

        $dispatcher = new EventDispatcher($eventDispatcher, $logger);
        $dispatcher->dispatch(new EventController($message));

        return $this->json(['message' => $message]);
    }

}
