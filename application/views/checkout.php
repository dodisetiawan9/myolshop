<div class="row">
	<div class="col m10 s12 offset-m1">
		<h4 style="color:#939393"><i class="fa fa-shopping-bag"></i> Checkout</h4>
		<hr />
		<br />

		<?php echo validation_errors('<p style="color:red">','</p>'); ?>

		<form action="" method="post">
			<div class="row">
				<div class="col m8 s12">
					<label>Provinsi</label>
					<select name="provinsi" class="browser-default" id="prov">
						<option value="" disabled selected>-- Pilih Provinsi --</option>
						<?php $this->load->view('prov'); ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col m8 s12">
					<label>Pilih Kota / Kabupaten</label>
					<select name="kota" class="browser-default" id="kota">
						<option value="" disabled selected>-- Kota / Kabupaten</option>
					</select>
				</div>	
			</div>

			<div class="row">
				<div class="input-field col m8 s12">
					<input type="text" id="alamat" class="validate" name="alamat" value="">
					<label for="alamat">Alamat</label>
				</div>

				<div class="input-field col m4 s12">
					<input type="number" id="kd_pos" name="kd_pos" value="" class="validate">
					<label for="kd_pos">Kode Pos</label>
				</div>
			</div>

			<div class="row">
				<div class="col m8 s12">
					<label>Pilih Layanan</label>
					<select name="layanan" class="browser-default">
						<option value="" disabled selected>Pilih layanan</option>
					</select>
				</div>

				<div class="col m4 s12">
					<label>Ongkos Kirim</label>
					<input type="number" name="ongkir" value="0">
				</div>
			</div>

			<div class="row">
				<div class="input-field col m4 s12 offset-m8">
					<input type="number" name="total" value="<?= $this->cart->total(); ?>">
					<label for="">Total Biaya</label>
				</div>
			</div>
			<br />

			<div class="row right">
				<button type="button" class="btn red waves-effect waves-light" onclick="window.history.go(-1)">Kembali</button>
				<button type="submit" name="submit" value="Submit" class="btn blue waves-effect waves-light">Submit <i class="fa fa-paper-plane"></i></button>
			</div>
		</form>
	</div>
</div>