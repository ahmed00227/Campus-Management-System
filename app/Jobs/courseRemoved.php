<?php

namespace App\Jobs;

use App\Mail\removedCourse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class courseRemoved implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $student;
    public $course;

    /**
     * Create a new job instance.
     */
    public function __construct($student, $course)
    {
        $this->course = $course;
        $this->student = $student;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->student->user->email)->send(new removedCourse($this->course));

    }
}
