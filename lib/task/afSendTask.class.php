<?php

class afSendTask extends sfPropelBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      // add your own options here
    ));

    $this->namespace        = 'afAutomailerPlugin';
    $this->name             = 'send';
    $this->briefDescription = 'Sends not sent emails';
    $this->detailedDescription = <<<EOF
The [afAutomailer:send|INFO] task sends not sent emails.
Call it with:

  [php symfony afAutomailerPlugin:send|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $automailer_objs = AutomailerPeer::getUnsentEmails();

    if(count($automailer_objs)>0)
    {
      foreach ($automailer_objs as $k=>$automailer_obj)
      {
        // only proceed if and only if there is a source and a destination
        if ($automailer_obj->getFromEmail() != '' && $automailer_obj->getToEmail() != '') {
          afAutomailer::sendMail($automailer_obj);
        }
      }
    }
    
  }
}
