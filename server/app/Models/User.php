<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;
    public const ID = 'id';
    public const NAME = 'name';
    public const SURNAME = 'surname';
    public const CITY = 'city';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const IMAGE = 'image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::PASSWORD
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
     * @return User
     */
    public function setId(int $id): User
    {
        $this->setAttribute(self::ID, $id);
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage(): string
    {
        return $this->getAttribute(self::IMAGE);
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage(string|null $image): User
    {
        $this->setAttribute(self::IMAGE, $image);
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
     * @return User
     */
    public function setName(string $name): User
    {
        $this->setAttribute(self::NAME, $name);
        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->getAttribute(self::SURNAME);
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname(string|null $surname): User
    {
        $this->setAttribute(self::SURNAME, $surname);
        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->getAttribute(self::CITY);
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity(string|null $city): User
    {
        $this->setAttribute(self::CITY, $city);

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getAttribute(self::EMAIL);
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->setAttribute(self::EMAIL, $email);

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getAttribute(self::PASSWORD);
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->setAttribute(self::PASSWORD, $password);

        return $this;
    }
}
