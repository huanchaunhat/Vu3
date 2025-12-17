<?php
// app/models/OrderDetail.php

class OrderDetail extends Model
{
    public function addItem($orderId, $productId, $quantity, $price)
    {
        $total = $quantity * $price;
        $sql = "INSERT INTO orderdetails (orderid, productid, quantity, price, total)
                VALUES (:orderid, :productid, :quantity, :price, :total)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'orderid' => $orderId,
            'productid' => $productId,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $total
        ]);
    }
}
