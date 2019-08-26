<?php

namespace App\Http\Controllers\Api\V1;

use App\KeyAnswer;
use App\FilterKey;
use App\Http\Controllers\Controller;
use App\Http\Resources\KeyAnswer as KeyAnswerResource;
use App\Http\Requests\Admin\StoreKeyAnswersRequest;
use App\Http\Requests\Admin\UpdateKeyAnswersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class KeyAnswersController extends Controller
{
    public function index()
    {
        return new KeyAnswerResource(KeyAnswer::all());
    }
    public function getKeyAnswers($kId)
    {

        $keyAnswers = KeyAnswer::where('filter_key_id', $kId)
            ->get();


        $filterKey = FilterKey::find($kId);
        $resultArr = array();
        foreach ($keyAnswers as $keyAnswer) {
            //get english value for default
            $tran = $keyAnswer->getTranslation();
            if (!$tran) {
                continue;
            }
            array_push($resultArr, [
                'id'                    =>  $keyAnswer->id,
                'title'                 =>  $tran['title'],
            ]);
        }

        return new KeyAnswerResource([
            'items'     => $resultArr,
            'filterKey' => ['id' => $kId, 'name' => $filterKey->getTranslation()['name']]
        ]);
    }

    public function store(StoreKeyAnswersRequest $request)
    {
        if (Gate::denies('key_answer_create')) {
            return abort(401);
        }

        $keyAnswer = new KeyAnswer();
        $keyAnswer = $keyAnswer->insertRecord($request->all());


        return (new KeyAnswerResource($keyAnswer))
            ->response()
            ->setStatusCode(201);
    }
    public function getKeyAnswer($id, $locale = 'en')
    {
        if (!$locale) {
            $locale = 'en';
        }
        $keyAnswer = KeyAnswer::with([])->findOrFail($id);
        return new KeyAnswerResource(array_merge($keyAnswer->toArray(), $keyAnswer->getTranslation($locale)));
    }
    public function show($id)
    {
        if (Gate::denies('key_answer_view')) {
            return abort(401);
        }

        $locale = isset($_GET['locale']) ? $_GET['locale'] : 'en';

        return $this->getKeyAnswer($id, $locale);
    }
    public function update(UpdateKeyAnswersRequest $request, $id)
    {
        if (Gate::denies('key_answer_edit')) {
            return abort(401);
        }
        $keyAnswer = KeyAnswer::findOrFail($id);


        $locale = isset($request->locale) ? $request->locale : 'en';

        $keyAnswer->updateRecord($request->all());


        return ($this->getKeyAnswer($id, $locale))
            ->response()
            ->setStatusCode(202);
    }
    public function destroy($id)
    {
        if (Gate::denies('key_answer_delete')) {
            return abort(401);
        }

        $keyAnswer = KeyAnswer::findOrFail($id);
        $keyAnswer->delete();

        return response(null, 204);
    }
}