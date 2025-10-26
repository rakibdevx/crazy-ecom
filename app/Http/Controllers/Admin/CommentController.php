<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()) {
            $comments = Comment::with('user','product')->latest();

            if (request()->has('search')) {
                $search = request()->search;

                $comments->where(function ($q) use ($search) {
                    $q->where('comment', 'like', '%' . $search . '%')
                    ->orWhereHas('product', function ($q2) use ($search) {
                        $q2->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('name', 'like', '%' . $search . '%');
                    });
                });
            }


            return DataTables::of($comments)
                ->addIndexColumn()
                ->addColumn('product', function($comment){
                    return $comment->product->name ?? '-';
                })
                ->addColumn('user', function($comment){
                    return $comment->user->name ?? '-';
                })
                ->addColumn('rating', function($comment){
                    return $comment->rating ?? '-';
                })
                ->addColumn('parent', function($comment){
                    return $comment->parent_id ? 'Reply to #'.$comment->parent_id : '-';
                })
                ->addColumn('status', function($comment){
                    return '<span class="badge bg-'.($comment->status=='active'?'success':'secondary').'">'.$comment->status.'</span>';
                })
                ->addColumn('action', function($admin) {

                    $show = route('admin.comment.show', $admin->id);
                    $deleteUrl = route('admin.comment.destroy', $admin->id);

                    $action = '<div class="btn-group" role="group" aria-label="First group">';

                    if (auth('admin')->user()->can('Comment-view')) {
                        $action .= '
                            <a href="'.$show.'" class="btn m-1 btn-success btn-circle raised rounded-circle d-flex gap-2 wh-35" title="Show Details">
                                <i class="material-icons-outlined">visibility</i>
                            </a>
                        ';
                    }

                    if (auth('admin')->user()->can('Comment-delete')) {
                        $action .= '
                            <button onclick="deleteComment(\''.$deleteUrl.'\')" class="btn btn-danger btn-circle raised rounded-circle d-flex gap-2 wh-40" title="Delete">
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

        $total = Comment::count();
        return view('backend.admin.comment.index',compact('total'));
    }


    public function show($id)
    {
        $comment = Comment::with(['user', 'product'])->findOrFail($id);
        return view('backend.admin.comment.show', compact('comment'));
    }

    public function destroy($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Comment deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: '.$e->getMessage()
            ], 500);
        }
    }
}
