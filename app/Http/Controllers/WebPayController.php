<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Transbank
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\RedirectorHelper;

class WebPayController extends Controller
{
    public function index(){
        return view('prueba');
    }

    public function pay(Request $request){
        $bag = CertificationBagFactory::integrationWebpayNormal();
        $plus = TransbankServiceFactory::normal($bag);
        $plus->addTransactionDetail(10000, 'Orden824201');

        $response = $plus->initTransaction('http://localhost:8000/prueba', 'http://localhost:8000/prueba');
    }
}
