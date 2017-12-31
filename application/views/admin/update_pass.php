<div class="x_panel">
	<div class="x_title">
		<h2>Update Password</h2>
		<div class="clearfix"></div>
	</div>
	<?php echo validation_errors('<p style="color:red">','</p>'); ?>
	<div class="x_content">
		<br />

		<div class="alert alert-warning">
			<h3>Warning !</h3>
			<p>Setelah Password di update, anda harus login ulang!</p>
		</div>

		<form action="" class="form-horizontal form-label-left" method="post">
			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2 col-xs-12">Password Baru</label>
				<div class="col-md-5 col-sm-6 col-xs-12">
					<input type="password" name="password1" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2 col-xs-12">Password Lama</label>
				<div class="col-md-5 col-sm-6 col-xs-12">
					<input type="password" name="password2" class="form-control">
					<em class="help-text">* Masukan password anda untuk konfirmasi perubahan</em>
				</div>
			</div>

			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
				<button type="button" class="btn btn-danger" onclick="window.history.go(-1)"> Kembali</button>
				<button type="submit" name="submit" value="Submit" class="btn btn-primary">Simpan Perubahan</button>
			</div>
		</form>
	</div>
</div>