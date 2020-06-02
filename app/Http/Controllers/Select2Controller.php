<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
class Select2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function select2LoadMore(Request $request)
    {
        $search = $request->get('search');

        if(!is_null($search))
        {
        $data = User::select(['id', 'email'])->where('email', 'like', '%' . $search . '%')->orderBy('email')->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
        }
    }

}
