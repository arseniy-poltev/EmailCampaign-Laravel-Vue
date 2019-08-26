<?php

namespace App\Http\Controllers;

use App\Service\AdsWebService;
use Illuminate\Http\Request;
use App\Country;
use App\City;
use Illuminate\Http\Resources\Json\JsonResource;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('locale');
    }
    public function index(Request $request)
    {
        $maps = Country::where('map_file_url', '!=', null)
            ->select('map_file_url')
            ->get();
        return view('home.home', [
            'maps'      =>  $maps
        ]);
    }

    public function getAllStates($code)
    {
        $country = Country::where('code', $code)->get()->first();
        if ($country == null) {
            return response([
                'data'  =>  array(),
                'error' =>  'No country info!'
            ]);
        }

        $cities = City::where('country_id', $country->id)
            ->get();

        return new JsonResource($cities);
    }

    public function getUserCount(Request $request)
    {
        $service = new AdsWebService();
        $parameter = [
            'cLogin'    =>  'inforeg',
            'cPassword' =>  's3cr3t',
            'cCountry'  =>  'es',
            'cZIP'      =>  null,
            'cGender'   =>  $request->sex,
            'cAge'      =>  null,
        ];
        $result = $service->getRecordCount($parameter);
        // var_dump($result);
        // exit();


        return response([
            'recipients'    =>  $result->iTOTAL,
            'campaigns'     =>  "791.624",
            'senders'        =>  "791.624",
        ]);
    }
}