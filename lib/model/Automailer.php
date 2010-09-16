<?php

class Automailer extends BaseAutomailer
{
    public function setContent($module, $partial, $vars)
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

        $config=sfApplicationConfiguration::getActive();
        
        $bodyPath = $config->getTemplatePath($module,'_'.$partial.'.php');
        $altBodyPath = $config->getTemplatePath($module,'_'.$partial.'.altbody.php');

        if($bodyPath!=null)
        {
            $body = get_partial($module.'/'.$partial, $vars);
            parent::setBody($body);
        }

        if($altBodyPath!=null)
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
