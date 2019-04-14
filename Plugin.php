<?php namespace DigitreadMedia\ExtendedBuilder;

use System\Classes\PluginBase;
use Event;
use App;
use Backend;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.Builder'];
    
    public function boot()
    {
        App::error(function($e) {
            if(preg_match('/direrror/',$e->getMessage())) {
    				return 'The plugin directory does not exist and could not be created.';
    	    }
            if(preg_match('/yamlerror/',$e->getMessage())) {
    				return 'The YAML content could not be created.';
    	    }  
            if(preg_match('/fileerror/',$e->getMessage())) {
    				return 'The YAML file could not be opened.';
    	    }    
            if(preg_match('/writeerror/',$e->getMessage())) {
    				return 'The YAML file could not be written.';
    	    }     	    
        });
    }
    
    public function registerPermissions()
    {
        return [
            'rainlab.builder.manage_plugins' => [
                'tab' => 'rainlab.builder::lang.plugin.name',
                'label' => 'rainlab.builder::lang.plugin.manage_plugins']
        ];
    }
    
    public function registerNavigation()
    {
        return [
            'autofields' => [
                'label'       => 'digitreadmedia.extendedbuilder::lang.autofields',
                'url'         => Backend::url('digitreadmedia/extendedbuilder'),
                'icon'        => 'icon-navicon',
                'iconSvg'     => 'plugins/digitreadmedia/extendedbuilder/assets/images/ebicon.svg',
                'permissions' => ['rainlab.builder.manage_plugins'],
                'order'       => 500,

                'sideMenu' => [
                    'models' => [
                        'label'       => 'rainlab.builder::lang.model.menu_label',
                        'icon'        => 'icon-random',
                        'url'         => 'javascript:;',
                        'attributes'  => ['data-menu-item'=>'models'],
                        'permissions' => ['rainlab.builder.manage_plugins'],
                        'order'       => 100
                    ]
                ]

            ]
        ];
    }
}
