<?php
// app/models/Category.php

class Category extends Model
{
    protected $table = 'categories';

    public function getAll()
    {
        $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY categoryname ASC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAdmin()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO categories (categoryname, description, status)
                                    VALUES (:name, :description, :status)");
        return $stmt->execute([
            'name' => $data['categoryname'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? 1
        ]);
    }

    public function updateCategory($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE categories
                                    SET categoryname = :name,
                                        description = :description,
                                        status = :status
                                    WHERE id = :id");
        return $stmt->execute([
            'name' => $data['categoryname'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? 1,
            'id' => $id
        ]);
    }

    public function deleteCategory($id)
    {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
