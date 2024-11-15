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
<div class="container-fluid">
  <div id="product_list"> <product-list :slug="'{{ $slug }}'"></product-list> </div>
</div>

<!-- end all product -->

@endsection