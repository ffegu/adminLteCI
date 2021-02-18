<!DOCTYPE html>
<html lang="{{ config('App')->defaultLocale }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="{{ csrf_token() }}" content="{{ csrf_hash() }}">
  <title>{{ config('Boilerplate')->appName }} {{ isset($title)? ' - '.$title : "" }} </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.min.css">
  @yield('pre-css')
  @yield('css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.0.4/dist/css/adminlte.min.css">
  <link  rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap">
</head>
<body class="layout-fixed layout-navbar-fixed sidebar-mini @php
  config('Boilerplate')->theme['footer']['fixed'] ? 'layout-footer-fixed' : ''
@endphp @php
  config('Boilerplate')->theme['body-sm'] ? 'text-sm' : ''
@endphp">
  <div class="wrapper">
    @include('render/nav')
    @include('render/sidebar')
    <div class="content-wrapper">
       @include('render/contentheader')
       <section class="content">
         <div class="container-fluid">
