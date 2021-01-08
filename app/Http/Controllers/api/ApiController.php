<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Disburse;
use Response;
use Illuminate\Cache\RateLimiter;
use Exception;
use Carbon;

class ApiController extends Controller
{

     public function update(Request $request){

        $limiter = app(RateLimiter::class);
        $actionKey = 'get_status_disburse';
        $threshold = 5;


        try{
          if ($limiter->tooManyAttempts($actionKey, $threshold)) {
                return $this->failOrFallback();
            }


          $response = Http::timeout(3)->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded'
          ])->withBasicAuth('HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41','')
            ->asForm()->get(
            'https://nextar.flip.id/disburse/'.$request->transaction_id
          );


           $data = $response->json();
           if($data){
               if(isset($data['errors'])){
                  $errors = '';
                   foreach($data['errors'] as $val){
                      $errors .= $val['message'];
                   }
                   return Response::json(
                    array(
                        'error' => ["message"=>$errors]
                    ), 200
                );   
              }else{


                 $disburse =  Disburse::where('transaction_id', $request->transaction_id)->first();
                 $disburse->updated_at =  $data['timestamp'];
                 $disburse->receipt = $data['receipt'];
                 $disburse->status = $data['status'];
                 $disburse->time_served = $data['time_served'];
    
                 $result = $disburse->update();

                 if($result){
                   return Response::json(
                    array(
                        'success' => 'true',
                        'message' => 'Data has been updated succesfully'
                    ), 200);
                 }else{
                    return Response::json(
                    array(
                        'success' => 'false',
                        'message' => 'Data failed to submitted'
                    ), 200);  
                 }

              }

           }

        }catch(Exception $exception){
             $limiter->hit($actionKey, Carbon::now()->addMinutes(15));
            return $this->failOrFallback();

        }

      

  

     }

     public function store(Request $request){

        $limiter = app(RateLimiter::class);
        $actionKey = 'post_disburse';
        $threshold = 5;

          try{  

                $response = Http::timeout(3)->withHeaders([
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ])->withBasicAuth('HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41','')
                  ->asForm()->post(
                  'https://nextar.flip.id/disburse',[
                    'bank_code'=> $request->bank_code,
                    'account_number'=>$request->account_number,
                            'amount'=>$request->amount,
                            'remark'=>$request->remark
                  ]

                );

                $data = $response->json();
                if($data){
                    if(isset($data['errors'])){
                        $errors = '';
                         foreach($data['errors'] as $val){
                            $errors .= $val['message'];
                         }
                         return Response::json(
                          array(
                              'error' => ["message"=>$errors]
                          ), 200
                      );   
                    }else{
                       $disburse = new Disburse();
                       $disburse->bank_code = $data['bank_code'];
                       $disburse->account_number = $data['account_number'];
                       $disburse->transaction_id = $data['id'];
                       $disburse->beneficiary_name = $data['beneficiary_name'];
                       $disburse->created_at =  $data['timestamp'];
                       $disburse->remark = $data['remark'];
                       $disburse->amount = $data['amount'];
                       $disburse->receipt = $data['receipt'];
                       $disburse->status = $data['status'];

                       if($data['time_served'] != '0000-00-00 00:00:00'){
                          $disburse->time_served = $data['time_served'];
                       }
                       $disburse->fee = $data['fee'];
                       $result = $disburse->save();

                       if($result){
                         return Response::json(
                          array(
                              'success' => 'true',
                              'message' => 'Data has been submitted succesfully'
                          ), 200);
                       }else{
                          return Response::json(
                          array(
                              'success' => 'false',
                              'message' => 'Data failed to submitted'
                          ), 200);  
                       }

                    }
                }else{
            
                       return Response::json(
                          array(
                              'error' => ["message"=>$response->getReasonPhrase()]
                          ), $response->getStatusCode());

                }

          }catch(Exception $exception){
                $limiter->hit($actionKey, Carbon::now()->addMinutes(15));
                return $this->failOrFallback();

          }

     
     

     }

}