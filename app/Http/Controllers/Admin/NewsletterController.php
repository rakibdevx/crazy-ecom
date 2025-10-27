<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsletterController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()) {
            $newsletters = Newsletter::latest();

            if (request()->has('search')) {
                $search = request()->search;

                $newsletters->where(function ($q) use ($search) {
                    $q->where('email', 'like', '%' . $search . '%');
                });
            }


            return DataTables::of($newsletters)
                ->addIndexColumn()
                ->addColumn('email', function($newsletter){
                    return $newsletter->email ?? '-';
                })
                ->addColumn('subscribe_time', function($newsletter){
                    return format_date($newsletter->subscribed_at) ?? '-';
                })
                ->addColumn('action', function($admin) {

                    $deleteUrl = route('admin.newsletter.destroy', $admin->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Newsletter-delete')) {
                        $action .= '
                            <button onclick="deleteNewsletter(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
                                <i class="material-icons-outlined">delete</i>
                            </button>
                        ';
                    }

                    $action .= '</div>';

                    return $action;
                })

                ->rawColumns(['status','action'])
                ->make(true);
        }

        $total = Newsletter::count();
        return view('backend.admin.newsletter.index',compact('total'));
    }

    public function destroy($id)
    {
        try {
            $newsletter = Newsletter::findOrFail($id);
            $newsletter->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Newsletter deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: '.$e->getMessage()
            ], 500);
        }
    }
}
