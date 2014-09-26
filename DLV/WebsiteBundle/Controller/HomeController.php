<?php

namespace DLV\WebsiteBundle\Controller;

use DLV\WebsiteBundle\Controller\DefaultController;

use Symfony\Component\HttpFoundation\Request;

class HomeController extends DefaultController {
    
    public function indexAction($lang, $subpage = 'home', Request $request) {
        
        $this->initialize($request, $lang);
        
        $this->template = 'DLVWebsiteBundle:Home:' . $subpage . '.html.twig';
        
        return $this->getResponse();
        
    }
    
}
