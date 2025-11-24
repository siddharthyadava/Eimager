<?php

namespace App\Services;

use App\Models\AdminActivity;
use Illuminate\Database\Eloquent\Model;

class AdminActivityLogger
{
    public function log(
        string $action,
        ?Model $subject = null,
        ?array $changes = null,
        ?string $message = null
    ): AdminActivity {

        // Your app stores the logged-in admin in the session
        $admin = session('admin'); // App\Models\Admin or null

        return AdminActivity::create([
            'admin_id'     => optional($admin)->id,        // points to admin.id
            'action'       => $action,                     // e.g. 'contact.deleted'
            'subject_type' => $subject ? get_class($subject) : null,
            'subject_id'   => $subject ? $subject->getKey() : null,
            'message'      => $message,
            'changes'      => $changes,
            'ip_address'   => request()->ip(),
            'user_agent'   => request()->userAgent(),
        ]);
    }
}
