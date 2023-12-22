<?php

namespace App\Http\Controllers;

use App\Models\memobutton;
use Illuminate\Http\Request;

class MemobuttonController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = auth()->user();
        $userid = $user->id;
        $memodata = memobutton::where('memocreateid', $userid)->get();
        $memodatainvite = memobutton::whereJsonContains('invitedid', $userid)->get();
        return response()->json(['mymemo' => $memodata, 'othersmemo' => $memodatainvite]);
    }


    public function postdata(Request $request)
    {
        $user = auth()->user();

        $memo = new memobutton();
        $memo->memocreateid = $user->id;
        $memo->memotitle = $request->input('memotitle');
        $memo->urlparam = $request->input('param');

        $memo->save();
        return response()->json($memo, 201);
    }

    public function adduser(Request $request)
    {
        $user = auth()->user();

        $userid = $user->id;
        $memotoken = $request->token;

        $memodata = memobutton::where('urlparam', $memotoken)->first();
        $usersid = $memodata->invitedid;

        if (!(in_array($userid, $usersid)) && $memodata->memocreateid !== $userid) {
            array_push($usersid,  $userid);
            $memodata->update(['invitedid' => $usersid]);
        }

        $memodata->save();
        return response()->json($memodata, 201);
    }
}
