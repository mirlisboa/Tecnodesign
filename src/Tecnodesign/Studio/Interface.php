<?php
/**
 * Tecnodesign Automatic Interfaces
 *
 * This is an action for managing interfaces for all available models
 *
 * PHP version 5.3
 *
 * @category  Interface
 * @package   Studio
 * @author    Guilherme Capilé, Tecnodesign <ti@tecnodz.com>
 * @copyright 2015 Tecnodesign
 * @link      https://tecnodz.com/
 */
class Tecnodesign_Studio_Interface extends Tecnodesign_Interface
{
    public static
        $breadcrumbs        = false,
        $displaySearch      = true,
        $displayList        = true,
        $listPagesOnTop     = true,
        $listPagesOnBottom  = true,
        $translate          = true,
        $hitsPerPage        = 25,
        $attrListClass      = 'tdz-i-list',
        $attrPreviewClass   = 'tdz-i-preview',
        $attrParamClass     = 'tdz-i-param',
        $attrTermClass      = 'tdz-i-term',
        $attrErrorClass     = 'tdz-err tdz-msg',
        $attrCounterClass   = 'tdz-counter',
        $attrButtonsClass   = '',
        $attrButtonClass    = '',
        $dir                = array('interface'),
        $additionalActions   = array(
                                //'publish'=> array('position'=>31, 'action' => 'executePublish',  'identified'=>true, 'batch'=>true, 'renderer'=>'renderPublish'),
                            ),
        $models             = array(
                                //'e'=>'Entry',
                                'c'=>'Content',
                                //'p'=>'Permission',
                                //'w'=>'User',
                                //'g'=>'Group',
            );

    private static $t;

    public static function t($s, $alt=null)
    {
        return Tecnodesign_Studio::t($s, $alt, 'interface');
    }

    /**
     * Main static caller: just trigger a interface with it
     *
     *   (string) $n   interface to be called
     *   (string) $url optional base url
     *
     */
    public static function run($n=null, $url=null)
    {
        return '<div id="studio" class="studio-interface">'.parent::run($n, $url).'</div>';
    }

    public static function loadInterface($a=array(), $prepare=true)
    {
        $a = parent::loadInterface($a, $prepare);

        // overwrite credentials
        if($prepare && !isset($a['credential'])) {
            $min = null;
            foreach(self::$actionAlias as $aa=>$an) {
                $m = (isset(self::$models[$a['interface']]))?(self::$models[$a['interface']]):($a['model']);
                $c = Tecnodesign_Studio::credential($an.'Interface'.$m);
                if(!is_null($c)) {
                    if($c===true) {
                        $min = $c;
                        $a['actions'][$an] = true;
                    } else if(!$c) {
                        continue;
                    } else {
                        if(is_null($min)) $min = $c;
                        else if(is_array($min)) $min = array_merge($min, $c);

                        if(isset($a['actions'][$an]) && !is_array($a['actions'][$an])) $a['actions'][$an]=array();
                        $a['actions'][$an]['credential'] = $c;
                    }
                }
            }
            if(!is_null($min)) {
                if(is_array($min)) $min = array_unique($min);
                $a['credential'] = $min;
            }
        }
        return $a;
    }

    public static function error($code=500, $msg=null)
    {
        Tecnodesign_Studio::error($code);
    }
}

if(TDZ_VAR!=TDZ_ROOT.'/data') {
    Tecnodesign_Studio_Interface::$dir[] = TDZ_ROOT.'/data/interface';
}