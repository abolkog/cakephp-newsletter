<?php

namespace Newsletter\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;

class NewsletterComponent extends Component {

    /**
     * The Controller that will attach this component to
     */
    protected $_controller = null;


    public function __construct(ComponentRegistry $registry, array $config = [])
    {
        parent::__construct($registry, $config);
        $this->_controller = $registry->getController();
    }

    public function beforeRender(Event $event) {
        //Attach the SubscribeWidgetHelper to the controller's helpers
        $this->_controller->helpers = array_merge($this->_controller->helpers, ['Newsletter.SubscribeWidget']);
    }
}