<?php

namespace Tests\Feature\Notifications;

use Tests\TestCase;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

class WelcomeNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_email_contains_correct_data()
    {
        Notification::fake();

        $user = User::factory()->create();
        
        $notification = new WelcomeNotification();
        
        $mailData = $notification->toMail($user);
        
        $this->assertEquals('Welcome to ' . config('app.name'), $mailData->subject);
        $this->assertEquals('Hello ' . $user->name . '!', $mailData->greeting);
        $this->assertStringContainsString('Welcome to our platform', $mailData->introLines[0]);
    }

    public function test_new_users_receive_welcome_notification()
    {
        Notification::fake();

        $user = User::factory()->create();

        Notification::assertSentTo(
            $user,
            WelcomeNotification::class,
            function ($notification) use ($user) {
                $mailData = $notification->toMail($user);
                return $mailData->subject === 'Welcome to ' . config('app.name');
            }
        );
    }
}