<?php

namespace App\Http\Controllers\Api\V1;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\City as CityResource;
use App\Http\Requests\Admin\StoreCitiesRequest;
use App\Http\Requests\Admin\UpdateCitiesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class CitiesController extends Controller
{
    public function index()
    {
        return new CityResource(City::all());
    }

    public function getCities(Request $request, $cId)
    {
        $country = Country::findOrFail($cId);
        if ($country == null) {
            return abort(401);
        }
        $cities = City::where('country_id', $cId)
            ->get();

        return new CityResource([
            'cities'            =>  $cities,
            'country'      =>  $country
        ]);
    }


    public function show($id)
    {
        if (Gate::denies('city_view')) {
            return abort(401);
        }

        $city = City::with([])->findOrFail($id);


        return new CityResource(array_merge($city->toArray(), [
            'country_code'  =>  $city->country->code,
            'country_name'  =>  $city->country->name,
        ]));
    }

    public function store(StoreCitiesRequest $request)
    {
        if (Gate::denies('city_create')) {
            return abort(401);
        }

        $city = City::create($request->all());


        return (new CityResource($city))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCitiesRequest $request, $id)
    {
        if (Gate::denies('city_edit')) {
            return abort(401);
        }

        $city = City::findOrFail($id);
        $city->update($request->all());

        return (new CityResource($city))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('city_delete')) {
            return abort(401);
        }

        $city = City::findOrFail($id);
        $city->delete();

        return response(null, 204);
    }
}