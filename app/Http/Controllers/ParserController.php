<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App;

include 'simple_html_dom.php';

class ParserController extends Controller
{
    function index()
    {
        $data = [];
        $html = file_get_html('https://realt.by/sale/flats/');

        foreach ($html->find('div.bd-item') as $announceDiv) {

            $data['name'] = $announceDiv->find('div.media-body a', 0)->plaintext;
            $data['price'] = $announceDiv->find('span.price-byr', 0)->plaintext;

            if (!(App\Parser::where('name', '=', $data['name'])->first())) {
                $this->create($data);
            }
        }

        return view('live_search');
    }

    public function create(array $data)
    {
        return App\Parser::create([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);
    }

    function action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
            {
                $data = DB::table('parsers')
                    ->where('name', 'like', '%'.$query.'%')
                    ->orWhere('price', 'like', '%'.$query.'%')
                    ->orderBy('id', 'desc')
                    ->get();

            }
            else
            {
                $data = DB::table('parsers')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
        <tr>
         <td>'.$row->name.'</td>
         <td>'.$row->price.'</td>
        </tr>
        ';
                }
            }
            else
            {
                $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
}
