<?php


use Illuminate\Support\Facades\DB;

$results = DB::table('products as p')
    ->select('p.name', DB::raw('SUM(oi.quantity) as total_quantity'), DB::raw('AVG(p.rating) as average_rating'))
    ->join('order_items as oi', 'p.id', '=', 'oi.product_id')
    ->groupBy('p.id')
    ->orderBy('total_quantity', 'desc')
    ->limit(5)
    ->get();