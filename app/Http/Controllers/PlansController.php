<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    protected $plans;

    public function __construct()
    {
        $this->plans = app(Plan::class);
    }

    public function index()
    {
        $plans = $this->plans->all();
        return view('admin.pages.plans.index', compact('plans', $plans));
    }
}
