<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MasterDataController extends Controller
{
    //return roles.

    public static function getRoles(Request $request) {
        $roles = DB::table('tbl_roles')
                     ->select('id','Role')
                     ->get();

        return response()->json($roles);
    }

    //return division
    public static function getDivisions(Request $request){
        $divisions = DB::table('tbl_divisions')->where('agency_id','=',$request->agencyId)
                    ->select('id','division')
                    ->get();

        return response()->json($divisions);
    }

}
