<?php

namespace Mollie\Payment\extend\Core;

class Session extends Session_parent
{
    /**
     * returns configuration array with info which parameters require session
     * start
     *
     * @return array
     */
    protected function getRequireSessionWithParams()
    {
        $this->_aRequireSessionWithParams['cl']['mollieFinishPayment'] = true;

        return parent::getRequireSessionWithParams();
    }
}
