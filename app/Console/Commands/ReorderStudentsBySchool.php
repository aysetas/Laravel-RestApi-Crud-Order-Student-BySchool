<?php

namespace App\Console\Commands;

use App\Events\StudentsReorderedEvent;
use App\Models\School;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function Sodium\increment;

class ReorderStudentsBySchool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reorder:students {school?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            if ($this->argument('school')){
                $school = School::with('students')
                    ->whereId($this->argument('school'))
                     ->first();
                     $this->updateStudentsOrder($school->students);

            }else{
                School::with('students')
                    ->orderBy('id')
                    ->get()
                    ->each(function ($school) {
                       $this->updateStudentsOrder($school->students);
                    });
            }
            event(new StudentsReorderedEvent());
            $this->info('Öğrencilerin okul sıraları yeniden düzenlendi.');

        } catch (\Exception $exception) {
            Log::error('Sıralama Hatası: ' . $exception->getMessage());
            $this->error('Sıralama esnasında bir hata oluştu.');
        }

    }

    /**
     * @param $students
     * @return void
     */
    protected function updateStudentsOrder($students)
    {
        $students->each(function ($student, $index) {
            $student->update(['order' => $index + 1]);
        });
    }
}
