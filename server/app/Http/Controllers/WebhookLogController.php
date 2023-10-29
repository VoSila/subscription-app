<?php

namespace App\Http\Controllers;

use App\Repository\WebhookLogRepository;
use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController;

class WebhookLogController extends WebhookController
{

    /**
     * @var WebhookLogRepository
     */
    private WebhookLogRepository $webhookLogRepository;

    /**
     * @param WebhookLogRepository $webhookLogRepository
     */
    public function __construct(WebhookLogRepository $webhookLogRepository)
    {
        parent::__construct();
        $this->webhookLogRepository = $webhookLogRepository;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function handleLogWebhook(Request $request): void
    {
        $payload = json_decode($request->getContent(), true);
        $type = $payload['type'];

        $this->webhookLogRepository->create($type, $payload);

       $this->handleWebhook($request);
    }
}
