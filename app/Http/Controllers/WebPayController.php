<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transaction;
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\RedirectorHelper;

class WebPayController extends Controller
{

    public function index(){
        return view('prueba');
    }

    public function redirect(Request $request){
        //Detalles de transacción
        $amount = $request->total;
        $buyOrder = rand(1, 100000);

        //Manejo de certificados y envio de total y orden de compra
        $bag = CertificationBagFactory::integrationWebpayNormal();
        $plus = TransbankServiceFactory::normal($bag);
        $plus->addTransactionDetail($amount, $buyOrder);
        
        //Links de respuesta
        $response = $plus->initTransaction('http://localhost:8000/response', 'http://localhost:8000/finish');

        //Se comienza la operación ingresando la orden de compra, monto y token. 
        //Este ultimo se mantiene durante todo el proceso
        
        //Guardado de datos en la db
        $initTransactionData = new Transaction;
        $initTransactionData->buyorder = $buyOrder;
        $initTransactionData->ammount = $amount;
        $initTransactionData->transactiontoken = $response->token;
        $initTransactionData->save();

        //Respuesta modo json a vuejs. Link y token
        //Vue maneja esto por su parte con un formulario
        return response()->json([
            'url' => $response->url,
            'token' => $response->token,
        ]);
    }

    public function response(Request $request){
        //Certificados 
        //ESTO DEBE SOLUCIONARSE
        $bag = CertificationBagFactory::integrationWebpayNormal();
        $plus = TransbankServiceFactory::normal($bag);

        //Resultado de la respuesta
        $response = $plus->getTransactionResult();
 
        //Si la respuesta es 0 la transacción fue aprovada
        if($response->detailOutput->responseCode == 0){
            
            //Actualización de datos en la db correspondientes a la orden de compra
            //Se guardan para su posterior visualización
            $transactionData = Transaction::where('buyorder', $response->detailOutput->buyOrder)
                ->update(array(
                    'authorizationcode' => $response->detailOutput->authorizationCode,
                    'payment' => $response->detailOutput->paymentTypeCode,
                    'approved' => $response->detailOutput->responseCode,
                    'ammount' => $response->detailOutput->amount
                ));
        } else{
            //En caso de no ser aprobada se guardan con otro valor
            $transactionData = Transaction::where('buyorder', $response->detailOutput->buyOrder)
                ->update(array(
                    'authorizationcode' => $response->detailOutput->authorizationCode,
                    'payment' => $response->detailOutput->paymentTypeCode,
                    'approved' => $response->detailOutput->responseCode,
                    'ammount' => $response->detailOutput->amount
                ));
        }
        
        //Se confirma la respuesta y redirige
        $plus->acknowledgeTransaction();
        return RedirectorHelper::redirectBackNormal($response->urlRedirection);
    }

    public function finish(){
        //Se busca si la transacción fue aceptada en la db, esto en base al token 
        //Este token se mantiene siempre
        $approved = Transaction::where('transactiontoken', $_POST['token_ws'])->value('approved');

        //Si es 0 se prodece a una respuesta positiva
        if($approved == '0'){
            echo 'Gracias por su compra';
            return;
        } 
        //En caso contrario se da respuesta fallida
        echo 'Su compra falló';
    }
}
