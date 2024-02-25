<?php

namespace app\controllers;

class ProductController extends \yii\rest\Controller
{
    private $products = [
        ['id' => 1, 'name' => 'Electronic Device', 'reference' => 'ABC123', 'category' => 'Electronics', 'color' => 'Silver'],
        ['id' => 2, 'name' => 'Casual T-shirt', 'reference' => 'DEF456', 'category' => 'Clothing', 'color' => 'Blue'],
        ['id' => 3, 'name' => 'Running Shoes', 'reference' => 'GHI789', 'category' => 'Footwear', 'color' => 'Red'],
        ['id' => 4, 'name' => 'Coffee Maker', 'reference' => 'JKL012', 'category' => 'Electronics', 'color' => 'Black'],
        ['id' => 5, 'name' => 'Smart Watch', 'reference' => 'MNO345', 'category' => 'Electronics', 'color' => 'Black'],
        ['id' => 6, 'name' => 'Leather Wallet', 'reference' => 'PQR678', 'category' => 'Accessories', 'color' => 'Brown'],
        ['id' => 7, 'name' => 'Sunglasses', 'reference' => 'STU901', 'category' => 'Accessories', 'color' => 'Black'],
        ['id' => 8, 'name' => 'Electronic Device', 'reference' => 'ABC123', 'category' => 'Electronics', 'color' => 'Black'],
        ['id' => 9, 'name' => 'Casual T-shirt', 'reference' => 'DEF456', 'category' => 'Clothing', 'color' => 'Black'],
        ['id' => 10, 'name' => 'Running Shoes', 'reference' => 'GHI789', 'category' => 'Footwear', 'color' => 'White'],
        ['id' => 11, 'name' => 'Coffee Maker', 'reference' => 'JKL012', 'category' => 'Electronics', 'color' => 'Silver'],
        ['id' => 12, 'name' => 'Smart Watch', 'reference' => 'MNO345', 'category' => 'Electronics', 'color' => 'Silver'],
        ['id' => 13, 'name' => 'Leather Wallet', 'reference' => 'PQR678', 'category' => 'Accessories', 'color' => 'Black'],
        ['id' => 14, 'name' => 'Sunglasses', 'reference' => 'STU901', 'category' => 'Accessories', 'color' => 'Blue'],
        ['id' => 15, 'name' => 'Electronic Device', 'reference' => 'ABC123', 'category' => 'Electronics', 'color' => 'Red'],
        ['id' => 16, 'name' => 'Casual T-shirt', 'reference' => 'DEF456', 'category' => 'Clothing', 'color' => 'Gray'],
        ['id' => 17, 'name' => 'Running Shoes', 'reference' => 'GHI789', 'category' => 'Footwear', 'color' => 'Brown'],
        ['id' => 18, 'name' => 'Coffee Maker', 'reference' => 'JKL012', 'category' => 'Electronics', 'color' => 'White'],
        ['id' => 19, 'name' => 'Smart Watch', 'reference' => 'MNO345', 'category' => 'Electronics', 'color' => 'Gold'],
        ['id' => 20, 'name' => 'Leather Wallet', 'reference' => 'PQR678', 'category' => 'Accessories', 'color' => 'Tan'],
    ];    

    public function actionAllproducts()
    {
        $saved = [];
        foreach ($this->products as $product) {
            $index = $this->indexOf($product,$saved);
            if($index != -1 ){
                $saved[$index]['color'][]=$product['color'];
            }else{
                $saved[] = [
                    'reference' => $product['reference'],
                    'name' => $product['name'],
                    'category' => $product['category'],
                    'color'=>[$product['color']]
                ];
            }
        }
        return $saved;
    }

    private function indexOf($product,$array){
        for ($i=0; $i < count($array); $i++) { 
            if($product['reference'] == $array[$i]['reference']){
                return $i;
            }
        }
        return -1;
    }
}
