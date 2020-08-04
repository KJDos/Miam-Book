<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\IngredientRepository;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"", "g", "mL", "cL", "L", "pincée", "sachet", "cuillère à soupe", "cuillère à café"})
     */
    private $unit;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 3,
     *      max = 155,
     *      minMessage = "{{ limit }} caractères minimum",
     *      maxMessage = "{{ limit }} caractères maximum",
     *      allowEmptyString = false
     * )
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }
}
