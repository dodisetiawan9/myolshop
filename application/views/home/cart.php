<h4><i class="fa fa-shopping-cart"></i> Daftar Belanja</h4>
<hr />
<br />

<table class="responsive-table bordered striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nama Barang</th>
			<th>Berat</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Opsi</th>
		</tr>
	</thead>

	<tbody>
		<?php 
			$no = 1;
			foreach ($this->cart->contents() as $key) { 
		?>

			<tr>
				<td><?= $no++; ?></td>	
				<td><?= $key['name']; ?></td>
				<td><?= $key['weight']; ?></td>
				<td><?= $key['qty']; ?></td>
				<td><?= 'Rp. '.number_format($key['price'],0,',','.'); ?></td>
				<td>
					<a href="#<?= $key['rowid']; ?>" class="btn-floating orange"><i class="fa fa-edit"></i></a>
					<a href="<?= base_url(); ?>cart/delete/<?= $key['rowid']; ?>" class="btn-floating red"><i class="fa fa-trash"></i></a>
				</td>
			</tr>

			<div class="modal" id="<?= $key['rowid']; ?>">
				<form action="<?= base_url(); ?>cart/update" method="post">
					<div class="modal-content">
						<div class="input-field">
							<input type="number" name="qty" value="<?= $key['qty']; ?>" id="qty<?= $key['rowid']; ?>">
							<label for="qty<?= $key['rowid']; ?>">Jumlah Pesanan</label>
						</div>
					</div>

					<div class="modal-footer">
						<button type="submit" name="submit" value="Submit" class="modal-action btn blue">Update Pesanan</button>
					</div>
				</form>
			</div>

		<?php }  ?>

		<tr>
			<td colspan="4">Total</td>
			<td colspan="2"><?= 'Rp. '.number_format($this->cart->total(),0,',','.'); ?></td>
		</tr>
	</tbody>
</table>
<br />
<button type="button" class="btn red" onclick="window.history.go(-1)">Kembali</button>