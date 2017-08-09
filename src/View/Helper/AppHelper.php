<?php

namespace Newsletter\View\Helper;

use Cake\View\Helper\HtmlHelper;

class AppHelper extends HtmlHelper
{

    public function niceDate($date,$time=false)
    {
        if($time)
            return date('M d, Y H:m',strtotime($date));
        return  date('M d, Y',strtotime($date));
    }

    public function campaignStatusToString($status) {
        switch ($status) {
            case 1:
                $result['status'] = __('New');
                $result['color']  = 'brown';
                break;
            case 2:
                $result['status'] = __('Sending');
                $result['color']  = 'aqua';
                break;
            case 3:
                $result['status'] = __('Completed');
                $result['color']  = 'green';
                break;
            default:
                $result['status'] = __('Unknown');
                $result['color']  = 'red';
                break;

        }
        return $result;
    }

}