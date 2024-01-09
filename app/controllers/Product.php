<?php
class Product extends BaseController

{
    public $model;
    public $productData = [];

    public function __construct()
    {
        $this->model = $this->model('ProductModel');
    }

    public function a()
    {
        $data = $this->model('ProductModel');
        $dataProduct = $data->getProductFilter($_POST['minimum-price'], $_POST['maximum-price'], $_POST['arrange'], $_POST['category']);
        echo $dataProduct;
    }

    public function index()
    {
        $data = $this->model('ProductModel');
        $categories = $data->getCategory();
        $dataProduct = null;
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['search-product'])) {
            if (isset($_POST['search-button'])) {
                $dataProduct = $data->getProductSearch($_POST['search-product'], $_SESSION['pageStart'] = 0);
                $dataProductList = $dataProduct;
            }
        } elseif (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['category_id'])) {
            $dataProduct = $data->getListProductsbyCategory($_POST['category_id']);
            $dataProductList = $dataProduct;
        } elseif (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['product-filter'])) {

            $dataProduct = $data->getProductFilter($_POST['minimum-price'], $_POST['maximum-price'], $_POST['arrange'], $_POST['category']);
            $dataProductList = $dataProduct;
        } elseif (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['group_by'])) {
            $dataProduct = $data->getListProductgroupby($_POST['group_by']);
            $dataProductList = $dataProduct;
        } else {
            $dataProductList = $data->getListProducts();
            $dataProduct = $data->getProductPage($_SESSION['pageStart'] = 0);
        }

        // xử lý phần chuyển trang là của mặc định hay là tìm kiếm, bộ lọc...


        if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['submit-page_start'])) {
            $dataProduct = $data->getProductPage($_POST['pageStart']);
            $_SESSION['pageStart'] = $_POST['pageStart'];
        }

        $countProduct = 0;
        foreach ($dataProduct as $product) {
            $countProduct++;
        }

        $title = 'Products';
        $this->productData['page_title'] = $title;
        $this->productData['content'] = 'clients/products/index';

        $this->productData['sub_content']['product_list'] = $dataProduct;
        $this->productData['sub_content']['all_product'] = $dataProductList;
        $this->productData['sub_content']['count'] = $countProduct;
        $this->productData['sub_content']['categories_list'] = $categories;

        // goi ra views
        $this->render('clients/layouts/clientLayout', $this->productData);
    }


    public function product_detail()
    {

        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $id = $_POST['product_id'];
            $data = $this->model('ProductModel');
            $this->model = $this->model('FeedbackModel');
            $dataFeedback = $this->model('FeedbackModel');
            $listFeedback = $dataFeedback->getFeedbacksForProductDetail($id);

            $dataProduct = $data->getProductDetail($id);
            $dataVariation = $data->getVariations($id);
            $title = 'Product detail';
            $this->productData['page_title'] = $title;
            $this->productData['content'] = 'clients/products/product_detail';

            $this->productData['sub_content']['product_detail'] = $dataProduct;
            $this->productData['sub_content']['variations_list'] = $dataVariation;
            $this->productData['sub_content']['feedbacks_list'] = $listFeedback;

            // goi ra views
            $this->render('clients/layouts/clientLayout', $this->productData);
        } // tao bien de lay du lieu tu model

    }
}
