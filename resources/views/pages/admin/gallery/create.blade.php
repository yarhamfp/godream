@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Gallery</h1>
<a href="{{ route('gallery.index')}}" class="btn btn-sm btn-primary shadow-sm">
<i class="fas fa-undo fa-sm text-white-50"></i> Back
</a>
</div>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="card shadow col-md-8" style="margin: auto;">
  <div class="card-body">
      <form action="{{ route('gallery.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="travel_packages_id">Paket Travel *</label>
          <a href="{{ route('travel-package.create')}}" class="btn btn-sm btn-primary shadow-sm" style="margin-left: 385px;">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Paket Travel Baru </a>
          <select name="travel_packages_id" class="form-control" required>
            <option value="">- Pilih Paket Travel -</option>
            @foreach ($travel_packages as $travel_package)
              <option value="{{ $travel_package->id }}">
                {{ $travel_package->title }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="image">Image *</label>
          <input type="file" class="form-control" name="image" placeholder="image">
        </div>
        <button class="btn btn-primary btn-block" type="submit">
          <i class="fa fa-save"></i> Simpan
        </button>
      </form>
  </div>
</div>


</div>
<!-- /.container-fluid -->
@endsection