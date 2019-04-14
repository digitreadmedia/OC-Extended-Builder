<?php namespace DigitreadMedia\ExtendedBuilder\Widgets;

use DB;
use Yaml;
use RainLab\Builder\Widgets\ModelList as RainLabModelList;

/**
 * Model list widget.
 * @extends rainlab\builder
 */
class ModelList extends RainLabModelList
{
    /**
     * Display model table column names
     */
    public function onLoadColumns() 
    {
        $postdata = filter_var(post('data'), FILTER_SANITIZE_STRING);
        $class = filter_var(post('class'), FILTER_SANITIZE_STRING);
        $code = filter_var(post('code'), FILTER_SANITIZE_STRING);
        
        $table = DB::select('DESCRIBE '.$postdata);
        
        $this->vars['table'] = $table;
        $this->vars['class'] = $class;
        $this->vars['code'] = $code;
    }
    
    /**
     * Generate the YAML file
     */
    public function onGenerateForm() 
    {
        /*Get post variables*/
        $haveTabs = false;
        $data = post('data');
        $tabbed = post('tabs');
        $tabs = post('order');
        $types = post('type');
        $additional = post('additional');

        /*Sanitize post data*/
        $code = filter_var($data['code'], FILTER_SANITIZE_STRING);
        $class = filter_var($data['class'], FILTER_SANITIZE_STRING);
        $formname = filter_var($data['formname'], FILTER_SANITIZE_STRING);
  
        /*Set filename & path*/
        if(($tabbed)&&(count($tabbed) > 0)) {$haveTabs = true;}
        $filename = str_replace('.yaml','',strtolower($formname));
        if(!$filename) {$filename = 'generatedfields.yaml';}
        else {$filename = $filename.'.yaml';}
        $ns = str_replace('.','/',strtolower($code));
        $folder = str_replace('.','/',strtolower($class));
        $path = plugins_path().'/'.$ns.'/models/'.$folder;
        if(!is_dir($path)) {
            try {mkdir($path);} catch(\Exception $e) {tracelog($e); throw new \Exception('_direrror');}
        }
        $filepath = $path . '/' . $filename;
        
        /*Create data array*/
        $fieldset = [];
        $yaml = [];
        
        foreach($types as $key => $type) {
            $add = null;
            $tab = null;
            if($type != '') {
                if(isset($additional[$key])) {$add[] = ['list'=>$additional[$key]];}
                if($haveTabs) {
                    if(isset($tabs[$key])) {
                        $tab = $tabs[$key];
                        if(is_numeric($tab)) {$tab = "Tab ".$tab;}
                    }
                    else {$tab = 'misc';}
                    $add[] = ['tab' => $tab];
                }

                $fieldset[$key] = ['label' => $key, 'type' => $type];
                
                foreach($add as $val) {
                    foreach($val as $k=>$v) {
                        if($v != '') {
                            if(($k == 'list')&&($v == '')) {$v = '~/plugins/rainlab/user/models/user/columns.yaml';}
                            $fieldset[$key][$k] = $v;
                        }
                    }
                }                
            }
        }
        
        if($haveTabs) {
            $yaml['tabs'] = ['fields'=>$fieldset];
        }
        else {
            $yaml = ['fields'=>$fieldset];
        }

        /*Create YAML data and file*/
        try {$yaml = Yaml::render($yaml);} catch(\Exception $e) {tracelog($e); throw new \Exception('_yamlerror');}
        try {$getfile = fopen($filepath, "w");} catch(\Exception $e) {tracelog($e); throw new \Exception('_fileerror');}
        try {
            fwrite($getfile, $yaml);
            fclose($getfile);
        } catch(\Exception $e) {tracelog($e); throw new \Exception('_writeerror');}
        
    }
    
}