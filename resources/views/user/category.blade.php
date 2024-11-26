@extends('user.layout')
@section('title')
{{ $title }} - Trendy U
@endsection

@section('category')
@foreach ($loai as $category)
  <li class="nav-item dropdown">
    <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
    href="{{ route('loai-san-pham', $category->slug) }}">
    {{$category->ten_loai}}
    </a>
    <ul class="dropdown-menu" id="userDropdown">
    @foreach ($danh_muc as $dm)
    @if ($dm->id_loai == $category->id)
    <li class="hover-dm"><a class="dropdown-item" href="{{ route('danh-muc-san-pham', $dm->slug)}}">{{$dm->ten_dm}}</a>
    </li>
  @endif
  @endforeach
    </ul>
  </li>
@endforeach
@endsection

@section('content')

<!-- all product -->
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="2000">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
  </div>
  <div class="carousel-inner img-header-all">
    <div class="carousel-item active">
      <img src="{{ asset('/imgnew/allpro.jpg') }}" class="d-block w-100 img-header-all" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" >
      <img src="{{ asset('/imgnew/allpro2.png') }}" class="d-block w-100 img-header-all" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container">
  <div id="product_list"> <product-list :slug="'{{ $slug ?? "default-slug"}}'"></product-list> </div>
</div>

<!-- end all product -->

@endsection