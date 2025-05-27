<?php

namespace App\Services;

use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Log;

class FirebaseNotificationService
{
    protected Messaging $messaging;

    public function __construct()
    {
        $this->messaging = (new Factory)
            ->withServiceAccount(storage_path(env('FIREBASE_CREDENTIALS')))
            ->createMessaging();
    }

    public function sendToDevice(string $fcmToken, string $title, string $body): void
{
    try {
        $message = CloudMessage::withTarget('token', $fcmToken)
            ->withNotification(Notification::create($title, $body))
            ->withData([
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'type' => 'jadwal_bimbingan',
            ]);

        $this->messaging->send($message);

        Log::info("✅ Notifikasi dikirim ke token: $fcmToken");
    } catch (\Throwable $e) {
        Log::error("❌ Gagal kirim notifikasi ke $fcmToken: " . $e->getMessage());
    }
}
}
