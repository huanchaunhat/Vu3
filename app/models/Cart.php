<?php
// app/models/Cart.php

class Cart extends Model
{
    /** Thêm vào giỏ */
    public function add($userId, $productId, $qty = 1)
    {
        $sql = "SELECT * FROM carts WHERE userid = :uid AND productid = :pid";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['uid' => $userId, 'pid' => $productId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $sql = "UPDATE carts 
                    SET quantity = quantity + :qty
                    WHERE userid = :uid AND productid = :pid";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'qty' => $qty,
                'uid' => $userId,
                'pid' => $productId
            ]);
        }

        $sql = "INSERT INTO carts (userid, productid, quantity)
                VALUES (:uid, :pid, :qty)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'uid' => $userId,
            'pid' => $productId,
            'qty' => $qty
        ]);
    }

    /** LẤY GIỎ HÀNG – TÍNH GIÁ SAU GIẢM */
    public function getItems($userId)
    {
        $sql = "
            SELECT 
                c.productid,
                c.quantity,
                p.productname,
                p.image,
                p.price AS original_price,
                p.discount,
                -- giá sau giảm
                ROUND(
                    p.price - (p.price * IFNULL(p.discount, 0) / 100),
                    0
                ) AS price
            FROM carts c
            JOIN products p ON c.productid = p.id
            WHERE c.userid = :uid
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Cập nhật số lượng */
    public function updateQty($userId, $productId, $qty)
    {
        $stmt = $this->db->prepare("
            UPDATE carts
            SET quantity = :qty
            WHERE userid = :uid AND productid = :pid
        ");
        return $stmt->execute([
            'qty' => max(1, $qty),
            'uid' => $userId,
            'pid' => $productId
        ]);
    }

    /** Xóa sản phẩm */
    public function removeItem($userId, $productId)
    {
        $stmt = $this->db->prepare("
            DELETE FROM carts
            WHERE userid = :uid AND productid = :pid
        ");
        return $stmt->execute([
            'uid' => $userId,
            'pid' => $productId
        ]);
    }

    /** Xóa toàn bộ giỏ */
    public function clear($userId)
    {
        $stmt = $this->db->prepare("
            DELETE FROM carts WHERE userid = :uid
        ");
        return $stmt->execute(['uid' => $userId]);
    }
}
