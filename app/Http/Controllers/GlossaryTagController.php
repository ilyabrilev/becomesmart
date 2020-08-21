<?php

namespace App\Http\Controllers;

use App\Models\GlossaryTag;
use Illuminate\Http\Request;
use Validator;

/**
 * Контроллер тегов
 *
 * Class GlossaryTagController
 * @package App\Http\Controllers
 */
class GlossaryTagController extends Controller
{
    /**
     * Получение слов по тегу
     * //ToDo: web
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWordsByTagHtml(Request $request) {
        $tag = $this->getWordsByTagAbstract($request);
        return view('pages.tagwords', ['tag' => $tag]);
    }

    /**
     * Получение тега
     *
     * ToDo: в сервис, валидацию в реквест
     *
     * @param Request $request
     * @return GlossaryTag|GlossaryTag[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    public function getWordsByTagAbstract(Request $request) {
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
