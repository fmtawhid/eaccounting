<?php
namespace App\Exports;


use App\Models\TeacherAttendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class TeacherAttendanceExport implements FromView
{
    protected $filterDate;

    public function __construct($filterDate)
    {
        $this->filterDate = $filterDate;
    }
    /**
     * @return View
     */
    public function view():View
    {
        // // Build the query for teacher attendance
        // $query = TeacherAttendance::with('teacher', 'attendanceType')
        //     ->join('teachers', 'teachers.id', '=', 'teacher_attendances.teacher_id')
        //     ->join('attendance_types', 'attendance_types.id', '=', 'teacher_attendances.attendance_type_id')
        //     ->select(
        //         'teacher_attendances.date',
        //         'teachers.name as teacher_name',
        //         'teachers.designation as teacher_designation',
        //         'attendance_types.name as attendance_type_name',
        //         'teacher_attendances.remark'
        //     )
        //     ->orderBy('teacher_attendances.date', 'desc');

        // // Apply the date filter if available
        // if ($this->filterDate) {
        //     $query->whereDate('teacher_attendances.date', '=', $this->filterDate);
        // }
        // $attendances = $query->get();

        // return view('admin.teacher_attendance.export_pdf', [
        //     'attendances' => $attendances
        // ]);

        $query = TeacherAttendance::with(['teacher', 'attendanceType'])
    ->orderBy('date', 'desc');

    if ($this->filterDate) {
        $query->whereDate('date', '=', $this->filterDate);
    }

    $attendances = $query->get();

    return view('admin.teacher_attendance.export_pdf', [
        'attendances' => $attendances
    ]);


        // Get the results
        // return $query->get()->map(function ($attendance) {
        //     return [
        //         'Date' => \Carbon\Carbon::parse($attendance->date)->format('d-m-Y'),
        //         'Teacher Name' => $attendance->teacher_name,
        //         'Teacher Designation' => $attendance->teacher_designation,
        //         'Attendance Type' => $attendance->attendance_type_name,
        //         'Remark' => $attendance->remark,
        //     ];
        // });
    }

}