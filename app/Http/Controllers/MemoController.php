<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Events\MessageCreated;

class MemoController extends Controller
{
    public function index(Request $request)
    {
        $memotoken = $request->token;
        $memodata = Memo::where('memotoken', $memotoken)->get();
        return response()->json($memodata);
    }

    public function aaa(Request $request)
    {
        $user = auth()->user();

        $memo = new Memo();
        $memo->user_id = $user->id;
        $memo->title = $request->input('title');
        $memo->body = $request->input('body');
        $memo->memotoken = $request->input('memotoken');

        $memo->save();
        event(new MessageCreated($memo));
        return response()->json($memo, 201);
    }
}
