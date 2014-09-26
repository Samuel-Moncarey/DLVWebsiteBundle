<?php

namespace DLV\WebsiteBundle;

class Notification {
    
    private $type;
    private $text;
    private $is_set;

    public function __construct() {
        
        $this->is_set = false;
        
    }
    
    public function set($type, $text) {
        
        $this->type = $type;
        $this->text = $text;
        $this->is_set = true;
        
    }
    
    public function is_set() {
        
        return $this->is_set;
        
    }
    
    public function get_array() {
        
        return array(
            'type' => $this->type,
            'text' => $this->text
        );
        
    }
    
}
