<?php

namespace eventBundle\EventListener;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;
use eventBundle\Entity\Evenement;
use eventBundle\eventBundle;

class CalendarEventListener
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $repository = $this->entityManager->getRepository('eventBundle:Evenement');
        $events = $repository->findAll();

        // You may want to add an Event into the Calendar view.
        /**
         * @var eventBundle/Entity/Evenement $events
         */
        foreach ($events as $event) {
            $calendarEvent->addEvent(new EventEntity($event->getNomevent(), $event->getDateD() ,$event->getDateF() ));
        }
    }
}