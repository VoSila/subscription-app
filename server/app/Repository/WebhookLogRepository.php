<?php

namespace App\Repository;

use App\Models\StripeWebhookLog as WebhookModel;

class WebhookLogRepository
{
    /**
     *  Create webhook
     *
     * @param string $type
     * @param array $payload
     * @return WebhookModel
     */
    public function create(string $type, array $payload):WebhookModel
    {
        $webhook = new WebhookModel();
        $webhook->setType($type)
            ->setPayload(json_encode($payload));

        $webhook->save();

        return $webhook;
    }

}
