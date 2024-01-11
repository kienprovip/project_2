<?php
class Home extends BaseController

{

    public $model;
    private $homeData = [];

    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }
    public function index()
    {
        $data = $this->model('HomeModel');

        $dataCategory = $data->getCategory();

        $dataFeatureProducts = $data->getFeatureProduct();

        $dataFlashSales = $data->getFlashSales();
        $title = 'Home';
        $this->homeData['page_title'] = $title;
        $this->homeData['content'] = 'clients/home/index';

        $this->homeData['sub_content']['category_list'] = $dataCategory;
        $this->homeData['sub_content']['featureProductList'] = $dataFeatureProducts;
        $this->homeData['sub_content']['flashSaleList'] = $dataFlashSales;

        // goi ra views
        $this->render('clients/layouts/clientLayout', $this->homeData);
    }

    public function searchByCategoryName()
    {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $category_id = $_POST['category_id'];
        }
    }
}
