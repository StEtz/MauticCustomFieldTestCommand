<?php
// plugins/MauticCustomFieldTestBundle/MauticCustomFieldTestBundle.php

namespace MauticPlugin\MauticCustomFieldTestBundle;

use Doctrine\DBAL\Schema\Schema;
use Mautic\PluginBundle\Bundle\PluginBundleBase;
use Mautic\PluginBundle\Entity\Plugin;
use Mautic\CoreBundle\Factory\MauticFactory;

class MauticCustomFieldTestBundle extends PluginBundleBase
{

    /**
     * Called by PluginController::reloadAction when adding a new plugin that's not already installed
     *
     * @param Plugin        $plugin
     * @param MauticFactory $factory
     * @param null          $metadata
     */

    static public function onPluginInstall(Plugin $plugin, MauticFactory $factory, $metadata = null, $installedSchema = NULL)
    {
        if ($metadata !== null) {
            self::installPluginSchema($metadata, $factory, $installedSchema = NULL);
        }
        // Do other install stuff
    }

    /**
    * Called by PluginController::reloadAction when the plugin version does not match what's installed
    *
    * @param Plugin        $plugin
    * @param MauticFactory $factory
    * @param null          $metadata
    * @param Schema        $installedSchema
    *
    * @throws \Exception
    */
    static public function onPluginUpdate(Plugin $plugin, MauticFactory $factory, $metadata = null, Schema $installedSchema = null)
    {
    }

}
