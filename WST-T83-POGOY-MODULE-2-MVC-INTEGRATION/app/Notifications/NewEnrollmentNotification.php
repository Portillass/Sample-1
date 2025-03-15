<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Enrollment;

class NewEnrollmentNotification extends Notification
{
    use Queueable;

    public $enrollment;

    public function __construct(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('New enrollment request received.')
            ->line('Student Name: ' . $this->enrollment->first_name . ' ' . $this->enrollment->last_name)
            ->line('Course: ' . $this->enrollment->course)
            ->action('Review Enrollment', url('/admin/enrollments/' . $this->enrollment->id))
            ->line('Please review this enrollment request.');
    }

    public function toArray($notifiable)
    {
        return [
            'enrollment_id' => $this->enrollment->id,
            'student_name' => $this->enrollment->first_name . ' ' . $this->enrollment->last_name,
            'course' => $this->enrollment->course
        ];
    }
}