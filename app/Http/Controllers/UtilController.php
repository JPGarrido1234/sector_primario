<?php

namespace App\Http\Controllers;

use App\Models\User;

class UtilController extends Controller
{
    public static function getChart1(){
        $users_chart_count = User::selectRaw('count(*) as count, month(created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month');

        return $users_chart_count;
    }
}
