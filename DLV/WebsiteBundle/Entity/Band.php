<?php

namespace DLV\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bands")
 */

class Band {
    
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
     * @ORM\Column(type="json_array")
     */
    protected $description = array('en'=>'','nl'=>'','fr'=>'');
    
    /**
     * @ORM\Column(type="string")
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
     * @return Band
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
     * @return Band
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
     * Set website
     *
     * @param string $website
     * @return Band
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
    
    public function getAll($lang) {
        return array(
            'name'=> $this->getName(),
            'description'=> $this->getDescription($lang),
            'website'=> $this->getWebsite()
        );
    }
    

    /**
     * Set published
     *
     * @param boolean $published
     * @return Band
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
