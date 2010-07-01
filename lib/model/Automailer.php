<?php

class Automailer extends BaseAutomailer
{
    public function setContent($module, $partial, $vars)
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

        $pathToModules = sfConfig::get('sf_root_dir').'/apps/'.sfContext::getInstance()->getConfiguration()->getApplication().'/modules';
        $bodyPath = $pathToModules.'/'.$module.'/templates/_'.$partial.'.php';
        $altBodyPath = $pathToModules.'/'.$module.'/templates/_'.$partial.'.altbody.php';

        if(file_exists($bodyPath))
        {
            $body = get_partial($module.'/'.$partial, $vars);
            parent::setBody($body);
        }

        if(file_exists($altBodyPath))
        {
            $alt_body = get_partial($module.'/'.$partial.'.altbody', $vars);
            parent::setAltBody($alt_body);
        }
    }


    public function markSubmitted() {
        $this->setIsSent(1);
        $this->save();
    }

    public function markFailed() {
        $this->setIsFailed(1);
        $this->save();
    }
}
