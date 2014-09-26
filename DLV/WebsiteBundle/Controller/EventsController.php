<?php

namespace DLV\WebsiteBundle\Controller;

use DLV\WebsiteBundle\Controller\DefaultController;

use Symfony\Component\HttpFoundation\Request;

use DLV\WebsiteBundle\Languages\EventText;

class EventsController extends DefaultController {
    
    public function indexAction($lang, $subpage = 'spotlight', Request $request) {
        
        $this->initialize($request, $lang);
        
        $text = new EventText();
        $this->template_data['lang'] = $text->getText($lang, 'event-list');
        
        $this->template_data['events'] = $this->data->getEventlist($lang, $subpage);
        
        foreach ($this->template_data['events'] as $key => $event) {
            $this->template_data['events'][$key]['link'] = $this->generateUrl(
                        'dlv_website_event',
                        array(
                            'lang'=> $lang,
                            'event'=> str_replace(' ', '-', $event['name'])
                        ),
                        true
                    );
        }
        
        $this->template = 'DLVWebsiteBundle:Events:event-list.html.twig';
        
        return $this->getResponse();
        
    }
    
    public function eventAction($lang, $event, Request $request) {
        
        $this->initialize($request, $lang);
        
        $text = new EventText();
        $this->template_data['lang'] = $text->getText($lang, 'event');
        
        $this->template_data['event'] = $this->data->getEventDetails($lang, $event);
        
        if(is_array($this->template_data['event'])){
            $this->template = 'DLVWebsiteBundle:Events:event.html.twig';
        }
        else{
            $this->setNotFound();
            $this->template = 'DLVWebsiteBundle:Error:not-found.html.twig';
        }
        
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
            return $this->redirect($this->generateUrl('dlv_website_events',array('lang'=>$lang), true));
        }
        
        $redirect = false;
        
        switch ($action) {
            case 'new-event':
                $redirect = $this->redirect($this->generateUrl(
                        'dlv_website_edit_event',
                        array(
                            'lang'=> $lang,
                            'action'=> 'edit-event',
                            'id'=> $this->data->createEvent($this->user['id'], $this)
                        ),
                        true
                    ));
                break;
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
            return $this->redirect($this->generateUrl('dlv_website_events',array('lang'=>$lang), true));
        }
        
        if($request->getMethod() == 'POST'){
            
        }
        else{
            $this->template_data['event'] = $this->data->getEventById($id);
        }
        
        $this->template = 'DLVWebsiteBundle:Admin:edit-event.html.twig';
        
        return $this->getResponse();
        
    }
    
}
