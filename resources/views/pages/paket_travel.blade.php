@extends('layouts.app')
@section('title', 'Paket Travel')

@section('content')
<main>
<section class="section-details-header"></section>
<section class="section-details-content">
  <div class="container">
    <div class="row">
      <div class="col p-lg-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            Travel Package
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <form action="" method="GET">
      <div class="row content-filter-travel">
        <div class="col-md-2 col-sm-12 mb-3">
          <input type="text" class="form-control form-filter" id="title" name="title" placeholder="Name">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
          <input type="text" class="form-control form-filter" id="location" name="location"
          placeholder="Location">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
          <input type="text" class="form-control datepicker" name="departure_date" id="departure_date"
          placeholder="Departure" >
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
          <input type="text" class="form-control form-filter" id="minimum_price" name="minimum_price"
          placeholder="Minimum Price">
        </div>
        <div class="col-md-2 col-sm-12 mb-3">
          <input type="text" class="form-control form-filter" id="maximum_price" name="maximum_price"
          placeholder="Maximum Price">
        </div>
        <div class="col-md-2 col-sm-12">
          <button class="btn btn-login btn-block">
          Search
          </button>
        </div>
      </div>
    </form>
  </div>

<br>
<br>
<br>
  {{-- <section class="section-travel-list" id="travelList"> --}}
    <div class="row">
      <div class="col-lg-12 pl-lg-0">
        {{-- <div class="card card-details"> --}}
            <section class="section-paket-list" id="popularContent" data-aos="zoom-in">
              <div class="container">
                <div class="section-paket-list row justify-content-center">
                  @foreach ($items as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                      <div class="card-travel text-center d-flex flex-column" style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');">
                        <div class="travel-country">{{ $item->location }}</div>
                        <div class="travel-location">{{ $item->title }}</div>
                        <div class="travel-button mt-auto">
                          <a href="{{ route('detail', $item->slug ) }}" class="btn btn-travel-details px-4">
                            View Details
                          </a>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    

    {{-- <div class="col-lg-12 col-md-12 col-sm-12 mt-3 row justify-content-center pagination-content">
    <nav>
    <ul class="pagination">
    <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
    <span class="page-link" aria-hidden="true">&lsaquo;</span>
    </li>
    <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
    <li class="page-item"><a class="page-link" href="">2</a></li>
    <li class="page-item">
    <a class="page-link" href="" rel="next" aria-label="Next &raquo;">&rsaquo;</a>
    </li>
    </ul>
    </nav>
    </div>
    </div> --}}
  {{-- </section> --}}

</section>
</main>
@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/dist/xzoom.css') }}">
@endpush

@push('addon-script')
<script src="{{ url('frontend/libraries/xzoom/dist/xzoom.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $('.xzoom, .xzoom-gallery').xzoom({
      zoomWidth: 500,
      title: false,
      tint: '#333',
      Xoffset: 15
    });
  });
</script>
@endpush