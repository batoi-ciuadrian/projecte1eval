<!-- Box within partners name and logo -->
    <div class="last-box row">
        <div class="col-xs-12 col-sm-4 col-sm-push-4 last-block">
            <div class="partner-box text-center">
                <p>
                    <i class="fa fa-map-marker fa-2x sr-icons"></i> 
                    <span class="text-muted">35 North Drive, Adroukpape, PY 88105, Agoe Telessou</span>
                </p>
                <h4>Our Main Partners</h4>
                <hr>
                <div class="text-muted text-left">
                    <?php if(count($associatsAleatori) > 0) { ?>
                    <ul class="list-inline">
                        <li><img style="width: 246px; height: 246px;" src='<?php echo $associatsAleatori[0]->getRutaImages(); ?>' alt='<?php echo $associatsAleatori[0]->getDescripcion(); ?>'></li>
                        <br>
                        <li>'<?php echo $associatsAleatori[0]->getNombre(); ?>'</li>
                    </ul>
                    <?php } ?>
                    <?php if(count($associatsAleatori) > 1) { ?>
                    <ul class="list-inline">
                        <li><img style="width: 246px; height: 246px;" src='<?php echo $associatsAleatori[1]->getRutaImages(); ?>' alt='<?php echo $associatsAleatori[1]->getDescripcion(); ?>'></li>
                        <br>
                        <li>'<?php echo $associatsAleatori[1]->getNombre(); ?>'</li>
                    </ul>
                    <?php } ?>
                    <?php if(count($associatsAleatori) > 2) { ?>
                    <ul class="list-inline">
                        <li><img style="width: 246px; height: 246px;" src='<?php echo $associatsAleatori[2]->getRutaImages(); ?>' alt='<?php echo $associatsAleatori[2]->getDescripcion(); ?>'></li>
                        <br>
                        <li>'<?php echo $associatsAleatori[2]->getNombre(); ?>'</li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Box within partners name and logo -->

