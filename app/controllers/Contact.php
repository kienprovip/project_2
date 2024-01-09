<?php
class Contact extends BaseController
{
    private $homeData = [];

    public function index()
    {

        $title = 'Contact';
        $this->homeData['page_title'] = $title;
        $this->homeData['content'] = 'clients/contact/index';
        $this->homeData['sub_content'][] = null;

        // goi ra views
        $this->render('clients/layouts/clientLayout', $this->homeData);
    }
}
