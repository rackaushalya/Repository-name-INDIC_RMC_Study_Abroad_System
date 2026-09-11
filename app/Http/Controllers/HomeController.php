<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Course;
use App\Models\Scholarship;
use App\Models\University;

class HomeController extends Controller
{
    public function index()
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        $universities = University::where('is_active', true)
            ->orderBy('university_name')
            ->get();

        $courses = Course::where('is_active', true)
            ->orderBy('course_name')
            ->get();

        $scholarships = Scholarship::where('is_active', true)
            ->latest()
            ->get();

        return view('home', compact(
            'countries',
            'universities',
            'courses',
            'scholarships'
        ));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function howItWorks()
    {
        return view('pages.how-it-works');
    }

    public function countries()
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        return view('pages.countries', compact('countries'));
    }

    public function universities()
    {
        $universities = University::where('is_active', true)
            ->with('country')
            ->orderBy('university_name')
            ->get();

        return view('pages.universities', compact('universities'));
    }

    public function courses()
    {
        $courses = Course::where('is_active', true)
            ->with('university.country')
            ->orderBy('course_name')
            ->get();

        return view('pages.courses', compact('courses'));
    }

    public function scholarships()
    {
        $scholarships = Scholarship::where('is_active', true)
            ->with(['university', 'course'])
            ->latest()
            ->get();

        return view('pages.scholarships', compact('scholarships'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}