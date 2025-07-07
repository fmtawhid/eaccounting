<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class StudentsExport implements FromView
{

    protected $fromDate;
    protected $toDate;
    protected $bibagId;
    protected $sreniId;

    public function __construct($fromDate, $toDate,$bibagId,$sreniId)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->bibagId = $bibagId;
        $this->sreniId = $sreniId;
    }


    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        // Build the query with necessary joins and filters
        $query = Student::with('attachments')
            ->join('srenis', 'srenis.id', '=', 'students.sreni_id')
            ->join('bibags', 'bibags.id', '=', 'students.bibag_id')
            ->select('students.*', 'srenis.name as sreni_name', 'bibags.name as bibag_name')
            ->latest();

        // Apply date filters
        if ($this->fromDate && $this->toDate) {
            $query->whereDate('students.created_at', '>=', $this->fromDate)
                ->whereDate('students.created_at', '<=', $this->toDate);
        } elseif ($this->fromDate) {
            $query->whereDate('students.created_at', '>=', $this->fromDate);
        } elseif ($this->toDate) {
            $query->whereDate('students.created_at', '<=', $this->toDate);
        }

        if ($this->bibagId) {
            $query->where('bibags.id', $this->bibagId);
        }
    
        if ($this->sreniId) {
            $query->where('srenis.id', $this->sreniId);
        }

        $students = $query->get();

        return view('admin.student.export_pdf', [
            'students' => $students
        ]);
    }
}
