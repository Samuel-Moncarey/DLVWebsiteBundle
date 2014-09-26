<?php

namespace DLV\WebsiteBundle\Controller;

use DLV\WebsiteBundle\Controller\DefaultController;

use Symfony\Component\HttpFoundation\Request;

class BookingsController extends DefaultController {
    
    public function indexAction($lang, $subpage = 'host-an-event', Request $request) {
        
        $this->initialize($request, $lang);
        
        $this->template = 'DLVWebsiteBundle:Bookings:' . $subpage . '.html.twig';
        
        return $this->getResponse();
        
    }
    
}
