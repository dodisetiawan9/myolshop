<div class="row">
	<div class="col m10 s12 offset-m1">
		<h4 style="color:#939393;"><i class="fa fa-pencil-square-o"></i> Ubah Password</h4>
		<hr />
		<br />
		<?php echo validation_errors('<p style="color:red">','</p>'); ?>
		<form action="" method="post">
			<div class="alert alert-warning">
				<h5>Warning!</h5>
				<p>Anda harus login ulang ketika password berhasil di update!</p>
			</div>

			<div class="col m10 s12">
				<div class="row">
					<div class="input-field col m8 s12">
						<input type="password" id="password" class="validate" name="password1">
						<label for="first_name">New Password</label>
					</div>
				</div>

				<br />
				<div class="row">
					<div class="input-field col m8 s12">
						<input type="password" id="password" class="validate" name="password2">
						<label for="first_name">Re-Password</label>
					</div>
				</div>
				
				<div class="row">
					<div class="input-field col m8 s12">
						<input type="password" id="password" class="validate" name="password">
						<small>* Masukan kembali password sebelumnya</small>
						<label for="first_name">Password</label>
					</div>
				</div>
					
				<div class="row right">
					<button type="buttton" onclick="window.history.go(-1)" class="btn red waves-effect waves-light">Kembali</button>
					<button type="submit" name="submit" value="Submit" class="btn blue waves-effect waves-light">Submit <i class=" fa fa-paper-plane"></i></button>
				</div>
					
			</div>
		</form>
	</div>
</div>