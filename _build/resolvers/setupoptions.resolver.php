<?php
$success= false;
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        $settings = array(
            'piwigo_url',
        );
        foreach ($settings as $key) {
            if (isset($options[$key])) {
                $setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'piwigomodx.'.$key));
                if ($setting != null) {
                    $setting->set('value',$options[$key]);
                    $setting->save();
                } else {
                    $object->xpdo->log(xPDO::LOG_LEVEL_ERROR,'[PiwigoModx] '.$key.' setting could not be found, so the setting could not be changed.');
                }
            }
        }

        $success= true;
        break;
    case xPDOTransport::ACTION_UNINSTALL:
        $success= true;
        break;
}
return $success;
