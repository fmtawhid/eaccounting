<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OptionalService;
use App\Models\AssignedFee;
use App\Models\Student;
use Illuminate\Support\Carbon;

class AssignOptionalServiceFees extends Command
{
    protected $signature = 'fees:assign-optional';
    protected $description = 'Assign accepted optional services to assigned fees table';

    public function handle()
    {
        $now = Carbon::now();

        $students = Student::where('type', 'active')->get();
        foreach ($students as $student) {
            $serviceIds = json_decode($student->services, true);

            if (!$serviceIds || !is_array($serviceIds)) {
                continue;
            }

            foreach ($serviceIds as $serviceId) {
                $optionalService = OptionalService::where('id', $serviceId)
                    ->where('status', 'accepted')
                    ->first();

                if (!$optionalService) {
                    continue;
                }

                // এই মাসে আগেই দেওয়া হয়েছে কিনা চেক করো
                $alreadyAssigned = AssignedFee::where('student_id', $student->id)
                    ->where('optional_service_id', $optionalService->id)
                    ->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year)
                    ->exists();

                if ($alreadyAssigned) {
                    $this->line("🔁 Already assigned: Student {$student->id} - Service {$optionalService->id}");
                    continue;
                }


                AssignedFee::create([
                    'student_id' => $student->id,
                    'fee_category_id' => null,
                    'optional_service_id' => $optionalService->id,
                    'amount' => $optionalService->amount,
                    'sreni_id' => $student->sreni_id,
                    'bibag_id' => $student->bibag_id,
                    'is_optional' => true,
                ]);

                $this->info("✅ Assigned Service ID {$optionalService->id} to Student {$student->id}");
            }
        }

        $this->info('🎉 All eligible optional services assigned successfully.');
    }
}
