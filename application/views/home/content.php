<div class="row">
    <?php foreach ($data->result() as $key) { ?>          
	    <div class="col s12 m3">
	      <div class="card">
	        <div class="card-image">
	           <a href="<?= base_url(); ?>home/detail/<?= $key->id_item; ?>"><img src="<?= base_url(); ?>assets/upload/<?= $key->gambar; ?>"></a>
	           <span class="card-title"><?= $key->nama_item; ?></span>
	        </div>
	        <div class="card-content">
	           <p><?= 'Rp. '.number_format($key->harga,0,',','.'); ?></p>
	        </div>
	        <div class="card-action">
	           <a href="<?= base_url(); ?>home/detail/<?= $key->id_item; ?>" class="waves-effect waves-light btn-flat blue white-text"><i class="fa fa-search-plus"></i> Detail</a>
	           <a href="<?= base_url(); ?>cart/add/<?= $key->id_item; ?>" class="waves-effect waves-light btn-flat green white-text"><i class="fa fa-shopping-cart"></i> Add to cart</a>
	        </div>
	      </div>
	    </div>
   <?php } ?>           
</div>
            