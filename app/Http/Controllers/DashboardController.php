<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cv;

class DashboardController extends Controller
{
    public function index()
    {
        // récupérer l'étudiant connecté
        $student = Auth::user();

        // récupérer son CV
        $cv = Cv::where('student_id', $student->id)->first();

        return view('student.dashboard', compact('student','cv'));
    }
}
