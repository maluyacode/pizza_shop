<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PaymentImport;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = Payment::with('media')->get();
        return response()->json($payment);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payment = new Payment;
        $payment->name = $request->name;
        $payment->description = $request->description;
        if ($request->document !== null) {
            foreach ($request->input("document", []) as $file) {
                $payment->addMedia(storage_path("payment/images/" . $file))->toMediaCollection("images");
            }
        }
        $payment->save();
        return response()->json($payment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = Payment::find($id);
        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Debugbar::info($request);
        $payment = Payment::find($id);
        $payment->name = $request->name;
        $payment->description = $request->description;
        if ($request->document !== null) {
            DB::table('media')->where('model_type', 'App\Models\Payment')->where('model_id', $id)->delete();
            foreach ($request->input("document", []) as $file) {
                $payment->addMedia(storage_path("payment/images/" . $file))->toMediaCollection("images");
            }
        }
        $payment->save();
        return response()->json($payment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payment::destroy($id);
        return response()->json([]);
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path("payment/images");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file("file");
        $name = uniqid() . "_" . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            "name" => $name,
            "original_name" => $file->getClientOriginalName(),
        ]);
    }
    public function import(Request $request){
        Excel::import(new PaymentImport, $request->excel);
        return redirect()->route('payment.index');
    }
}
