<?php

namespace DLV\WebsiteBundle\Header;

class MenuItem {
    
    private $page;
    private $pagename;
    private $pagetitle;
    private $lang;
    private $pageurl;
    private $subpages;

    public function __construct($page, $params, $lang, $user, $that) {
        
        $this->page = $page;
        $this->pagename = $params['name'];
        $this->pagetitle = $params['title'];
        if($user && isset($params[$user['type'] . '-title'])){
            $this->pagetitle = $params[$user['type'] . '-title'];
        }
        $this->lang = $lang;
        $this->pageurl = $that->generateUrl($params['route'], array('lang' => $this->lang), true);
        
        $subroute = $params['route'];
        if(isset($params['submenu']['route'])){
            $subroute = $params['submenu']['route'];
        }
        
        $subneedle = 'items';
        if($user && isset($params['submenu'][$user['type'] . '-items'])){
            $subneedle = $user['type'] . '-items';
        }
        
        foreach ($params['submenu'][$subneedle] as $subpage => $subpagename) {
            $this->subpages[$subpage]['name'] = $subpagename;
            $this->subpages[$subpage]['pageurl'] = $that->generateUrl(
                                                        $subroute,
                                                        array(
                                                            'lang' => $this->lang,
                                                            'subpage' => $subpage
                                                        ),
                                                        true
                                                    );
        }       
        
    }
    
    public function getPageName() {
        return $this->pagetitle;
    }
    
    public function getSubPageName($param) {
        
        $name = str_replace('-', ' ', $param);
        
        if(isset($this->subpages[$param])){
            $name = $this->subpages[$param]['name'];
        }
        
        return $name;
        
    }
    
    public function getPageArray($mainpage) {
        
        $class = 'off_page';
        if($this->page == $mainpage){
            $class = 'on_page';
        }
        
        return array(
            'title'=>  $this->pagename,
            'url'=> $this->pageurl,
            'class'=> $class
        );
        
    }
    
    public function getSubPageArray($pagename) {
        
        $returnArray = array();
        
        foreach ($this->subpages as $page) {
            
            $class = 'off_page';
            if($page['name'] == $pagename){
                $class = 'on_page';
            }
            
            $returnArray[] = array(
                'title'=> $page['name'],
                'url'=> $page['pageurl'],
                'class'=> $class
            );
        }
        
        return $returnArray;
        
    }
    
}
