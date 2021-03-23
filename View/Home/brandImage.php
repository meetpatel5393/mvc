<?php $brands = $this->getBrands()->getData(); ?>
<!-- Client Brand -->
<section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12 m-0 p-0">
            <div class="aa-client-brand-area">
                <ul class="aa-client-brand-slider">
                    <?php foreach ($brands as $brand): ?>
                        <li><a href="#"><img style="width: 150px; height: 60px;" src="<?php echo $this->baseUrl().'Media/Brand/'.$brand->image; ?>"></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
      </div>
    </div>
</section>
<!-- / Client Brand -->