<?php
// plugins/MauticCustomFieldTestBundle/Entity/DataLogRepository.php

namespace MauticPlugin\MauticCustomFieldTestBundle\Event;

use Symfony\Component\EventDispatcher\Event;


final class MauticEventTrigger
{
    const TRIGGERUPDATE = 'mauticcustomfieldtest.triggereventcontent';
}

/**
 * These are the types of events we handle.
 */
abstract class MauticEventTriggerType
{
    const PERFORM_CUSTOM_FIELD_TEST = 1;

}

/**
 * The information which is transported with the event.
 */
final class MauticEventTriggerContent  extends Event
{
    /**
     * @var triggerType
     */
    private $triggerType;

    /**
     * The constructor
     *
     * @var string triggerType
     * @var string userId
     *
     */
    function __construct(int $triggerType)
    {
        $this->triggerType = $triggerType;
    }

    /**
     *
     * @var string triggerType
     *
     */
    function getType() : int
    {
        return $this->triggerType;
    }
}
?>
