<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Database\Eloquent\Model;

trait LogsAdminActions
{
    protected function logAdmin(string $action, ?Model $subject = null, ?array $changes = null, ?string $message = null)
    {
        app(\App\Services\AdminActivityLogger::class)->log($action, $subject, $changes, $message);
    }
}
