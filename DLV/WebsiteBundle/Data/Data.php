<?php

namespace DLV\WebsiteBundle\Data;

use DLV\WebsiteBundle\Entity\TmpUser;

use DLV\WebsiteBundle\Entity\Statistics;

class Data {
    
    private $doctrine;

    public function __construct($doctrine) {
        $this->doctrine = $doctrine;
    }
    
    public function addStat($request) {
        
        $stat = new Statistics();
        $user = (($request->getSession()->has('user_id'))? $request->getSession()->get('user_id') : 0 );
        $datetime = new \DateTime();
        $referer = (($request->server->has('HTTP_REFERER'))? $request->server->get('HTTP_REFERER') : 'addressbar' );
        
        $stat->setUser($user);
        $stat->setIpAddr($request->server->get('REMOTE_ADDR'));
        $stat->setBrowser($request->server->get('HTTP_USER_AGENT'));
        $stat->setRequestTime($datetime->setTimeStamp($request->server->get('REQUEST_TIME')));
        $stat->setRequestUri($request->server->get('REQUEST_URI'));
        $stat->setReferer($referer);
        
        $db = $this->doctrine->getManager();
        $db->persist($stat);
        $db->flush();
        
    }
    
    public function getEventlist($lang, $page) {
        
        $date = new \DateTime();
        $tresshold = ($date->getTimestamp()-($date->getTimestamp()%86400));
        
        $event_list = array();
        
        $order = '';
        $field = '';
        switch ($page) {
            case 'spotlight':
                $order = 'DESC';
                $field = 'id';
                break;
            case 'upcoming-events':
                $order = 'ASC';
                $field = 'date';
                break;
            case 'previous-events':
                $order = 'DESC';
                $field = 'date';
                break;
        }
        
        $events = $this->doctrine->getRepository('DLVWebsiteBundle:Event')->findBy(array('published'=>1), array($field=>$order));
        
        foreach ($events as $event) {
            $show_event = false;
            switch ($page) {
                case 'spotlight':
                    if($event->getDate()->getTimestamp() >= ($tresshold-15768000) && $event->getDate()->getTimestamp() < ($tresshold+15768000)){
                        $show_event = true;
                    }
                    break;
                case 'upcoming-events':
                    if($event->getDate()->getTimestamp() >= $tresshold){
                        $show_event = true;
                    }
                    break;
                case 'previous-events':
                    if($event->getDate()->getTimestamp() < $tresshold){
                        $show_event = true;
                    }
                    break;
            }
            
            if($show_event){
                $event_list[] = $event->getBasic($lang);
            }
            
        }
        
        return $event_list;
    }
    
    public function getEventDetails($lang, $eventname) {
        $name = str_replace('-', ' ', $eventname);
        
        $event_data = false;
        
        $event = $this->doctrine->getRepository('DLVWebsiteBundle:Event')->findOneByName($name);
        if(!is_null($event)){
            if($event->getPublished()){
                $event_data = $event->getDetails($lang);
            }
        }
        
        return $event_data;
        
    }
    
    public function getEventById($eventid) {
        
        $event_data = false;
        
        $event = $this->doctrine->getRepository('DLVWebsiteBundle:Event')->find($eventid);
        if(!is_null($event)){
            $event_data = $event->getAll();
        }
        if(preg_match('/^new event/', $event_data['name'])){
            $event_data['name'] = '';
        }
        var_dump($event_data);
        return $event_data;
        
    }
    
    public function getEventSummary($lang, $user, $that) {
        
        $summary = array(
            'public'=> array(),
            'hidden'=> array()
        );
        
        $event_list = $this->doctrine->getRepository('DLVWebsiteBundle:Event')->findAll(array('user'=>$user), array('id'=>'DESC'));
        foreach ($event_list as $event) {
            $array = array(
                'name'=> $event->getName(),
                'date'=> $event->getDate()->format('d-m-y'),
                'viewlink'=> $that->generateUrl(
                        'dlv_website_event',
                        array(
                            'lang'=> $lang,
                            'event'=> str_replace(' ', '-', $event->getName())
                        ),
                        true
                    ),
                'editlink'=> $that->generateUrl(
                        'dlv_website_edit_event',
                        array(
                            'lang'=> $lang,
                            'action'=> 'edit-event',
                            'id'=> $event->getId()
                        ),
                        true
                    )
            );
            switch ($event->getPublished()) {
                case true:
                    $summary['public'][] = $array;
                    break;
                case false:
                    $summary['hidden'][] = $array;
                    break;
            }
        }
        
        return $summary;
        
    }
    
    public function createEvent($user, $that) {
        $event = new \DLV\WebsiteBundle\Entity\Event();
        
        $event->setCreatedBy($that->getUserData($user, true));
        
        $db = $this->doctrine->getManager();
        $db->persist($event);
        $db->flush();
        
        return $event->getId();
    }
    
    public function createLocation() {
        $location = new \DLV\WebsiteBundle\Entity\Location();
        
        $db = $this->doctrine->getManager();
        $db->persist($location);
        $db->flush();
        
        return $location->getId();
    }
    
    public function createBand() {
        $band = new \DLV\WebsiteBundle\Entity\Band(); 
        
        $db = $this->doctrine->getManager();
        $db->persist($band);
        $db->flush();
        
        return $band->getId();
    }
    
    public function getLinks($page) {
        $repo = ucfirst(substr($page, 0, strlen($page)-1));
        
        $links = $this->doctrine->getRepository('DLVWebsiteBundle:' . $repo)->findAll(array(),array('id'=>'DESC'));
        
        var_dump($links);
    }
    
    public function checkLogin($email, $pass) {
        
        $login = false;
        
        $user = $this->doctrine->getRepository('DLVWebsiteBundle:User')->findOneByEmail($email);
        if(!is_null($user)){
            $password = hash('sha256', $user->getSalt() . $pass);
            if($user->getPassword() == $password){
                $login = array(
                    'id'=> $user->getId(),
                    'fullname'=> $user->getFirstName() . ' ' . $user->getLastName()
                );
            }
        }
        
        return $login;
        
    }
    
    public function hasEmail($email) {
        
        $has = true;
        
        $test = $this->doctrine->getRepository('DLVWebsiteBundle:User')->findOneByEmail($email);
        if(is_null($test)){
            $has = false;
        }
        elseif($test->getActive() == 0){
            $has = false;
        }
        
        return $has;
        
    }
    
    public function setNewUser($fname, $lname, $email, $pass, $key){
        $user = new TmpUser();
        $user->setFirstName($fname);
        $user->setLastName($lname);
        $user->setEmail($email);
        $user->setHashkey($key);
        
        $salt = $this->genString();
        $password = hash('sha256', $salt . $pass);
        
        $user->setSalt($salt);
        $user->setPassword($password);
        
        $db = $this->doctrine->getManager();
        $db->persist($user);
        $db->flush();
    }
    
    public function genString() {
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        $length = 20;

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $string;
            
    }
    
}
