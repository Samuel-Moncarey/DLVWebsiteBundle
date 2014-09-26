<?php

namespace DLV\WebsiteBundle\Controller;

use DLV\WebsiteBundle\Controller\DefaultController;

use Symfony\Component\HttpFoundation\Request;

use DLV\WebsiteBundle\Entity\User;

use DLV\WebsiteBundle\Languages\VipText;

class VipController extends DefaultController {
    
    public function indexAction($lang, $subpage = '', Request $request) {
        
        $allowed = 'anonimous';
        
        switch ($subpage) {
            case 'profile':
            case 'settings':
                $allowed = 'user';
                break;
            case 'admin':
                $allowed = 'admin';
                break;
            case '':
                $allowed = 'all';
                break;
            case 'logout':
                $request->getSession()->remove('user_id');
                return $this->redirect($this->generateUrl('dlv_website_vip',array('lang'=>$lang), true));
        }
        
        $this->initialize($request, $lang, $allowed);
        
        if(!$this->allow){
            return $this->redirect($this->generateUrl('dlv_website_vip',array('lang'=>$lang), true));
        }
        
        if($subpage == ''){
            $subpage = ($this->user)? 'profile' : 'login';
        }
        $this->text = new VipText();
        $this->template_data['lang'] = $this->text->getText($lang, $subpage);
        
        if($request->getMethod() == 'POST'){
            switch ($subpage) {
                case 'login':
                    if($this->handleLogin()){
                        return $this->redirect($this->generateUrl('dlv_website_vip',array('lang'=>$lang), true));
                    }
                    break;
                case 'signup':
                    $this->handleSignup();
                    break;
                case 'settings':
                    $this->handleSetteings();
                    break;
            }
        }
        else{
            $this->template = 'DLVWebsiteBundle:Vip:' . $subpage . '.html.twig';
        }
        return $this->getResponse();
        
    }
    
    public function confirmAccountAction($lang, $key, Request $request) {
        
        $tmp_user = $this->getDoctrine()->getRepository('DLVWebsiteBundle:TmpUser')->findOneByHashkey($key);
        
        if(!is_null($tmp_user)){
            
            $user = new User();
            $user->setEmail($tmp_user->getEmail());
            $user->setSalt($tmp_user->getSalt());
            $user->setPassword($tmp_user->getPassword());
            $user->setFirstName($tmp_user->getFirstName());
            $user->setLastName($tmp_user->getLastName());
            $user->setPicture('default_picture.png');
            $user->setNewsMail(0);
            $user->setEventMail(0);
            $user->setType('user');
            $user->setActive(1);
        
            $db = $this->getDoctrine()->getManager();
            $db->persist($user);
            $db->remove($tmp_user);
            $db->flush();
            
            $request->getSession()->set('user_id', $user->getId());
            
            return $this->redirect($this->generateUrl('dlv_website_subvip', array('lang'=>$lang, 'subpage'=>'settings')));
            
        }
        else{
            
            throw $this->createNotFoundException();
            
        }
    }
    
    private function handleLogin() {
        
        $post = $this->request->request;
        
        $email = $post->get('email');
        $pass = $post->get('pass');
        $user = $this->data->checkLogin($email, $pass);
        if(is_array($user)){
            $this->session->set('notification', array(
                'type'=> 'success',
                'text'=> $this->text->getNotification($this->lang, 'loginsuccess')
            ));
            $this->session->set('user_id', $user['id']);
            return true;
        }
        else{
            $this->notification->set('error',  $this->text->getNotification($this->lang, 'loginfail'));
            $this->template = 'DLVWebsiteBundle:Vip:login.html.twig';
            return false;
        }
        
    }
    
    private function handleSignup() {
        
        $post = $this->request->request;
        $this->template = 'DLVWebsiteBundle:Vip:signup.html.twig';
        
        $fname = $post->get('fname');
        $lname = $post->get('lname');
        $email = $post->get('email');
        $pass = $post->get('pass');
        
        if(strlen($fname) == 0){
            $this->notification->set('error', $this->text->getNotification($this->lang, 'fnamerequired'));
        }
        elseif(strlen($lname) == 0){
            $this->notification->set('error', $this->text->getNotification($this->lang, 'lnamerequired'));
        }
        elseif(strlen($pass) < 6){
            $this->notification->set('error', $this->text->getNotification($this->lang, 'passrequired'));
        }
        elseif($this->data->hasEmail($email)){
            $this->notification->set('error', $this->text->getNotification($this->lang, 'existingemail'));
        }
        
        if(!$this->notification->is_set()){
            try {
                
                $key = hash('sha256', $fname . $lname . $email . $this->data->genString());
                
                $link = $this->generateUrl('dlv_website_comfirmsignup', array('lang'=>  $this->lang, 'key'=>$key),true);
                
                $transport = \Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
                $transport->setUsername('samuel.moncarey@live.com');
                $transport->setPassword('gB-g0J43FCF49wOPynRvYw');
                $swift = \Swift_Mailer::newInstance($transport);
                $message = \Swift_Message::newInstance()
                    ->setSubject('Comfirm account')
                    ->setFrom('noreply@dangerlivevoltage.be', 'Danger Live Voltage')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                            'DLVWebsiteBundle:Mail:comfirm-account.html.twig',
                            array('link' => $link)
                        )
                    );
                
                $this->data->setNewUser($fname, $lname, $email, $pass, $key);


                if ($recipients = $swift->send($message, $failures)){
                    $this->template = 'DLVWebsiteBundle:Vip:comfirm.html.twig';
                    $this->notification->set('success', $this->text->getNotification($this->lang, 'validsignup'));
                }
                else {
                    throw new \Exception('send_error');
                }
            } catch (\Exception $e) {
                if(preg_match('/Address in mailbox given \[(.*)\] does not comply with(.*)/', $e->getMessage())){
                    $this->notification->set('error', $this->text->getNotification($this->lang, 'invalidemail'));
                }
                else{
                    $this->notification->set('error', $e->getMessage());
                }
            }
        }
            
    }
    
    private function handleSetteings() {
        
    }
    
}
