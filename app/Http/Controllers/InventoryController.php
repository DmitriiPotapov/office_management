<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('inventory.addInventory');
    }

    public function showAllInventory()
    {
        return view('inventory.viewInventory');
    }

    public function showEditInventory($id)
    {
        return view('inventory.editInventory');
    }

    public function showReleaseFrom()
    {
        return view('inventory.releaseInventory');
    }

    public function showInventoryUse()
    {
        return view('inventory.diskUseInventory');
    }

    public function updateJob()
    {

    }

    public function deleteJob($id)
    {

    }

}
