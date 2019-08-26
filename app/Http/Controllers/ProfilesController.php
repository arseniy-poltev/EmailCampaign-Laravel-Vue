<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\User\UpdateProfilesRequest;
use App\Profile;

class ProfilesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProfile()
    {
        $user = Auth::user();
        $profile = $user->profile;
        $result = [
            'name'      =>  $user->name,
            'email'     =>  $user->email,
            'phone'     =>  $profile != null ? $profile->phone : null,
            'country'   =>  $profile != null ? $profile->country : null,
            'address'   =>  $profile != null ? $profile->address : null,
            'vat_number' =>  $profile != null ? $profile->vat_number : null,
        ];
        return new JsonResource($result);
    }
    public function changeProfile(UpdateProfilesRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'name'  =>  $request->name,
            'email' =>  $request->email
        ]);
        $profile = [
            'phone'     =>  $request->phone,
            'country'   =>  $request->country,
            'address'   =>  $request->address,
            'vat_number' =>  $request->vat_number,
            'user_id'   =>  $user->id,
        ];
        if ($user->profile == null) {
            $newProfile = Profile::create($profile);
            $user->update([
                'profile_id'    =>  $newProfile->id
            ]);
        } else {
            $user->profile->update($profile);
        }

        return response(null, 202);
    }
}