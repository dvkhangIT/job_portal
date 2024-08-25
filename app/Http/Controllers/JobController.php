<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
  public function index(Request $request)
  {
    $categories = Category::where('status', 1)->get();
    $jobTypes = JobType::where('status', 1)->get();
    $jobs = Job::where('status', 1);
    if (!empty($request->keyword)) {
      $jobs = $jobs->where(function ($query) use ($request) {
        $query->orWhere('title', 'like', '%' . $request->keyword . '%');
        $query->orWhere('keywords', 'like', '%' . $request->keyword . '%');
      });
    }
    if (!empty($request->location)) {
      $jobs = $jobs->where('location', $request->location);
    }
    if (!empty($request->category)) {
      $jobs = $jobs->where('category_id', $request->category);
    }
    $jobTypeArray = [];
    if (!empty($request->jobType)) {
      $jobTypeArray = explode(',', $request->jobType);
      $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
    }
    if (!empty($request->experience)) {
      $jobs = $jobs->where('experience', $request->experience);
    }
    $jobs = $jobs->with(['jobType', 'category']);

    if ($request->sort == '0') {
      $jobs = $jobs->orderBy('created_at', 'ASC');
    } else {
      $jobs = $jobs->orderBy('created_at', 'DESC');
    }
    $jobs = $jobs->paginate(9);
    return view('front.jobs', [
      'categories' => $categories,
      'jobTypes' => $jobTypes,
      'jobs' => $jobs,
      'jobTypeArray' => $jobTypeArray,
    ]);
  }
  public function detail($id)
  {
    $job = Job::where(['id' => $id, 'status' => 1])->with('jobType', 'category')->first();
    if ($job == null) {
      abort(404);
    }
    return view('front.jobDetail', ['job' => $job]);
  }
  public function applyJob(Request $request)
  {
    $id = $request->id;
    $job = Job::where('id', $id)->first();
    // If job not found in db
    if ($job == null) {
      $message = 'Job does not exist';
      session()->flash('error', $message);
      return response()->json([
        'status' => false,
        'message' => $message
      ]);
    }
    // You can not apply on your own job
    $employer_id = $job->user_id;
    if ($employer_id == Auth::user()->id) {
      $message = 'You can not apply on your own job';
      session()->flash('error', $message);
      return response()->json([
        'status' => false,
        'message' => $message
      ]);
    }
    // You cant not apply on a job twise
    $jobApplicationCount = JobApplication::where([
      'user_id' => Auth::user()->id,
      'job_id' => $id,
    ])->count();
    if ($jobApplicationCount > 0) {
      $message = 'You already applied on this job.';
      session()->flash('error', $message);
      return response()->json([
        'status' => false,
        'message' => $message
      ]);
    }
    $application = new JobApplication();
    $application->job_id = $id;
    $application->user_id = Auth::user()->id;
    $application->employer_id = $employer_id;
    $application->applied_date = now();
    $application->save();
    $message = 'You have successfully aplied.';
    session()->flash('success', $message);
    return response()->json([
      'status' => true,
      'message' => $message
    ]);
  }
}
