<?php

/*
 * @author Anas almasri (anas.almasri@merwas.net)
 * @Description: This is class for general functions
 */

namespace drafeef\base\Foundation;

use Illuminate\Support\Facades\Auth;
use drafeef\users\Constants\Roles\Role;
use Illuminate\Support\Facades\Storage;

final class Collection {


    /**
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This is function to move file or photo
     * @param string $from
     * @param string $to
     * @return boolean
     */
    static function moveFile(string $from, string $to)
    {
        $pathFrom = 'public/' . $from;
        $pathTo = 'public/' . $to;

        if (Storage::exists($pathFrom)) {
            Storage::move($pathFrom, $pathTo);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This is function to get sort by role
     * @param array $user_attr
     * @param array $admin_attr
     * @return array
     */
    static function getSortByRole(array $user_attr,array $admin_attr = ['sort_type'=>'ASC','sort_attr'=>'id']):array
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            if ($user->hasRole(Role::ADMIN)){
              return $admin_attr;
            }else{
                return $user_attr;
            }
        }
        return $user_attr;
    }

 }
