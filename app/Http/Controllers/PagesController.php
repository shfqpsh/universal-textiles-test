<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pack;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function addNewPackSize()
    {
        $pack_sizes_list = Pack::all(['id', 'pack_size']);

        return view('add-new-pack-size', compact('pack_sizes_list'));
    }

    public function listPackSize()
    {
        try
        {
            $list = Pack::all();

            return view('list-pack-size', compact('list'));
        }
        catch(\Exception $e)
        {
            \Log::error($e);
        }
    }

    public function insertNewPackSize()
    {
        $request = request()->all();
        $pack_size = $request['packSize'];

        try
        {
            $res = Pack::getPackBySize($pack_size);

            if(isset($res[0]))
            {
                echo "Already Exists";
                exit;
            }
            
            // Adding new record
            $p = new Pack;
            $p->pack_size = $pack_size;
            $p->save();
        }
        catch(\Exception $e)
        {
            \Log::error($e);
            echo 'Error';
            exit;
        }

        echo 'Success';
    }

    public function getUpdate($id)
    {
        $pack_size_info = Pack::where([['id', $id]])->get();

        if(!isset($pack_size_info[0]))
        {
            abort(404, 'Page Not Found');
        }

        return view('update-pack-size', compact('pack_size_info'));
    }

    public function updatePackSize()
    {
        $request = request()->all();
        $id = $request['pack_id'];
        $pack_size = $request['packSize'];

        try
        {
            $res = Pack::getPackBySize($pack_size);

            if(isset($res[0]))
            {
                echo "This Pack Size Already Exists, Please Enter Different Size";
                exit;
            }
            
            // Adding new record
            $p = Pack::find($id);
            $p->pack_size = $pack_size;
            $p->save();
        }
        catch(\Exception $e)
        {
            \Log::error($e);
            echo 'Error';
            exit;
        }

        echo 'Success';
    }

    public function deletePackSize()
    {
        try
        {
            $request = request()->all();
            $id = $request['id'];

            //Deleting the record
            Pack::destroy($id);

            echo "Deleted!";
            exit;
        }
        catch(\Exception $e)
        {
            \Log::error($e);
            echo "Error";
            exit;
        }
        
    }
}
