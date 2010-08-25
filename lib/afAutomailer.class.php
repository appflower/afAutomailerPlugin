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
              $mail = new PHPMailer();
              $mail->IsMail();
              $mail->From     = $automailer_obj->getFromEmail();
              $mail->FromName = $automailer_obj->getFromName();
              $mail->IsHTML(($automailer_obj->getIsHtml()==1 ? true : false));
              $mail->Subject  = $automailer_obj->getSubject();
              $mail->Body     = $automailer_obj->getBody();
              $mail->AltBody  = $automailer_obj->getAltBody();
              $mail->AddAddress($automailer_obj->getToEmail());

              if ($mail->Send()) {
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
