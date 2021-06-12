@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
<a href="{{ route('travel-package.create')}}" class="btn btn-sm btn-primary shadow-sm">
<i class="fas fa-plus fa-sm text-white-50"></i> Tambah Paket Travel
</a>
</div>

<div class="row">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspasing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Location</th>
            <th>Type</th>
            <th>Departure Date</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1 ?>
          @foreach ($items as $item)
          <tr>
            <th>{{$no}}</th>  
            <th>{{ $item->title }}</th>
            <th>{{ $item->location }}</th>
            <th>{{ $item->type }}</th>
            <th>{{ $item->departure_date }}</th>
            <th>Rp <?=number_format($item->price,0,',','.');?></th>
            <th>
            <a href="{{ route('travel-package.edit', $item->id)}}" class="btn btn-info">
              <i class="fa fa-pencil-alt"></i>
            </a>
            <form action="{{ route('travel-package.destroy', $item->id)}}" method="POST" class="d-inline">
              @csrf
              @method('delete')
              <button class="btn btn-danger">
                <i class="fa fa-trash"></i>
              </button>
            </form>
            </th>
          </tr>
          {{-- @empty
          <tr>
            <td colspan="7" class="text-center">
              Data Kosong
            </td>
          </tr> --}}
          <?php $no++ ?>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection