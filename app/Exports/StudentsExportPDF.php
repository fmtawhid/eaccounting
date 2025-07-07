<?php
namespace App\Exports;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentsExportPDF
{
    protected $fromDate;
    protected $toDate;
    protected $bibagId;
    protected $sreniId;

    public function __construct($fromDate, $toDate, $bibagId, $sreniId)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->bibagId = $bibagId;
        $this->sreniId = $sreniId;
    }

    public function generatePDF()
    {
        $students = $this->getFilteredStudents();

        $pdf = Pdf::loadView('admin.results.export_pdf', compact('students', 'fromDate', 'toDate'));
        return $pdf->download('students_report.pdf');
    }

    private function getFilteredStudents()
    {
        // Query to filter students based on the input parameters
        $query = Student::query();

        if ($this->fromDate && $this->toDate) {
            $query->whereDate('created_at', '>=', $this->fromDate)
                ->whereDate('created_at', '<=', $this->toDate);
        } elseif ($this->fromDate) {
            $query->whereDate('created_at', '>=', $this->fromDate);
        } elseif ($this->toDate) {
            $query->whereDate('created_at', '<=', $this->toDate);
        }

        if ($this->bibagId) {
            $query->where('bibag_id', $this->bibagId);
        }

        if ($this->sreniId) {
            $query->where('sreni_id', $this->sreniId);
        }

        return $query->get();
    }
}
