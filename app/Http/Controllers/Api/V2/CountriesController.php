<?php

namespace App\Http\Controllers\Api\V2;

use App\Country;
use App\FilterKey;
use App\KeyAnswer;
use App\Http\Controllers\Controller;
use App\Http\Resources\Country as CountryResource;
use App\Http\Requests\Admin\StoreCountriesRequest;
use App\Http\Requests\Admin\UpdateCountriesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Service\AdsWebService;
use App\GlobalConstants;

class CountriesController extends Controller
{
    public function getActive()
    {
        //get all active countries
        $active = Country::where('activated', 1)
            ->select('code')
            ->get();
        $result = [];
        foreach ($active as $country) {

            $result[$country->code] = 'active';
        }

        $hasMapCountry = Country::where('map_file_url', '!=', null)
            ->select('code')
            ->get();
        $mapResult = [];
        foreach ($hasMapCountry as $map) {
            array_push($mapResult, $map->code);
        }

        //return extra filters
        $filterKeys = FilterKey::all();
        $keyArr = [];
        foreach ($filterKeys as $filterKey) {
            if ($filterKey->type == GlobalConstants::FILTER_KEY_TYPE_RANGE) {
                array_push($keyArr, [
                    'name'      =>  $filterKey->getTranslation()['name'],
                    'jsonName'  =>  $filterKey->json_name,
                    'type'  =>  $filterKey->type,
                    'value' =>  [
                        'minValue'  =>  "",
                        'maxValue'  =>  "",
                    ],
                    'data'  =>  [
                        'minValue'  =>  $filterKey->min_value,
                        'maxValue'  =>  $filterKey->max_value,
                        'step'      =>  $filterKey->step
                    ],
                    'possibleVals'  =>  [""]
                ]);
            } else {
                $answers = $filterKey->answers()->get();
                $possibleVals = [];
                foreach ($answers as $answer) {
                    array_push($possibleVals, $answer->getTranslation()['title']);
                }
                array_push($keyArr, [
                    'name'  =>  $filterKey->getTranslation()['name'],
                    'jsonName'  =>  $filterKey->json_name,
                    'type'  =>  $filterKey->type,
                    'value' =>  "",
                    'possibleVals'  =>  $possibleVals
                ]);
            }
        }

        return new CountryResource([
            'active'        =>  $result,
            'map'           =>  $mapResult,
            'extraFilters'  =>  $keyArr
        ]);
    }
}