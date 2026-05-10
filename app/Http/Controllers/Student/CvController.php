<?php

namespace App\Http\Controllers\Student; // correct si dans le dossier Student

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cv;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class CvController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user();
        $cv = $student->cv ?? null;

        return view('student.dashboard', compact('student', 'cv'));
    }

    public function update(Request $request)
    {
        $student = Auth::user();

        $cv = $student->cv ?? new Cv();
        $cv->student_id = $student->id;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $cv->photo = $path;
        }

        $cv->centre_interet = $request->input('centre_interet');
        $cv->experience = $request->input('experience');
        $cv->formation = $request->input('formation');
        $cv->competence = $request->input('competence');
        $cv->certification = $request->input('certification');

        $cv->save();

        return back()->with('success', 'CV mis à jour avec succès !');
    }

    public function download()
{
    $student = Auth::user();

    $cv = \App\Models\Cv::where('student_id', $student->id)->first();

    return view('student.cv_pdf', compact('cv','student'));
}
}
