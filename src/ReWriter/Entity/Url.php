<?php

namespace ReWriter\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="url_rewrite")
 * @ORM\Entity(repositoryClass="ReWriter\Repository\UrlRepository")
 */
class Url
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
     * @ORM\Column(name="location", type="text")
     */
    private $location;


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=32)
     */
    private $slug;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Url
     */
    public function setLocation(string $location): Url
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Url
     */
    public function setSlug(string $slug): Url
    {
        $this->slug = $slug;

        return $this;
    }

}