<?php

// Ke thua tu class Model
class ProductsModel extends Model
{
    protected $table = '';
    protected $lastId = 0;

    public function getCategories()
    {
        $this->table = 'categories';
        $data = $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }



    public function getListProduct()
    {
        $this->table = 'products';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_status != -1")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function GetProductID($productId)
    {
        $this->table = 'products';
        // Use prepared statements to prevent SQL injection
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_id = $productId")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function GetVariation($productId)
    {
        $this->table = 'variations';
        $data = $this->db->query("SELECT * FROM $this->table WHERE product_id = $productId")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function UpdateProduct($productData, $id)
    {
        $this->table = 'products';
        $data = [
            'product_id' => $productData['product_id'],
            'product_image' => $productData['productimage'],
            'product_name' => $productData['productname'],
            'product_cost' => $productData['productcost'],
            'product_current_price' => $productData['productcurrentprice'],
            'product_discount_percent' => $productData['productdiscountpercent'],
            'product_discount_price' => $productData['product_discount_price'],
            'product_thumbnail1' => $productData['product_thumbnail1'],
            'product_thumbnail2' => $productData['product_thumbnail2'],
            'product_thumbnail3' => $productData['product_thumbnail3'],
            'product_describe' => $productData['product_describe'],
            'product_status' => 1,
            'product_quantity' => $productData['product_quantity']
        ];

        $condition = 'product_id =' . $id;



        $status = $this->db->update($this->table, $data, $condition);
        if ($status) {
            return true;
        }

        return false;
    }
    public function UpdateVariation($variationData, $count, $idV)
    {
        $this->table = 'variations';
        $data = [];

        for ($i = 1; $i <= $count; $i++) {
            $data = [
                'color_name' => $variationData[$i]['colorname' . $i],
                'size_name' => $variationData[$i]['sizename' . $i],
                'variation_quantity' => $variationData[$i]['variationquantity' . $i],
            ];
            $condition[$i] = 'variation_id = ' . $idV[$i];
            $UpdateV[$i] = $this->db->update($this->table, $data, $condition[$i]);

            if (!$UpdateV[$i]) {
                return false; // If any variation fails to update, return false immediately.
            }
        }

        return true; // Return true only if all variations are updated successfully.
    }
    public function InsertVariation($InsertVData, $countAddVariation)
    {
        $this->table = 'variations';
        $data = [];

        for ($i = 0; $i < $countAddVariation; $i++) {
            if (
                !empty($InsertVData[$i]['Icolorname' . ($i + 1)]) &&
                !empty($InsertVData[$i]['Isizename' . ($i + 1)]) &&
                !empty($InsertVData[$i]['Ivariationquantity' . ($i + 1)])
            ) {
                $data = [
                    'product_id' => $InsertVData[$i]['product_id'],
                    'color_name' => $InsertVData[$i]['Icolorname' . ($i + 1)],
                    'size_name'  => $InsertVData[$i]['Isizename' . ($i + 1)],
                    'variation_quantity' => $InsertVData[$i]['Ivariationquantity' . ($i + 1)],
                    'variation_status' => $InsertVData[$i]['Ivariation_status' . ($i + 1)],
                ];

                $InsertV[] = $this->db->insert($this->table, $data);

                if (!$InsertV[$i]) {
                    return false;
                }
            }
        }

        return true;
    }
    public function DeleteProduct($id)
    {
        $this->table = 'products';
        $data = [
            'product_status' => -1
        ];
        $condition = 'product_id=' . $id;
        $DeleteP = $this->db->update($this->table, $data, $condition);
        if (!$DeleteP) {
            return false;
        }
        return true;
    }

    public function deleteVariations($id)
    {
        $this->table = 'variations';
        $data = [
            'variation_status' => -1
        ];
        $condition = 'product_id = ' . $id;
        $status = $this->db->update($this->table, $data, $condition);
        if (!$status) {
            return false;
        }
        return true;
    }
    public function GetVariationID($id)
    {
        $this->table = 'variations';
        $VariationID = $this->db->query("SELECT * FROM $this->table WHERE product_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $VariationID;
    }
    public function UpdateQuantityVariation($UpdateV, $variationId)
    {
        $this->table = 'variations';
        $data = [
            'variation_quantity'  => $UpdateV['Ivariation_quantity']
        ];

        $condition = 'variation_id = ' . $variationId;
        $ADDVariationQuantity = $this->db->update($this->table, $data, $condition);
        if (!$ADDVariationQuantity) {
            return false;
        }
        return true;
    }



    public function addProduct($productData)
    {
        $this->table = 'products';

        // Assuming $productData is an array containing the data you want to insert
        $data = [
            'category_id' => $productData['categoryid'],
            'product_cost' => $productData['productcost'],
            'product_current_price' => $productData['productcost'],
            'product_discount_price' => 0,
            'product_discount_percent' => 0,
            'product_quantity' => $productData['productquantity'],
            'product_name' => $productData['productname'],
            'product_image' => $productData['productimage'],
            'product_thumbnail1' => $productData['productthumbnail1'],
            'product_thumbnail2' => $productData['productthumbnail2'],
            'product_thumbnail3' => $productData['productthumbnail3'],
            'product_describe' => $productData['productdescribe'],
            'product_date' => $productData['productdate'],
            'product_sold' => 0,
            'product_status' => $productData['productstatus'],
        ];

        $status = $this->db->insert($this->table, $data);

        $this->lastId = $this->db->lastInsertId();



        if ($status) {
            return true;
        }

        return false;
    }


    public function addVariation($variationData)
    {
        $this->table = 'variations';
        $countVariation = 0;
        for ($i = 1; $i <= $_SESSION['variation_quantity']; $i++) {
            if (!empty($variationData)) {
                if (!empty($variationData[$i]['colorname' . $i]) && !empty($variationData[$i]['sizename' . $i]) && !empty($variationData[$i]['variationquantity' . $i])) {
                    $data = [
                        'product_id' => $this->lastId,
                        'color_name' => $variationData[$i]['colorname' . $i],
                        'size_name' => $variationData[$i]['sizename' . $i],
                        'variation_quantity' => $variationData[$i]['variationquantity' . $i],
                        'variation_status' => 1
                    ];
                    $countVariation += $variationData[$i]['variationquantity' . $i];
                    $statusV = $this->db->insert($this->table, $data);
                    if (!$statusV) {
                        return false;
                    }
                }
            }
        }

        return true; // Return true only if all variations are inserted successfully.
    }
}
