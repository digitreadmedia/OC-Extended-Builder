<?php namespace DigitreadMedia\ExtendedBuilder\Controllers;

use RainLab\Builder\controllers\Index as BuilderIndex;
use DigitreadMedia\ExtendedBuilder\Widgets\PluginList;
use DigitreadMedia\ExtendedBuilder\Widgets\ModelList;
use BackendMenu;

/**
 * ExtendedBuilder index controller
 *
 */
class Index extends BuilderIndex
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('DigitreadMedia.ExtendedBuilder', 'autofields', 'models');

        $this->bodyClass = 'compact-container ext-builder';
        $this->pageTitle = 'digitreadmedia.extendedbuilder::lang.plugin.name';
        $this->addCss('/plugins/digitreadmedia/extendedbuilder/assets/css/custom.css', 'DigitreadMedia.ExtendedBuilder');
        
        new PluginList($this, 'pluginList');
        new ModelList($this, 'modelList');
    }
}
