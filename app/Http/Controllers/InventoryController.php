<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Option;
use App\Models\Meal;
use App\Models\CuisineType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    //
	//meal
	protected function getMealList()
	{
		$meal_lists =  Meal::latest()->get();

		return view('Inventory.meal_list', compact('meal_lists'));
	}

	protected function storeMeal(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $meal = Meal::create([
                'name' => $request->name,
            ]);

        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }

        return redirect()->route('meal_list');
	}

	protected function updateMeal($id, Request $request)
	{
		try {

        	$meal = Meal::findOrFail($id);

   		} catch (\Exception $e) {

            return redirect()->back();

    	}

        $meal->name = $request->name;

        $meal->save();

        return redirect()->route('meal_list');
	}

	//cuisine
    protected function getCuisineTypeList()
	{
		$cuisine_type_lists =  CuisineType::latest()->get();

		$meal_lists =  Meal::latest()->get();

		return view('Inventory.cuisine_type_list', compact('cuisine_type_lists','meal_lists'));
	}

	protected function storeCuisineType(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'name' => 'required',
            'meal_id' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $category = CuisineType::create([
                'name' => $request->name,
                'meal_id' => $request->meal_id,
            ]);

        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect()->route('cuisine-type_list');
	}

	protected function updateCuisineType($id, Request $request)
	{
		try {

        	$cuisine = CuisineType::findOrFail($id);

   		} catch (\Exception $e) {

            return redirect()->back();

    	}

        $cuisine->name = $request->name;

        $cuisine->meal_id = $request->meal_id;

        $cuisine->save();

        return redirect()->route('cuisine-type_list');
	}

	//Menu Item
	protected function getMenuItemList()
	{
		$menu_item_lists =  MenuItem::whereNull("deleted_at")->orderBy('cuisine_type_id', 'ASC')->latest()->get();

		$cuisine_type_lists =  CuisineType::latest()->get();

		return view('Inventory.item_list', compact('menu_item_lists','cuisine_type_lists'));
	}

	protected function storeMenuItem(Request $request)
	{

		$validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'cuisine_type_id' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back();
        }

        if ($request->hasfile('photo_path')) {

			$image = $request->file('photo_path');

			$name = $image->getClientOriginalName();

			$photo_path =  time()."-".$name;

			$image->move(public_path() , $photo_path);
		}
		else{
			$photo_path = "default.jpg";
		}

        try {

            $item = MenuItem::create([
                'item_code' => $request->code,
                'item_name' => $request->name,
                'photo_path' => $photo_path,
                'cuisine_type_id' => $request->cuisine_type_id,
            ]);

        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect()->route('menu_item_list');
	}

    protected function updateMenuItem($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        try {

            $item = MenuItem::findOrFail($id);

        } catch (\Exception $e) {

            return redirect()->back();

        }

        if ($request->hasfile('photo_path')) {

			$image = $request->file('photo_path');

			$name = $image->getClientOriginalName();

			$photo_path =  time()."-".$name;

			$image->move(public_path(), $photo_path);
            
            if (Storage::exists($item->photo_path) && $item->photo_path != 'default.jpg') {
                // Delete the image file
                Storage::delete($item->photo_path);
            }
		}
		else{

			$photo_path = "default.jpg";

		}

        $item->item_code = $request->code;

        $item->item_name = $request->name;

        $item->photo_path = $photo_path;

        $item->cuisine_type_id = $request->cuisine_type_id;

        $item->save();

        return redirect()->back();
    }

    protected function deleteMenuItem(Request $request) //Not Finish
    {
        $id = $request->item_id;

        $item = MenuItem::find($id);

        if (Storage::exists($item->photo_path) && $item->photo_path != 'default.jpg') {
            // Delete the image file
            Storage::delete($item->photo_path);
        }

        $counting_units = Option::where('menu_item_id', $item->id)->get();

        foreach ($counting_units as $unit) {

            $unit->delete();
        }

        $item->delete();

        return back();
    }

//counting unit
    protected function getOptionList($item_id)
    {

        $units = Option::where('menu_item_id', $item_id)->whereNull("deleted_at")->latest()->get();

        try {

            $item = MenuItem::findOrFail($item_id);

        } catch (\Exception $e) {

            return redirect()->back();
        }

        return view('Inventory.unit_list', compact('units','item'));
    }

    protected function storeOption(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sale_price' => 'required',
            'size' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $option = Option::create([
                'name' => $request->name,
                'sale_price' => $request->sale_price,
                'size' => $request->size,
                'menu_item_id' => $request->item_id,
            ]);


        } catch (\Exception $e) {

            dd($e);

            return redirect()->back();
        }

        return redirect()->back();
    }

    protected function updateOption($id,Request $request)
    {
        try {

            $unit = Option::findOrFail($id);

        } catch (\Exception $e) {

            return redirect()->back();

        }

        $unit->name = $request->name;

        $unit->sale_price = $request->sale_price;

        $unit->size = $request->size;

        $unit->save();

        return redirect()->back();
    }

    protected function deleteOption(Request $request)
    {
        $id = $request->unit_id;

        $unit = Option::findOrFail($id);

        $unit->delete();

        return response()->json($unit);
    }
    
    protected function changeBrake($id){
        $change = Option::find($id);
        $change->brake_flag = 2;
        $change->save();
        return back();
    }
    protected function changeUnbrake($id){
        $change = Option::find($id);
        $change->brake_flag = 1;
        $change->save();
        return back();
    }
}
