<?php

namespace DLV\WebsiteBundle\Languages;

class VipText {
    
    private $text = array(
        'en'=> array(
            'login'=> array(
                'formtitle'=> 'Login',
                'emaillabel'=> 'E-mail',
                'passlabel'=> 'Password',
                'submitvalue'=> 'Login'
            ),
            'signup'=> array(
                'formtitle'=> 'Signup Form',
                'fnamelabel'=> 'First Name',
                'lnamelabel'=> 'Last Name',
                'emaillabel'=> 'E-mail',
                'passlabel'=> 'Password',
                'chars'=> 'chars',
                'submitvalue'=> 'Signup'
            ),
            'profile'=> array(
                
            ),
            'settings'=> array(
                
            ),
            'admin'=> array(
                
            )
        ),
        'nl'=> array(
            'login'=> array(
                'formtitle'=> 'Login',
                'emaillabel'=> 'E-mail',
                'passlabel'=> 'Paswoord',
                'submitvalue'=> 'Login'
            ),
            'signup'=> array(
                'formtitle'=> 'Registratie Formulier',
                'fnamelabel'=> 'Vooraam',
                'lnamelabel'=> 'Achternaam',
                'emaillabel'=> 'E-mail',
                'passlabel'=> 'Paswoord',
                'chars'=> 'tekens',
                'submitvalue'=> 'Registreer'
            ),
            'profile'=> array(
                
            ),
            'settings'=> array(
                
            ),
            'admin'=> array(
                
            )
        ),
        'fr'=> array(
            'login'=> array(
                'formtitle'=> 'Connèxion',
                'emaillabel'=> 'E-mail',
                'passlabel'=> 'Mot De Passe',
                'submitvalue'=> 'Connèxion'
            ),
            'signup'=> array(
                'formtitle'=> 'Formulaire d\'Inscription',
                'fnamelabel'=> 'Prénom',
                'lnamelabel'=> 'Nom De Famille',
                'emaillabel'=> 'E-mail',
                'passlabel'=> 'Mot De Passe',
                'chars'=> 'caractères',
                'submitvalue'=> 'S\'inscrire'
            ),
            'profile'=> array(
                
            ),
            'settings'=> array(
                
            ),
            'admin'=> array(
                
            )
        )
    );
    
    private $notification = array(
        'en'=> array(
            'fnamerequired'=> 'First Name is required.',
            'lnamerequired'=> 'Last Name is required.',
            'passrequired'=> 'The Password requires at least 6 characters.',
            'existingemail'=> 'There is already an account with this email address...',
            'invalidemail'=> 'The given email address is not valid.',
            'validsignup'=> 'Congratulations, you are now only one step away from your VIP accout ;)',
            'loginfail'=> 'Login failed, try again.',
            'loginsuccess'=> 'Login successful, welcome'
        ),
        'nl'=> array(
            'fnamerequired'=> 'Voornaam is verplicht.',
            'lnamerequired'=> 'Achternaam is verplicht',
            'passrequired'=> 'Het wachtwoord moet minstens 6 tekens bevatten.',
            'existingemail'=> 'Er is al een account met dit e-mailadres ...',
            'invalidemail'=> 'Het opgegeven e-mailadres is niet geldig.',
            'validsignup'=> 'Gefeliciteerd, je bent nu nog maar een stap verwijderd van je VIP account ;)',
            'loginfail'=> 'Inloggen mislukt, probeer het opnieuw.',
            'loginsuccess'=> 'Succesvol ingelogd, welkom'
        ),
        'fr'=> array(
            'fnamerequired'=> 'Prénom est requis.',
            'lnamerequired'=> 'Nom De Famille requis.',
            'passrequired'=> 'Le mot de passe nécessite au moins 6 caractères.',
            'existingemail'=> 'Il existe déjà un compte avec cette adresse e-mail ...',
            'invalidemail'=> 'L\'adresse e-mail donnée n\'est pas valide.',
            'validsignup'=> 'Félicitations, vous êtes maintenant plus qu\'a une étape de votre compte VIP ;)',
            'loginfail'=> 'Connexion a échoué, essayez de nouveau.',
            'loginsuccess'=> 'Connexion réussie, bienvenue'
        )
    );


    public function __construct() {}
    
    public function getText($lang, $page) {
        return $this->text[$lang][$page];
    }
    
    public function getNotification($lang, $notification) {
        return $this->notification[$lang][$notification];
    }
    
}
