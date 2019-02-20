<?php

namespace App\EntityListener;

use App\Entity\ContactUsEmail;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Class ContactUsEmailListener.
 *
 * @package App\EntityListener
 */
class ContactUsEmailListener
{
    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        // only act on some "Product" entity
        if (!$entity instanceof ContactUsEmail) {
            return;
        }

        $entityManager = $args->getObjectManager();
        // ... do something with the Product & send mail
    }
}
