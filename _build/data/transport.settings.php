<?php
$settings = array();

$settings['piwigomodx.piwigo_url']= $modx->newObject('modSystemSetting');
$settings['piwigomodx.piwigo_url']->fromArray(array(
    'key' => 'piwigomodx.piwigo_url',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'piwigomodx',
    'area' => 'common',
),'',true,true);

return $settings;
