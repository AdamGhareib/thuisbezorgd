<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function fetch(Request $request) {
     	if($request->get('query')) {
      		$query = $request->get('query');

      		$data = DB::table('restaurants')
        		->where('name', 'LIKE', $query.'%')
        		->get();
      		$output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      		foreach($data as $row) {
       			$output .= '
                <li><a href=http://localhost/thuisbezorgd/public/restaurant/'.$row->name.'>'.$row->name.'</a></li>
                ';
      		}
      		$output .= '</ul>';
      		echo $output;
     	}
    }
}
