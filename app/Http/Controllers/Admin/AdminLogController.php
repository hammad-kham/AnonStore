<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use App\Http\Controllers\Controller;

class AdminLogController extends Controller
{
    public function index()
    {
        // Fetch all audit logs
        $audits = Audit::all();

        // Passed the audit logs to the view
        return view('admin.logs.adminLog', compact('audits'));
    }
}
