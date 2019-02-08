<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\DataInventory;

class InventoryController extends Controller
{
    //
    public function __constuct() 
    {
        parent::__constuct();
        $this->middleware('auth');
    }

    public function showAddInventory()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        return view('inventory.addInventory');
    }

    public function showAllInventory()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $inventories = DataInventory::all();

        return view('inventory.viewInventory', compact('inventories'));
    }

    public function showEditInventory($id)
    {
        if( !Auth::check() )
            return redirect()->route('login');

        return view('inventory.editInventory');
    }

    public function showReleaseFrom()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $inventories = DataInventory::all();

        return view('inventory.releaseInventory',compact('inventories'));
    }

    public function showInventoryUse()
    {
        if( !Auth::check() )
            return redirect()->route('login');
            
        $inventories = DataInventory::all();

        return view('inventory.diskUseInventory',compact('inventories'));
    }

    public function updateJob()
    {

    }

    public function deleteJob($id)
    {

    }

    public function addNewInventory(Request $request)
    {
        $inventory = new DataInventory();
        $inventory->acquire_from = $request->input('acquired_from');
        $inventory->role = $request->input('item_role');
        $inventory->device_type = $request->input('storagetype');
        $inventory->category = $request->input('category');
        $inventory->manufacturer = $request->input('manufacturer');
        $inventory->model = $request->input('model');
        $inventory->serial_number = $request->input('serial');
        $inventory->interface = $request->input('interface');
        $inventory->part_number = $request->input('part_number');
        $inventory->capacity = $request->input('capacity');
        $inventory->LBA_number = $request->input('LBA_number');
        $inventory->family = $request->input('family');
        $inventory->firmware = $request->input('firmware');
        $inventory->Form_factor = $request->input('form_factor');
        $inventory->RPM = $request->input('RPM');
        $inventory->PCB_state = $request->input('pcb_state');
        $inventory->PCB_id = $request->input('pcb_id');
        $inventory->PCB_controller = $request->input('pcb_controller');
        $inventory->PCB_motor_driver = $request->input('motor_driver');
        $inventory->PCB_connection = $request->input('connection');
        $inventory->location = $request->input('location');
        $inventory->heads_number = $request->input('heads_number');
        $inventory->heads_info = $request->input('heads_info');
        $inventory->madeIn = $request->input('madeIn');
        $inventory->PH = $request->input('PH');
        $inventory->note = $request->input('note');

        $inventory->save();
        
        return redirect(route('show_all_inventory'));
    }

}
