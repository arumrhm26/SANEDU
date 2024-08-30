<?php

namespace App\Notifications;

use App\Models\Materi;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentIndikatorNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Materi $materi, public Student $student)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Halo ' . $notifiable->name)
            ->line('Berikut adalah lampiran progres pembelajaran murid atas nama ' . $this->student->user->name)
            ->line('Tahun Ajaran : ' . $this->materi->subject->classRoom->tahunAjaran->name)
            ->line('Kelas : ' . $this->materi->subject->classRoom->full_name)
            ->line('Mata Pelajaran : ' . $this->materi->subject->name)
            ->line('Materi : ' . $this->materi->name)
            ->action('Download Lampiran', route('siswa.progres-pembelajaran.pdf', $this->materi->id))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
