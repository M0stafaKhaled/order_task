<?php


use Illuminate\Support\Facades\DB;

$orders = DB::table(DB::raw("(SELECT * FROM categories WHERE name = 'Electronics') as c"))
    ->select('o.*', 'oi.*', 'p.*', 'c.*')
    ->join('products as p', 'c.id', '=', 'p.category_id')
    ->join('order_items as oi', 'p.id', '=', 'oi.product_id')
    ->join('orders as o', 'oi.order_id', '=', 'o.id')
    ->where('o.created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 30 DAY)'))
    ->orderBy('o.created_at', 'desc')
    ->limit(10)
    ->get();


    /// or we can use this 


    $categoryId = DB::table('categories')
    ->where('name', 'Electronics')
    ->value('id');

$orders = DB::table('orders as o')
    ->select('o.*', 'oi.*', 'p.*')
    ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
    ->join('products as p', 'oi.product_id', '=', 'p.id')
    ->where('p.category_id', $categoryId)
    ->where('o.created_at', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 30 DAY)'))
    ->orderBy('o.created_at', 'desc')
    ->limit(10)
    ->get();