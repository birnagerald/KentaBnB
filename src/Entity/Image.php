<?php

namespace App\Entity;

use App\Entity\Ad;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      max = 255,
     *      minMessage = "Le titre de l'image doit faire plus de {{ limit }} caractères",
     *      maxMessage = "Le titre de l'image doit faire moins de {{ limit }} caractères"
     * )
     */
    private $caption;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ad", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ad;

    /**
     * Constructor
     *
     * @param Ad $ad
     */
    public function __construct(Ad $ad = null){
        $this->ad = $ad;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    public function setAd(?Ad $ad): self
    {
        $this->ad = $ad;

        return $this;
    }
}
