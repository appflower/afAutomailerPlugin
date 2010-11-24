<?php

class AutomailerPeer extends BaseAutomailerPeer
{
    public static function getEmailsForSending() {
        $c = new Criteria();
        $c->add(self::IS_SENT, 0);
        $c->addAnd(self::IS_FAILED, 0);
        $c->setLimit(30);
        $c->add(self::SEND_AT_DATE, time(), Criteria::LESS_EQUAL);
        
        return self::doSelect($c);
    }
}
