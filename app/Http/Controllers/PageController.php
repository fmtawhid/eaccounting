<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Notice;
use App\Models\Gallery;
use App\Models\Teacher;
class PageController extends Controller
{
    // Show Home Page
    public function contact()
    {
        return view('frontend/contact'); 
    }
    
    public function gallery()
    {
        $galleries = Gallery::all();
        return view('frontend/gallery', compact('galleries')); 
    }
    public function notice()
    {
        $notices = Notice::all();
        return view('frontend/notice', compact('notices') ); 
    }
    public function singelnotice($id)
    {
        // Fetch the notice by ID or throw a 404 error if it doesn't exist
        $notice = Notice::findOrFail($id);

        // Return the view and pass the notice data
        return view('frontend.singelNotice', compact('notice'));
    }





    public function about()
    {
        return view('frontend/about'); 
    }
    
    public function campus()
    {
        return view('frontend/campus'); 
    }
    
    public function teachers()
    {   
        $teachers = Teacher::where('staff_type', 'teacher')->get();
        return view('frontend/teachers', compact('teachers')); 
    }




    public function nurani()
    {
        return view('frontend/nurani');
    }
    public function hefjo()
    {
        return view('frontend/hefjo');
    }
    public function school()
    {
        return view('frontend/school');
    }





    public function library()
    {
        return view('frontend/library');
    }
    public function computerlab()
    {
        return view('frontend/computerLab');
    }
    public function occasions()
    {
        return view('frontend/occasions');
    }
    public function sports()
    {
        return view('frontend/sports');
    }





    public function costs()
    {
        return view('frontend/costs');
    }
    
    
    
}