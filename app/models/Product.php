<?php

class Product extends Model
{
    protected $table = "products";

    /** Lấy tất cả sản phẩm */
    public function getAll()
    {
        $sql = "SELECT p.*, c.categoryname 
                FROM products p
                LEFT JOIN categories c ON p.categoryid = c.id
                ORDER BY p.id DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Lấy sản phẩm nổi bật cho trang chủ */
    public function getHotProducts($limit = 8)
    {
        $sql = "SELECT p.*, c.categoryname 
                FROM products p
                LEFT JOIN categories c ON p.categoryid = c.id
                WHERE p.status = 1
                ORDER BY p.id DESC
                LIMIT ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Lấy theo id */
    public function find($id)
    {
        $sql = "SELECT p.*, c.categoryname
                FROM products p
                LEFT JOIN categories c ON p.categoryid = c.id
                WHERE p.id = ? LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Hàm tương thích controller cũ */
    public function getById($id)
    {
        return $this->find($id);
    }

    /** Thêm sản phẩm */
    public function create($data)
    {
        $sql = "INSERT INTO products 
                (productname, price, quantity, categoryid, description,detail, image, status)
                VALUES (?, ?, ?, ?, ?, ?, ?,?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data["productname"],
            $data["price"],
            $data["quantity"],
            $data["categoryid"],
            $data["description"],
            $data["detail"],
            $data["image"],
            $data["status"]
        ]);
    }

    /** Sửa sản phẩm */
    public function update($id, $data)
    {
        $sql = "UPDATE products SET
                    productname = ?, 
                    price       = ?, 
                    quantity    = ?, 
                    categoryid  = ?, 
                    description = ?,
                    detail = ?, 
                    image       = ?, 
                    status      = ?
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data["productname"],
            $data["price"],
            $data["quantity"],
            $data["categoryid"],
            $data["description"],
            $data["detail"],
            $data["image"],
            $data["status"],
            $id
        ]);
    }

    /** Xoá sản phẩm */
    public function deleteById($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /** Lọc sản phẩm */
    public function getFilteredProducts($filters)
    {
        $sql = "SELECT p.*, c.categoryname
                FROM products p
                JOIN categories c ON p.categoryid = c.id
                WHERE 1 ";

        $params = [];

        if (!empty($filters['keyword'])) {
            $sql .= "AND p.productname LIKE ? ";
            $params[] = "%".$filters['keyword']."%";
        }

        if (!empty($filters['categoryid'])) {
            $sql .= "AND p.categoryid = ? ";
            $params[] = $filters['categoryid'];
        }

        if (!empty($filters['min_price'])) {
            $sql .= "AND p.price >= ? ";
            $params[] = $filters['min_price'];
        }

        if (!empty($filters['max_price'])) {
            $sql .= "AND p.price <= ? ";
            $params[] = $filters['max_price'];
        }

        $sql .= " ORDER BY p.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        /**
     * Lấy sản phẩm có giá sau giảm
     */
    public function getProductsWithDiscount()
    {
        $sql = "SELECT 
                    p.*,
                    c.categoryname,
                    CASE 
                        WHEN p.discount > 0 
                        THEN p.price - (p.price * p.discount / 100)
                        ELSE p.price
                    END AS final_price
                FROM products p
                LEFT JOIN categories c ON p.categoryid = c.id
                WHERE p.status = 1
                ORDER BY p.id DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

}
