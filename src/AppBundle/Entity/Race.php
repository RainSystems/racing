<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Race
 *
 * @ORM\Table(name="race")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RaceRepository")
 */
class Race
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RaceMeeting")
     */
    private $raceMeeting;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="race_date", type="date")
     */
    private $raceDate;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Points")
     */
    private $points;


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
     * Set title
     *
     * @param string $title
     *
     * @return Race
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Race
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
     * Set raceMeeting
     *
     * @param integer $raceMeeting
     *
     * @return Race
     */
    public function setRaceMeeting($raceMeeting)
    {
        $this->raceMeeting = $raceMeeting;

        return $this;
    }

    /**
     * Get raceMeeting
     *
     * @return int
     */
    public function getRaceMeeting()
    {
        return $this->raceMeeting;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Race
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set raceDate
     *
     * @param \DateTime $raceDate
     *
     * @return Race
     */
    public function setRaceDate($raceDate)
    {
        $this->raceDate = $raceDate;

        return $this;
    }

    /**
     * Get raceDate
     *
     * @return \DateTime
     */
    public function getRaceDate()
    {
        return $this->raceDate;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return Race
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }
}

