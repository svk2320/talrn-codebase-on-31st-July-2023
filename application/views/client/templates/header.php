<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $page_title; ?>
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet"
    href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet"
    href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>Jvectormap/jquery-jvectormap-2.0.5.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet"
    href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet"
    href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/summernote/summernote-bs4.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
  <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
  <link rel=" shortcut icon" href="<?=base_url('assets/img/newfavicon.png')?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
  <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

  <link rel="stylesheet" media="all" href="<?php echo base_url() . $this->config->item('css') . 'client-dashbroad.css' ?>">

  <style>
    #nav-main {
      background-color: #F5F5F7 !important;
    }

    #hire-button {
      padding: 10px 24px;
      background-color: #5271FF;
      color: white;
      border: none;
      border-radius: 30px;
      font-weight: bold;
    }

    .field {
      background-color: white;
    }

    .english-radio {
      margin-left: 30px;
    }

    .english-label {
      margin-left: 6px;
    }

    #next,
    #previous {
      margin-top: 50px;
      padding: 12px 50px;
      border: none;
      float: right;
      border-radius: 5px;
      background-color: #5271FF;
      color: white;
      font-weight: bold;
    }
    .req{
      display:none; 
    }
    #previous {
      background-color: grey;
      float: left;
    }
    .invalid{
      background-color:red;
    }
    #add {
      margin-top: 20px;
      padding: 12px 50px;
      border: none;
      border-radius: 5px;
      background-color: #5271FF;
      color: white;
      font-weight: bold;
    }

    #placeholder {
      text-align: center;
      background-color: white;
      padding: 16px;
      margin-top: 10px;
      border: 1px solid grey;

      border-radius: 5px;
    }

    .education-card {
      padding: 10px 20px;
      background-color: white;
      margin-top: 10px;
      border: 1px solid grey;
      border-radius: 5px;
    }

    .education-title {
      font-size: 18px;
      font-weight: bold;
    }

    .stepper-wrapper {
      text-align: center;
      display: flex;
      justify-content: space-evenly;
      padding: 16px 0px;
      border-bottom: 1px solid lightgray;
    }

    .stepper-title {
      font-size: 16px;
      margin-top: 12px;
    }

    .stepper-item {
    flex-basis: calc(100% / 7);
    }

    .stepper-number {
      border: 1px solid #5271FF;
      display: inline-block;
      color: #5271FF;
      border-radius: 50%;
      padding: 10px 18px;
    }

    .stepper-active {
      background-color: #5271FF !important;
      color: white;
    }

    .finish {
      background-color: rgb(31, 157, 31);
      color: white;
      border-color:rgb(31, 157, 31);
    }

    #multiple-checkboxes {
      width: 100% !important;
    }

    #select-picker {
      padding: 100px !important;
    }

    .tab {
      display: none;
    }

    .invalid {
      background-color: #ffdddd;
    }

    .profile-page-arrow {
      font-size: 14px !important;
    }

    .profile-details {
      display: flex;
      justify-content: space-between;
    }

    .hire-button {
      border: none;
      background-color: #fafafa;
      padding: 20px 30px;
      border-radius: 40px;
      display: flex;
      align-items: center;
    }

    #select-box {
      width: 100%;
      padding: 8px !important;
      border-radius: 5px;
      border: 1px solid lightgray;
    }

    .select-box {
      width: 100%;
      padding: 8px !important;
      border-radius: 5px;
      border: 1px solid lightgray;
    }

    #header-image {
      background-image: url("../images//bg-header-designers_51661c.jpg");
      background-size: cover;
      height: 150px;
    }

    .profile-container {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .profile-wrapper {
      margin-top: -5%;
      width: 90%;
      background-color: white;
      box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .font-small {
      font-size: 14px;
    }

    .section-2 {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 16px 0px;
      background-color: #EBFBF5;
      width: 100%;
    }

    .hire-person {
      background-color: #00DB86;
      color: white;
    }

    @media only screen and (max-width: 600px) {

      #next,
      #previous {
        width: 100%;
        margin-top: 10px;
      }

      .stepper-number {
        padding: 8px 16px;
      }

      .profile-image {
        width: 100%;
      }
      .stepper-title{
        font-size:12px;
      }

    }

    .ui-datepicker-calendar {
      display: none;
    }

    textarea {
      resize: none;
    }
  </style>
  <style>
    #signup-step {
      margin: auto;
      padding: 0;
      width: 53%
    }

    #signup-step li {
      list-style: none;
      float: left;
      padding: 5px 10px;
      border-top: #004C9C 1px solid;
      border-left: #004C9C 1px solid;
      border-right: #004C9C 1px solid;
      border-radius: 5px 5px 0 0;
    }

    .active {
      color: #FFF;
    }

    #signup-step li.active {
      background-color: #004C9C;
    }

    #signup-form {
      clear: both;
      border: 1px #004C9C solid;
      padding: 20px;
      width: 50%;
      margin: auto;
    }

    .demoInputBox {
      padding: 10px;
      border: #CDCDCD 1px solid;
      border-radius: 4px;
      background-color: #FFF;
      width: 50%;
    }

    .signup-error {
      color: #FF0000;
      padding-left: 15px;
    }

    .message {
      color: #00FF00;
      font-weight: bold;
      width: 100%;
      padding: 10;
    }

    .btnAction {
      padding: 5px 10px;
      background-color: #F00;
      border: 0;
      color: #FFF;
      cursor: pointer;
      margin-top: 15px;
    }

    label {
      line-height: 35px;
    }

    .custom-pagination {
      padding: 0 50% 10px;
      margin: 10px 0;
    }

    .more_projects {
      border: 1px solid #ddd;
      margin: 10px 0;
      padding: 10px;
      border-radius: 10px;
    }

    .displayNone {
      display: none;
    }
  </style>
  <style>
    .pull-left {
        float: left !important;
    }

    .pull-right {
        float: right !important;
    }
</style>
  <script src="<?php echo base_url('assets/AdminLTE-3.0.2/'); ?>plugins/jquery/jquery.min.js"></script>
  <script>
  </script>
</head>
