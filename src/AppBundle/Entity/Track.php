<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Track
 *
 * @ORM\Table(name="track")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrackRepository")
 */
class Track
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var float
     *
     * @ORM\Column(name="length", type="float")
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(name="direction", type="string", length=255)
     */
    private $direction;

    /**
     * @var float
     *
     * @ORM\Column(name="max_speed", type="float")
     */
    private $maxSpeed;

    /**
     * @var float
     *
     * @ORM\Column(name="min_speed", type="float")
     */
    private $minSpeed;

    /**
     * @var float
     *
     * @ORM\Column(name="lap_record", type="string")
     */
    private $lapRecord;


    /**
     * @var float
     *
     * @ORM\Column(name="map_url", type="string")
     */
    private $mapUrl;

    /**
     * @var float
     *
     * @ORM\Column(name="city", type="string")
     */
    private $city;


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
     * @return Track
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
     * Set url
     *
     * @param string $url
     *
     * @return Track
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
     * Set image
     *
     * @param string $image
     *
     * @return Track
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set length
     *
     * @param float $length
     *
     * @return Track
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return Track
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set maxSpeed
     *
     * @param float $maxSpeed
     *
     * @return Track
     */
    public function setMaxSpeed($maxSpeed)
    {
        $this->maxSpeed = $maxSpeed;

        return $this;
    }

    /**
     * Get maxSpeed
     *
     * @return float
     */
    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    /**
     * @return float
     */
    public function getMinSpeed()
    {
        return $this->minSpeed;
    }

    /**
     * @param float $minSpeed
     */
    public function setMinSpeed($minSpeed)
    {
        $this->minSpeed = $minSpeed;
    }

    /**
     * @return float
     */
    public function getLapRecord()
    {
        return $this->lapRecord;
    }

    /**
     * @param float $lapRecord
     */
    public function setLapRecord($lapRecord)
    {
        $this->lapRecord = $lapRecord;
    }

    /**
     * @return float
     */
    public function getMapUrl()
    {
        return $this->mapUrl;
    }

    /**
     * @param float $mapUrl
     */
    public function setMapUrl($mapUrl)
    {
        $this->mapUrl = $mapUrl;
    }

    /**
     * @return float
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param float $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }


}

