<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Transbank
session_start();
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\RedirectorHelper;

class WebPayController extends Controller
{
    public function index(){
        return view('prueba');
    }

    public function redirect(){

        $bag = CertificationBagFactory::integrationWebpayNormal();
        $plus = TransbankServiceFactory::normal($bag);
        $plus->addTransactionDetail(10000, 'Orden824201');
    
        $response = $plus->initTransaction('http://localhost:8000/response', 'http://localhost:8000/finish');
        
        //Asociar transacción con el token $response->token...... Guardarla en la DB o algo

        return RedirectorHelper::redirectHTML($response->url, $response->token); 
    }

    public function response(Request $request){
        $bag = CertificationBagFactory::integrationWebpayNormal();
        $plus = TransbankServiceFactory::normal($bag);

        $response = $plus->getTransactionResult();

        //Guardar el token en variable sesión, mas tarde mover a base de datos
        $_SESSION['responseCode'] = $response->detailOutput->responseCode;

        if($response->detailOutput->responseCode == 0){
            //echo 'Transacción aprobada';
            //Guardar resultado en base de datos
        }
        else{
            //Marcar orden en base de datos como rechazada
        }

        $plus->acknowledgeTransaction();
        return RedirectorHelper::redirectBackNormal($response->urlRedirection);
    }

    public function finish(){
        //Obtener la transacción que tenga el token $_POST['tokenw_ws'] asociado.
        if($_SESSION['responseCode'] == '0'){
            echo 'Gracias por su compra';
            return;
        } 
        echo 'Su compra falló';
    }
}
