<?php

class Clients extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->load->model('model_clients');

        $this->data['page_title'] = 'Clients';
    }

    public function index()
    {
        $this->data['js'] = 'application/views/admin/stores/index-js.php';
        $this->render_template('admin/clients/index', $this->data);
    }

    public function fetchCategoryData()
    {

        $result = array('data' => array());

        $data = $this->model_clients->getStoresDataExtra();

        foreach ($data as $key => $value) {

            $buttons = '';
            $buttons = '<button type="button" class="btn btn-default" onclick="window.open(' . "'" . base_url('admin/clients/clientsinfo/' . $value['id']) . "','_blank'" . ');" ><i class="fa fa-eye"></i></button>';

            $dateTime = new DateTime($value['date']);
            $formattedDate = $dateTime->format('Y-m-d');
            $result['data'][$key] = array(
                $formattedDate,
                $value['unique_id'],
                $value['name'],
                $value['company'],
                $value['phone'],
                $value['email'],
                $buttons
            );
        }

        echo json_encode($result);
    }

    function clientsinfo($client_id)
    {
        $client_data = $this->model_clients->getClientData($client_id);
        $this->data['client_data'] = $client_data;

        $this->render_template('admin/clients/view', $this->data);
    }

}