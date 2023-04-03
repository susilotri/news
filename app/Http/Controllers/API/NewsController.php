<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\News;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

use function PHPUnit\Framework\returnSelf;

class NewsController extends Controller
{

    public function index(Request $request)
    {
       $news =  News::when($request->has('limit') && $request->limit !== null, function($q) use($request){
            $q->limit($request->limit)->offset($request->offset);
        })->orderBy('created_at', 'desc')->get();

        if(!$news) return response(['status' => false, 'message' => 'Not Found'], 404);
        return response(['status' => true, 'message' => [
            'data' => $news,
            'offset' => $request->offset,
            'limit' => $request->limit
        ]]);
    }

    public function store(Request $request, $id = null)
    {
        $role_user = Auth::user()->role;
        if($role_user != 1) return response(['status' => false, 'message' => 'Unautorized'], 401);
        $image_path = null;
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'content' => 'required',
            'author' => 'required'
        ]);
        if ($validator->fails()) return response(['status' => false, 'message' => $validator->errors()], 400);
        try {
            if($request->has('file'))
                $image_path = $request->file('image')->store('image', 'public');

            $news =  News::updateOrCreate(['id' => $id],[
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'image' => $image_path,
                'content' => $request->content,
                'author' => $request->author
            ]);
            return response(['status' => true, 'message' => $news]);
        } catch (Exception $e) {
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function delete($id){
        $role_user = Auth::user()->role;
        if($role_user != 1) return response(['status' => false, 'message' => 'Unautorized'], 401);
        $news = News::findOrFail($id);
        if(!$news) return response(['status' => false, 'message' => 'News Not Found'], 404);

        $news->delete();
        return response(['status' => true, 'message' => 'News Deleted']);
    }

    public function detail($id)
    {
        $news = News::findOrFail($id);
        $comments = $news->Comments()->get()->toArray();

        if(!$news) return response(['status' => false, 'message' => 'News Not Found'], 404);

        return response(['status' => false, 'message' => [
            'data' => [
                'news' => $news,
                'commnets' => $comments
            ]
        ]]);
    }
}
