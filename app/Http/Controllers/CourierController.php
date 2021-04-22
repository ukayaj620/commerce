<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use Illuminate\Support\Facades\Storage;

class CourierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function fetchAll()
    {
        $couriers = Courier::all();
        return view('admin.courier.index', [
            'couriers' => $couriers,
            'url' => 'admin'
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'courier_name' => 'required',
            'image' => 'required|file'
        ]);

        $photo = $request->file('image');
        $image_path = uniqid() . '.' . $photo->extension();
        $path = $photo->storeAs('public/', $image_path);

        Courier::create([
            'courier_name' => $request->input('courier_name'),
            'courier_icon' => $image_path,
        ]);

        return redirect(route('courier.fetchAll'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'courier_name' => 'required',
            'image' => 'required|file'
        ]);

        Courier::whereId($request->input('id'))->update([
            'courier_name' => $request->input('courier_name'),
        ]);

        $courier = Courier::whereId($request->input('id'))->first();

        if($request->hasFile('image')) {

            Storage::delete('/public/' . $courier->courier_icon);

            $photo = $request->file('image');
            $image_path = uniqid() . '.' . $photo->extension();
            $path = $photo->storeAs('public/', $image_path);

            Courier::whereId($request->input('id'))->update([
                'courier_icon' => $image_path
            ]);
        }

        return redirect(route('courier.fetchAll'));
    }

    public function delete($id)
    {
        $courier = Courier::whereId($id)->first();
        Storage::delete('/public/' . $courier->courier_icon);
        Courier::find($id)->delete();
        return redirect(route('courier.fetchAll'));
    }
}
