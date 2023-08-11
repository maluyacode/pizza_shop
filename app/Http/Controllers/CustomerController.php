<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    public function create()
    {
        return view('customer.create');
    }

    public function update()
    {
        return view('customer.update');
    }

    public function customerEdit($id){
        $customer = Customer::find($id);
        return view('customer.edit',compact('customer'));
    }

    public function customerStore(Request $request){
        $request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'address' => 'required'
    ]);
        $customer = new Customer();
    
        $customer->name = $request->name;
    $customer->email = $request->email;
    $customer->phone = $request->phone;
    $customer->address = $request->address;
    $customer->save();
    
    return redirect('datatables/customer');
    }

    public function customerUpdate(Request $request, $id){
        $customer = customer::find($id);
          $request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'address' => 'required'
          ]);
    
        $customer->name = $request->name;
        $customer->email = $request->email;
            $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
    
    return redirect()->route('customer.datatable');
    }

    public function customerDelete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('datatables/customer');
    }
}
