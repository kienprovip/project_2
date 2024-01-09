<?php
class AboutUs extends BaseController
{
    public $AboutUsData = [];

    public function index()
    {

        $title = 'AboutUs';
        $this->AboutUsData['page_title'] = $title;
        
        $this->AboutUsData['content'] = 'clients/aboutUs/index';

        $this->AboutUsData['sub_content'][] = null;

        // goi ra views
        $this->render('clients/layouts/clientLayout', $this->AboutUsData);
    }
}
