<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pack;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('homepage');
    }

    public function placeOrder()
    {
        // Getting the order value entered by user
        $request = request()->all();
        $tshirts = $request['tshirts'];

        // Fetching all available packs for this wholesaler from the database
        $list = Pack::all(['pack_size'])
                ->sortByDesc('pack_size')
                ->toArray();

        // Converting associative array to single array
        $packs = array();
        foreach($list as $l)
        {
            $packs[] = $l['pack_size'];
        }

        // Selecting all closest packs to fullfill the order
        $required = $tshirts;
        $selected_packs = $this->selectClosestPacksToFulfillOrder($required, $packs);

        // Making sure we have as few packs as possible to fullfill the order
        $final_selection = $this->selectFewPacksAsPossible($selected_packs, $packs);
        
        return view('checkout', compact('tshirts', 'final_selection'));
    }

    public function selectClosestPacksToFulfillOrder($required, $packs)
    {
        $selected_packs = array();

        while($required > 0)
        {
            $result = $this->getClosest($required, $packs);
            $required = $required - $result;
            
            if(array_key_exists($result, $selected_packs))
            {
                $selected_packs[$result] += 1;
            }
            else
            {
                $selected_packs[$result] = 1;
            }
        }

        return $selected_packs;
    }

    public function selectFewPacksAsPossible($selected_packs, $packs)
    {
        $final_selection = array();

        foreach($selected_packs as $pack => $count)
        {
            if($count > 1)
            {
                $sum = 0;
                $sum = $pack * $count;
                
                //Checking if we have closest pack which is greater than the current pack
                $result = $this->getClosest($sum, $packs);

                if($result > $pack)
                {
                    $final_selection[$result] = 1;
                }
                else
                {
                    $final_selection[$pack] = $count;
                }
            }
            else
            {
                $final_selection[$pack] = $count;
            }
        }

        return $final_selection;
    }

    public function getClosest($search, $arr) {
        $closest = null;
        foreach ($arr as $item) {
           if ($closest === null || abs($search - $closest) > abs($item - $search)) {
              $closest = $item;
           }
        }
        return $closest;
    }
}
