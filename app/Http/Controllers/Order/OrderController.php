<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data['orders']=OrderProduct::with('order','product')->paginate(10);

        return view('order.ordermanage', $data);
    }

    public function destroy($id): RedirectResponse
    {
        try {

            $data = OrderProduct::where('order_id',$id)->get();
            $order_data = Order::where('id', $id)->get();

            foreach ($data as $datum)
            {$datum->delete();}
            foreach ($order_data as $datum)
            {$datum->delete();}
            session()->flash('message', 'Deleted!');
            session()->flash('type', 'success');
            return redirect()->route('orders.index');
        }
        catch(Exception $e){
            session()->flash('message',$e->getMessage());
            session()->flash('type','danger');

            return redirect()->back();
        }

    }


}
