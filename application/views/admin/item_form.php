<div class="x_panel">
	<div class="x_title">
		<h2><?= $header; ?></h2>
		<div class="clearfix"></div>
	</div>

    <?= validation_errors('<p style="color:red">','</p>'); ?>

    <?php 
      if($this->session->flashdata('alert'))
      {
        echo '<div class="alert alert-danger alert-message">';
        echo $this->session->flashdata('alert');
        echo '</div>';
      }

    ?>

	<div class="x_content">
		<br />

		 <form action="" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nama Item</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="nama" class="form-control col-md-7 col-xs-12" value="<?= $nama; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Gambar Item</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" id="last-name" name="gambar" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Harga Item</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="harga" class="form-control col-md-7 col-xs-12" value="<?= $harga; ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Berat Item</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="berat" class="form-control col-md-7 col-xs-12" value="berat">
              <p class="help-text">* Berat dalam satuan gram</p>
            </div>
          </div>

          <div class="form-group">
          	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Status</label>
          	<div class="col-md-4 col-sm-6">
          		<select name="status" id="" class="form-control">
          			<option value="">--Pilih Status--</option>
          			<option value="1" <?php if($status == 1){echo "selected";} ?>>Aktif</option>
          			<option value="2" <?php if($status == 2){echo "selected";} ?>>Tidak Aktif</option>
          		</select>
          	</div>
          </div>
			
		  <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Deskripsi</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea  name="deskripsi" class="form-control" id="" rows="4"><?= $deskripsi; ?></textarea>
            </div>
          </div>

          <div class="in_solid"></div>
			<br />
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="button">Cancel</button>
              <button class="btn btn-primary" type="reset">Reset</button>
              <input type="submit" class="btn btn-success" name="submit" value="Submit">
            </div>
          </div>

        </form>
	</div>
</div>