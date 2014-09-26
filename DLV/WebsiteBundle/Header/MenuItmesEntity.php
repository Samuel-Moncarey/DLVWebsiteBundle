<?php

namespace DLV\WebsiteBundle\Header;

class MenuItmesEntity {
    
    private $menu = array(
        'en'=> array(
            'home'=> array(
                'name'=> 'Home',
                'title'=> 'Home',
                'route'=> 'dlv_website_homepage',
                'submenu'=> array(
                    'items'=> array(
                        'concept'=> 'Concept',
                        'behind-the-scenes'=> 'Behind The Scenes',
                        'news'=> 'News'
                    ),
                    'route'=> 'dlv_website_homesubpage'
                )
            ),
            'events'=> array(
                'name'=> 'Events',
                'title'=> 'Events',
                'route'=> 'dlv_website_events',
                'submenu'=> array(
                    'items'=> array(
                        'upcoming-events'=> 'Upcoming Events',
                        'previous-events'=> 'Previous Events'
                    ),
                    'admin-items'=> array(
                        'upcoming-events'=> 'Upcoming Events',
                        'previous-events'=> 'Previous Events',
                        'admin'=> 'Admin'
                    ),
                    'route'=> 'dlv_website_subevents'
                )
            ),
            'bookings'=> array(
                'name'=> 'Bookings',
                'title'=> 'Host An Event',
                'route'=> 'dlv_website_bookings',
                'submenu'=> array(
                    'items'=> array(
                        'host-an-event'=> 'Host An Event',
                        'get-on-stage'=> 'Get On Stage'
                    ),
                    'route'=> 'dlv_website_subbookings'
                )
            ),
            'media'=> array(
                'name'=> 'Media',
                'title'=> 'Pictures',
                'route'=> 'dlv_website_media',
                'submenu'=> array(
                    'items'=> array(
                        'pictures'=> 'Pictures',
                        'videos'=> 'Videos'
                    ),
                    'route'=> 'dlv_website_submedia'
                )
            ),
            'links'=> array(
                'name'=> 'Links',
                'title'=> 'Bands',
                'route'=> 'dlv_website_links',
                'submenu'=> array(
                    'items'=> array(
                        'bands'=> 'Bands',
                        'locations'=> 'Locations'
                    ),
                    'admin-items'=> array(
                        'bands'=> 'Bands',
                        'locations'=> 'Locations',
                        'admin'=> 'Admin'
                    ),
                    'route'=> 'dlv_website_sublinks'
                )
            ),
            'vip'=> array(
                'name'=> 'VIP',
                'title'=> 'Login',
                'user-title'=> 'Profile',
                'admin-title'=> 'Profile',
                'route'=> 'dlv_website_vip',
                'submenu'=> array(
                    'items'=> array(
                        'login'=> 'Login',
                        'signup'=> 'Signup'
                    ),
                    'user-items'=> array(
                        'profile'=> 'Profile',
                        'settings'=> 'Settings'
                    ),
                    'admin-items'=> array(
                        'profile'=> 'Profile',
                        'settings'=> 'Settings',
                        'admin'=> 'Admin'
                    ),
                    'route'=> 'dlv_website_subvip'
                )
            )
        ),
        'nl'=> array(
            'home'=> array(
                'name'=> 'Home',
                'title'=> 'Home',
                'route'=> 'dlv_website_homepage',
                'submenu'=> array(
                    'items'=> array(
                        'concept'=> 'Concept',
                        'behind-the-scenes'=> 'Behind The Scenes',
                        'news'=> 'Nieuws'
                    ),
                    'route'=> 'dlv_website_homesubpage'
                )
            ),
            'events'=> array(
                'name'=> 'Events',
                'title'=> 'Events',
                'route'=> 'dlv_website_events',
                'submenu'=> array(
                    'items'=> array(
                        'upcoming-events'=> 'Komende Evenementen',
                        'previous-events'=> 'Vorige Evenementen'
                    ),
                    'admin-items'=> array(
                        'upcoming-events'=> 'Komende Evenementen',
                        'previous-events'=> 'Vorige Evenementen',
                        'admin'=> 'Admin'
                    ),
                    'route'=> 'dlv_website_subevents'
                )
            ),
            'bookings'=> array(
                'name'=> 'Bookings',
                'title'=> 'Host Een Evenement',
                'route'=> 'dlv_website_bookings',
                'submenu'=> array(
                    'items'=> array(
                        'host-an-event'=> 'Host Een Evenement',
                        'get-on-stage'=> 'Treed Op'
                    ),
                    'route'=> 'dlv_website_subbookings'
                )
            ),
            'media'=> array(
                'name'=> 'Media',
                'title'=> 'Foto\'s',
                'route'=> 'dlv_website_media',
                'submenu'=> array(
                    'items'=> array(
                        'pictures'=> 'Foto\'s',
                        'videos'=> 'Video\'s'
                    ),
                    'route'=> 'dlv_website_submedia'
                )
            ),
            'links'=> array(
                'name'=> 'Links',
                'title'=> 'Bands',
                'route'=> 'dlv_website_links',
                'submenu'=> array(
                    'items'=> array(
                        'bands'=> 'Bands',
                        'locations'=> 'Locaties'
                    ),
                    'admin-items'=> array(
                        'bands'=> 'Bands',
                        'locations'=> 'Locaties',
                        'admin'=> 'Admin'
                    ),
                    'route'=> 'dlv_website_sublinks'
                )
            ),
            'vip'=> array(
                'name'=> 'VIP',
                'title'=> 'Login',
                'user-title'=> 'Profiel',
                'admin-title'=> 'Profiel',
                'route'=> 'dlv_website_vip',
                'submenu'=> array(
                    'items'=> array(
                        'login'=> 'Login',
                        'signup'=> 'Registreer'
                    ),
                    'user-items'=> array(
                        'profile'=> 'Profiel',
                        'settings'=> 'Instellingen'
                    ),
                    'admin-items'=> array(
                        'profile'=> 'Profiel',
                        'settings'=> 'Instellingen',
                        'admin'=> 'Admin'
                    ),
                    'route'=> 'dlv_website_subvip'
                )
            )
        ),
        'fr'=> array(
            'home'=> array(
                'name'=> 'Acceuil',
                'title'=> 'Accueil',
                'route'=> 'dlv_website_homepage',
                'submenu'=> array(
                    'items'=> array(
                        'concept'=> 'Concept',
                        'behind-the-scenes'=> 'Derrière Les Coulisses',
                        'news'=> 'Nouvelles'
                    ),
                    'route'=> 'dlv_website_homesubpage'
                )
            ),
            'events'=> array(
                'name'=> 'Evénements',
                'title'=> 'Evénements',
                'route'=> 'dlv_website_events',
                'submenu'=> array(
                    'items'=> array(
                        'upcoming-events'=> 'Evénements A Venir',
                        'previous-events'=> 'Evénements Précédents'
                    ),
                    'admin-items'=> array(
                        'upcoming-events'=> 'Evénements A Venir',
                        'previous-events'=> 'Evénements Précédents',
                        'admin'=> 'Administrateur'
                    ),
                    'route'=> 'dlv_website_subevents'
                )
            ),
            'bookings'=> array(
                'name'=> 'Bookings',
                'title'=> 'Organisez Un Evénement',
                'route'=> 'dlv_website_bookings',
                'submenu'=> array(
                    'items'=> array(
                        'host-an-event'=> 'Organisez Un Evénement',
                        'get-on-stage'=> 'Monter Sur Scène'
                    ),
                    'route'=> 'dlv_website_subbookings'
                )
            ),
            'media'=> array(
                'name'=> 'Media',
                'title'=> 'Fotos',
                'route'=> 'dlv_website_media',
                'submenu'=> array(
                    'items'=> array(
                        'pictures'=> 'Fotos',
                        'videos'=> 'Videos'
                    ),
                    'route'=> 'dlv_website_submedia'
                )
            ),
            'links'=> array(
                'name'=> 'Liens',
                'title'=> 'Groupes',
                'route'=> 'dlv_website_links',
                'submenu'=> array(
                    'items'=> array(
                        'bands'=> 'Groupes',
                        'locations'=> 'Locations'
                    ),
                    'admin-items'=> array(
                        'bands'=> 'Groupes',
                        'locations'=> 'Locations',
                        'admin'=> 'Administrateur'
                    ),
                    'route'=> 'dlv_website_sublinks'
                )
            ),
            'vip'=> array(
                'name'=> 'VIP',
                'title'=> 'Connexion',
                'user-title'=> 'Profile',
                'admin-title'=> 'Profile',
                'route'=> 'dlv_website_vip',
                'submenu'=> array(
                    'items'=> array(
                        'login'=> 'Connexion',
                        'signup'=> 'S\'inscrire'
                    ),
                    'user-items'=> array(
                        'profile'=> 'Profile',
                        'settings'=> 'Paramètres'
                    ),
                    'admin-items'=> array(
                        'profile'=> 'Profile',
                        'settings'=> 'Paramètres',
                        'admin'=> 'Administrateur'
                    ),
                    'route'=> 'dlv_website_subvip'
                )
            )
        )
    );
    
    public function __construct() {
        
    }
    
    public function getMenu($lang) {
        return $this->menu[$lang];
    }
    
}
