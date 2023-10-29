<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookLog extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const TYPE = 'type';
    public const PAYLOAD = 'payload';

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
     * @return WebhookLog
     */
    public function setId(int $id): WebhookLog
    {
        $this->setAttribute(self::ID, $id);
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->getAttribute(self::TYPE);
    }

    /**
     * Set type
     *
     * @param string $type
     * @return WebhookLog
     */
    public function setType(string $type): WebhookLog
    {
        $this->setAttribute(self::TYPE, $type);
        return $this;
    }

    /**
     * Get payload
     *
     * @return string
     */
    public function getPayload(): string
    {
        return $this->getAttribute(self::PAYLOAD);
    }

    /**
     * Set payload
     *
     * @param string $payload
     * @return WebhookLog
     */
    public function setPayload(string $payload): WebhookLog
    {
        $this->setAttribute(self::PAYLOAD, $payload);
        return $this;
    }
}
