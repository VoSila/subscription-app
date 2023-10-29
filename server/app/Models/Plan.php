<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const NAME = 'name';
    public const SLUG = 'slug';
    public const STRIPE_PLAN = 'stripe_plan';
    public const PRICE = 'price';
    public const DESCRIPTION = 'description';

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        self::NAME,
        self::SLUG,
        self::STRIPE_PLAN,
        self::PRICE,
        self::DESCRIPTION,
    ];

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->getAttribute(self::ID);
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return Plan
     */
    public function setId(int $id): Plan
    {
        $this->setAttribute(self::ID, $id);
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute(self::NAME);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Plan
     */
    public function setName(string $name): Plan
    {
        $this->setAttribute(self::NAME, $name);
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->getAttribute(self::SLUG);
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Plan
     */
    public function setSlug(string $slug): Plan
    {
        $this->setAttribute(self::SLUG, $slug);
        return $this;
    }

    /**
     * Get stripe plan
     *
     * @return string
     */
    public function getStripePlan(): string
    {
        return $this->getAttribute(self::STRIPE_PLAN);
    }

    /**
     * Set stripe plan
     *
     * @param string $stripePlan
     * @return Plan
     */
    public function setStripePlan(string $stripePlan): Plan
    {
        $this->setAttribute(self::STRIPE_PLAN, $stripePlan);

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice(): int
    {
        return $this->getAttribute(self::PRICE);
    }

    /**
     * Set price
     *
     * @param int $price
     *
     * @return Plan
     */
    public function setPrice(int $price): Plan
    {
        $this->setAttribute(self::PRICE, $price);
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getAttribute(self::DESCRIPTION);
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Plan
     */
    public function setDescription(string $description): Plan
    {
        $this->setAttribute(self::DESCRIPTION, $description);

        return $this;
    }
}
