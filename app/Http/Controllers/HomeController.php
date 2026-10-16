<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Course;
use App\Models\Scholarship;
use App\Models\University;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Public Home Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('public.home');
    }


    /*
    |--------------------------------------------------------------------------
    | About Page
    |--------------------------------------------------------------------------
    */

    public function about()
    {
        return view('public.about');
    }


    /*
    |--------------------------------------------------------------------------
    | How It Works Page
    |--------------------------------------------------------------------------
    */

    public function howItWorks()
    {
        return view('public.how-it-works');
    }


    /*
    |--------------------------------------------------------------------------
    | Countries Page
    |--------------------------------------------------------------------------
    */

    public function countries()
    {
        $countries = Country::where('is_active', true)
            ->orderBy('country_name')
            ->get();

        return view('public.countries', compact('countries'));
    }


    /*
    |--------------------------------------------------------------------------
    | Universities Page
    |--------------------------------------------------------------------------
    */

    public function universities()
    {
        $universities = University::where('is_active', true)
            ->whereHas('country', fn ($query) => $query->where('is_active', true))
            ->with('country')
            ->orderBy('university_name')
            ->get();

        return view('public.universities', compact('universities'));
    }


    /*
    |--------------------------------------------------------------------------
    | Courses Page
    |--------------------------------------------------------------------------
    */

    public function courses()
    {
        $courses = Course::where('is_active', true)
            ->whereHas('university', fn ($query) => $query
                ->where('is_active', true)
                ->whereHas('country', fn ($query) => $query->where('is_active', true)))
            ->with(['university.country', 'tuitionFees'])
            ->orderBy('course_name')
            ->get();

        return view('public.courses', compact('courses'));
    }


    /*
    |--------------------------------------------------------------------------
    | Scholarships Page
    |--------------------------------------------------------------------------
    */

    public function scholarships()
    {
        $scholarships = Scholarship::where('is_active', true)
            // Hide scholarships whose deadline has passed.
            ->where(fn ($query) => $query
                ->whereNull('application_deadline')
                ->orWhereDate('application_deadline', '>=', today()))
            // Hide ones linked to an inactive university, country or course.
            ->where(fn ($query) => $query
                ->whereNull('university_id')
                ->orWhereHas('university', fn ($query) => $query
                    ->where('is_active', true)
                    ->whereHas('country', fn ($query) => $query->where('is_active', true))))
            ->where(fn ($query) => $query
                ->whereNull('course_id')
                ->orWhereHas('course', fn ($query) => $query->where('is_active', true)))
            ->with([
                'university.country',
                'course'
            ])
            ->orderByRaw('application_deadline IS NULL, application_deadline')
            ->get();

        return view('public.scholarships', compact('scholarships'));
    }


    /*
    |--------------------------------------------------------------------------
    | Contact Page
    |--------------------------------------------------------------------------
    */

    public function contact()
    {
        return view('public.contact');
    }
}