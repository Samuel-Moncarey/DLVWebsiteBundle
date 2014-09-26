<?php

namespace DLV\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="events")
 */

class Event {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="json_array", length=2500)
     */
    protected $description = array('en'=>'','nl'=>'','fr'=>'');
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;
    
    /**
     * @ORM\Column(type="float")
     */
    protected $price = 0;

    /**
     * @ORM\Column(type="string")
     */
    protected $picture = '';
    
    /**
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(name="location", referencedColumnName="id")
     **/
    protected $location;
    
    /**
     * @ORM\OneToMany(targetEntity="Lineup", mappedBy="event")
     */
    protected $bands;

    public function __construct() {
        
        $this->bands = new ArrayCollection();
        $this->date = new \DateTime();
        $this->name = 'new event' . $this->date->getTimestamp();
        
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="createdBy", referencedColumnName="id")
     **/
    protected $createdBy;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $published = 0;
    

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
     * @return Event
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
     * Set description
     *
     * @param array $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return array 
     */
    public function getDescription($lang)
    {
        return $this->description[$lang];
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Event
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Event
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Event
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

    /**
     * Set location
     *
     * @param \DLV\WebsiteBundle\Entity\Location $location
     * @return Event
     */
    public function setLocation(\DLV\WebsiteBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \DLV\WebsiteBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }
    
    public function getBasic($lang) {
        
        $datetext = new \DLV\WebsiteBundle\Languages\DateTimeText($lang);
        
        return array(
            'name'=> $this->getName(),
            'description'=> $this->getDescription($lang),
            'date'=> $datetext->getDateText($this->getDate()),
            'time'=> $datetext->getTimeText($this->getDate()),
            'location'=> $this->getLocation()->getName()
        );
    }
    
    public function getDetails($lang) {
        
        $datetext = new \DLV\WebsiteBundle\Languages\DateTimeText($lang);
        
        $lineup = array();
        $bands = $this->getBands()->toArray();
        foreach ($bands as $band) {
            $lineup[] = $band->getLine($lang);
        }
        
        return array(
            'name'=> $this->getName(),
            'description'=> $this->getDescription($lang),
            'picture'=> $this->getPicture(),
            'date'=> $datetext->getDateText($this->getDate()),
            'time'=> $datetext->getTimeText($this->getDate()),
            'location'=> $this->getLocation()->getAll(),
            'price'=> $this->getPrice(),
            'lineup'=> $lineup
        );
    }
    
    public function getAll() {
                
        $lineup = array();
        $bands = $this->getBands()->toArray();
        foreach ($bands as $band) {
            $lineup[] = $band->getLine('en');
        }
        return array(
            'name'=> $this->getName(),
            'description'=> $this->description,
            'picture'=> $this->getPicture(),
            'date'=> $this->getDate()->format('d-m-y'),
            'time'=> $this->getDate()->format('H'),
            'location'=> ((!is_null($this->location))? $this->getLocation()->getAll() : ''),
            'price'=> $this->getPrice(),
            'lineup'=> $lineup
        );
    }
    

    /**
     * Add bands
     *
     * @param \DLV\WebsiteBundle\Entity\Lineup $bands
     * @return Event
     */
    public function addBand(\DLV\WebsiteBundle\Entity\Lineup $bands)
    {
        $this->bands[] = $bands;

        return $this;
    }

    /**
     * Remove bands
     *
     * @param \DLV\WebsiteBundle\Entity\Lineup $bands
     */
    public function removeBand(\DLV\WebsiteBundle\Entity\Lineup $bands)
    {
        $this->bands->removeElement($bands);
    }

    /**
     * Get bands
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBands()
    {
        return $this->bands;
    }

    /**
     * Set createdBy
     *
     * @param \DLV\WebsiteBundle\Entity\User $createdBy
     * @return Event
     */
    public function setCreatedBy(\DLV\WebsiteBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \DLV\WebsiteBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}
