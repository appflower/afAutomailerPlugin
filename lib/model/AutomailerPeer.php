<?php

class AutomailerPeer extends BaseAutomailerPeer
{
    public static function getEmailsForSending() {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(self::ID);
        $c->add(self::IS_SENT, 0);
        $c->addAnd(self::IS_FAILED, 0);
        $c->setLimit(sfConfig::get('app_afAutomailerPlugin_emails_limit'));
        $c->add(self::SEND_AT_DATE, time(), Criteria::LESS_EQUAL);
        
        return self::doSelect($c);
    }
}
