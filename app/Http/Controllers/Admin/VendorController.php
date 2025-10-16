<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;


class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->guard('admin')->user();
            if (!$user->can('Vendor-view') && !$user->can('Vendor-edit') && !$user->can('Vendor-create')) {
                abort(403);
            }
            return $next($request);
        })->only(['index', 'show']);

        $this->middleware('permission:Vendor-create')->only(['create', 'store']);
        $this->middleware('permission:Vendor-edit')->only(['edit', 'update']);
        $this->middleware('permission:Vendor-delete')->only(['destroy']);
        $this->middleware('permission:Vendor-verify')->only(['verify']);
        $this->middleware('permission:Vendor-login')->only(['login']);
    }


    public function index()
    {

        $query = Vendor::select('id', 'name', 'email', 'phone', 'created_at','profile_image','last_login_at','status','verified','email_verified_at')->latest();
        if (request()->has('search')) {
            $search = request()->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%')
                ->orWhere('status', 'like', '%'.$search.'%');
            });
        }

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('name', function($vendor) {
                    $name = "-";
                    $image = $vendor->profile_image? asset($vendor->profile_image): asset(setting('default_profile_image'));

                    if ($vendor->name) {
                        $name = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <div class="customer-pic">
                                    <img src="'.$image.'" class="rounded-circle" width="40" height="40" alt="'.$vendor->name.'">
                                </div>
                                <p class="mb-0 customer-name fw-bold">'.$vendor->name.'</p>
                            </a>
                        ';
                    }
                    return $name;
                })
                ->addColumn('login', function($vendor) {
                    $login = '-';
                    if($vendor->last_login_at)
                    {
                        $login = format_date($vendor->last_login_at);
                    }
                    return $login;
                })
                ->addColumn('status', function($vendor) {
                    switch ($vendor->status) {
                        case 'active':
                            return '<span class="badge bg-success">Active</span>';
                        case 'suspend':
                            return '<span class="badge bg-danger text-white">Suspend</span>';
                        case 'pending':
                            return '<span class="badge bg-warning text-dark">Pending</span>';
                        default:
                            return '<span class="badge bg-secondary">'.$vendor->status.'</span>';
                    }
                })
                ->addColumn('verified', function($vendor) {
                    if ($vendor->verified) {
                        return '<span class="badge bg-success">Verified</span>';
                    }
                    return '<span class="badge bg-danger text-white">Not Verified</span>';
                })
                ->addColumn('email_verified', function($vendor) {
                    if ($vendor->email_verified_at) {
                        return '
                        <span class="btn m-1 btn-success text-white btn-circle raised rounded-circle d-flex align-items-center justify-content-center wh-35"
                            title="'. format_date($vendor->email_verified_at) .'">
                            <i class="material-icons-outlined">check</i>
                        </span>';
                    }

                    $url = route('admin.vendor.verify', $vendor->id);
                    if (auth('admin')->user()->can('User-verify')) {
                        return '
                        <button onclick="verifyVendor(\''.$url.'\')"
                                class="btn m-1 btn-danger text-white btn-circle raised rounded-circle d-flex align-items-center justify-content-center wh-35"
                                title="Verify Now">
                            <i class="material-icons-outlined">close</i>
                        </button>';
                    }
                    return '
                    <span class="btn m-1 btn-warning text-white btn-circle raised rounded-circle d-flex align-items-center justify-content-center wh-35"
                        title="Not Allowed">
                        <i class="material-icons-outlined">close</i>
                    </span>';
                })

               ->addColumn('action', function($vendor) {
                    $show = route('admin.vendor.show', $vendor->id);
                    $edit = route('admin.vendor.edit', $vendor->id);
                    $login = route('admin.vendor.login', $vendor->id);
                    $deleteUrl = route('admin.vendor.destroy', $vendor->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';
                        if (auth('admin')->user()->can('Vendor-view')) {
                            $action .= '<a href="'.$show.'" class="btn m-1 btn-success btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Show Details">
                                <i class="material-icons-outlined">visibility</i>
                            </a>';
                        }
                        if (auth('admin')->user()->can('Vendor-login')) {
                            $action .= '<a href="'.$login.'" target="_blank" class="btn m-1 btn-warning text-white btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Login">
                                <i class="material-icons-outlined">lock</i>
                            </a>';
                        }
                        if (auth('admin')->user()->can('Vendor-edit')) {
                            $action .= '<a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>';
                        }
                        if (auth('admin')->user()->can('Vendor-delete')) {
                            $action .= '<button onclick="deleteVendor(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>';
                        }
                        $action .= '</div>';
                    return $action;
                })
                ->rawColumns(['action', 'name','login','verified','status','email_verified'])
                ->make(true);
        }

        $total = (clone $query)->count();
        $new = (clone $query)->whereNull('last_login_at')->count();
        $verified = (clone $query)->where('verified', 1)->count();
        $active = (clone $query)->where('status', 'active')->count();
        $pending = (clone $query)->where('status', 'pending')->count();
        $suspend = (clone $query)->where('status', 'suspend')->count();


        return view('backend.admin.vendor.index',compact([
            'total','new','active','verified','pending','suspend'
        ]));
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('backend.admin.vendor.show',compact('vendor'));
    }

    public function create()
    {
        return view('backend.admin.vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'phone'=> [
                'nullable',
                'string',
                'regex:/^[0-9+\-\s()]+$/',
                'min:' . setting('phone_digit_min'),
                'max:' . setting('phone_digit_max'),
            ],
            'bio' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,active,suspend',
            'verified' => 'required|in:0,1',
            'password' => 'required|string|min:6',
        ]);

        $name = $request->name;
        $baseUsername = strtolower(str_replace(' ', '.', $name));
        $slugname = strtolower(str_replace(' ', '-', $name));
        $username = $baseUsername . rand(10000, 99999);
        $slug = $slugname . rand(10000, 99999);

        $vendor = Vendor::create([
            'name' => $request->name,
            'username' => $username,
            'slug' => $slug,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'status' => $request->status,
            'verified' => $request->verified,
            'password' => bcrypt($request->password),
        ]);

        $mailData = \App\Services\MailTemplateService::prepare('Account Created', [
            'name' => $vendor->name,
            'email' => $vendor->email,
            'password' => $request->password,
            'site_name' => setting('site_name'),
            'login_url' => route('vendor.login'),
        ]);

        Mail::to($vendor->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

        return redirect()->route('admin.vendor.create')->with('success', 'Vendor created successfully.');
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('backend.admin.vendor.edit',compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email,'.$vendor->id,
            'phone' => [
                'nullable',
                'string',
                'regex:/^[0-9+\-\s()]+$/',
                'min:' . setting('phone_digit_min'),
                'max:' . setting('phone_digit_max'),
            ],
            'bio' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,active,suspend',
            'verified' => 'required|in:0,1',
            'password' => 'nullable|string|min:6',
        ]);

        $vendor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'status' => $request->status,
            'verified' => $request->verified,
        ]);

        if ($request->filled('password')) {
            $vendor->password = bcrypt($request->password);
            $vendor->save();
        }

        if($request->status == 'suspend')
        {
            $mailData = \App\Services\MailTemplateService::prepare('Account Suspended', [
                'name' => $vendor->name,
                'site_name' => setting('site_name'),
                'support_email' => setting('support_email'),
            ]);

            Mail::to($vendor->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));
        }


        return redirect()->back()->with('success', 'Vendor updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $vendor = Vendor::findOrFail($id);
            $vendor->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Vendor deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: '.$e->getMessage()
            ], 500);
        }
    }

    public function login($id)
    {
        $vendor = Vendor::findOrFail($id);
        Auth::guard('vendor')->login($vendor);
        return redirect()->route('vendor.dashboard')->with('success', "You are now logged in as {$vendor->name}");
    }
    public function verify($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update([
            'email_verified_at'=>now()
        ]);
        flash()->success('Email successfully Verified.');
        return redirect()->back();
    }
}

