<?php
// app/models/Order.php

class Order extends Model
{
    public function createOrder($userId, $address, $total, $note = null)
    {
        $sql = "INSERT INTO orders (userid, address, total, note, status)
                VALUES (:userid, :address, :total, :note, 'processing')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'userid' => $userId,
            'address' => $address,
            'total' => $total,
            'note' => $note
        ]);
        return $this->db->lastInsertId();
    }

    public function getAll()
    {
        $sql = "SELECT o.*, u.fullname
                FROM orders o
                JOIN users u ON o.userid = u.id
                ORDER BY o.id DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT o.*, u.fullname, u.email
                FROM orders o
                JOIN users u ON o.userid = u.id
                WHERE o.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE orders SET status = :status WHERE id = :id");
        return $stmt->execute([
            'status' => $status,
            'id' => $id
        ]);
    }

    public function getOrderDetails($orderId)
    {
        $sql = "SELECT od.*, p.productname
                FROM orderdetails od
                JOIN products p ON od.productid = p.id
                WHERE od.orderid = :orderid";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['orderid' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
