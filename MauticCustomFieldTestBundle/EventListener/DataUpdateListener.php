<?php
// plugins/MauticCustomFieldTestBundle/Entity/DataUpdateListener.php


namespace MauticPlugin\MauticCustomFieldTestBundle\EventListener;

use Mautic\CoreBundle\EventListener\CommonStatsSubscriber;

use MauticPlugin\MauticCustomFieldTestBundle\EventListener\DataUpdateListener;
use MauticPlugin\MauticCustomFieldTestBundle\Event\MauticEventTriggerContent;
use MauticPlugin\MauticCustomFieldTestBundle\Event\MauticEventTriggerType;
use MauticPlugin\MauticCustomFieldTestBundle\Event\MauticEventTrigger;
use MauticPlugin\MauticCustomFieldTestBundle\Model\DatabaseModel;


/**
 * The DataUpdateListener class which is used by the "DataUpdateController" class indirectly
 * via the MauticEventTrigger.
 *
 */
class DataUpdateListener extends CommonStatsSubscriber
{
    /**
     * The class "Model/DatabaseModel.php to store the data in the Lead tables"
     *
     * @var databaseModel
     */
    private $databaseModel;

    /**
     * DataUpdateListener constructor.
     *
     * @param DatabaseModel $databaseModel
     */
    public function __construct(DatabaseModel $databaseModel)
    {
        $this->databaseModel = $databaseModel;
    }

    /**
     * Return the subscribed Events
     *
     * @return array
     */
    static public function getSubscribedEvents()
    {
        return array(
            MauticEventTrigger::TRIGGERUPDATE => array('onPerformTest', 0)
        );
    }

    /**
     * Method for starting an the data operation
     *
     * @var MauticEventTriggerContent $event
     */
    public function onPerformTest(MauticEventTriggerContent $event)
    {
        if($event->getType() == MauticEventTriggerType::PERFORM_CUSTOM_FIELD_TEST)
        {
            $this->databaseModel->performCustomFieldTest();
	}
    }
}
?>
