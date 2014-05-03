<?php

namespace Sportlobster\ApiBundle\EventListener;

use Sportlobster\ApiBundle\Model\SerializableInterface;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\Serializer;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class ModelViewListener
{

    protected $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $data = $event->getControllerResult();
        $request = $event->getRequest();

        if ($data instanceof SerializableInterface) {
            $output = $this->serializer->serialize($data, $request->getRequestFormat());
            $event->setResponse(new Response($output));
        }
    }

}
