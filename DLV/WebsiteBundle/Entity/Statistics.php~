<?php

namespace DLV\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="statistics")
 */

class Statistics {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $ipAddr;

    /**
     * @ORM\Column(type="string")
     */
    protected $browser;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $requestTime;

    /**
     * @ORM\Column(type="string")
     */
    protected $requestUri;

    /**
     * @ORM\Column(type="string")
     */
    protected $referer;
    

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
     * Set user
     *
     * @param integer $user
     * @return Statistics
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set ipAddr
     *
     * @param string $ipAddr
     * @return Statistics
     */
    public function setIpAddr($ipAddr)
    {
        $this->ipAddr = $ipAddr;

        return $this;
    }

    /**
     * Get ipAddr
     *
     * @return string 
     */
    public function getIpAddr()
    {
        return $this->ipAddr;
    }

    /**
     * Set browser
     *
     * @param string $browser
     * @return Statistics
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser
     *
     * @return string 
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set requestTime
     *
     * @param \DateTime $requestTime
     * @return Statistics
     */
    public function setRequestTime($requestTime)
    {
        $this->requestTime = $requestTime;

        return $this;
    }

    /**
     * Get requestTime
     *
     * @return \DateTime 
     */
    public function getRequestTime()
    {
        return $this->requestTime;
    }

    /**
     * Set requestUri
     *
     * @param string $requestUri
     * @return Statistics
     */
    public function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    /**
     * Get requestUri
     *
     * @return string 
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * Set referer
     *
     * @param string $referer
     * @return Statistics
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;

        return $this;
    }

    /**
     * Get referer
     *
     * @return string 
     */
    public function getReferer()
    {
        return $this->referer;
    }
}
