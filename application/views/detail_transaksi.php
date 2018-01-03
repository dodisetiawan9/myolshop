<h4><i class="fa fa-exchange"></i> Detail Transaksi</h4>
<hr />
<br />

<?php  
	$data = $get->row();
?>
<div class="row">
	<div class="col m2 s4">
		<b>Id Pesanan</b>
	</div>

	<div class="col m6 s6">
		: <b><?= $data->id_order; ?></b>
	</div>
</div>

<div class="row">
	<div class="col m2 s4">
		<b>Nama Penerima</b>
	</div>

	<div class="col m6 s6">
		: <b><?= $data->fullname; ?></b>
	</div>
</div>

<div class="row">
	<div class="col m2 s4">
		<b>Tujuan</b>
	</div>

	<div class="col m6 s6">
		: <b><?= $data->tujuan; ?>, <?= $data->kota; ?></b>
	</div>
</div>

<div class="row">
	<div class="col m2 s4">
		<b>Kurir / Layanan</b>
	</div>

	<div class="col m6 s6">
		: <b><?= $data->kurir; ?>, <?= $data->service; ?></b>
	</div>
</div>
<br />
<table class="responsive-table bordered col m8 s12 offset-m1">
	<thead>
		<tr>
			<th width="5%" class="center">#</th>
			<th width="20%">Nama Item</th>
			<th width="15%" class="center">Jumlah Pesan</th>
			<th width="15%">Biaya</th>

		</tr>
	</thead>

	<tbody>
		<?php 
			$no=1;
			$total_biaya = 0;
			foreach ($get->result() as $key) :
					$total_biaya += $key->biaya;
				?>
				<tr>
					<td class="center"><?= $no++; ?></td>
					<td><?= $key->nama_item; ?></td>
					<td class="center"><?= $key->qty; ?></td>
					<td><?= 'Rp. '.number_format($key->biaya,0,',','.'); ?></td>
					
		<?php endforeach; ?>

		<tr>
			<td colspan="3">Ongkos Kirim</td>
			<td><?= 'Rp. '.number_format($data->total - $total_biaya, 0, ',','.'); ?></td>
		</tr>
		<tr>
			<td colspan="3"><b>Total</b></td>
			<td><b><?= 'Rp. '.number_format($key->total,0, ',','.'); ?></b></td>
		</tr>
	</tbody>
</table>
<br />

<div class="row right">
	<a href="<?= base_url(); ?>home" class="btn red">Kembali</a>
</div>
<br />