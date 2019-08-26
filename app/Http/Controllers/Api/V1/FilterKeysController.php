<?php

namespace App\Http\Controllers\Api\V1;

use App\FilterKey;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilterKey as FilterKeyResource;
use App\Http\Requests\Admin\StoreFilterKeysRequest;
use App\Http\Requests\Admin\UpdateFilterKeysRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class FilterKeysController extends Controller
{
    public function index()
    {
        $filterKeys = FilterKey::all();
        $resultArr = array();
        foreach ($filterKeys as $filterKey) {
            //get english value for default
            $tran = $filterKey->getTranslation();
            if (!$tran) {
                continue;
            }
            array_push($resultArr, [
                'id'                    =>  $filterKey->id,
                'name'                  =>  $tran['name'],
                'json_name'             =>  $filterKey->json_name,
                'type'                  =>  $filterKey->type,
                'answer_cnt'            =>  $filterKey->answers()->count(),
            ]);
        }
        return new FilterKeyResource($resultArr);
    }

    public function store(StoreFilterKeysRequest $request)
    {
        if (Gate::denies('filter_key_create')) {
            return abort(401);
        }


        $filterKey = new FilterKey();
        $filterKey = $filterKey->insertRecord($request->all());


        return (new FilterKeyResource($filterKey))
            ->response()
            ->setStatusCode(201);
    }
    public function getFilterKey($id, $locale = 'en')
    {
        if (!$locale) {
            $locale = 'en';
        }
        $filterKey = FilterKey::with([])->findOrFail($id);
        $otherInfo = [
            'answer_cnt'     =>  $filterKey->answers()->count(),
        ];

        $detail = array_merge($filterKey->getTranslation($locale), $otherInfo);

        return new FilterKeyResource(array_merge($filterKey->toArray(), $detail));
    }
    public function show($id)
    {
        if (Gate::denies('filter_key_view')) {
            return abort(401);
        }

        $locale = isset($_GET['locale']) ? $_GET['locale'] : 'en';

        return $this->getFilterKey($id, $locale);
    }
    public function update(UpdateFilterKeysRequest $request, $id)
    {
        if (Gate::denies('filter_key_edit')) {
            return abort(401);
        }
        $filterKey = FilterKey::findOrFail($id);

        $locale = isset($request->locale) ? $request->locale : 'en';

        $filterKey->updateRecord($request->all());


        return ($this->getFilterKey($id, $locale))
            ->response()
            ->setStatusCode(202);
    }
    public function destroy($id)
    {
        if (Gate::denies('filter_key_delete')) {
            return abort(401);
        }

        $filterKey = FilterKey::findOrFail($id);
        $filterKey->delete();

        return response(null, 204);
    }
}