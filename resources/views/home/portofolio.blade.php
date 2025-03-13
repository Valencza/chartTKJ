@extends('home.layouts.app')

{{-- @section('attr-nav')
<!-- Start Attribute Navigation -->
<div class="attr-nav flex">
    <ul>
        <li class="side-menu">
            <a href="#">
                <span class="bar-1"></span>
                <span class="bar-2"></span>
                <span class="bar-3"></span>
            </a>
        </li>
    </ul>
</div>
<!-- End Attribute Navigation -->
@endsection --}}

@section('content')

<div class="blog-area blog-grid-colum" style="padding: 10px;">
    <div class="container">
        <div class="row">
            <!-- Single Item -->
            @foreach($portofolioDisplay as $portofolio)
            <div class="col-lg-4 col-md-6 mb-50 portofolio-item"">
                <div class="blog-style-one">
                    <div class="thumb">
                        <a href="{{ route('portofolio.detail', $portofolio->slug) }}"><img
                                src="{{asset('storage/' . $portofolio->gambar)}}" alt="Image Not Found"
                                style="width: 100%; height: auto; object-fit: cover; border-radius: 10px; aspect-ratio: 3 / 2;"></a>
                    </div>
                    <div class="info">
                        <div class="meta">
                            <ul>
                                <li>{{ $portofolio->tanggalProyek }}</li>
                            </ul>
                        </div>
                        <h3 class="post-title"><a href="{{ route('portofolio.detail', $portofolio->slug) }}">{{
                                $portofolio->nama }}</a></h3>
                        <a href="{{ route('portofolio.detail', $portofolio->slug) }}" class="button-regular">
                            See Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- End Single Item -->
        </div>
      
    </div>
</div>
<!-- End Blog -->
@endsection

<script>
    $(document).ready(function() {
        $('.filter-button').click(function() {
            $('.filter-button').removeClass('active');
            $(this).addClass('active');
            var filter = $(this).data('filter');

            if(filter == 'all') {
                $('.portfolio-item').show();
            } else {
                $('.portfolio-item').hide();
                $('.portfolio-item[data-category="' + filter + '"]').show();
            }
        });
    });
</script>