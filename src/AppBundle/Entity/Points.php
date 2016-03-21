<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Points
 *
 * @ORM\Table(name="points")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PointsRepository")
 */
class Points
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
     * @ORM\Column(name="Title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=255)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="two_race", type="string", length=513, nullable=true)
     */
    private $twoRace;

    /**
     * @var string
     *
     * @ORM\Column(name="three_race", type="string", length=513, nullable=true)
     */
    private $threeRace;

    /**
     * @var string
     *
     * @ORM\Column(name="four_race", type="string", length=513, nullable=true)
     */
    private $fourRace;

    /**
     * @var string
     *
     * @ORM\Column(name="specific_points", type="string", length=255)
     */
    private $specificPoints;


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
     * @return Points
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
     * Set year
     *
     * @param string $year
     *
     * @return Points
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set twoRace
     *
     * @param string $twoRace
     *
     * @return Points
     */
    public function setTwoRace($twoRace)
    {
        $this->twoRace = $twoRace;

        return $this;
    }

    /**
     * Get twoRace
     *
     * @return string
     */
    public function getTwoRace()
    {
        return $this->twoRace;
    }

    /**
     * Set threeRace
     *
     * @param string $threeRace
     *
     * @return Points
     */
    public function setThreeRace($threeRace)
    {
        $this->threeRace = $threeRace;

        return $this;
    }

    /**
     * Get threeRace
     *
     * @return string
     */
    public function getThreeRace()
    {
        return $this->threeRace;
    }

    /**
     * Set fourRace
     *
     * @param string $fourRace
     *
     * @return Points
     */
    public function setFourRace($fourRace)
    {
        $this->fourRace = $fourRace;

        return $this;
    }

    /**
     * Get fourRace
     *
     * @return string
     */
    public function getFourRace()
    {
        return $this->fourRace;
    }

    /**
     * Set specificPoints
     *
     * @param string $specificPoints
     *
     * @return Points
     */
    public function setSpecificPoints($specificPoints)
    {
        $this->specificPoints = $specificPoints;

        return $this;
    }

    /**
     * Get specificPoints
     *
     * @return string
     */
    public function getSpecificPoints()
    {
        return $this->specificPoints;
    }
}

