<?php

/**
 * Configuration array, processed by Mautic
 *
 */

return array(
    'name'        => 'Custom field tester',
    'description' => 'Tests whether it is possbile to perfrom a query using a customfield as a criteria.',
    'author'      => 'StEtz',
    'version'     => '1.0.0',

    'menu' => array(
        'main' => array(
                'priority' => 2,
                'items'    => array(
                    'Test plugin' => array(
                        'id'        => 'plugin_MauticCustomFieldTestBundle_root'
                    ),
                )
            )
        ),


    'services' => array(
       'events' => array(
            'plugin.MauticCustomFieldTestBundle.dateupdate.listener' => array(
                'class' => 'MauticPlugin\MauticCustomFieldTestBundle\EventListener\DataUpdateListener',
                'arguments' => array(
                    'mautic.MauticCustomFieldTestBundle.model.databasemodel'
                    ),
                ),
            ),
        'models' => array(
            'mautic.MauticCustomFieldTestBundle.model.databasemodel' => array(
                'class'     => 'MauticPlugin\MauticCustomFieldTestBundle\Model\DatabaseModel',
                'arguments' => array(
                    ),
                ),
            ),
        'command' => array(
            'mautic.MauticCustomFieldTestBundle.command.testcustomfield' => array(
                'class'     => 'MauticPlugin\MauticCustomFieldTestBundle\Command\TestCustomFieldCommand',
                'arguments' => array(
                ),
            ),
        ),
    ),

);
