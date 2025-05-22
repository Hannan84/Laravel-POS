<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use DB;

class DashboardController extends Controller
{
 public function index()
 {
  $total_sell = Order::sum('total');

  $cost = DB::table('order_details')
   ->join('products', 'order_details.product_id', '=', 'products.id')
   ->selectRaw('SUM(order_details.quantity * products.buying_price) as total_cost')
   ->value('total_cost');

  return view('dashboard.index', [
   'total_paid'      => Order::sum('pay'),
   'total_due'       => Order::sum('due'),
   'total_sell'      => $total_sell,
   'complete_orders' => Order::where('order_status', 'complete')->get(),
   'products'        => Product::orderBy('product_store')->take(5)->get(),
   'new_products'    => Product::orderBy('buying_date')->take(2)->get(),
   'cost'            => $cost,
   'profit'          => $total_sell - $cost,
  ]);
 }

 public function getData()
 {
  $months      = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  $revenueData = [];
  $costData    = [];
  $profitData  = [];

  foreach (range(1, 12) as $month) {

   $revenue = OrderDetails::whereMonth('created_at', $month)
    ->sum('total');

   $cost = DB::table('order_details')
    ->join('products', 'order_details.product_id', '=', 'products.id')
    ->whereMonth('order_details.created_at', $month)
    ->selectRaw('SUM(order_details.quantity * products.buying_price) as total_cost')
    ->value('total_cost');

   $profit = $revenue - $cost;

   $revenueData[] = $revenue ?: 0;
   $costData[]    = $cost ?: 0;
   $profitData[]  = $profit ?: 0;
  }

  return response()->json([
   'categories' => $months,
   'series'     => [
    ['name' => 'Revenue', 'data' => $revenueData],
    ['name' => 'Cost', 'data' => $costData],
    ['name' => 'Profit', 'data' => $profitData],
   ],
  ]);
 }
}
