<?php

namespace DLV\WebsiteBundle\Controller;

use DLV\WebsiteBundle\Controller\DefaultController;

use Symfony\Component\HttpFoundation\Request;

class MediaController extends DefaultController {
    
    public function indexAction($lang, $subpage = 'pictures', Request $request) {
        
        $this->initialize($request, $lang);
        
        $this->template = 'DLVWebsiteBundle:Media:' . $subpage . '.html.twig';
        
        return $this->getResponse();
        
    }
    
}
