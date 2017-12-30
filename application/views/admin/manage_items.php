<div class="x_panel">
	<div class="x_title">
		<h2>Manage Items</h2>
		<div style="float:right">
			<a href="<?= base_url(); ?>item/add_item" class="btn btn-primary">Tambah Item</a>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<table class="table table-striped table-bordered table-hover" id="datatable">
			<thead>
				<tr>
					<th>#</th>
					<th>Nama Item</th>
					<th>Harga</th>
					<th>Status</th>
					<th>Opsi</th>
				</tr>
			</thead>
				
			<tbody>
				<?php  
					$no = 1;
					foreach ($data->result() as $item) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $item->nama_item; ?></td>
							<td><?= 'Rp. '.number_format($item->harga,0,',','.'); ?></td>
							<td>
								<?php 
									if($item->status == 1){
										echo '<label class="label label-success" style="color:white; padding: 3px 5px;">Aktif</label>';
									}
									else{
										echo '<label class="label label-danger" style="color:white; padding: 3px 5px;">Aktif</label>';
									}
								?>
							</td>
										
							<td>
								<a href="" class="btn btn-success"><i class="fa fa-search-plus"> Detail</i></a>
								<a href="" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
							</td>
						</tr>

					<?php } ?>
			</tbody>
		</table>
	</div>
</div>