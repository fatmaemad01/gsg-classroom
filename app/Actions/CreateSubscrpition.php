<?php

namespace App\Actions;

use App\Models\Subscription;

class CreateSubscrpition
{
    public function __invoke(array $data): Subscription
    {
        return Subscription::create($data);
    }
}
