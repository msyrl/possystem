@extends('templates.app')

@push('title','Barang')

@section('content')
	<div class="card">
		<div class="card-header">
			<h1 class="card-title">Master Barang</h1>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="table-good-category" class="table table-stripped" width="100%">
					<thead>
						<th width="1%">#</th>
						<th>Barcode</th>
						<th>Nama</th>
						<th>Kategori</th>
						<th>Vendor</th>
						<th>HPP</th>
						<th>Harga Jual</th>
						<th class="text-center" width="5%"><button class="btn btn-primary btn-sm modal-show" data-href="{{ route('good.create') }}" data-title="Tambah Master Barang"><i class="fa fa-plus"></i></button></th>
					</thead>
				</table>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		$('#table-good-category').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('good.api') }}",
			columns: [
				{data: "DT_RowIndex", name: 'id'},
				{data: 'barcode', name: 'barcode'},
				{data: 'name', name: 'name'},
				{data: 'category_name', name: 'category_name'},
				{data: 'vendor_name', name: 'vendor_name'},
				{data: 'cost', name: 'cost'},
				{data: 'price', name: 'price'},
				{data: 'action', name: 'action'},
			],
			columnDefs: [
				{targets: [5, 6], className: 'text-right'},
				{targets: 7, orderable: false},
			
			],
		});
	</script>
@endpush