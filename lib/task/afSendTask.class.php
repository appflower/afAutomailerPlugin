<?php

class afSendTask extends sfPropelBaseTask
{
  protected function configure()
  {
    $this->namespace        = 'afAutomailerPlugin';
    $this->name             = 'send';
    $this->briefDescription = 'Sends not sent emails';
    $this->detailedDescription = <<<EOF
The [afAutomailer:send|INFO] task sends not sent emails.
Call it with:

  [php symfony afAutomailerPlugin:send|INFO]
EOF;
    $this->addOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', 'frontend' );
    $this->addOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod');
    $this->addOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel');
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = Propel::getConnection($options['connection'] ? $options['connection'] : '');
    
    $automailer_objs = AutomailerPeer::getEmailsForSending();

    $counter = 0;
    if(count($automailer_objs)>0)
    {
      foreach ($automailer_objs as $k=>$automailer_obj)
      {

        // only proceed if and only if there is a source and a destination
        if ($automailer_obj->getFromEmail() != '' && $automailer_obj->getToEmail() != '') {
          if (afAutomailer::sendMail($automailer_obj)) {
              $counter++;
          }
        }
      }
    }

    $this->log("Nr of emails send: $counter");
    return 0;
  }
}