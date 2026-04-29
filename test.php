<?php


/*

 */


$orders = [
    ["customer_id" => 101, "total" => 100],
    ["customer_id" => null, "total" => 150],   // inválido
    ["customer_id" => 102, "total" => -200],   // inválido
    ["customer_id" => 103, "total" => 0],      // inválido
    ["customer_id" => 101, "total" => 50],
];

interface ValidatorInterface{
    public function isValid(array $order): bool;
}

class OrderValidator implements ValidatorInterface{

    public function isValid(array $order): bool{
        if(!isset($order["customer_id" ],$order["total" ])){
            return false;
        }
        if($order["customer_id"] === null){
            return false;
        }
        if($order["total"] <= 0){
            return false;
        }
        return true;
    }
}

class OrderService{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator) {
        $this->validator = $validator;
    }

    public function getOrder(array $orders): array{
        $result=[];

        foreach($orders as $order){
            $isValid = $this->validator->isValid($order);
            if($isValid){
                $customer = $order["customer_id"];
                $total = $order["total"];

                if(!isset($result[$customer])){
                    $result[$customer] = 0;
                }
                $result[$customer] += $total;
            }
        }
        
        return $result;
    }
}

$validator = new OrderValidator();
$service = new OrderService($validator);
Print_r($service->getOrder($orders));
echo("\n");