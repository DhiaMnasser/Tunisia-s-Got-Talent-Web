<?php
namespace  Gth\UploadBundle\Listener;

use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;
use Gth\UploadBundle\Annotation\UploadAnnotationReader;
use Gth\UploadBundle\Handler\UploadHandlerGth;

class UploadSubscriber implements EventSubscriber {


    /**
     * @var UploadAnnotationReader
     */
    private $reader;

    /**
     * @var UploadHandlerGth
     */
    private $handler;
    public function __construct(UploadAnnotationReader $reader, UploadHandlerGth $handler)
    {
        $this->reader=$reader;
        $this->handler=$handler;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return  [
            'prePersist',
            'postLoad',
            'preUpdate',
            'postRemove'
        ];
    }

    /**
     * @param EventArgs $event
     * @throws \Exception
     */
    public function prePersist(EventArgs $event){
        $this->preEvent($event);
    }

    /**
     * @param EventArgs $event
     * @throws \Exception
     */
    public function preUpdate(EventArgs $event){
        $this->preEvent($event);
    }

    /**
     * @param EventArgs $event
     * @throws \Exception
     */
    private function preEvent(EventArgs $event){
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation){
            $this->handler->removeOldFile($entity,$annotation);
            $this->handler->uploadFile($entity,$property,$annotation);
        }
    }

    public function postLoad(EventArgs $event){
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation){
            $this->handler->setFileFromFilename($entity,$property,$annotation);
        }
    }

    /**
     * @param EventArgs $event
     * @throws \Exception
     */
    public function postRemove(EventArgs $event){
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation){
            $this->handler->removeFile($entity,$annotation);
        }
    }
}