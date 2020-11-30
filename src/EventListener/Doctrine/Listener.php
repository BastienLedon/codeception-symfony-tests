<?php
namespace App\EventListener\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Security;

class Listener implements EventSubscriber
{
    private Security $security;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, Security $security)
    {
        $this->security = $security;
        $this->logger = $logger;
    }

    public function prePersist(LifecycleEventArgs $entity)
    {
        $user = $this->security->getUser();
        if($user) {
            $entity->getObject()->setUser($user);
        } else {
            $this->logger->warning('Security user is empty');
        }
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
        ];
    }
}