<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Notifications_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('notifications');
    }
}
 
class Notification_model extends Base_module_record {
 
}
