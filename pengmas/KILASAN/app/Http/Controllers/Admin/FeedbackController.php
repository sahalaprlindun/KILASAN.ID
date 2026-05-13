<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(): View
    {
        return view('admin.feedback.index', [
            'feedbacks' => Complaint::whereNotNull('saran')->latest()->paginate(10),
        ]);
    }
}
