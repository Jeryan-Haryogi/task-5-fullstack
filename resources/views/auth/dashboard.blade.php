@extends('layouts.app')

@section('content')
<style>
    .card {
        border: none;
    }
    .card-body {
        background-image: url('https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/5167ae86839785.5eaed991961e7.gif');
        height: 630px;
        width: 100%;
        background-attachment: fixed;
        background-size: cover;
        text-shadow: 2px 2px #eeee;
        animation-duration: 3s;
  animation-name: slidein;
  animation-iteration-count: infinite;
  animation-direction: alternate;


        
        
    }
</style>
    <div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <div class="">
                <span>Menu</span>
                <br>
                <span class="">
                    <a href="{{ route('artikel') }}"  class="text-white mr-3" style="text-decoration: none">Article</a>
                    |
                    
                </span>
                <span >
                    <a href="{{ route('kategori') }}"  class="text-white" style="text-decoration: none">Kategori</a>
                    
                </span>
            </div>
        </div>
        <div class="card-body text-center ">
           <div style="margin-top: 200px;">
           <h1><b>SunBlog Articel</b></h1>
            <h2><b>Virtual Intership Experience Investree</b></h2>
            <h2><b>Fullstack Developer</b></h2>
           </div>
        </div>
        </div>
            </div>
@endsection