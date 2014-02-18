<?php
$output = '';
$values = array(
    'piwigo_url' => MODX_SITE_URL.'piwigo/',
);
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        $setting = $modx->getObject('modSystemSetting',array('key' => 'piwigomodx.piwigo_url'));
        if ($setting != null) { $values['piwigo_url'] = $setting->get('value'); }
        unset($setting);
        break;
    case xPDOTransport::ACTION_UNINSTALL:
        break;
}

$output = '
<label for="piwigomodx-piwigo_url">Url of Piwigo gallery:</label><br />
<input type="text" name="piwigo_url" id="piwigomodx-piwigo_url" value="'.$values['piwigo_url'].'" />';
return $output;
