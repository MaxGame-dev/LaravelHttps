<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItemList;
use Ramsey\Uuid\Type\Integer;

class SaleItemListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale_item_data = SaleItemList::where('id',$id)->get();
        // dd($sale_item_data); 
        if ($sale_item_data->isNotEmpty()) {
            return view('sale_item_list')->with([
                'item_title' => $sale_item_data[0]['item_title'],
                'item_description' => $sale_item_data[0]['item_description'],
                'item_start_price' => $sale_item_data[0]['start_price'],
                'item_expired_date' => $sale_item_data[0]['expired_date'],
                'item_image' => $sale_item_data[0]['item_image'],
            ]);
        } else {
            return view('sale_item_list')->with([
                'item_title' => "登録なし",
                'item_description' => "",
                'item_start_price' => "",
                'item_expired_date' => "",
                'item_image' => "",
            ]);            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
