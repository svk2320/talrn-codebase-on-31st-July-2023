<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php if (isset($description)) {
    echo $description;
  } else {
    echo 'Browse thousands of Developer Candidate Profiles | talrn.com';
  } ?>">

  <meta name="application-name" content="<?= base_url() ?>">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= base_url() ?>">
  <meta property="og:title" content="<?php if (isset($og)) {
    echo $og;
  } else {
    echo 'Browse thousands of Developer Candidate Profiles | talrn.com';
  } ?>">
  <meta property="og:image" content="<?php 
    if(isset($og_image)) {
        echo base_url($og_image);
    } else {
        echo base_url('assets/img/press/talrn_banner.jpg');
    }?>">
  <meta property="og:url" content="<?= base_url() ?>" />
  <meta property="og:description" content="<?php if (isset($description)) {
    echo $description;
  } else {
    echo 'Browse thousands of Developer Candidate Profiles | talrn.com';
  } ?>" />

  <title>
    <?php if (isset($title)) {
      echo $title;
    } else {
      echo 'Talrn - Hire Freelance Talent from the Top Talent';
    } ?>
  </title>
  <link rel=" shortcut icon" href="<?php echo base_url() . $this->config->item('image') . 'newfavicon.png' ?>">
  <link rel="stylesheet" media="all" href="<?php echo base_url() . $this->config->item('css') . 'plugins-v1.css' ?>">
  <link rel="stylesheet" media="all" href="<?php echo base_url() . $this->config->item('css') . 'style-v2.css' ?>">
  <link rel="stylesheet" media="all" href="<?php echo base_url() . $this->config->item('css') . 'landingpage-v1.css' ?>">
  <link rel="stylesheet" media="all" href="<?php echo base_url() . $this->config->item('css') . 'forgot-password-v1.css' ?>">
  <link rel="stylesheet" media="all" href="<?php echo base_url() . $this->config->item('css') . 'profile_details-v1.css' ?>">
  <link rel="stylesheet" media="all" href="<?php echo base_url() . $this->config->item('css') . 'colors/sky.css' ?>">
  <link rel="stylesheet" media="all" href="<?php echo base_url() . $this->config->item('css') . 'fonts/dm.css' ?>" as="style"
    onload="this.rel='stylesheet'">
    <link media="all" href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

  <style type="text/css">
    .custom-font-size-0.6rem {
      font-size: 0.6rem;
    }
  </style>
    
  <link media="all" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  <link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'profile-details.css' ?>">
  <link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'industries.css' ?>">
  <link media="all" rel="stylesheet" href="<?php echo base_url() . $this->config->item('css') . 'popovers.css' ?>">
  <link media="all" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  
  
  
  
</head>

<body>
