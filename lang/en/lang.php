<?php return [
    'plugin' => [
        'name' => 'Extended Builder Plugin',
        'description' => 'This plugin extends the RainLab Builder plugin to auto-generate a YAML form skeleton from database columns for editing in Builder.',
        'extended_description' => 'This plugin extends the RainLab Builder plugin. Save time with form creation by auto-generating a basic YAML form with fields batch-generated from the model table columns. Thereafter you can configure and customize the form using RainLab Builder.',
        'use' => 'How To Use',
        'use_description' => '&bull; Install the plugin.<br/>&bull; Navigate to <strong>Auto Fields</strong> on the menu<br/>&bull; Select your plugin<br/>&bull; Select the model<br/>&bull; Set the field options for each table column<br/>&bull; Click on <strong>GENERATE FORM</strong><br/>&bull; Open the generated YAML form in <strong>RainLab Builder</strong> and configure/customize it.<br/><br/><p><strong>PLEASE NOTE:</strong> This plugin generates a basic skeleton.  You still need to properly configure the form fields via RainLab Builder or by manually editing the YAML files, otherwise the forms may not function correctly.</p>',
        'search' => 'Search...',
        'filter_description' => 'Display all plugins or only your plugins.',
        'no_description' => 'No description provided for this plugin',
    ],
    'autofields' => 'Auto Fields',
    'model' => [
        'search' => 'Search...',
    ],
    'common' => [
        'select_plugin_first' => 'Please select a plugin first. To see the plugin list click the > icon on the left sidebar.',
        'plugin_not_selected' => 'Plugin is not selected',
        'generate_fields' => 'Generate Fields',
        'form_name' => 'Form Name',
        'form_name_description' => 'Please note: you may want to use a non-existing filename and rename later - existing YAML forms will be overwritten!',
        'list_fields' => 'Database Fields',
        'skip'=>'Skip',
        'field_type' => 'Field Type',
        'add_tab' => 'Add Tab',
        'tab_order' => 'Tab #',
        'generate' => 'GENERATE FORM',
    ]
];