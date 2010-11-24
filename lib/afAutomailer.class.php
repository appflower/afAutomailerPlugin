<?php
class afAutomailer {

        public static function saveMail($mailModule, $mailTemplate, $parameters, $sendAt = null)
	{
            $mail = new Automailer();
            $mail->setToEmail($parameters['email']);
            $appConf = sfApplicationConfiguration::getActive();
            if (method_exists($appConf, 'configGet')) {
                $appDomain = $appConf->configGet('app_domain');
            } else {
                $appDomain = sfConfig::get('app_domain');
            }
            $mail->setFromEmail("no-reply@$appDomain");
            $mail->setFromName($parameters['from']);
            $mail->setSubject($parameters['subject']);
            $mail->setIsHtml(1);
            $mail->setSentDate(time());
            $mail->setContent($mailModule, $mailTemplate, $parameters);
            $mail->setSendAtDate($sendAt);
            $mail->save();
	}

        public static function sendMail($automailer_obj)
        {
            $frontendConfiguration = sfProjectConfiguration::getApplicationConfiguration('frontend', 'prod', true);
            $instance = sfContext::createInstance($frontendConfiguration);

            $mailer = $instance->getMailer();
            
            $message = Swift_Message::newInstance()
              ->setFrom($automailer_obj->getFromEmail(), $automailer_obj->getFromName())
              ->setTo($automailer_obj->getToEmail())
              ->setSubject($automailer_obj->getSubject())
              ->setBody($automailer_obj->getBody())
              ->addPart($automailer_obj->getAltBody(), 'text/plain');
            ;

            if($automailer_obj->getIsHtml()) {
                $message->setContentType("text/html");
            }

            if ($mailer->send($message) > 0) {
				if( sfConfig::get('app_afAutomailerPlugin_delete_on_success') ) {
		            $automailer_obj->delete();
				} else {
				    $automailer_obj->markSubmitted();
				}

                return true;
            }
            else {
                $automailer_obj->markFailed();
                return false;
            }
        }

}
?>
