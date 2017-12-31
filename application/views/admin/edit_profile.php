<div class="x_panel">
	<div class="x_title">
		<h2>Edit Profile</h2>
		<div class="clearfix"></div>
	</div>
	<?php echo validation_errors('<p style="color:red">','</p>'); ?>
	<div class="x_content">
		<br />

		<form action="" class="form-horizontal form-label-left" method="post">
			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2 col-xs-12">Username</label>
				<div class="col-md-5 col-sm-6 col-xs-12">
					<input type="text" name="username" class="form-control" value="<?= $username; ?>">
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2 col-xs-12">Fullname</label>
				<div class="col-md-5 col-sm-6 col-xs-12">
					<input type="text" name="fullname" class="form-control" value="<?= $fullname; ?>">
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
				<div class="col-md-5 col-sm-6 col-xs-12">
					<input type="email" name="email" class="form-control" value="<?= $email; ?>">
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-md-2 col-sm-2 col-xs-12">Password</label>
				<div class="col-md-5 col-sm-6 col-xs-12">
					<input type="password" name="password" class="form-control">
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