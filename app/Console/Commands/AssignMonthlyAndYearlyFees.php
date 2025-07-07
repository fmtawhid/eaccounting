<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FeeCategory;
use App\Models\AssignedFee;
use App\Models\Student;

class AssignMonthlyAndYearlyFees extends Command
{
    protected $signature = 'fees:assign-regular';
    protected $description = 'Assign monthly and yearly fees to students';

    public function handle()
    {
        $today = now();

        FeeCategory::all()->each(function ($category) use ($today) {
            $shouldAssign = false;

            if ($category->is_recurring == 0 && $today->day == 20) {
                $shouldAssign = true;
            }

            elseif ($category->is_recurring == 1 && $today->month == 1 && $today->day == 20) {
                $shouldAssign = true;
            }

            if ($shouldAssign) {
                $students = Student::where('sreni_id', $category->sreni_id)
                    ->where('bibag_id', $category->bibag_id)
                    ->get();

                // ডিবাগ: কতজন student পেল
                $this->info("Category: {$category->id} => Students found: " . $students->count());

                foreach ($students as $student) {
                    $query = AssignedFee::where('student_id', $student->id)
                        ->where('fee_category_id', $category->id);

                    if ($category->is_recurring == 0) {
                        $query->whereMonth('created_at', $today->month)
                              ->whereYear('created_at', $today->year);
                    } else {
                        $query->whereYear('created_at', $today->year);
                    }

                    $exists = $query->exists();

                    $this->info("Student: {$student->id} - Fee exists: " . ($exists ? 'Yes' : 'No'));

                    if ($exists) {
                        AssignedFee::create([
                            'student_id' => $student->id,
                            'fee_category_id' => $category->id,
                            'amount' => $category->amount,
                            'sreni_id' => $category->sreni_id,
                            'bibag_id' => $category->bibag_id,
                            'is_optional' => false,
                        ]);
                        $this->info("Assigned fee for student: {$student->id}");
                    }
                }
            }
        });

        $this->info("✅ Monthly/Yearly fees assigned.");
    }
}
