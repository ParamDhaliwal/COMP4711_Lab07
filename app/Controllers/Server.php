<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Server extends Controller
{
    public function work()
    {
        $contenttype = $_SERVER['CONTENT_TYPE'];
        echo $contenttype . "<br>";
        if(strcmp($contenttype, "application/json") == 0) {
            $json = json_decode(file_get_contents('php://input'), true);
            echo json_encode($json). "<br>";
            $total = $json["price"] * $json["quantity"];
            echo 'Total price = ' . $total;
        }
        if(strcmp($contenttype, "application/x-www-form-urlencoded") == 0) {
            echo $this->request->getBody() . "<br>";
            $total = $_POST['quantity'] * $_POST['price'];
            echo 'Total price = ' . $total;
        }
        if(strcmp($contenttype, "application/xml") == 0) {
            $xml = new \SimpleXMLElement($this->request->getBody());
            echo $xml->asXML() . "<br>";
            $total = $xml->quantity * $xml->price;
            echo 'Total price = ' . $total;

        }
        if(strpos($contenttype, "ultipart") > 0) {
            echo json_encode($_POST) . "<br>";
            $total = $_POST['quantity'] * $_POST['price'];
            echo 'Total price = ' . $total;
        }

    }
}