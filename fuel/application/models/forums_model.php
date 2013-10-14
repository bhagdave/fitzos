<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Forums_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('forum');
    }
}
 
class Forum_model extends Base_module_record {
 
}
