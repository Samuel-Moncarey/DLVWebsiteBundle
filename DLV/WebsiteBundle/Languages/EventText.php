<?php

namespace DLV\WebsiteBundle\Languages;

class EventText {
    
    private $text = array(
        'en'=> array(
            'event-list'=> array(
                'time'=> 'at',
                'location'=> 'in',
                'more'=> 'Read more'
            ),
            'event'=> array(
                'date'=> 'Date',
                'time'=> 'at',
                'location'=> 'Location',
                'price'=> 'Price',
                'bands'=> 'Bands'
                
            )
        ),
        'nl'=> array(
            'event-list'=> array(
                'time'=> 'om',
                'location'=> 'in',
                'more'=> 'Lees verder'
            ),
            'event'=> array(
                'date'=> 'Datum',
                'time'=> 'om',
                'location'=> 'Locatie',
                'price'=> 'Prijs',
                'bands'=> 'Bands'
            )
        ),
        'fr'=> array(
            'event-list'=> array(
                'time'=> 'à',
                'location'=> 'à',
                'more'=> 'En savoir plus'
            ),
            'event'=> array(
                'date'=> 'Date',
                'time'=> 'à',
                'location'=> 'Location',
                'price'=> 'Prix',
                'bands'=> 'Groupes'
            )
        )
    );
    
    public function __construct() {
        
    }
    
    public function getText($lang, $page) {
        return $this->text[$lang][$page];
    }
    
}
