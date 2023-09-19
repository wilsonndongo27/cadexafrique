<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function dashboard(Request $request){
        if(Auth::check()){
            $file_size = 0;
            foreach( File::allFiles(public_path('storage')) as $file)
            {
                $file_size += $file->getSize();
            }
            $file_size = number_format($file_size / 1048576,2);

            $alladmin = User::where('is_admin', '1')->where('actif', '1')->get();
            $allsupport =  DB::table('support')->where('status', '0')->get();
            $allaccountclient =  DB::table('clientaccount')->where('status', '1')->get();
            return view('analytics.dashboard')
            ->with('alladmin', $alladmin)
            ->with('allsupport', $allsupport)
            ->with('allaccountclient', $allaccountclient)
            ->with('sizefiles', $file_size);
        }else{
            return view('analytics.login');
        }
    }
}
