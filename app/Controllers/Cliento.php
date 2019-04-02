<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class Cliento extends Controller
{
    public function index()
    {
        $client = Services::curlrequest();

        $response2 = $client->request('POST', 'http://localhost:8080/server/work', ['debug' => fopen('php://stderr', 'w'),
            'form_params' => ['item' => 'bubbletea',
                'quantity'=>5,
                'price'=>5]]);
        echo $response2->getBody();


    }

    public function jsonRequest()
    {
        $client = Services::curlrequest();
        $response = $client->request('POST', 'http://localhost:8080/server/work', ['debug' => fopen('php://stderr', 'w'),
            'json' => ['item' => 'bubbletea',
                'quantity'=>10,
                'price'=>5]]);
        echo $response->getBody();
    }

    public function multipart() {
        $postdata = array(
            'item' => 'bubbletea',
            'quantity'=>5,
            'price'=>5
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080/server/work');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }

    public function xml() {
        $input_data = '<order> 
                <item>bubbletea</item> 
                <quantity>2</quantity> 
                <price>3</price> 
              </order>';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "8080",
            CURLOPT_URL => "http://localhost:8080/server/work",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $input_data,
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/xml"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }


    }
    //--------------------------------------------------------------------

}


