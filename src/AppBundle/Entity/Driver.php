<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Driver
 *
 * @ORM\Table(name="driver")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DriverRepository")
 */
class Driver
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Sponsor", type="string", length=255, nullable=true)
     */
    private $sponsor;

    /**
     * @var string
     *
     * @ORM\Column(name="Bio", type="text", nullable=true)
     */
    private $bio;

    /**
     * @var string
     *
     * @ORM\Column(name="car_number", type="string", length=5, nullable=true)
     */
    private $carNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="lives", type="string", length=255, nullable=true)
     */
    private $lives;

    /**
     * @var string
     *
     * @ORM\Column(name="car_photo", type="string", length=255, nullable=true)
     */
    private $carPhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="major_sponsor", type="string", length=255, nullable=true)
     */
    private $majorSponsor;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_photo", type="string", length=255, nullable=true)
     */
    private $driverPhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="team", type="string", length=255, nullable=true)
     */
    private $team;

    /**
     * @var bool
     *
     * @ORM\Column(name="hide_in_list", type="boolean")
     */
    private $hideInList;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\News", inversedBy="drivers")
     */
    private $news_articles;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Driver
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
     * Set sponsor
     *
     * @param string $sponsor
     *
     * @return Driver
     */
    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    /**
     * Get sponsor
     *
     * @return string
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return Driver
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set carNumber
     *
     * @param string $carNumber
     *
     * @return Driver
     */
    public function setCarNumber($carNumber)
    {
        $this->carNumber = $carNumber;

        return $this;
    }

    /**
     * Get carNumber
     *
     * @return string
     */
    public function getCarNumber()
    {
        return $this->carNumber;
    }

    /**
     * Set lives
     *
     * @param string $lives
     *
     * @return Driver
     */
    public function setLives($lives)
    {
        $this->lives = $lives;

        return $this;
    }

    /**
     * Get lives
     *
     * @return string
     */
    public function getLives()
    {
        return $this->lives;
    }

    /**
     * Set carPhoto
     *
     * @param string $carPhoto
     *
     * @return Driver
     */
    public function setCarPhoto($carPhoto)
    {
        $this->carPhoto = $carPhoto;

        return $this;
    }

    /**
     * Get carPhoto
     *
     * @return string
     */
    public function getCarPhoto()
    {
        return $this->carPhoto;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Driver
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set majorSponsor
     *
     * @param string $majorSponsor
     *
     * @return Driver
     */
    public function setMajorSponsor($majorSponsor)
    {
        $this->majorSponsor = $majorSponsor;

        return $this;
    }

    /**
     * Get majorSponsor
     *
     * @return string
     */
    public function getMajorSponsor()
    {
        return $this->majorSponsor;
    }

    /**
     * Set driverPhoto
     *
     * @param string $driverPhoto
     *
     * @return Driver
     */
    public function setDriverPhoto($driverPhoto)
    {
        $this->driverPhoto = $driverPhoto;

        return $this;
    }

    /**
     * Get driverPhoto
     *
     * @return string
     */
    public function getDriverPhoto()
    {
        return $this->driverPhoto;
    }

    /**
     * Set team
     *
     * @param string $team
     *
     * @return Driver
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return string
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set hideInList
     *
     * @param boolean $hideInList
     *
     * @return Driver
     */
    public function setHideInList($hideInList)
    {
        $this->hideInList = $hideInList;

        return $this;
    }

    /**
     * Get hideInList
     *
     * @return bool
     */
    public function getHideInList()
    {
        return $this->hideInList;
    }

    /**
     * @return News[]
     */
    public function getNewsArticles()
    {
        return $this->news_articles;
    }

    /**
     * @param News[] $news_articles
     */
    public function setNewsArticles($news_articles)
    {
        $this->news_articles = $news_articles;
    }
}

