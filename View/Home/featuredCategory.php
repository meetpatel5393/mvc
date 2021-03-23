<?php $featuredCategory = $this->getFeaturedCategory()->getData(); ?>
<h2 class="p-2">Featured Category</h2>
<section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row justify-content-center">
            	<?php foreach ($featuredCategory as $key => $value): ?>
					       <div class="col-md-4 no-padding p-1">
	            		  <div class="aa-promo-left">
	                  		<div class="aa-promo-banner">  
                          <?php if ($value->banner == 1): ?>
                            <img src="<?php echo $this->baseUrl().'Media/Category/'.$value->imageName;?>" alt="img">
                          <?php endif; ?>
	                    		<div class="aa-prom-content">
          									<h4 class="p-2" style="color: white; font-size: 20px;background: rgba(0,0,0,0.2);">
                              <?php echo $value->name; ?>
                            </h4>
					           			</div>
                  			</div>
                		</div>
                	</div>
			       	<?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </section>