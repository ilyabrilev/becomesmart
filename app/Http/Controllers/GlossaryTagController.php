<?php

namespace App\Http\Controllers;

use App\Models\GlossaryTag;
use Illuminate\Http\Request;
use Validator;

class GlossaryTagController extends Controller
{

    public function GetWordsByTagHtml(Request $request) {
        $tag = $this->GetWordsByTagAbstract($request);
        return view('template-steak.tagwords', ['tag' => $tag]);
    }

    public function GetWordsByTagAbstract(Request $request) {
        $validator = Validator::make($request->all(), [
            'tag_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            //ToDo: error message on main page
            return redirect('/');
        }

        $tag = GlossaryTag::with('words')
            ->find($request->tag_id);

        return $tag;

    }
}
