<?php
class afAutomailer {

        public static function getMailTemplate($mailModule, $mailTemplate)
        {
            sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

            return get_component('afAutomailer', 'get', array(
                    'mailModule'   => $mailModule,
                    'mailTemplate' => $mailTemplate
                )
            );
        }

        public static function getUnsentEmails() {
            $c = new Criteria();
            $c->add(AutomailerPeer::IS_SENT,0);
            $c->addAnd(AutomailerPeer::IS_FAILED,0);
            $c->setLimit(100);
            $objs = AutomailerPeer::doSelect($c);
            //print_r($objs);
            return $objs;
        }

        public static function markSubmitted($id) {
            $automailer=AutomailerPeer::retrieveByPK($id);
            $automailer->setIsSent(1);
            $automailer->save();
        }

        public static function markFailed($id) {
            $automailer=AutomailerPeer::retrieveByPK($id);
            $automailer->setIsFailed(1);
            $automailer->save();
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
                  //echo $automailer_obj->getId().' was sent!';
                  self::markSubmitted($automailer_obj->getId());
                  return true;
              }
              else {
                  //echo $automailer_obj->getId().' failed!';
                  self::markFailed($automailer_obj->getId());
                  return false;
              }

              $mail->ClearAddresses();
              $mail->ClearAttachments();
              //$mail->SmtpClose();
              unset($mail);
        }

}
?>
