<?php
// plugins/MauticCustomFieldTestBundle/Command/MauticTestCustomFieldCommand.php

namespace MauticPlugin\MauticCustomFieldTestBundle\Command;

use Mautic\CoreBundle\Command\ModeratedCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MauticPlugin\MauticCustomFieldTestBundle\Event\MauticEventTriggerContent;
use MauticPlugin\MauticCustomFieldTestBundle\Event\MauticEventTriggerType;
use MauticPlugin\MauticCustomFieldTestBundle\Event\MauticEventTrigger;


class TestCustomFieldCommand extends ModeratedCommand
{
    /**
     * @var
     */
    protected $output;

    /**
     * @var
     */
    protected $input;

    /**
     * MauticTestCustomFieldCommand constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Configure the command.
     */
    protected function configure()
    {
        //public function addOption($name, $shortcut = null, $mode = null, $description = '', $default = null)

        $this->setName('mautic:customfield:test')
            ->setDescription('Does a query with a filter for "customField = 5"');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input  = $input;
        $this->output = $output;
   
	$dispatcher = $this->getContainer()->get('event_dispatcher');
        $dispatcher->dispatch(MauticEventTrigger::TRIGGERUPDATE, new MauticEventTriggerContent(MauticEventTriggerType::PERFORM_CUSTOM_FIELD_TEST, array()));
    }

}
