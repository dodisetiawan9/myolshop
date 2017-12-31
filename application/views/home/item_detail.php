<h4><i class="fa fa-search-plus"></i> Detail item</h4>
<hr />
<br />

<?php 
	$key = $data->row();
?>

<div class="row">
	<div class="col m3 s12 offset-m1">
		<img src="<?= base_url(); ?>assets/upload/<?= $key->gambar; ?>" class="resposive-img" style="width: 100%;">
	</div>

	<div class="col m7 s12 offset-m1">
		<table class="responsive-table bordered striped">
			<tr>
				<td style="width: 30%; vertical-align: top; text-align: right;">Nama Barang : </td>
				<td><?= ucfirst($key->nama_item); ?></td>
			</tr>

			<tr>
				<td style="width: 30%; vertical-align: top; text-align: right;">Harga Barang : </td>
				<td><?= 'Rp. '.number_format($key->harga,0,',','.'); ?></td>
			</tr>

			<tr>
				<td style="width: 30%; vertical-align: top; text-align: right;">Berat Barang : </td>
				<td><?= ucfirst($key->berat).' gr'; ?></td>
			</tr>

			<tr>
				<td style="width: 30%; vertical-align: top; text-align: right;">Deskripsi : </td>
				<td><?= ucfirst(nl2br($key->deskripsi)); ?></td>
			</tr>

		</table>

		<br />
		<button type="button" class="btn red waves-effect waves-light" onclick="window.history.go(-1)">Kembali</button>
		<a href="<?= base_url(); ?>cart/add/<?= $key->id_item; ?>" class="btn blue waves-effect waves-light"><i class="fa fa-shopping-cart"></i> Add to cart</a>
	</div>
</div>