<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Option;
use App\Models\Meal;
use App\Models\CuisineType;
use App\Models\Voucher;
use Datetime;
use App\Models\OptionVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    //
    protected function getShopOrderPanel(){

            $items = MenuItem::all();
    
            $meal_types = Meal::all();
    
            $cuisine_types = CuisineType::all();

		    return view('Sale.sale_page', compact('items','meal_types','cuisine_types'));
	}

    protected function getCountingUnitsByItemId(Request $request){

		$item_id = $request->item_id;
        
        $item = MenuItem::where('id', $item_id)->first();
       
        $units = Option::where('menu_item_id', $item_id)->with('menu_item')->get();
        
        return response()->json($units);
	}

    protected function storeShopOrder(Request $request){
		$validator = Validator::make($request->all(), [
			'option_lists' => 'required',
		]);

		if ($validator->fails()) {    
            return redirect()->back();
		}
        $date = new DateTime('Asia/Yangon');

		$real_date = $date->format('Y-m-d H:i:s');

        $re_date = $date->format('Y-m-d');

        $options = json_decode($request->option_lists,true);
        // dd($options[0]['unit_name']);
        $voucher = Voucher::create([
           'voucher_date'=>$real_date,
           'date'=>$re_date,
           'total_amount'=>$request->voc_tot,
           'pay'=>$request->voc_pay,
           'change'=>$request->voc_chg,
        ]);
        $voucher->voucher_code = "VOU-".date('dmY')."-".sprintf("%04s", $voucher->id);

        $voucher->save();
        foreach ($options as $option) {
            OptionVoucher::create([
                'voucher_id'=>$voucher->id,
                'item_name'=>$option['item_name'],
                'option_name'=>$option['unit_name'],
                'order_qty'=>$option['order_qty'],
                'selling_price'=>$option['selling_price'],
            ]);
        }

        $units = OptionVoucher::where('voucher_id',$voucher->id)->get();

        return view('Sale.voucher_page', compact('units','voucher'));
    }

    protected function getFinishedOrderList(){

    	$vouchers = Voucher::latest()->get();
         
		return view('Sale.voucher_lists', compact('vouchers'));
	}

    protected function deleteVoucher(Request $request)
    {
        $id = $request->voucher_id;

        $vouchers = OptionVoucher::where('voucher_id',$id)->delete();
        
        $voucher = Voucher::find($id)->delete();
        
        return response()->json($voucher);
    }

    protected function getShopOrderVoucher($voucher_id){

		try {

        	$voucher = Voucher::findOrFail($voucher_id);

   		} catch (\Exception $e) {

            return redirect()->back();

    	}

        $units = OptionVoucher::where('voucher_id',$voucher->id)->get();

        return view('Sale.voucher_page', compact('units','voucher'));
    }

    protected function getFilterFinishedOrderList(Request $request){

    	$voucher = Voucher::whereBetween('date', [$request->start_date, $request->end_date])->get();

		return response()->json($voucher);
	}

    //report 

    protected function getReport(){
        $voucher = Voucher::latest()->get();
        $total_sale = 0;$today_sale = 0;$total_inventory = 0;
        $today = date("Y-m-d");
        foreach($voucher as $vou){
            $total_sale += $vou->total_amount;
        }
        $tod_voucher = Voucher::where('date',$today)->get();
           foreach($tod_voucher as $tod){
            $today_sale += $tod->total_amount;
        }

        $menu = MenuItem::all()->count();
        return view('report',compact('total_sale','today_sale','menu'));
    }

    protected function getTotalOrderFulfill(Request $request)
    {
        $currentYear = now()->year;
       $jan_income = Voucher::whereMonth('date', '01')->whereYear('date', $currentYear)->get();
       $jan  = 0;
       foreach($jan_income as $j){
             $jan += $j->total_amount;
       }

        $feb_income = Voucher::whereMonth('date', '02')->whereYear('date', $currentYear)->get();
        $feb  = 0;
       foreach($feb_income as $f){
             $feb += $f->total_amount;
       }

        $mar_income = Voucher::whereMonth('date', '03')->whereYear('date', $currentYear)->get();
        $mar  = 0;
       foreach($mar_income as $m){
             $mar += $m->total_amount;
       }

        $apr_income = Voucher::whereMonth('date', '04')->whereYear('date', $currentYear)->get();
        $apr  = 0;
        foreach($apr_income as $a){
              $apr += $a->total_amount;
        }

        $may_income = Voucher::whereMonth('date', '05')->whereYear('date', $currentYear)->get();
        $may  = 0;
       foreach($may_income as $ma){
             $may += $ma->total_amount;
       }

        $jun_income = Voucher::whereMonth('date', '06')->whereYear('date', $currentYear)->get();
        $jun  = 0;
       foreach($jun_income as $ju){
             $jun += $ju->total_amount;
       }

    $jul_income = Voucher::whereMonth('date', '07')->whereYear('date', $currentYear)->get();
    $jul  = 0;
    foreach($jul_income as $july){
          $jul += $j->total_amount;
    }

        $aug_income = Voucher::whereMonth('date', '08')->whereYear('date', $currentYear)->get();
        $aug  = 0;
        foreach($aug_income as $au){
              $aug += $au->total_amount;
        }
        $sep_income = Voucher::whereMonth('date', '09')->whereYear('date', $currentYear)->get();
        $sep  = 0;
        foreach($sep_income as $se){
              $sep += $se->total_amount;
        }
        $oct_income = Voucher::whereMonth('date', '10')->whereYear('date', $currentYear)->get();
        $oct  = 0;
       foreach($oct_income as $o){
             $oct += $o->total_amount;
       }
        $nov_income = Voucher::whereMonth('date', '11')->whereYear('date', $currentYear)->get();
        $nov  = 0;
        foreach($nov_income as $n){
              $nov += $n->total_amount;
        }

        $dec_income = Voucher::whereMonth('date', '12')->whereYear('date', $currentYear)->get();
        $dec  = 0;
       foreach($dec_income as $de){
             $dec += $de->total_amount;
       }

    return response()->json([
        "jan_income" => $jan,
        "feb_income" => $feb,
        "mar_income" => $mar,
        "apr_income" => $apr,
        "may_income" => $may,
        "jun_income" => $jun,
        "jul_income" => $jul,
        "aug_income" => $aug,
        "sep_income" => $sep,
        "oct_income" => $oct,
        "nov_income" => $nov,
        "dec_income" => $dec,
    ]);

    }

    protected function getWeekNowFamous()
    {
        // dd('hello');
    
        $mostFamousName = OptionVoucher::groupBy('item_name')
        ->select('item_name', \DB::raw('count(*) as count'))
        ->orderBy('count', 'desc')
        ->take(5)
        ->get();

       return response()->json($mostFamousName);
    }
}
