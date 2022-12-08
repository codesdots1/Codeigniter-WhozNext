<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
<div class="content">
    <?php
    if ($message != '') { ?>
        <div class="alert alert-warning alert-bordered">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                        class="sr-only">Close</span></button>
            <span class="text-semibold"><?= $message ?>

        </div>
    <?php } ?>


    <?php
    $form_id = array(
        'id' => 'loginfrm',
        'method' => 'post',
        'class' => 'form-horizontal'
    );


    echo form_open("auth/login", $form_id); ?>

	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
				<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url('<?= base_url()?>assets/media/bg/bg-4.jpg');">
					<div class="kt-grid__item">
						<a class="kt-login__logo">
							<img src="<?= base_url()?>assets/media/logos/logo-4.png">
						</a>
					</div>
					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
						<div class="kt-grid__item kt-grid__item--middle">
							<h3 class="kt-login__title">Welcome to WHOZ NXT!</h3>
						</div>
					</div>
					<div class="kt-grid__item">
						<div class="kt-login__info">
							<div class="kt-login__copyright">
								&copy 2020 Codexpert
							</div>
							<div class="kt-login__menu">
							</div>
						</div>
					</div>
				</div>
				<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
					<div class="kt-login__body">
						<div class="kt-login__form">
							<div class="kt-login__title">
								<h3>Sign In</h3>
							</div>

							<?php if($this->session->flashdata('login_msg')): ?>
									<span><?php echo $this->session->flashdata('login_msg'); ?></span>
						</div>
						<div class="alert alert-bold alert-solid-danger alert-dismissible" role="alert">
							<div class="alert-text"><?php echo $this->session->flashdata('login_msg'); ?></div>
							<div class="alert-close">
								<i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>
							</div>
						</div>
						<?php endif; ?>

						<div class="form-group">
							<input type="email" class="form-control" id="inputEmail" name="identity" required placeholder="Username">
							<div class="form-control-feedback" >
								<i class="icon-user text-muted"></i>
							</div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="inputPassword" name="password" required placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="kt-login__actions">
								<button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary"><?php echo lang('login_submit_btn') ?></button>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<script>
    $(document).ready(function () {

        var validator = $("#loginfrm").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function (error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                    if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo(element.parent().parent().parent().parent());
                    }
                    else {
                        error.appendTo(element.parent().parent().parent().parent().parent());
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo(element.parent().parent().parent());
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent());
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }

                else {
                    error.insertAfter(element);
                }
            },
            validClass: "validation-valid-label",
            success: function (label) {
                label.addClass("validation-valid-label").text("Success.")
            },
            rules: {
                identity: {
                    required: true,
                },
                password: {
                    required: true,
                },
                'g-recaptcha-response': {
                    required: true
                }
            },
            messages: {
                identity: {
                    required: "Please Enter <?= lang('identity') ?>",
                },
                password: {
                    required: "Please Enter <?= lang('password') ?>"
                },
                'g-recaptcha-response': {
                    required: '<?=lang('captcha_challenge') ?>',
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
<?php if (isset($select2)) { ?>
	<?= $select2 ?>
<?php } ?>
