<?php

namespace App;


class GlobalConstants
{
    const FILTER_KEY_TYPE_NORMAL    =   0;
    const FILTER_KEY_TYPE_RANGE    =   1;
    const CAMPAIGN_STATUS_ALL         =   "all";
    const CAMPAIGN_STATUS_DRAFT         =   "draft";
    const CAMPAIGN_STATUS_PENDING       =   "pending";
    const CAMPAIGN_STATUS_APPROVED       =   "approved";
    const CAMPAIGN_STATUS_REJECTED       =   "rejected";
    const CAMPAIGN_STATUS_DONE       =   "done";
    const TITLE_FOR_NEW_CAMPAIGN        =   "A new campaign has just created!";
    const TITLE_FOR_CHANGE_STATUS       =   "The status has just changed!";
    const MAP_FILE_PATH           =   '/uploads/map/';

    public static function getProfileOfUser($user)
    {
        $profile = $user->profile;
        $result = [
            'name'      =>  $user->name,
            'email'     =>  $user->email,
            'phone'     =>  $profile != null ? $profile->phone : null,
            'country'   =>  $profile != null ? $profile->country : null,
            'address'   =>  $profile != null ? $profile->address : null,
            'vat_number' =>  $profile != null ? $profile->vat_number : null,
        ];
        return $result;
    }

    public static function getProfileOfAdmin()
    {
        $users = User::get();
        foreach ($users as $user) {
            $roles = $user->role;
            //if admin
            foreach ($roles as $role) {
                if ($role->id == 1) {
                    return self::getProfileOfUser($user);
                }
            }
        }
        return null;
    }

    public static function getPriceInfo($filter, $cnt)
    {
        $param = json_decode($filter);
        if ($param == null) {
            return null;
        }
        $extraFilterCnt = count((array) $param->extra);

        $country = Country::with(['currency'])->where('code', $param->cCountry)->first();
        if ($country == null) {
            $currencyCode = \Config::get('constants.DEFAULT_CURRENCY_CODE');
            $currencySymbol = \Config::get('constants.DEFAULT_CURRENCY_SYMBOL');
            $initialPrice = (float) \Config::get('constants.DEFAULT_INITIAL_PRICE');
            $extraPrice = (float) \Config::get('constants.DEFAULT_EXTRA_PRICE');
        } else {
            $currencyCode = $country->currency->code;
            $currencySymbol = $country->currency->symbol;
            $initialPrice = $country->initial_price;
            $extraPrice = $country->extra_price;
        }

        $pricePerSMS = $initialPrice + $extraFilterCnt * $extraPrice;
        $totalPrice = (float) number_format((float) $cnt * $pricePerSMS, 2, '.', '');
        return [
            'recipients'            =>  $cnt,
            'currency_code'         =>  $currencyCode,
            'currency_symbol'       =>  $currencySymbol,
            'initial_price'         =>  $initialPrice,
            'extra_price'           =>  $extraPrice,
            'total_price'           =>  $totalPrice,
            'price_per_sms'         =>  $pricePerSMS,
            'extra_filter_count'    =>  $extraFilterCnt
        ];
    }
}