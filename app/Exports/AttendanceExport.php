<?php


// namespace App\Exports;

// use App\Models\Attendance;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;

// class AttendanceExport implements FromView
// {
//     protected $date;
//     protected $bibagId;
//     protected $sreniId;

//     public function __construct($date, $bibagId, $sreniId)
//     {
//         $this->date = $date;
//         $this->bibagId = $bibagId;
//         $this->sreniId = $sreniId;
//     }

//     /**
//      * @return View
//      */
//     public function view(): View
//     {
//         // Build the query for attendance records
//         $query = Attendance::with('student', 'attendanceType')
//             ->join('students', 'students.id', '=', 'attendances.student_id')
//             ->join('srenis', 'srenis.id', '=', 'students.sreni_id')
//             ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
//             ->select(
//                 'attendances.*',
//                 'students.student_name',
//                 'students.roll_number',
//                 'srenis.name as sreni_name',
//                 'bibags.name as bibag_name'
//             )
//             ->latest();

//         // Apply filters
//         if ($this->date) {
//             $query->whereDate('attendances.date', $this->date);
//         }

//         if ($this->bibagId) {
//             $query->where('bibags.id', $this->bibagId);
//         }

//         if ($this->sreniId) {
//             $query->where('srenis.id', $this->sreniId);
//         }

//         $attendances = $query->get();

//         // Return the filtered data to the view
//         return view('admin.attendance.export_pdf', [
//             'attendances' => $attendances
//         ]);
//     }
// }
namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements FromView
{
    protected $date;
    protected $bibagId;
    protected $sreniId;

    public function __construct($date, $bibagId, $sreniId)
    {
        $this->date = $date;
        $this->bibagId = $bibagId;
        $this->sreniId = $sreniId;
    }
public function view(): View
{
    // Build the query for attendance records
    $query = Attendance::with('student', 'attendanceType')
        ->join('students', 'students.id', '=', 'attendances.student_id')
        ->join('srenis', 'srenis.id', '=', 'students.sreni_id')
        ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
        ->select(
            'attendances.*',
            'students.student_name',
            'students.roll_number',
            'srenis.name as sreni_name',
            'bibags.name as bibag_name'
        )
        ->latest();

    // Apply filters
    if ($this->date) {
        $query->whereDate('attendances.date', $this->date);
    }

    if ($this->bibagId) {
        $query->where('bibags.id', $this->bibagId);
    }

    if ($this->sreniId) {
        $query->where('srenis.id', $this->sreniId);
    }

    $attendances = $query->get();

    // Count Present and Absent
    $presentCount = $attendances->where('attendance_type_id', 1)->count();  // Assuming 1 is Present
    $absentCount = $attendances->where('attendance_type_id', 2)->count();   // Assuming 2 is Absent

    // Prepare filters information
    $filters = [
        'Date' => $this->date ? \Carbon\Carbon::parse($this->date)->format('d-m-Y') : 'All Dates',
        'Bibag' => $this->bibagId ? \App\Models\Bibag::find($this->bibagId)->name : 'All Bibags',
        'Sreni' => $this->sreniId ? \App\Models\Sreni::find($this->sreniId)->name : 'All Srenis',
    ];

    // Return the filtered data and counts to the view
    return view('admin.attendance.export_pdf', [
        'attendances' => $attendances,
        'presentCount' => $presentCount,
        'absentCount' => $absentCount,
        'filters' => $filters // Ensure filters are passed to the view
    ]);
}

    /**
     * @return View
     */
    // public function view(): View
    // {
    //     // Build the query for attendance records
    //     $query = Attendance::with('student', 'attendanceType')
    //         ->join('students', 'students.id', '=', 'attendances.student_id')
    //         ->join('srenis', 'srenis.id', '=', 'students.sreni_id')
    //         ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
    //         ->select(
    //             'attendances.*',
    //             'students.student_name',
    //             'students.roll_number',
    //             'srenis.name as sreni_name',
    //             'bibags.name as bibag_name'
    //         )
    //         ->latest();

    //     // Apply filters
    //     if ($this->date) {
    //         $query->whereDate('attendances.date', $this->date);
    //     }

    //     if ($this->bibagId) {
    //         $query->where('bibags.id', $this->bibagId);
    //     }

    //     if ($this->sreniId) {
    //         $query->where('srenis.id', $this->sreniId);
    //     }

    //     // Fetch the attendance records
    //     $attendances = $query->get();

    //     // Count Present and Absent
    //     $presentCount = $attendances->where('attendance_type_id', 1)->count();  // Assuming 1 is Present
    //     $absentCount = $attendances->where('attendance_type_id', 2)->count();   // Assuming 2 is Absent

    //     // Prepare filters information
    //     $filters = [
    //         'Date' => $this->date ? \Carbon\Carbon::parse($this->date)->format('d-m-Y') : 'All Dates',
    //         'Bibag' => $this->bibagId ? \App\Models\Bibag::find($this->bibagId)->name : 'All Bibags',
    //         'Sreni' => $this->sreniId ? \App\Models\Sreni::find($this->sreniId)->name : 'All Srenis',
    //     ];

    //     // Return the filtered data and counts to the view
    //     return view('admin.attendance.export_pdf', [
    //         'attendances' => $attendances,
    //         'presentCount' => $presentCount,
    //         'absentCount' => $absentCount,
    //         'filters' => $filters
    //     ]);
    // }
}
