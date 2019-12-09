<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\models\order\createOrderCOD;
use App\models\order\getUserOrders;
use App\models\order\orderSearch;
use App\models\order\createOrderPayPal;
use App\models\order\executePayment;
use App\models\order\createOrderPay;
use App\models\order\getPendingOrders;
use App\models\order\getDeliveryOrders;
use App\models\order\getRecords;
use App\models\order\adminorderSearch;
use App\models\order\updatePendingOrder;
use App\models\order\updateDeliveredOrder;
use App\models\order\monthlysales;
use Illuminate\Http\Request;
use Validator;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

use DB;

class OrderController extends Controller {

	public function __construct(){

	}

	public function createOrderCOD(Request $request,createOrderCOD $action){


		$rules = [
			'name' => 'required',
			'email' => 'required',
			'contact' => 'required|numeric',
			'address' => 'required',
		];

		$validator = Validator::make($request->all(),$rules);

		if($validator->fails()){
			return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
		}

		$message = $action->execute($request->all()) == 1 ? "Successfully Saved!" : "Something Went Wrong!";
		return response()->json(['success'=>$message]);
	}

	public function getUserOrders(getUserOrders $action){
		return response()->json(['orders'=>$action->execute()]);
	}

	public function orderSearch($search,orderSearch $action){

		return response()->json(['orders'=>$action->execute($search)]);
	}

	public function createpayment(Request $request,createOrderPayPal $action){
			return $action->execute($request->all());
	}

	public function executepayment(Request $request,executePayment $action){
		return $action->execute($request->all());
	}

	public function createOrderPay(Request $request,createOrderPay $action){
		$message = $action->execute($request->all()) == 1 ? "Order Created!" : "Something Went Wrong!";
		return response()->json(['success'=>$message]);
	}

	public function getPendingOrders(getPendingOrders $action){
		return response()->json(['orders'=> $action->execute()]);
	}

	public function getDeliveryOrders(getDeliveryOrders $action){
		return response()->json(['orders'=> $action->execute()]);
	}

	public function getRecords(getRecords $action){
		return response()->json(['orders'=> $action->execute()]);
	}

	public function updatePendingOrder(Request $request,updatePendingOrder $action){
		$message = $action->execute($request->all()) == 1 ? "Updated Successfully!" : "Something Went Wrong!";
		return response()->json(['message' => $message]);
	}

	public function updateDeliveredOrder(Request $request,updateDeliveredOrder $action){
		$message = $action->execute($request->all()) == 1 ? "Updated Successfully!" : "Something Went Wrong!";
		return response()->json(['message' => $message]);
	}

	public function AdminorderSearch($search, adminorderSearch $action){
		return response()->json(['orders'=> $action->execute($search)]);
	}

	public function showdataYearly(Request $request){
		$yeararray =  [];
		$from = $request->from;

		if($request->to <= $request->from){
			return response()->json(['message'=> 'Year TO must be greater than Year FROM']);
		}
		$y=0;
		for($x = (int)$request->from; $x<= (int)$request->to; $x++){

			$yeararray[$y] = [$from+$y,0];
			$y++;
		}

		$data = [$request->from,$request->to];

	    $dashboarddata = DB::table('orders')
				->leftjoin('order_product__pivot','orders.id','=','order_product__pivot.order_id')
				->selectRaw('YEAR(orders.created_at) as yeardes,sum((order_product__pivot.amount*order_product__pivot.quantity)) as payment,sum(orders.deliverycharge) as deliverycharge')
				->whereRaw('orders.status = 2')
				->whereRaw('YEAR(orders.created_at) BETWEEN ? AND ?',$data)
				->groupby(DB::raw('YEAR(orders.created_at)'))
				->orderby(DB::raw('YEAR(orders.created_at)'))
				->get();
				$x = count($yeararray)-1;
				foreach($dashboarddata as $dashboard){
					$yeararray[$x][1] = ((float)$dashboard->payment+((float)$dashboard->deliverycharge/2));
					$x--;
				}

		return $yeararray;
	}

	public function showdataMonthly(Request $request){

		$data = [$request->year];

		$dashboarddata = DB::table('orders')
				->leftjoin('order_product__pivot','orders.id','=','order_product__pivot.order_id')
				->selectRaw('MONTH(orders.created_at) as monthdes,sum((order_product__pivot.amount*order_product__pivot.quantity)) as payment,sum(orders.deliverycharge) as deliverycharge')
				->where('orders.status','2')
				->whereRaw('YEAR(orders.created_at) = ?',$data)
				->groupby(DB::raw('MONTH(orders.created_at)'))
				->orderby(DB::raw('MONTH(orders.created_at)'))
				->get();

		 $displayarray = [
			 	['Jan',0],
			 	['Feb',0],
			 	['Mar',0],
			 	['Apr',0],
			 	['May',0],
			 	['Jun',0],
			 	['Jul',0],
			 	['Aug',0],
			 	['Sep',0],
			 	['Oct',0],
			 	['Nov',0],
			 	['Dec',0]]
			 	;

				foreach($dashboarddata as $dashboard){
					$displayarray[$dashboard->monthdes-1][1] = ((float)$dashboard->payment+((float)$dashboard->deliverycharge/2));
				}

		return $displayarray;

	}




	public function monthlysales(){

			$dashboarddata = DB::table('orders')
				->leftjoin('order_product__pivot','orders.id','=','order_product__pivot.order_id')
				->selectRaw('MONTH(orders.created_at) as monthdes,sum((order_product__pivot.amount*order_product__pivot.quantity)) as payment,sum(orders.deliverycharge) as deliverycharge')
				->whereRaw('orders.status = 2')
				->whereRaw('YEAR(orders.created_at) = YEAR(NOW())')
				->groupby(DB::raw('MONTH(orders.created_at)'))
				->orderby(DB::raw('MONTH(orders.created_at)'))
				->get();

			 $displayarray = [
			 	['Jan',0],
			 	['Feb',0],
			 	['Mar',0],
			 	['Apr',0],
			 	['May',0],
			 	['Jun',0],
			 	['Jul',0],
			 	['Aug',0],
			 	['Sep',0],
			 	['Oct',0],
			 	['Nov',0],
			 	['Dec',0]]
			 	;

				foreach($dashboarddata as $dashboard){
					$displayarray[$dashboard->monthdes-1][1] = ((float)$dashboard->payment+((float)$dashboard->deliverycharge/2));
				}

		return $displayarray;
	}

}
