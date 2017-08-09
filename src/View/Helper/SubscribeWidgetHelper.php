<?php
namespace Newsletter\View\Helper;

use Cake\ORM\TableRegistry;
use Cake\View\Helper;

class SubscribeWidgetHelper extends Helper
{

    public function show(){
        $subscriber = TableRegistry::get('Subscribers')->newEntity();
        $this->setConfig('subscriber',$subscriber);
        return $this->_View->element('Newsletter.subscribe_form');
    }
}