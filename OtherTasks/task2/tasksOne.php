<?php


use Illuminate\Support\Facades\DB;



$results = DB::table('users')
    ->join('purchases', 'users.id', '=', 'purchases.user_id')
    ->where('purchases.created_at', '>', now()->subDays(30))
    ->groupBy('users.id')
    ->select('users.name', 'users.email', DB::raw('SUM(purchases.amount) as total_spent'))
    ->get();