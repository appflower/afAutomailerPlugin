<?php

/**
 * mail actions.
 *
 * @package    automailer
 * @subpackage mail
 * @author     changes to automailer made by radu
 */
class afAutomailerComponents extends sfComponents
{
	public function executeGet()
	{				
                $mailModule   = $this->mailModule;
                $mailTemplate = $this->mailTemplate;

		$this->mail = $this->saveMail($mailModule, $mailTemplate);
	}
	
	public function saveMail($mailModule, $mailTemplate)
	{
                $this->getContext()->getConfiguration()->loadHelpers('Partial');
		
                $email = $this->getRequest()->getAttribute('email');
                $subject = $this->getRequest()->getAttribute('subject');
                $from = $this->getRequest()->getAttribute('from');

                $mail = new Automailer();
                $mail->setToEmail($email);
                $mail->setFromEmail('no-reply@'.sfConfig::get('app_domain'));
                $mail->setFromName($from);
                $mail->setSubject($subject);
                $mail->setIsHtml(1);
                $mail->setSentDate(time());
                $mail->setContent($mailModule, $mailTemplate, array('email' => $email));
                $mail->save();

                return $mail;
	}
}

?>
