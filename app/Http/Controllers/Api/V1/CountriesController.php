<?php

namespace App\Http\Controllers\Api\V1;

use App\Country;
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
    public function index()
    {
        $countries = Country::with(['currency'])->get();
        $countryArr = array();
        foreach ($countries as $country) {
            $currency = $country->currency;
            $currencyDetail = $currency->symbol . ' (' . $currency->code . ')';
            array_push($countryArr, [
                'id'            =>  $country->id,
                'name'          =>  $country->name,
                'code'          =>  $country->code,
                'initial_price' =>  $country->initial_price . $currencyDetail,
                'extra_price'   =>  $country->extra_price . $currencyDetail,
                'city_cnt'      =>  $country->cities()->count(),
                'activated'     =>  $country->activated
            ]);
        }
        return new CountryResource($countryArr);
    }




    public function show($id)
    {
        if (Gate::denies('country_view')) {
            return abort(401);
        }

        $country = Country::with(['currency'])->findOrFail($id);

        return new CountryResource($country);
    }

    public function store(StoreCountriesRequest $request)
    {
        if (Gate::denies('country_create')) {
            return abort(401);
        }
        //save map file
        if (isset($request->map_file)) {
            $file = $request->file('map_file');
            $path = public_path(GlobalConstants::MAP_FILE_PATH);
            $fileName = $file->getClientOriginalName();
            $file->move($path,  $fileName);
            $request->merge(['map_file_url' => GlobalConstants::MAP_FILE_PATH . $fileName]);
        }

        $country = Country::create($request->all());


        return (new CountryResource($country))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCountriesRequest $request, $id)
    {
        if (Gate::denies('country_edit')) {
            return abort(401);
        }

        //save map file
        if (isset($request->map_file)) {
            $file = $request->file('map_file');
            $path = public_path(GlobalConstants::MAP_FILE_PATH);
            $fileName = $file->getClientOriginalName();
            $file->move($path,  $fileName);
            $request->merge(['map_file_url' => GlobalConstants::MAP_FILE_PATH . $fileName]);
        }
        if (!isset($request->map_file_url)) {
            $request->merge(['map_file_url' => null]);
        }

        $country = Country::findOrFail($id);
        $country->update($request->all());

        return (new CountryResource($country))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('country_delete')) {
            return abort(401);
        }

        $country = Country::findOrFail($id);
        $country->delete();

        return response(null, 204);
    }

    public function getAvaliableUsers($code)
    {
        $service = new AdsWebService();
        $parameter = [
            'cLogin'    =>  'inforeg',
            'cPassword' =>  's3cr3t',
            'cCountry'  =>  $code,
            'cZIP'      =>  null,
            'cGender'   =>  null,
            'cAge'      =>  null,
        ];
        //$result = $service->getRecordCount($parameter);
        //-------testing code
        $cnt = random_int(0, 100000);
        //--------------------
        return response([
            'recipients'    =>  $cnt,
        ]);
    }
}