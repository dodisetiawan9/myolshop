<h4><i class="fa fa-exchange"></i> Data Belanja</h4>
<hr />
<br />


<table class="responsive-table bordered striped col m12 s12">
	<thead>
		<tr>
			<th width="5%">#</th>
			<th width="20%">Id Transaksi</th>
			<th width="15%">Tanggal Pesan</th>
			<th width="15%">Batas Bayar</th>
			<th width="15%">Total Biaya</th>
			<th width="10%">Status</th>
			<th width="15%" class="center">Opsi</th>
		</tr>
	</thead>

	<tbody>
		<?php 
			$no=1;
			$today = (abs(strtotime(date("Y-m-d"))));
			foreach ($get->result() as $key) :?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $key->id_order; ?></td>
					<td><?= date("d M y", strtotime($key->tgl_pesan)); ?></td>
					<td><?= date("d M y", strtotime($key->bts_bayar)); ?></td>
					<td><?= 'Rp. '.number_format($key->total,0, ',','.'); ?></td>
					<td>
						<?php 
							$batas = (abs(strtotime($key->bts_bayar)));

							if($today > $batas && $key->status == 'belum')
							{
								echo 'Kadaluarsa';
							}
							else{
								echo ucfirst($key->status);
							}
						?>
					</td>
					<td class="center">
						<a href="<?= base_url(); ?>home/detail_transaksi/<?= $key->id_order; ?>" class="btn btn-floating green"><i class="fa fa-search-plus"></i></a>

						<?php  
							if($key->status != 'proses') { ?>
							
								<a href="<?= base_url(); ?>home/hapus_transaksi/<?= $key->id_order; ?>" class="btn btn-floating red" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
						<?php } ?>	
						
					</td>
				</tr>
	
		<?php endforeach; ?>
	</tbody>
</table>
<br />

<div class="row right">
	<button type="button" class="btn red" onclick="window.history.go(-1)">Kembali</button>
</div>
<br />