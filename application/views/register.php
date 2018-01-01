<div class="row">
	<div class="col m10 s12 offset-m1">
		<h4 style="color:#939393;"><i class="fa fa-pencil-square-o"></i> From Registrasi</h4>
		<hr />
		<br />
		<?php echo validation_errors('<p style="color:red">','</p>'); ?>
		<form action="" method="post">
			<div class="col m10 s12">
				<div class="row">
					<div class="input-field col m6 s12">
						<input type="text" id="first_name" class="validate" name="nama1" value="<?= $nama1; ?>"> 
						<label for="first_name">Nama Depan</label>
					</div>

					<div class="input-field col m6 s12">
						<input type="text" id="last_name" class="validate" name="nama2" value="<?= $nama2; ?>">
						<label for="last_name">Nama Belakang</label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m8 s12">
						<input type="text" id="username" class="validate" name="username" value="<?= $user; ?>">
						<label for="username">Username</label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m8 s12">
						<input type="email" id="email" class="validate" name="email" value="<?= $email; ?>">
						<label for="email">Email</label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m8 s12">
						<input type="number" id="telp" class="validate" name="tlp" value="<?= $tlp; ?>">
						<label for="telp">Telepon</label>
					</div>
				</div>
				
				<div class="row">
					<div class="input-field col m6 s12">
						<input type="password" id="password" class="validate" name="password1">
						<label for="first_name">Password</label>
					</div>

					<div class="input-field col m6 s12">
						<input type="password" id="password" class="validate" name="password2">
						<label for="password">Re-Password</label>
					</div>
				</div>
				
				<div class="row">
					<div class="input-field col s12">
						<label>Jenis Kelamin</label>
						<br />
						<p>
							<input type="radio" class="with-gap" value="L" id="lk" name="jk" <?php if($jk == 'L'){echo 'checked';} ?> />
								<label for="lk">Laki-laki</label>
							<input type="radio" class="with-gap" value="P" id="pr" name="jk" <?php if($jk == 'P'){echo 'checked';} ?> />
								<label for="pr">Perempuan</label>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<textarea name="alamat" id="alamat" class="materialize-textarea"><?= $alamat; ?></textarea>
						<label for="alamat">Alamat</label>
					</div>
				</div>
					
				<div class="row-right">
					<button type="buttton" onclick="window.history.go(-1)" class="btn red waves-effect waves-light">Kembali</button>
					<button type="submit" name="submit" value="Submit" class="btn blue waves-effect waves-light">Submit <i class=" fa fa-paper-plane"></i></button>
				</div>
					
			</div>
		</form>
	</div>
</div>