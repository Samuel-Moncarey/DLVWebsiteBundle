<?php

namespace DLV\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="locations")
 */

class Location {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name = '';
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $street = '';
    
    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $number = '';
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $zipcode = 0;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $town = '';
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $website = '';
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $published = false;
    
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Location
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Location
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Location
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set zipcode
     *
     * @param integer $zipcode
     * @return Location
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return integer 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return Location
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Location
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }
    
    public function getAll() {
        return array(
            'name'=> $this->getName(),
            'street'=> $this->getStreet(),
            'number'=> $this->getNumber(),
            'zipcode'=> $this->getZipcode(),
            'town'=> $this->getTown(),
            'website'=> $this->getWebsite()
        );
    }
    

    /**
     * Set published
     *
     * @param boolean $published
     * @return Location
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }
}
