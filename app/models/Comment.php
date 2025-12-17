<?php
// app/models/Comment.php

class Comment extends Model
{
    public function getByProduct($productId)
    {
        $sql = "SELECT c.*, u.fullname
                FROM comments c
                JOIN users u ON c.userid = u.id
                WHERE c.productid = :pid
                ORDER BY c.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['pid' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($productId, $userId, $content, $rate = 5)
    {
        $sql = "INSERT INTO comments (productid, userid, content, rate)
                VALUES (:pid, :uid, :content, :rate)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'pid' => $productId,
            'uid' => $userId,
            'content' => $content,
            'rate' => $rate
        ]);
    }
}
