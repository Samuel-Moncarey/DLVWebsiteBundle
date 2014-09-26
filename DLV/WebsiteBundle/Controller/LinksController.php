<?php

namespace DLV\WebsiteBundle\Controller;

use DLV\WebsiteBundle\Controller\DefaultController;

use Symfony\Component\HttpFoundation\Request;

class LinksController extends DefaultController {
    
    public function indexAction($lang, $subpage = 'bands', Request $request) {
        
        $this->initialize($request, $lang);
        
        $this->data->getLinks($subpage);
        
        $this->template = 'DLVWebsiteBundle:Links:' . $subpage . '.html.twig';
        
        return $this->getResponse();
        
    }
    
    public function adminAction($lang, $action, $event = false, Request $request) {
        
        $this->initialize($request, $lang, 'admin');
        
        if(!$this->allow){
            return $this->redirect($this->generateUrl('dlv_website_events',array('lang'=>$lang), true));
        }
        
        switch ($action) {
            case 'summary':
                $this->template_data['events'] = $this->data->getEventSummary($lang, $this->user['id'], $this);
                $this->template_data['user'] = $this->user;
                break;
        }
        
        $this->template = 'DLVWebsiteBundle:Events:' . $action . '.html.twig';
        
        return $this->getResponse();
    }
    
    public function newAction($lang, $action, Request $request) {
        
        $this->initialize($request, $lang, 'admin');
        
        if(!$this->allow){
            return $this->redirect($this->generateUrl('dlv_website_links',array('lang'=>$lang), true));
        }
        
        $redirect = false;
        
        switch ($action) {
            case 'new-location':
                $redirect = $this->redirect($this->generateUrl(
                        'dlv_website_edit_link',
                        array(
                            'lang'=> $lang,
                            'action'=> 'edit-location',
                            'id'=> $this->data->createLocation($this->user['id'], $this)
                        ),
                        true
                    ));
                break;
            case 'new-band':
                $redirect = $this->redirect($this->generateUrl(
                        'dlv_website_edit_link',
                        array(
                            'lang'=> $lang,
                            'action'=> 'edit-band',
                            'id'=> $this->data->createBand($this->user['id'], $this)
                        ),
                        true
                    ));
                break;
        }
        
        return $redirect;
        
    }
    
    public function editAction($lang, $action, $id, Request $request) {
        
        $this->initialize($request, $lang, 'admin');
        
        if(!$this->allow){
            return $this->redirect($this->generateUrl('dlv_website_links',array('lang'=>$lang), true));
        }
        
        switch ($action) {
            case 'edit-location':
                if($request->getMethod() == 'POST'){
                    
                }
                else{
                    $this->template_data['location'] = $this->data->getEventById($id);
                }
                break;
            case 'edit-band':
                if($request->getMethod() == 'POST'){
                    
                }
                else{
                    $this->template_data['band'] = $this->data->getEventById($id);
                }
                break;
        }
        
        $this->template = 'DLVWebsiteBundle:Admin:' . $action . '.html.twig';
        
        return $this->getResponse();
        
    }
    
}
