<?php

namespace DLV\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use DLV\WebsiteBundle\Notification;

use DLV\WebsiteBundle\Header\Header;

use DLV\WebsiteBundle\Data\Data;

class DefaultController extends Controller {
    
    protected $request;
    protected $session;
    protected $notification;

    protected $lang;
    protected $user;
    protected $allow;
    
    protected $data;
    protected $text;

    protected $template;
    protected $template_data;
    protected $response;
    
    /*
     * 
     *      Comments
     * 
     */
    protected function initialize($request, $lang = null, $allowed = 'all') {
        
        $this->request = $request;
        $this->session = $this->request->getSession();
        $this->lang = $lang;
        if($this->lang === null){
            $this->lang = $this->getLang();
        }
        else{
            $this->response = new Response();
            $this->notification = new Notification();
            if($this->session->has('notification')){
                $notification = $this->session->get('notification');
                $this->notification->set($notification['type'], $notification['text']);
                $this->session->remove('notification');
            }
            
            $this->allow = false;
            
            if($this->session->has('user_id')){
                $this->user = $this->getUserData($this->request->getSession()->get('user_id'));
                
                if($this->user['type'] == $allowed || $this->user['type'] == 'admin'){
                    $this->allow = true;
                }
            }
            else{
                $this->user = false;
                if($allowed == 'anonimous'){
                    $this->allow = true;
                }
            }
                
            if($allowed == 'all'){
                $this->allow = true;
            }
            
            if($this->allow){
                
                $this->data = new Data($this->getDoctrine());
                
                $this->data->addStat($this->request);
                
                $header = new Header($this->request->getRequestUri(), $this->user, $this);
                $this->template_data['pagename'] = $header->getPageName();
                $this->template_data['langlinks'] = $header->getLangLinks();
                $this->template_data['menu_items'] = $header->getMenu();
                $this->template_data['submenu_items'] = $header->getSubMenu();
                
            }
        }
    }
    
    protected function getResponse() {
        
        $template = $this->template;
        $data = $this->template_data;
        $response = $this->response;
        $notification = $this->notification;
        
        $data['notify'] = $notification->is_set();
        if($data['notify']){
            $data['notification'] = $notification->get_array();
        }
        
        return $this->render($template, $data, $response);
        
    }
    
    protected function setNotFound() {
        $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
    }
    
    protected function getLang() {
        
        $user_options = explode(',', $this->request->server->get('HTTP_ACCEPT_LANGUAGE'));
        $server_options = array('en','nl','fr');
        $lang = 0;
        $count = 0;
        $match = false;
        
        do {
            foreach ($server_options as $index => $option) {
                if(preg_match('/' . $option . '/', $user_options[$count])){
                    $lang = $index;
                    $match = true;
                }
            }
            $count++;
        } while (!$match);
        
        return $server_options[$lang];
        
    }
    
    public function getUserData($id, $entity = false) {
        $user = $this->getDoctrine()->getRepository('DLVWebsiteBundle:User')->find($id);
        if($entity){
            return $user;
        }
        return array(
            'id'=> $user->getId(),
            'fname'=> $user->getFirstName(),
            'lname'=> $user->getLastName(),
            'email'=> $user->getemail(),
            'picture'=> $user->getPicture(),
            'type'=> $user->getType()
        );
    }
    
    public function redirectAction(Request $request) {
        
        $this->initialize($request);
        
        $url = $this->generateUrl('dlv_website_frontpage');
        $url.= $this->lang;
        $url.= rtrim($this->request->getRequestUri(),'/');
        
        return $this->redirect($url);
        
    }
    
}
