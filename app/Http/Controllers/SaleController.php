<?php

namespace App\Http\Controllers;

use App\Sale;
use DataTables;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function getGood(Request $request)
    {
        $barcode = [1, $request->barcode];

        if (preg_match('[\W]', $request->barcode)) {
            $barcode = explode('*', $request->barcode);
        }

        return view('sales.good',[
            'qty' => $barcode[0],
            'model' => \App\Good::where('barcode',$barcode[1])->firstOrFail(),
        ]);   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no = 1;

        do {
            $number = date('dmy');
            $number .= sprintf('%04d',$no++);
        } while (Sale::where('number', $number)->first());

        $model = Sale::create([
            'number' => $number,
            'total' => array_sum($request->subtotal),
        ]);

        for ($i=0; $i < count($request->barcode); $i++) { 
            $model->saleDetails()->create([
                'good_barcode' => $request->barcode[$i],
                'price' => $request->price[$i],
                'qty' => $request->qty[$i],
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleDetails = \App\SaleDetail::where('sale_number',$id)->get();
        return view('sales.show',compact('saleDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saleApi()
    {
        $model = Sale::query();

        return DataTables::of($model)
            ->addIndexColumn()
            ->editColumn('total', function($model) {
                return 'Rp ' . number_format($model->total);
            })
            ->addColumn('action', function ($model) {
                return view('templates._action', [
                    'model' => $model->number,
                    'url_show' => route('sale.show', $model->number),
                    // 'url_edit' => route('buy.edit', $model->id),
                    // 'url_destroy' => route('buy.destroy', $model->id),
                ]);
            })
            ->make(true);
    }
}