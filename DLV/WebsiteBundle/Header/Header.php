<?php

namespace DLV\WebsiteBundle\Header;

use DLV\WebsiteBundle\Header\MenuItem;

use DLV\WebsiteBundle\Header\MenuItmesEntity;

class Header {
    
    private $pagename;
    private $mainpage;
    private $lang;
    private $items;
    private $user;
    private $login;
    private $langLink = array(
        'en'=> array('title'=>'English','text'=>'EN'),
        'nl'=> array('title'=>'Nederlands','text'=>'NL'),
        'fr'=> array('title'=>'Français','text'=>'FR')
    );

    public function __construct($uri, $user, $that) {
        
        $uri_params = explode('/', $uri);
        $this->lang = $uri_params[1];
        $this->mainpage = (isset($uri_params[2]))? $uri_params[2] : 'home';
        
        foreach ($this->langLink as $lang => $array) {
            $this->langLink[$lang]['class'] = (($uri_params[1]==$lang)? 'current_language':'');
            $langurl = $that->generateUrl('dlv_website_homepage',array('lang'=>$lang),true);
            for($param = 2; $param < count($uri_params); $param++){
                $langurl.='/' . $uri_params[$param];
            }
            $this->langLink[$lang]['url'] = $langurl;
        }
        
        $menu = new MenuItmesEntity();
        $menuitem = $menu->getMenu($this->lang);
        
        foreach ($menuitem as $page => $params) {
            $this->items[$page] = new MenuItem($page, $params, $this->lang, $user, $that);
        }
        
        if(count($uri_params) < 4){
            $this->pagename = $this->items[$this->mainpage]->getPageName();
        }
        else{
            $this->pagename = $this->items[$this->mainpage]->getSubPageName($uri_params[3]);
        }
        
        $this->user = $user;
        
        $this->login = $this->loginBtnArray($that);
        
    }
    
    private function loginBtnArray($that) {
        return array(
            'en' => array(
                'login'=> array(
                    'title'=>'Login',
                    'url'=> $that->generateUrl('dlv_website_subvip', array('lang'=>'en','subpage'=>'login'))
                ),
                'logout'=> array(
                    'title'=>'Logout',
                    'url'=> $that->generateUrl('dlv_website_subvip', array('lang'=>'en','subpage'=>'logout'))
                )
            ),
            'nl' => array(
                'login'=> array(
                    'title'=>'Login',
                    'url'=> $that->generateUrl('dlv_website_subvip', array('lang'=>'nl','subpage'=>'login'))
                ),
                'logout'=> array(
                    'title'=>'Afmelden',
                    'url'=> $that->generateUrl('dlv_website_subvip', array('lang'=>'nl','subpage'=>'logout'))
                )
            ),
            'fr' => array(
                'login'=> array(
                    'title'=>'Connexion',
                    'url'=> $that->generateUrl('dlv_website_subvip', array('lang'=>'fr','subpage'=>'login'))
                ),
                'logout'=> array(
                    'title'=>'Déconnexion',
                    'url'=> $that->generateUrl('dlv_website_subvip', array('lang'=>'fr','subpage'=>'logout'))
                )
            )
        );
    }
    
    public function getPageName() {
        return $this->pagename;
    }
    
    public function getLangLinks() {
        return $this->langLink;
    }
    
    public function getMenu() {
        
        $returnArray = array();
        
        foreach ($this->items as $item) {
            $returnArray[] = $item->getPageArray($this->mainpage);
        }
        
        return $returnArray;
    }
    
    public function getSubMenu() {
        
        $returnArray = $this->items[$this->mainpage]->getSubPageArray($this->pagename);
        
        if($this->user){
            $returnArray[] = array(
                'title'=> $this->login[$this->lang]['logout']['title'],
                'url'=> $this->login[$this->lang]['logout']['url'],
                'class'=> 'login_shortcut'
            );
        }
        elseif($this->mainpage != 'vip'){
            $returnArray[] = array(
                'title'=> $this->login[$this->lang]['login']['title'],
                'url'=> $this->login[$this->lang]['login']['url'],
                'class'=> 'login_shortcut'
            );
        }
        
        return $returnArray;
        
    }
    
}
