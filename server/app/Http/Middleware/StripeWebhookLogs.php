<?php

namespace App\Http\Middleware;

use Closure;
use App\Repository\WebhookLogRepository;

class StripeWebhookLogs
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
        $this->webhookLogRepository = $webhookLogRepository;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $payload = json_decode($request->getContent(), true);

        $type = $payload['type'];
        $this->webhookLogRepository->create($type, $payload);

        return $next($request);
    }
}
