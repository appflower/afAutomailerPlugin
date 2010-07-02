<?php

class AutomailerPeer extends BaseAutomailerPeer
{
    public static function getUnsentEmails() {
        $c = new Criteria();
        $c->add(self::IS_SENT, 0);
        $c->addAnd(self::IS_FAILED, 0);
        $c->setLimit(100);
        
        return self::doSelect($c);
    }
}
