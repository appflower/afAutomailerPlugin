<?php

class Automailer extends BaseAutomailer
{
    public function setContent($module, $partial, $vars)
    {
        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

        $body = get_partial($module.'/'.$partial, $vars);

        if($body)
        {
                parent::setBody($body);
        }

        $alt_body = get_partial($module.'/'.$partial.'.altbody', $vars);

        if($alt_body)
        {
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
