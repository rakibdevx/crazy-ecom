<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->guard('admin')->user();
            if (!$user->can('Admin-view') && !$user->can('Admin-edit') && !$user->can('Admin-create')) {
                abort(403);
            }
            return $next($request);
        })->only(['index', 'show']);

        $this->middleware('permission:Admin-create')->only(['create', 'store']);
        $this->middleware('permission:Admin-edit')->only(['edit', 'update']);
        $this->middleware('permission:Admin-delete')->only(['destroy']);
        $this->middleware('permission:Admin-login')->only(['login']);
    }


    public function index()
    {

        $query = Admin::select('id', 'name', 'email', 'phone', 'created_at','profile_image','last_login_at','status')->with('roles')->latest();
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
                ->addColumn('name', function($admin) {
                    $name = "-";
                    $image = $admin->profile_image? asset($admin->profile_image): asset(setting('default_profile_image'));

                    if ($admin->name) {
                        $name = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <div class="customer-pic">
                                    <img src="'.$image.'" class="rounded-circle" width="40" height="40" alt="'.$admin->name.'">
                                </div>
                                <p class="mb-0 customer-name fw-bold">'.$admin->name.'</p>
                            </a>
                        ';
                    }
                    return $name;
                })
                ->addColumn('login', function($admin) {
                    $login = '-';
                    if($admin->last_login_at)
                    {
                        $login = format_date($admin->last_login_at);
                    }
                    return $login;
                })
                ->addColumn('roles', function($admin) {
                    if($admin->roles->count()) {
                        $badges = '';
                        foreach($admin->roles as $role) {
                            $badges .= '<span class="badge bg-primary me-1">'.$role->name.'</span>';
                        }
                        return $badges;
                    } else {
                        return '<span class="badge bg-secondary">No Roles Assigned</span>';
                    }
                })
                ->addColumn('status', function($admin) {
                    switch ($admin->status) {
                        case 'active':
                            return '<span class="badge bg-success">Active</span>';
                        case 'suspend':
                            return '<span class="badge bg-danger text-white">Suspend</span>';
                        case 'pending':
                            return '<span class="badge bg-warning text-white">Pending</span>';
                        default:
                            return '<span class="badge bg-secondary">'.$admin->status.'</span>';
                    }
                })
                ->addColumn('action', function($admin) {

                    $show = route('admin.admin.show', $admin->id);
                    $edit = route('admin.admin.edit', $admin->id);
                    $login = route('admin.admin.login', $admin->id);
                    $deleteUrl = route('admin.admin.destroy', $admin->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Admin-view')) {
                        $action .= '
                            <a href="'.$show.'" class="btn m-1 btn-success btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Show Details">
                                <i class="material-icons-outlined">visibility</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Admin-login')) {
                        $action .= '
                            <a href="'.$login.'" target="_blank" class="btn m-1 btn-warning text-white btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Login">
                                <i class="material-icons-outlined">lock</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Admin-edit')) {
                        $action .= '
                            <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                                <i class="material-icons-outlined">settings</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Admin-delete')) {
                        $action .= '
                            <button onclick="deleteadmin(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->rawColumns(['action', 'name','login','verified','status','roles'])
                ->make(true);
        }

        $total = (clone $query)->count();
        $new = (clone $query)->whereNull('last_login_at')->count();
        $active = (clone $query)->where('status', 'active')->count();
        $pending = (clone $query)->where('status', 'pending')->count();
        $suspend = (clone $query)->where('status', 'suspend')->count();

        return view('backend.admin.admin.index',compact([
            'total','new','active','pending','suspend'
        ]));
    }

    public function show($id)
    {
        $admin = Admin::with('roles')->findOrFail($id);
        return view('backend.admin.admin.show',compact('admin'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.admin.admin.create',compact('roles'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'phone'=> [
                'nullable',
                'string',
                'regex:/^[0-9+\-\s()]+$/',
                'min:' . setting('phone_digit_min'),
                'max:' . setting('phone_digit_max'),
            ],
            'password' => 'required|string|min:8',
            'role' => 'required|array',
            'role.*' => 'exists:roles,name',
        ]);


        $name = $request->name;
        $baseUsername = strtolower(str_replace(' ', '.', $name));
        $slugname = strtolower(str_replace(' ', '-', $name));
        $username = $baseUsername . rand(10000, 99999);
        $slug = $slugname . rand(10000, 99999);

        $admin = Admin::create([
            'name' => $request->name,
            'username' => $username,
            'slug' => $slug,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Assign Role(s)
        $admin->assignRole($request->role);

        $mailData = \App\Services\MailTemplateService::prepare('Account Created', [
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => $request->password,
            'site_name' => setting('site_name'),
            'login_url' => route('admin.login'),
        ]);

        Mail::to($admin->email)->send(new \App\Mail\CustomMail($mailData['subject'], $mailData['body']));

        return redirect()->route('admin.admin.index')
                        ->with('success', 'Admin created successfully!');
    }



    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();
        return view('backend.admin.admin.edit',compact('admin','roles'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'phone' => [
                    'nullable',
                    'string',
                    'regex:/^[0-9+\-\s()]+$/',
                    'min:' . setting('phone_digit_min'),
                    'max:' . setting('phone_digit_max'),
                ],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|array',
            'role.*' => 'exists:roles,name',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        $admin->syncRoles($request->role);

        return redirect()->route('admin.admin.index')->with('success', 'Admin updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $admin->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'admin deleted successfully.'
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
        $admin = Admin::findOrFail($id);
        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.dashboard')->with('success', "You are now logged in as {$admin->name}");
    }
}
