@extends('layouts.success')
@section('title', 'Suksses')

@section('content')
<main>
	<div class="section-success d-flex align-items-center">
		<div class="col text-center">
			<img src="{{ url('frontend/images/ic_mail.png') }}" alt="" />
			<h1>Oops! </h1>
			<p>
				Your transaction is failed
				<br>
				please contact our representative if this problem occurs
			</p>
			<a href="{{ url('/') }}" class="btn btn-home-page mt-3 px-5">
				Home Page
			</a>
		</div>
	</div>
</main>
@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}">
@endpush


