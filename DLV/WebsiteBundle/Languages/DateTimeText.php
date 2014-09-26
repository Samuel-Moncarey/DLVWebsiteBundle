<?php

namespace DLV\WebsiteBundle\Languages;

class DateTimeText {
    
    private $lang;
    private $weekdays = array(
        'nl'=> array('Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'),
        'fr'=> array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi')
    );
    private $months = array(
        'nl'=> array('January','February','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'),
        'fr'=> array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre')
    );

    public function __construct($lang) {
        $this->lang = $lang;
    }
    
    public function getDateText($date) {
        
        $datetext = '';
        
        $build = false;
        switch ($this->lang) {
            case 'en':
                $datetext = $date->format('l j F Y');
                break;
            default:
                $build = true;
                break;
        }
        
        if($build){
            $weekday = $this->weekdays[$this->lang][intval($date->format('w'))];
            $day = $date->format('j');
            $month = $this->months[$this->lang][intval($date->format('n'))-1];
            $year = $date->format('Y');
            
            $datetext = $weekday . ' ' . $day . ' ' . $month . ' ' . $year;
        }
        
        return $datetext;
        
    }
    
    public function getTimeText($date) {
        
        $timetext = '';
        
        switch ($this->lang) {
            case 'en':
                $timetext = $date->format('g:ia');
                break;
            case 'nl':
                $timetext = $date->format('H\u i');
                break;
            case 'fr':
                $timetext = $date->format('H\h i');
                break;
        }
        
        return $timetext;
        
    }
    
}
