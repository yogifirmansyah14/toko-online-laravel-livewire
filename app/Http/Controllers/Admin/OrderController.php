<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != NULL,
                        function ($q) use ($request) {
                            return $q->whereDate('created_at', $request->date);
                        }, function ($q) use($todayDate) {
                            return $q->whereDate('created_at', $todayDate);
                        })->
                        when($request->status != NULL, function ($q) use ($request) {
                            return $q->where('status_message', $request->status);
                        })->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        if ($order)
        {
            return view('admin.orders.view', compact('order'));
        }
        else
        {
            return redirect('admin/orders')->with('message', 'Order ID Not Found!');
        }
    }

    public function updateOrderStatus(Request $request, $order_id)
    {
        $order = Order::where('id', $order_id)->first();
        if ($order)
        {
            $order->update([
                'status_message' => $request->order_status
            ]);
            return redirect()->back()->with('message', 'Order Status Updated Successfully.');
        }
        else
        {
            return redirect('admin/orders')->with('message', 'Order ID Not Found!');
        }
    }

    public function viewInvoice($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('admin.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice($order_id)
    {
        $order = Order::findOrFail($order_id);
        $data = ['order' => $order];

        $todayDate = Carbon::now()->format('Y-m-d');
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }
    
    public function mailInvoice($order_id)
    {
        try
        {
            $order = Order::findOrFail($order_id);
    
            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));   
            return redirect()->back()->with('message', 'Invoice Mail has been sent to '.$order->email);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('message', 'Something went wrong!');
        }
    }
}
