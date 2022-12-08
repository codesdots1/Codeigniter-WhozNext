 <?php
    if ($message != '') { ?>
        <div class="alert alert-success alert-bordered">
            <button <?= base_url() . 'Item'?> class="close" data-dismiss="alert"><span>&times;</span><span
                        class="sr-only">Close</span></button>
            <span class="text-semibold"><?= $message ?>


        </div>
        <?php
    }
    ?>



