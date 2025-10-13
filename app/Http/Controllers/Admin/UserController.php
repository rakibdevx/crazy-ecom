<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function index()
    {

        $query = User::select('id', 'name', 'email', 'phone', 'created_at','profile_image','last_login_at','status','email_verified_at');
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
                ->addColumn('name', function($user) {
                    $name = "-";
                    $image = $user->profile_image? asset($user->profile_image): asset(setting('default_profile_image'));

                    if ($user->name) {
                        $name = '
                            <a class="d-flex align-items-center gap-3" href="javascript:;">
                                <div class="customer-pic">
                                    <img src="'.$image.'" class="rounded-circle" width="40" height="40" alt="'.$user->name.'">
                                </div>
                                <p class="mb-0 customer-name fw-bold">'.$user->name.'</p>
                            </a>
                        ';
                    }
                    return $name;
                })
                ->addColumn('login', function($user) {
                    $login = '-';
                    if($user->last_login_at)
                    {
                        $login =  \Carbon\Carbon::parse($user->last_login_at)->format('d M Y');
                    }
                    return $login;
                })
                ->addColumn('status', function($user) {
                    switch ($user->status) {
                        case 'active':
                            return '<span class="badge bg-success">Active</span>';
                        case 'suspend':
                            return '<span class="badge bg-danger">Suspend</span>';
                        case 'pending':
                            return '<span class="badge bg-warning text-dark">Pending</span>';
                        default:
                            return '<span class="badge bg-secondary">'.$user->status.'</span>';
                    }
                })
                ->addColumn('email_verified', function($user) {
                    if ($user->email_verified_at) {
                        return '
                        <span class="btn m-1 btn-success text-white btn-circle raised rounded-circle d-flex align-items-center justify-content-center wh-35"
                            title="'.\Carbon\Carbon::parse($user->email_verified_at)->format('d M Y').'">
                            <i class="material-icons-outlined">check</i>
                        </span>';
                    }

                    $url = route('admin.user.verify', $user->id);
                    return '
                    <button onclick="verifyUser(\''.$url.'\')"
                            class="btn m-1 btn-danger text-white btn-circle raised rounded-circle d-flex align-items-center justify-content-center wh-35"
                            title="Verify Now">
                        <i class="material-icons-outlined">close</i>
                    </button>';
                })

               ->addColumn('action', function($user) {
                    $show = route('admin.user.show', $user->id);
                    $edit = route('admin.user.edit', $user->id);
                    $login = route('admin.user.login', $user->id);
                    $deleteUrl = route('admin.user.destroy', $user->id);

                    $action = '

                    <div class="btn-group" role="group" aria-label="First group">
                        <a href="'.$show.'" class="btn m-1 btn-success btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Show Details">
                            <i class="material-icons-outlined">visibility</i>
                        </a>
                        <a href="'.$login.'" target="_blank" class="btn m-1 btn-warning text-white btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Login">
                            <i class="material-icons-outlined">lock</i>
                        </a>
                        <a href="'.$edit.'" class="btn m-1 btn-primary btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Edit">
                            <i class="material-icons-outlined">settings</i>
                        </a>
                        <button onclick="deleteUser(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-48" title="Delete">
                            <i class="material-icons-outlined">delete</i>
                        </button>
                    </div>
                    ';
                    return $action;
                })
                ->rawColumns(['action', 'name', 'status'])

                ->rawColumns(['action', 'name','login','status','email_verified'])
                ->make(true);
        }

        $total = (clone $query)->count();
        $new = (clone $query)->whereNull('last_login_at')->count();
        $active = (clone $query)->where('status', 'active')->count();
        $pending = (clone $query)->where('status', 'pending')->count();
        $suspend = (clone $query)->where('status', 'suspend')->count();


        return view('backend.admin.user.index',compact([
            'total','new','active','pending','suspend'
        ]));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.admin.user.show',compact('user'));
    }

    public function create()
    {
        return view('backend.admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone'=> [
                'nullable',
                'string',
                'regex:/^[0-9+\-\s()]+$/',
                'min:' . setting('phone_digit_min'),
                'max:' . setting('phone_digit_max'),
            ],
            'status' => 'required|in:pending,active,suspend',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.user.create')->with('success', 'user created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.admin.user.edit',compact('user'));
    }

    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => [
                'nullable',
                'string',
                'regex:/^[0-9+\-\s()]+$/',
                'min:' . setting('phone_digit_min'),
                'max:' . setting('phone_digit_max'),
            ],
            'status' => 'required|in:pending,active,suspend',
            'password' => 'nullable|string|min:6',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return redirect()->back()->with('success', 'user updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'user deleted successfully.'
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
        $user = User::findOrFail($id);
        Auth::guard('user')->login($user);
        return redirect()->route('user.dashboard')->with('success', "You are now logged in as {$user->name}");
    }
    public function verify($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'email_verified_at'=>now()
        ]);

        flash()->success('Email successfully Verified.');
        return redirect()->back();
    }
}
