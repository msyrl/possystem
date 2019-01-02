<table class="table table-stripped">
	<thead>
		<tr>
			<th width="1%">#</th>
			<th>Barang</th>
			<th class="text-right">Harga</th>
			<th width="5%" class="text-right">Qty</th>
			<th class="text-right">Total</th>
		</tr>
	</thead>
	<tbody>
		@php $no=1 @endphp
		@foreach ($buyDetails as $detail)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $detail->good_barcode. ' - ' .$detail->good()->withTrashed()->first()->name }}</td>
				<td class="text-right">Rp {{ number_format($detail->cost) }}</td>
				<td class="text-right">{{ $detail->qty }}</td>
				<td class="text-right">Rp {{ number_format($detail->cost * $detail->qty) }}</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2">Total</th>
			<th class="text-right">Rp {{ number_format(array_sum(array_column($buyDetails->toArray(), 'cost'))) }}</th>
			<th class="text-right">{{ number_format(array_sum(array_column($buyDetails->toArray(), 'qty'))) }}</th>
			<th class="text-right">Rp {{ number_format($buyDetails->first()->buy->total) }}</th>
		</tr>
	</tfoot>
</table>