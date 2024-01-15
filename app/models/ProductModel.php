<?php
class ProductModel extends Model
{
    protected $table = '';
    public function getListProducts()
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_status = 1")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getProductPage($pageStart)
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_status = 1 LIMIT $pageStart, 12")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getListProductsbyCategory($id)
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_status = 1 AND category_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getProductToUpdate($id)
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getCategory()
    {
        $this->table = 'categories';
        $data = $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getProductSearch($keyword, $pageStart)
    {
        if ($pageStart !== '') {
            $this->table = 'products';
            $data = $this->db->query("SELECT * FROM $this->table WHERE " . strtolower('product_name') . "  LIKE '%" . strtolower($keyword) . "%' AND product_status = 1 LIMIT $pageStart, 12")->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } else {
            $this->table = 'products';
            $data = $this->db->query("SELECT * FROM $this->table WHERE " . strtolower('product_name') . "  LIKE '%" . strtolower($keyword) . "%' AND product_status = 1")->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    public function getProductFilter($minPrice, $maxPrice, $arrange, $category)
    {
        $this->table = 'products';
        $conditionPrice = null;
        $conditionArrange = null;
        $conditionCategory =  null;

        if ($minPrice === '' && $maxPrice !== '') {
            $conditionPrice = ' AND product_current_price <= ' . $maxPrice;
        } elseif ($minPrice !== '' && $maxPrice === '') {
            $conditionPrice = ' AND product_current_price >= ' . $minPrice;
        } elseif ($minPrice === '' && $maxPrice === '') {
            $conditionPrice = null;
        } else {
            $conditionPrice = ' AND product_current_price >= ' . $minPrice . ' AND product_current_price <= ' . $maxPrice;
        }

        if ($arrange === 'product_date') {
            $conditionArrange = ' ORDER BY product_date DESC';
        } elseif ($arrange === 'product_sold') {
            $conditionArrange = ' ORDER BY product_sold DESC';
        } elseif ($arrange === 'cheapest') {
            $conditionArrange = ' ORDER BY product_current_price ASC';
        } elseif ($arrange === 'the-most_expensive') {
            $conditionArrange = ' ORDER BY product_current_price DESC';
        } elseif ($arrange === 'biggest-discount') {
            $conditionArrange = ' ORDER BY product_current_price DESC';
        }

        if ($category !== '0') {
            $conditionCategory = ' AND category_id = ' . $category;
        } else {
            $conditionCategory = null;
        }

        $data = $this->db->query("SELECT * FROM $this->table WHERE product_status = 1 $conditionPrice $conditionCategory $conditionArrange")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function getProductDetail($id)
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT a.product_date, b.variation_quantity, b.variation_id, b.product_id, b.variation_status, a.product_id, a.category_id, a.product_image, a.product_name, a.product_cost, a.product_discount_price, a. product_discount_percent, a.product_current_price, a.product_quantity, a.product_thumbnail1, a.product_thumbnail2, a.product_thumbnail3, a.product_describe, a.product_status, a.product_sold, GROUP_CONCAT(DISTINCT b.color_name) AS colors, GROUP_CONCAT(DISTINCT b.size_name) AS sizes FROM $this->table a INNER JOIN variations b ON a.product_id = b.product_id WHERE a.product_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function updateProductFromCart($quantity, $id)
    {
        $this->table = 'products';
        $condition = 'product_id = ' . $id;
        $dataUpdate = [
            'product_quantity' => $quantity['productquantity'],
            'product_status' => $quantity['productstatus'],
        ];
        $status = $this->db->update($this->table, $dataUpdate, $condition);
        if ($status) {
            return true;
        }
        return false;
    }

    public function updateProduct($data, $id)
    {
        $this->table = 'products';
        $condition = 'product_id = ' . $id;
        $dataUpdate = [
            'product_quantity' => $data['productquantity'],
            'product_sold' => $data['productsold'],
            'product_status' => $data['productstatus'],
        ];
        $status = $this->db->update($this->table, $dataUpdate, $condition);
        if ($status) {
            return true;
        }
        return false;
    }



    public function getVariationId($id, $color, $size)
    {
        $this->table = 'variations';
        $data = $this->db->query("SELECT variation_id FROM $this->table WHERE product_id = $id AND color_name = '$color' AND size_name = '$size'")->fetchColumn();
        return $data;
    }

    public function getListProductgroupby($groupby)
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_status = 1 ORDER BY ($groupby) DESC")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function updateVariation($data, $id)
    {
        $this->table = 'variations';
        $condition = 'variation_id = ' . $id;
        $dataUpdate = [
            'variation_quantity' => $data['variationquantity'],
            'variation_status' => $data['variationstatus'],
        ];

        $status = $this->db->update($this->table, $dataUpdate, $condition);
        if ($status) {
            return true;
        }
        return false;
    }


    // lấy ra bên product detail
    public function getVariations($id)
    {
        $this->table = 'variations';
        $data = $this->db->query("SELECT variation_id, color_name, size_name, variation_quantity FROM $this->table WHERE product_id = $id AND variation_status != -1")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getVariationQuantity($id)
    {
        $this->table = 'variations';
        $data = $this->db->query("SELECT color_name, size_name, variation_quantity FROM $this->table WHERE variation_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function addProductSold($dataAdd, $id)
    {
        $this->table = 'products';
        $condition = 'product_id = ' . $id;
        $data = [
            'product_sold' => $dataAdd['productsold']
        ];
        $status = $this->db->update($this->table, $data, $condition);
        if (!$status) {
            return false;
        }
        return true;
    }
}
