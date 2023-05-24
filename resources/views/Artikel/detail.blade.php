@extends('layouts.app')

@section('content')
@foreach($data as $d)
<style>
    .banner {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('../../images/<?=$d->image?>');
        width: 100%;
        height: 300px;
        background-size: cover;
        
        background-attachment: fixed;
    }
  

    
</style>
<div class="bg">

<div class="banner">
    <br>
    <br>
    <br>
    <br>
    <br>
    <h2 class="text-center text-white"><b>{{$d->title}}</b></h2>
    <h4 class="text-center text-white"><b>
        <?php
        $kategori = DB::table('categories')->where('id', $d->category_id)->get();
        echo $kategori[0]->name; 
        ?>
    </b></h4>
    
</div>
<div class="container mt-4">
    <p><?= $d->content ?></p>
</div>
</div>
@endforeach

@endsection
