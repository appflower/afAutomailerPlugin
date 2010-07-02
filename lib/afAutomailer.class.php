<?php
class afAutomailer {

        public static function saveMail($mailModule, $mailTemplate, $parameters)
	{
            $mail = new Automailer();
            $mail->setToEmail($parameters['email']);
            $mail->setFromEmail('no-reply@'.sfConfig::get('app_domain'));
            $mail->setFromName($parameters['from']);
            $mail->setSubject($parameters['subject']);
            $mail->setIsHtml(1);
            $mail->setSentDate(time());
            $mail->setContent($mailModule, $mailTemplate, $parameters);
            $mail->save();
	}

        public static function sendMail($automailer_obj)
        {
            $frontendConfiguration = sfProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
            $instance = sfContext::createInstance($frontendConfiguration);

            $mail = $instance->getMailer();

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

            if ($mail->send($message) > 0) {
                $automailer_obj->markSubmitted();
                return true;
            }
            else {
                $automailer_obj->markFailed();
                return false;
            }
        }

}
?>
