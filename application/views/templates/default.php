<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= SITE_NAME ?></title>

	<!--    <link rel="icon" href="--><? //= $assets ?><!--../../uploads/logo.png" type="image/png" sizes="16x16">-->
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
		  type="text/css">
	<link href="<?= $assets ?>/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?= $assets ?>/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?= $assets ?>/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?= $assets ?>/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?= $assets ?>/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?= $assets ?>/css/colors.css" rel="stylesheet" type="text/css">


	<!-- /global stylesheets -->

	<style>
		.pageTitle {
			padding: 0px 25px 20px 0 !important;
		}

		.odd-color {
			background-color: #ECEFF1 !important;
		}

		.modal-open .ui-datepicker {
			z-index: 2000 !important
		}


	</style>

	<!-- Extra Css-->
	<?php
	if (isset($extra_css)) {
		foreach ($extra_css as $css) {
			echo '<link rel="stylesheet" href="' . $assets . $css . '">';
		}
	}
	?>


	<!-- Core JS files -->
	<script type="text/javascript" src="<?= $assets ?>js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?= $assets ?>js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?= $assets ?>js/core/libraries/bootstrap.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?= $assets ?>js/core/libraries/jquery_ui/core.min.js"></script>
	<script type="text/javascript" src="<?= $assets ?>js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="<?= $assets ?>js/plugins/forms/validation/validate.min.js"></script>

	<script type="text/javascript" src="<?= $assets ?>js/core/app.js"></script>
	<script type="text/javascript" src="<?= $assets ?>js/plugins/ui/ripple.min.js"></script>
	<script type="text/javascript" src="<?= $assets ?>js/plugins/buttons/spin.min.js"></script>
	<script type="text/javascript" src="<?= $assets ?>js/plugins/buttons/ladda.min.js"></script>



	<?php if(isset($datePicker)){ ?>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/pickadate/picker.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/notifications/jgrowl.min.js"></script>

		<script type="text/javascript" src="<?= $assets ?>js/plugins/ui/moment/moment.min.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/daterangepicker.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/anytime.min.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/pickadate/picker.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/pickadate/picker.date.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/pickadate/picker.time.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/pages/picker_date.js"></script>
	<?php } ?>


	<!-- /theme JS files -->


	<?php if(isset($datePicker)){ ?>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/pickadate/picker.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/notifications/jgrowl.min.js"></script>

		<script type="text/javascript" src="<?= $assets ?>js/plugins/ui/moment/moment.min.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/daterangepicker.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/anytime.min.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/pickadate/picker.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/pickadate/picker.date.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/plugins/pickers/pickadate/picker.time.js"></script>
		<script type="text/javascript" src="<?= $assets ?>js/pages/picker_date.js"></script>
	<?php } ?>


	<script>
		$.ajaxSetup({
			data: { <?= $this->security->get_csrf_token_name() ?>:
						'<?= $this->security->get_csrf_hash() ?>'
			}
		})
		;

	</script>

</head>

<body>
<!-- Main navbar -->
<div class="navbar navbar-default header-highlight">
	<div class="navbar-header">
		<a class="navbar-brand" href="<?= base_url(); ?>" style="color: #fff;"><?= SITE_NAME ?></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
			</li>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?= $assets ?>images/image.png" alt="">
					<span><?= $user_display_name; ?></span>
					<i class="caret"></i>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="<?= base_url('Auth/logout'); ?>"><i class="icon-switch2"></i>Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">


		<!-- Main sidebar -->
		<div class="sidebar sidebar-main">
			<div class="sidebar-content">
				<?php
				$CI =& get_instance();
				?>

				<!-- Main navigation -->
				<div class="sidebar-category sidebar-category-visible">
					<div class="category-content no-padding">
						<ul class="navigation navigation-main navigation-accordion">



							<li class="active"><a href="<?= base_url(); ?>"><i class="icon-home4"></i>
									<span>Dashboard</span></a></li>


							<!-- Start Site -->

							<!-- End Site  -->
							<!-- Customer-->
							<li>
								<a href="#"><i class="fa fa-book"></i> <span><?= lang('business') ?></span></a>
								<ul>
									<?php
									//Customer
									if ($CI->dt_ci_acl->checkAccess("Business|index")) {
										echo '<li ' . $CI->dt_ci_acl->getActiveMenu("Business/index") . ' ' . $CI->dt_ci_acl->getActiveMenu("Business") . '><a  href="' . base_url() . 'Business"><i class="fa fa-book"></i><span class="sidebar-mini-hide">' . lang('business') . '</span></a></li>';
									}
									?>
								</ul>
							</li>
							<!-- End Samaj-->

							<!-- Reports-->
							<li>
								<a href="#"><i class="fa fa-braille"></i> <span><?= lang('category') ?></span></a>
								<ul>
									<?php
									//Customer
									if ($CI->dt_ci_acl->checkAccess("Categories|index")) {
										echo '<li ' . $CI->dt_ci_acl->getActiveMenu("Categories/index") . ' ' . $CI->dt_ci_acl->getActiveMenu("Categories") . '><a  href="' . base_url() . 'Categories"><i class="fa fa-braille"></i><span class="sidebar-mini-hide">' . lang('category') . '</span></a></li>';
									}
									?>
								</ul>
							</li>

							<li>
								<a href="#"><i class="fa fa-users"></i> <span><?= lang('staff') ?></span></a>
								<ul>
									<?php
									//Customer
									if ($CI->dt_ci_acl->checkAccess("Staff|index")) {
										echo '<li ' . $CI->dt_ci_acl->getActiveMenu("Staff/index") . ' ' . $CI->dt_ci_acl->getActiveMenu("Staff") . '><a  href="' . base_url() . 'Staff"><i class="fa fa-users"></i><span class="sidebar-mini-hide">' . lang('staff') . '</span></a></li>';
									}
									?>
								</ul>
							</li>

							<li>
								<a href="#"><i class="fa fa-cogs"></i> <span><?= lang('services') ?></span></a>
								<ul>
									<?php
									//Customer
									if ($CI->dt_ci_acl->checkAccess("Services|index")) {
										echo '<li ' . $CI->dt_ci_acl->getActiveMenu("Services/index") . ' ' . $CI->dt_ci_acl->getActiveMenu("Services") . '><a  href="' . base_url() . 'Services"><i class="fa fa-cogs"></i><span class="sidebar-mini-hide">' . lang('services') . '</span></a></li>';
									}
									?>
								</ul>
							</li>

							<li>
								<a href="#"><i class="fa fa-check-square-o"></i> <span><?= lang('bookings') ?></span></a>
								<ul>
									<?php
									//Customer
									if ($CI->dt_ci_acl->checkAccess("Bookings|index")) {
										echo '<li ' . $CI->dt_ci_acl->getActiveMenu("Bookings/index") . ' ' . $CI->dt_ci_acl->getActiveMenu("Bookings") . '><a  href="' . base_url() . 'Bookings"><i class="fa fa-check-square-o"></i><span class="sidebar-mini-hide">' . lang('bookings') . '</span></a></li>';
									}
									?>
								</ul>
							</li>
							
							<li>
								<a href="#"><i class="fa fa-image"></i> <span><?= lang('gallery') ?></span></a>
								<ul>
									<?php
									//Customer
									if ($CI->dt_ci_acl->checkAccess("Gallery|index")) {
										echo '<li ' . $CI->dt_ci_acl->getActiveMenu("Gallery/index") . ' ' . $CI->dt_ci_acl->getActiveMenu("Gallery") . '><a  href="' . base_url() . 'Gallery"><i class="fa fa-image"></i><span class="sidebar-mini-hide">' . lang('gallery') . '</span></a></li>';
									}
									?>
								</ul>
							</li>

							<!-- End Reports-->

						</ul>
					</div>
				</div>
				<!-- /main navigation -->

			</div>
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">


			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content ">
					<div class="page-title pageTitle">

					</div>


				</div>

				<div id="Scroll" class="breadcrumb-line breadcrumb-line-component">

					<ul class="breadcrumb">
						<li><a href="<?= site_url(); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
						<?php if ($this->uri->segment(1) != '' && $this->uri->segment(2) == '') { ?>
							<!--                            <li class="active">$this->uri->segment(1)</li>-->
							<li class="active"><?= preg_replace('/(?<!\ )[A-Z]/', ' $0', $this->uri->segment(1)); ?></li>
						<?php } else if ($this->uri->segment(2) != '') { ?>
							<!--                            <li><a href=" site_url($this->uri->segment(1));">$this->uri->segment(1)</a> </li>-->
							<li>
								<a href="<?= site_url($this->uri->segment(1)); ?>"><?= preg_replace('/(?<!\ )[A-Z]/', ' $0', $this->uri->segment(1)) ?></a>
							</li>
							<li class="active"><?= ucwords(basename(site_url($this->uri->segment(2)))); ?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="content">
				<!-- /page header -->
				<?php echo $body; ?>

				<!-- Footer -->
				<div class="footer text-muted">
					&copy; <?php echo date('Y'); ?> <a href="#" target="_blank">CodeExpert Solution</a>
				</div>
				<!-- /footer -->

			</div>
		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</div>
<!-- /page container -->
<?php
if (isset($extra_js)) {
	foreach ($extra_js as $js) {
		echo '<script type="text/javascript" src="' . $assets . $js . '"></script>';
		echo "\n";
	}
}

?>

</body>

<script>

	$(document).ready(function(){
		$('select').on("select2:close", function () { $(this).focus(); });
	})

	var dt_DataTable;


	//var laddaSubmitBtn = Ladda.create(document.querySelector('#submit'));

	function laddaStart() {
		laddaSubmitBtn.start();
		$("#icon-hide").removeClass('icon-arrow-right8');
	}


	function laddaStop() {
		laddaSubmitBtn.stop();
		$("#icon-hide").addClass('icon-arrow-right8');
	}

	function DtSwitcheryKeyGen() {
		var switcherySettings =
				{
					color: '#455A64'
				};

		if (Array.prototype.forEach) {
			var elems = Array.prototype.slice.call(document.querySelectorAll('.dt_switchery'));
			elems.forEach(function (html) {
				var switchery = new Switchery(html, switcherySettings);
			});
		}
		else {
			var elems = document.querySelectorAll('.dt_switchery');
			for (var i = 0; i < elems.length; i++) {
				var switchery = new Switchery(elems[i], switcherySettings);
			}
		}
	}

	function SwitcheryKeyGen() {
		var switcherySettings =
				{
					color: '#455A64'
				};

		if (Array.prototype.forEach) {
			var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
			elems.forEach(function (html) {
				var switchery = new Switchery(html, switcherySettings);
			});
		}
		else {
			var elems = document.querySelectorAll('.switchery');
			for (var i = 0; i < elems.length; i++) {
				var switchery = new Switchery(elems[i], switcherySettings);
			}
		}
	}

	function CheckboxKeyGen(Type) {
		if (Type == 'checkAll') {
			$('#checkAll').prop('checked', false);
		}
		$(".styled").uniform({
			checkboxClass: 'checker'
		});
	}

	//    function CheckboxKeyGen() {
	//        $(".styled").uniform({
	//            checkboxClass: 'checker'
	//        });
	//    }

	function RadioKeyGen() {
		$(".styledRadio").uniform({
			radioClass: 'choice'
		});
	}

	function FileKeyGen() {
		// Primary file input
		$(".file-styled-primary").uniform({
			fileButtonClass: 'action btn bg-blue'
		});
	}

	function CustomToolTip() {

		$('[data-popup=custom-tooltip]').tooltip({
			trigger: 'hover',
			template: '<div class="tooltip"><div class="bg-grey-800"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div></div>'
		});
	}

	var id = "";

	function startDateInit(id) {
		$(id).datepicker({
			dateFormat: "<?= DATE_FORMATE ?>",
			todayBtn: "linked",
			autoclose: true,
			todayHighlight: true,
			changeMonth: true,
			changeYear: true,
			//container: '#fiscalYearModal modal-body',
			onSelect: function (selected) {
				$("#end_date").datepicker("option", "minDate", selected)
			}
		}).on('changeDate', function () {
			// $(this).valid();  // triggers the validation test
			if ($(id).valid()) {
				$(id).removeClass('invalid').addClass('success');
			}
		});
	}


	function endDateInit(id) {
		$(id).datepicker({
			dateFormat: "<?= DATE_FORMATE ?>",
			todayBtn: "linked",
			autoclose: true,
			todayHighlight: true,
			changeMonth: true,
			changeYear: true,
			// container: '#fiscalYearModal modal-body',
			onSelect: function (selected) {
				//$("#start_date").datepicker("option", "maxDate", selected)
			}
		}).on('changeDate', function () {
			$(this).valid();  // triggers the validation test
		});
	}


	function dateInit(id) {
		$(id).datepicker({
			dateFormat: "<?= DATE_FORMATE ?>",
			todayBtn: "linked",
			autoclose: true,
			todayHighlight: true,
//            changeMonth: true,
//            changeYear: true,
			maxDate: new Date(),
			//orientation: "top auto",
			//  orientation: "top bottom",
			//container: '#fiscalYearModal modal-body',
//            onSelect: function (selected) {
//                $("#end_date").datepicker("option", "minDate", selected)
//            }
		}).on('changeDate', function () {
			// $(this).valid();  // triggers the validation test
			if ($(id).valid()) {
				$(id).removeClass('invalid').addClass('success');
			}

		});
	}

	function CountryStateCityDD(countryId='', stateId='', cityId='') {
		$("#country_id").select2({
			ajax: {
				url: "<?= site_url('Country/getCountryDD') ?>",
				dataType: 'json',
				type: 'post',
				delay: 250,
				data: function (params) {
					return {
						filter_param: params.term || '', // search term
						countryIdActive: countryId,
						page: params.page || 1
					};
				},
				processResults: function (data, params) {
					// parse the results into the format expected by Select2
					// since we are using custom formatting functions we do not need to
					// alter the remote JSON data, except to indicate that infinite
					// scrolling can be used
//                    params.page = params.page || 1;

					return {
						results: data.result,
						pagination: {
							more: (data.page * 10) < data.totalRows

						}
					};
				},
				//cache: true
			},
			placeholder: 'Search For Your Country',
			escapeMarkup: function (markup) {
				return markup;
			}, // let our custom formatter work
			//minimumInputLength: 2,
		}).on('select2:select', function () {
			if ($("#" + $(this).attr('id')).valid()) {
				$("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
			}
			$('#state_id').val(null).trigger('change');
			$('#state_id-error').html("");
			$('#city_id').val(null).trigger('change');
			$('#city_id-error').html("");
		});


		$("#state_id").select2({
			ajax: {
				url: "<?= site_url('State/getStateDD') ?>",
				dataType: 'json',
				type: 'post',
				delay: 250,
				data: function (params) {
					return {
						filter_param: params.term || '', // search term
						countryId: $("#country_id").val(),
						stateIdActive: stateId,
						page: params.page || 1
					};
				},
				processResults: function (data, params) {
					// parse the results into the format expected by Select2
					// since we are using custom formatting functions we do not need to
					// alter the remote JSON data, except to indicate that infinite
					// scrolling can be used
//                    params.page = params.page || 1;

					return {
						results: data.result,
						pagination: {
							more: (data.page * 10) < data.totalRows

						}
					};
				},
				//cache: true
			},
			placeholder: 'Search For Your State',
			escapeMarkup: function (markup) {
				return markup;
			}, // let our custom formatter work
			//minimumInputLength: 2,
		}).on('select2:select', function () {
			if ($("#" + $(this).attr('id')).valid()) {
				$("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
			}
			$('#city_id').val(null).trigger('change');
			$('#city_id-error').html("");
		});


		$("#city_id").select2({
			ajax: {
				url: "<?= site_url('City/getCityDD') ?>",
				dataType: 'json',
				type: 'post',
				delay: 250,
				data: function (params) {
					return {
						filter_param: params.term || '', // search term
						stateId: $("#state_id").val(),
						cityIdActive: cityId,
						page: params.page || 1
					};
				},
				processResults: function (data, params) {
					// parse the results into the format expected by Select2
					// since we are using custom formatting functions we do not need to
					// alter the remote JSON data, except to indicate that infinite
					// scrolling can be used
//                    params.page = params.page || 1;

					return {
						results: data.result,
						pagination: {
							more: (data.page * 10) < data.totalRows

						}
					};
				},
				//cache: true
			},
			placeholder: 'Search For Your City',
			escapeMarkup: function (markup) {
				return markup;
			}, // let our custom formatter work
			//minimumInputLength: 2,


		}).on('select2:select', function () {
			if ($("#" + $(this).attr('id')).valid()) {
				$("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
			}
		});
	}

	$(".filter_data").on('click', function () {
		$("#submit_btn").val('true');
		dt_DataTable.draw();
	});

	$(".clear_filter").on('click', function () {
		DtFormClear('advanceFilter');
		$("#created_at_start_date").val('');
		$("#created_at_end_date").val('');
		dt_DataTable.draw();
	});


	function calculateTotal() {
		var all_exchange_rate = $.parseJSON($("#all_exchange_rate").text());
		if (all_exchange_rate != '') {
			var total = 0;
			var customer_currency_id = parseInt($(".customer_currency_id").val()) + 0;
			var company_currency_id = parseInt($(".company_currency_id").val()) + 0;
			var exchange_rate = parseFloat($(".conversion_rate").val());
			console.log(typeof  exchange_rate);
			$(".item_total_amount").each(function () {

				var row = $(this);
				var quantity = parseFloat(row.parents("tr").find(".item_quantity").val());
				var rate = parseFloat(row.attr('data-original_rate'));

				var amount = parseFloat(row.val());
				var currency_id = parseFloat(row.attr('data-item_currency'));

				var found = false;

				quantity = isNaN(quantity) ? 0 : quantity;
				rate = isNaN(rate) ? 0 : rate;
				amount = isNaN(amount) ? 0 : amount;

				if (currency_id == company_currency_id) {
					amount = (rate * quantity).toFixed(2);
				} else {
					$.each(all_exchange_rate, function (index, value) {
						var exchange_rate = parseFloat(value.exchange_rate);
						if (value.from_currency == currency_id && value.to_currency == company_currency_id) {
							rate = (rate / parseFloat(value.exchange_rate)).toFixed(2); // convert rate to customer currency exchange rate
							amount = (rate * quantity).toFixed(2);
							found = true;
							return false;
						}
					});
					if (!found) {
						amount = (rate * quantity).toFixed(2);
					}
				}
				row.parents("tr").find("td:eq(2) input").val(rate); // set rate
				row.val(amount); // set total
				total += parseFloat(amount); // addition to grand total
			});

			$("#company_total").val(total.toFixed(2));
			$("#company_net_total").val(total.toFixed(2));

			var total_tax_amount = parseFloat(total);
			var tax_total = 0;
			$(".tax_rate").each(function () {
				var tax_rate = parseFloat($(this).val());
				var tax_amount = 0;
				if (tax_rate > 0) {
					tax_amount = ((total * tax_rate) / 100).toFixed(2);
					total_tax_amount = total_tax_amount + parseFloat(tax_amount);
					tax_total = tax_total + parseFloat(tax_amount);
					$(this).closest("tr").find('.tax_amount').val(tax_amount);
					$(this).closest("tr").find('.tax_total').val(total_tax_amount.toFixed(2));
				}
			});
			$("#base_total_taxes").val(tax_total.toFixed(2));
			$("#total_taxes").val((tax_total * exchange_rate).toFixed(2));

			total = total_tax_amount;

			var apply_discount_on = $("#apply_discount_on").val();
			var additional_discount_percentage = parseFloat($("#additional_discount_percentage").val());
			var base_discount_amount = 0;
			var discount_amount = 0;

			if (additional_discount_percentage > 0) {
				var amount = parseFloat((apply_discount_on == 'grand total') ? total : (apply_discount_on == 'net total' ? $("#company_total").val() : 0 ));
				if (amount > 0) {
					var disc = (amount * additional_discount_percentage) / 100;
					base_discount_amount = disc.toFixed(2);
					discount_amount = (base_discount_amount * exchange_rate).toFixed(2);
				}
			}
			total = total - base_discount_amount;
			var round_total = Math.ceil(total);
			var round_adjustment = (round_total - total).toFixed(2);

			$("#base_discount_amount").val(base_discount_amount);
			$("#discount_amount").val(discount_amount);

			$("#base_grand_total").val(total.toFixed(2));
			$("#base_rounding_adjustment").val(round_adjustment);
			$("#base_rounded_total").val(round_total);

			var customer_total = (parseFloat($("#company_total").val()) * exchange_rate).toFixed(2);
			$("#customer_total").val(customer_total);
			$("#customer_net_total").val(customer_total);

			var grand_total = (total * exchange_rate).toFixed(2);
			round_adjustment = (round_adjustment * exchange_rate).toFixed(2);
			round_total = (round_total * exchange_rate).toFixed(2);

			$("#grand_total").val(grand_total);
			$("#rounding_adjustment").val(round_adjustment);
			$("#rounded_total").val(round_total);
		}

	}

	function fetchAllCurrencyExchange(for_data, currency_id) {

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('CurrencyExchange/getExchangeRate');?>",
			dataType: "json",
			data: {currency_id: currency_id},
			success: function (data) {
				$("#" + for_data + "_exchange_rate").text(JSON.stringify(data));
				$("." + for_data + "_currency_id").val(currency_id);
				getConversionRate();
			}
		});
	}

	function getConversionRate() {
		var customer_currency_id = parseInt($(".customer_currency_id").val());
		var company_currency_id = parseInt($(".company_currency_id").val());
		if (customer_currency_id == company_currency_id) {
			$(".conversion_rate").val(1);
		}

		else if (customer_currency_id > 0 && company_currency_id > 0) {
			var customer_exchange_rate = $.parseJSON($("#customer_exchange_rate").text());
			$.each(customer_exchange_rate, function (index, value) {
				if (value.from_currency == customer_currency_id && value.to_currency == company_currency_id) {
					$(".conversion_rate").val(value.exchange_rate);
					return false;
				}
			});
		}
		calculateTotal();
	}

	// supplier start
	function fetchAllCurrencyExchangeSupplier(for_data, currency_id) {
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('CurrencyExchange/getExchangeRate');?>",
			dataType: "json",
			data: {currency_id: currency_id},
			success: function (data) {
				$("#" + for_data + "_exchange_rate").text(JSON.stringify(data));
				$("." + for_data + "_currency_id").val(currency_id);
				getConversionRateSupplier();
			}
		});
	}


	function getConversionRateSupplier() {
		var customer_currency_id = parseInt($("#currency_id").val());

		// console.log("customer_currency_id");
		//console.log(customer_currency_id);
		//naitik var customer_currency_id = parseInt($(".supplier_currency_id").val());
		var company_currency_id = parseInt($(".company_currency_id").val());

		//console.log("company_currency_id");
		//console.log(company_currency_id);

		if (customer_currency_id == company_currency_id) {
			$(".conversion_rate").val(1);
		}


		else if (customer_currency_id > 0 && company_currency_id > 0) {

			var customer_exchange_rate = $.parseJSON($("#supplier_exchange_rate").text());
			//  console.log("else if");
			// console.log(customer_exchange_rate);


			$.each(customer_exchange_rate, function (index, value) {
				// naitik if (value.from_currency == customer_currency_id && value.to_currency == company_currency_id) {
				if (value.from_currency == company_currency_id && value.to_currency == customer_currency_id) {
					$(".conversion_rate").val(value.exchange_rate);
					return false;
				}
			});
		}
		calculateTotalSupplier();
	}


	function calculateTotalSupplier() {

		//console.log("calculateTotalSupplier");

		var json = $("#all_exchange_rate").text();

		if (json != '') {

			var total = 0;

			var displaytotal = 0;

			var taxDisplayamount = 0;

			var customer_currency_id = parseInt($(".supplier_currency_id").val()) + 0;

			var company_currency_id = parseInt($(".company_currency_id").val()) + 0;



			var exchange_rate = parseFloat($(".conversion_rate").val()).toFixed(2);


			var all_exchange_rate = $.parseJSON($("#all_exchange_rate").text());



			$(".item_total_amount").each(function () {

				var row = $(this);

//                var quantity = parseFloat(row.parents("tr").find("td:eq(1) input").val());
				var quantity = parseFloat(row.parents("tr").find(".item_quantity").val());


				var rate = parseFloat(row.attr('data-original_rate'));


				var amount = parseFloat(row.val());


				var currency_id = parseFloat(row.attr('data-item_currency'));

				var found = false;

				quantity = isNaN(quantity) ? 0 : quantity;

				rate = isNaN(rate) ? 0 : rate;

				amount = isNaN(amount) ? 0 : amount;


				if (currency_id == company_currency_id) {
					itemDisplayRate = parseFloat(rate * exchange_rate);
					amount = (rate * quantity).toFixed(2);
					itemDisplayamount = (itemDisplayRate * quantity).toFixed(2);
				}
				else
				{
					$.each(all_exchange_rate, function (index, value) {
						//var exchange_rate = parseFloat(value.exchange_rate);
						if (value.from_currency == currency_id && value.to_currency == company_currency_id) {

							rate = (rate * parseFloat(value.exchange_rate)).toFixed(2); // convert rate to customer currency exchange rate


							itemDisplayRate = parseFloat(rate * exchange_rate);

							itemDisplayamount = (itemDisplayRate * quantity).toFixed(2);


							amount = (rate * quantity).toFixed(2);

							found = true;

							return false;
						}
					});

					if (!found) {
						itemDisplayRate = parseFloat(rate * exchange_rate);
						itemDisplayamount = (itemDisplayRate * quantity).toFixed(2);
						amount = (rate * quantity).toFixed(2);
					}
				}

//                row.parents("tr").find("td:eq(2) input").val(itemDisplayRate); // set rate
				row.parents("tr").find(".item_rate").val(itemDisplayRate); // set rate


				row.val(itemDisplayamount);   // set total
				total += parseFloat(amount);   // addition to grand total
				displaytotal += parseFloat(itemDisplayamount); // addition to grand total
			});



			$("#base_total").val(total.toFixed(2));
			$("#base_net_total").val(total.toFixed(2));

			var total_tax_amount = parseFloat(total);
			var taxDisplayamount = parseFloat(displaytotal);

			var tax_total = 0;

			$(".tax_rate").each(function () {
				var tax_rate = parseFloat($(this).val());
				var tax_amount = 0;
				if (tax_rate > 0) {
					tax_amount = ((total * tax_rate) / 100).toFixed(2);
					taxDisplayRate = parseFloat(tax_amount * exchange_rate);
					taxDisplayamount = taxDisplayamount + parseFloat(taxDisplayRate);
					total_tax_amount = total_tax_amount + parseFloat(tax_amount);
					tax_total = tax_total + parseFloat(tax_amount);
					$(this).closest("tr").find('.tax_amount').val(taxDisplayRate);
					$(this).closest("tr").find('.tax_total').val(taxDisplayamount.toFixed(2));
				}
			});



			$("#base_total_taxes_and_charges").val(tax_total.toFixed(2));
			$("#total_taxes_and_charges").val((tax_total * exchange_rate).toFixed(2));

			total = total_tax_amount;

			var apply_discount_on = $("#apply_discount_on").val();
			var additional_discount_percentage = parseFloat($("#additional_discount_percentage").val());
			var base_discount_amount = 0;
			var discount_amount = 0;

			if (additional_discount_percentage > 0) {
				var amount = parseFloat((apply_discount_on == 'grand total') ? total : (apply_discount_on == 'net total' ? $("#base_total").val() : 0 ));
				if (amount > 0) {
					var disc = (amount * additional_discount_percentage) / 100;
					base_discount_amount = disc.toFixed(2);
					discount_amount = (base_discount_amount * exchange_rate).toFixed(2);
				}
			}

			total = total - base_discount_amount;

			var round_total = Math.ceil(total);
			var round_adjustment = (round_total - total).toFixed(2);

			$("#base_discount_amount").val(base_discount_amount);
			$("#discount_amount").val(discount_amount);


			$("#base_grand_total").val(total.toFixed(2));
			$("#base_rounding_adjustment").val(round_adjustment);
			$("#base_rounded_total").val(round_total);


			var customer_total = (parseFloat($("#base_total").val()) * exchange_rate).toFixed(2);

			$("#total").val(customer_total);
			$("#net_total").val(customer_total);

			var grand_total = (total * exchange_rate).toFixed(2);
			round_adjustment = (round_adjustment * exchange_rate).toFixed(2);
			round_total = (round_total * exchange_rate).toFixed(2);

			$("#grand_total").val(grand_total);
			$("#rounding_adjustment").val(round_adjustment);
			$("#rounded_total").val(round_total);
		}
	}
	// supplier end



	function fetchAllCurrencyExchangeHire(for_data, currency_id) {

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('CurrencyExchange/getExchangeRate');?>",
			dataType: "json",
			data: {currency_id: currency_id},
			success: function (data) {
				$("#" + for_data + "_exchange_rate").text(JSON.stringify(data));
				$("." + for_data + "_currency_id").val(currency_id);

				getConversionRateHire();

			}
		});
	}

	function getConversionRateHire() {
		var customer_currency_id = parseInt($(".customer_currency_id").val());
		var company_currency_id = parseInt($(".company_currency_id").val());
		if (customer_currency_id == company_currency_id) {
			$(".conversion_rate").val(1);
		}

		else if (customer_currency_id > 0 && company_currency_id > 0) {
			var customer_exchange_rate = $.parseJSON($("#customer_exchange_rate").text());
			$.each(customer_exchange_rate, function (index, value) {
				if (value.from_currency == customer_currency_id && value.to_currency == company_currency_id) {
					$(".conversion_rate").val(value.exchange_rate);
					return false;
				}
			});
		}
		calculateTotalHire();
	}


	function calculateTotalHire() {
		var total = 0;

		var customer_currency_id = parseInt($(".customer_currency_id").val()) + 0;
		var company_currency_id = parseInt($(".company_currency_id").val()) + 0;
		var exchange_rate = parseFloat($(".conversion_rate").val()).toFixed(2);

		var all_exchange_rate = $.parseJSON($("#all_exchange_rate").text());
		$(".item_total_amount").each(function () {

			var row = $(this);
			var quantity = parseFloat(row.parents("tr").find("td:eq(1) input").val());
			var rate = parseFloat(row.attr('data-original_rate'));

			var amount = parseFloat(row.val());
			var currency_id = parseFloat(row.attr('data-item_currency'));

			var found = false;

			quantity = isNaN(quantity) ? 0 : quantity;
			rate = isNaN(rate) ? 0 : rate;
			amount = isNaN(amount) ? 0 : amount;

			if (currency_id == company_currency_id) {
				amount = (rate * quantity).toFixed(2);
			} else {
				$.each(all_exchange_rate, function (index, value) {
					var exchange_rate = parseFloat(value.exchange_rate);
					if (value.from_currency == currency_id && value.to_currency == company_currency_id) {
						rate = (rate / parseFloat(value.exchange_rate)).toFixed(2); // convert rate to customer currency exchange rate
						amount = (rate * quantity).toFixed(2);
						found = true;
						return false;
					}
				});
				if (!found) {
					amount = (rate * quantity).toFixed(2);
				}
			}
			row.parents("tr").find("td:eq(2) input").val(rate); // set rate
			row.val(amount); // set total
			total += parseFloat(amount); // addition to grand total
		});

		$("#base_total").val(total.toFixed(2));
		$("#base_net_total").val(total.toFixed(2));

		var total_tax_amount = parseFloat(total);
		var tax_total = 0;
		$(".tax_rate").each(function () {
			var tax_rate = parseFloat($(this).val());
			var tax_amount = 0;
			if (tax_rate > 0) {
				tax_amount = ((total * tax_rate) / 100).toFixed(2);
				total_tax_amount = total_tax_amount + parseFloat(tax_amount);
				tax_total = tax_total + parseFloat(tax_amount);
				$(this).closest("tr").find('.tax_amount').val(tax_amount);
				$(this).closest("tr").find('.tax_total').val(total_tax_amount.toFixed(2));
			}
		});

		$("#base_total_taxes_and_charges").val(tax_total.toFixed(2));
		$("#total_taxes_and_charges").val((tax_total * exchange_rate).toFixed(2));

		total = total_tax_amount;

		var apply_discount_on = $("#apply_discount_on").val();
		var additional_discount_percentage = parseFloat($("#additional_discount_percentage").val());
		var base_discount_amount = 0;
		var discount_amount = 0;

		if (additional_discount_percentage > 0) {
			var amount = parseFloat((apply_discount_on == 'grand total') ? total : (apply_discount_on == 'net total' ? $("#base_total").val() : 0 ));
			if (amount > 0) {
				var disc = (amount * additional_discount_percentage) / 100;
				base_discount_amount = disc.toFixed(2);
				discount_amount = (base_discount_amount * exchange_rate).toFixed(2);
			}
		}
		total = total - base_discount_amount;
		var round_total = Math.ceil(total);
		var round_adjustment = (round_total - total).toFixed(2);

		$("#base_discount_amount").val(base_discount_amount);
		$("#discount_amount").val(discount_amount);

		$("#base_grand_total").val(total.toFixed(2));
		$("#base_rounding_adjustment").val(round_adjustment);
		$("#base_rounded_total").val(round_total);

		var customer_total = (parseFloat($("#base_total").val()) * exchange_rate).toFixed(2);
		$("#total").val(customer_total);
		$("#net_total").val(customer_total);

		var grand_total = (total * exchange_rate).toFixed(2);
		round_adjustment = (round_adjustment * exchange_rate).toFixed(2);
		round_total = (round_total * exchange_rate).toFixed(2);

		$("#grand_total").val(grand_total);
		$("#rounding_adjustment").val(round_adjustment);
		$("#rounded_total").val(round_total);
	}


	//    commom module

	function fetchAllCurrencyExchange1(for_data, currency_id) {
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('CurrencyExchange/getExchangeRate');?>",
			dataType: "json",
			data: {currency_id: currency_id},
			success: function (data) {
				$("." + for_data + "_exchange_rate").text(JSON.stringify(data));
				$("." + for_data + "_currency_id").val(currency_id);

				getConversionRate1();
			}
		});
	}

	function getConversionRate1() {
		var customer_currency_id = parseInt($("#currency_id").val());
		//var customer_currency_id = parseInt($(".customer_currency_id").val());
		var company_currency_id = parseInt($(".company_currency_id").val());

		if (customer_currency_id == company_currency_id) {
			$(".conversion_rate").val(1);
		}
		else if (customer_currency_id > 0 && company_currency_id > 0) {
			var customer_exchange_rate = $.parseJSON($(".customer_exchange_rate").text());
			$.each(customer_exchange_rate, function (index, value) {
				if (value.from_currency == company_currency_id && value.to_currency == customer_currency_id) {
					// if (value.from_currency == customer_currency_id && value.to_currency == company_currency_id) {
					$(".conversion_rate").val(value.exchange_rate);
					return false;
				}
			});
		}
		calculateTotal1();
	}


	function calculateTotal1() {

		var total = 0;
		var displaytotal = 0;
		var taxDisplayamount = 0;
		var customer_currency_id = parseInt($(".customer_currency_id").val()) + 0;
		var company_currency_id = parseInt($(".company_currency_id").val()) + 0;
		var exchange_rate = parseFloat($(".conversion_rate").val()).toFixed(2);

		var all_exchange_rate = $.parseJSON($("#all_exchange_rate").text());

		$(".item_total_amount").each(function () {

			var row = $(this);
			//var quantity = parseFloat(row.parents("tr").find("td:eq(1) input").val());
			var quantity = parseFloat(row.parents("tr").find(".item_quantity").val());
			var rate = parseFloat(row.attr('data-change_rate'));
			var rateOrg = parseFloat(row.attr('data-original_rate'));
			//var changeRate = parseFloat(row.attr('data-original_rate'));
			//var rate = parseFloat(row.parents("tr").find(".item_rate").val());
			//console.log(row.parents("tr").find(".item_rate").val());

			var amount = parseFloat(row.val());
			var currency_id = parseFloat(row.attr('data-item_currency'));

			var found = false;

			quantity = isNaN(quantity) ? 0 : quantity;
			rate = isNaN(rate) ? 0 : rate;
			amount = isNaN(amount) ? 0 : amount;
			//var itemDisplayRate = rateOrg;
			if (currency_id == company_currency_id) {
				//amount = (rate * quantity).toFixed(2);

				// agentx change start
				if(parseFloat(rateOrg) == parseFloat(rate)){
					itemDisplayRate = parseFloat(rate * exchange_rate);

				} else {
					itemDisplayRate = rate;
				}
				amount = (rate * quantity).toFixed(2);
				itemDisplayamount = (itemDisplayRate * quantity).toFixed(2);
				// agentx change end

			} else {

				$.each(all_exchange_rate, function (index, value) {
					var exchange_rate = parseFloat(value.exchange_rate);
					if (value.from_currency == currency_id && value.to_currency == company_currency_id) {
						if(parseFloat(rateOrg) == parseFloat(rate)){
							rate = (rate / parseFloat(value.exchange_rate)).toFixed(2); // convert rate to customer currency exchange rate
						}
						amount = (rate * quantity).toFixed(2);
						// agentx change start
						if(parseFloat(rateOrg) == parseFloat(rate)){
							itemDisplayRate = parseFloat(rate * exchange_rate);
						} else {
							itemDisplayRate = rate;
						}
						itemDisplayamount = (itemDisplayRate * quantity).toFixed(2);
						// agentx change start
						found = true;
						return false;
					}
				});
				if (!found) {
					if(parseFloat(rateOrg) == parseFloat(rate)){
						console.log(1);
						itemDisplayRate = parseFloat(rate * exchange_rate);
					} else {
						itemDisplayRate = rate;
					}
					itemDisplayamount = (itemDisplayRate * quantity).toFixed(2);
					amount = (rate * quantity).toFixed(2);
				}
			}
			// row.parents("tr").find("td:eq(2) input").val(rate); // set rate
			//row.parents("tr").find(".item_rate").val(rate);
			//row.val(amount); // set total
			//total += parseFloat(amount); // addition to grand total
			console.log(itemDisplayRate);
			row.parents("tr").find(".item_rate").val(parseFloat(itemDisplayRate).toFixed(2)); // set rate
			$(this).closest("tr").find(".item_total_amount").attr("data-change_rate",parseFloat(itemDisplayRate).toFixed(2));
			row.val(itemDisplayamount); // set total
			total += parseFloat(amount); // addition to grand total
			displaytotal += parseFloat(itemDisplayamount); // addition to grand total
		});

		$("#base_total").val(total.toFixed(2));
		$("#base_net_total").val(total.toFixed(2));

		var total_tax_amount = parseFloat(total);
		var tax_total = 0;
		$(".tax_rate").each(function () {
			var tax_rate = parseFloat($(this).val());
			var tax_amount = 0;
			if (tax_rate > 0) {
				tax_amount = ((total * tax_rate) / 100).toFixed(2);
				taxDisplayRate = parseFloat(tax_amount * exchange_rate);
				taxDisplayamount = taxDisplayamount + parseFloat(taxDisplayRate);
				total_tax_amount = total_tax_amount + parseFloat(tax_amount);

				tax_total = tax_total + parseFloat(tax_amount);
				$(this).closest("tr").find('.tax_amount').val(taxDisplayRate);
				//$(this).closest("tr").find('.tax_amount').val(tax_amount);
				$(this).closest("tr").find('.tax_total').val(total_tax_amount.toFixed(2));
			}
		});
		$("#base_total_taxes_and_charges").val(tax_total.toFixed(2));
		$("#total_taxes_and_charges").val((tax_total * exchange_rate).toFixed(2));

		total = total_tax_amount;

		var apply_discount_on = $("#apply_discount_on").val();
		var additional_discount_percentage = parseFloat($("#additional_discount_percentage").val());
		var base_discount_amount = 0;
		var discount_amount = 0;

		if (additional_discount_percentage > 0) {
			var amount = parseFloat((apply_discount_on == 'grand total') ? total : (apply_discount_on == 'net total' ? $("#base_total").val() : 0 ));
			if (amount > 0) {
				var disc = (amount * additional_discount_percentage) / 100;
				base_discount_amount = disc.toFixed(2);
				discount_amount = (base_discount_amount * exchange_rate).toFixed(2);
			}
		}
		total = total - base_discount_amount;
		var round_total = Math.ceil(total);
		var round_adjustment = (round_total - total).toFixed(2);

		$("#base_discount_amount").val(base_discount_amount);
		$("#discount_amount").val(discount_amount);


		$("#base_grand_total").val(total.toFixed(2));
		$("#base_rounding_adjustment").val(round_adjustment);
		$("#base_rounded_total").val(round_total);


		var customer_total = (parseFloat($("#base_total").val()) * exchange_rate).toFixed(2);
		$("#total").val(customer_total);
		$("#net_total").val(customer_total);

		var grand_total = (total * exchange_rate).toFixed(2);
		round_adjustment = (round_adjustment * exchange_rate).toFixed(2);
		round_total = (round_total * exchange_rate).toFixed(2);

		$("#grand_total").val(grand_total);
		$("#rounding_adjustment").val(round_adjustment);
		$("#rounded_total").val(round_total);
	}



	function getAllExchangeRates() {
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('CurrencyExchange/getAllExchangeRate');?>",
			dataType: "json",
			success: function (data) {
				$("#all_exchange_rate").text(JSON.stringify(data));
			}
		});
	}

	function Select2Init() {
		$('.select').each(function () {
			var select = $(this);
			$("#" + select.attr('id')).select2({ allowClear: true,containerCssClass: 'border-primary'}).on('change.select2', function () {
				if ($("#" + select.attr('id')).valid()) {
					$("#" + select.attr('id')).removeClass('invalid').addClass('success');
				}
			});
		});

		// Menu border and text color
		$('.select-border-color').select2({
			dropdownCssClass: 'border-primary',
			containerCssClass: 'border-primary text-primary-700'
		});
	}
	function Select2TagsInit() {
		$('.select-tag').each(function () {
			var select = $(this);
			$("#" + select.attr('id')).select2({tags :true,tokenSeparators :[',',' '], allowClear: true,containerCssClass: 'border-primary'}).on('change.select2', function () {
				if ($("#" + select.attr('id')).valid()) {
					$("#" + select.attr('id')).removeClass('invalid').addClass('success');
				}
			});
		});

		// Menu border and text color
		$('.select-border-color').select2({
			dropdownCssClass: 'border-primary',
			containerCssClass: 'border-primary text-primary-700'
		});
	}


	function numberInit() {
		$('.numberInit').each(function () {
			var number = $(this);
			$("#" + number.attr('id')).keydown(function (e) {
				// Allow: backspace, delete, tab, escape, enter and .
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
						// Allow: Ctrl+A, Command+A
						(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
						// Allow: home, end, left, right, down, up
						(e.keyCode >= 35 && e.keyCode <= 40)) {
					// let it happen, don't do anything
					return;
				}
				// Ensure that it is a number and stop the keypress
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});
		});
	}

	function DtFormClear(formName) {

		$("form#" + formName + " input[type=checkbox]").prop('checked', false);
		$("form#" + formName + " input[type=checkbox]").siblings().remove();
		$("form#" + formName + " input[type=text]").val('');
		$("form#" + formName + " input[type=tel]").val('');
		$("form#" + formName + " input[type=email]").val('');
		$("form#" + formName + " input[type=radio]").prop('checked', false);
		$("form#" + formName + " textarea").val('');
		$('form#' + formName + " input[type=file]").val('');
		$('form#' + formName + " input[type=file]").parents('.form-group').find('img').attr('src', null);
		$("form#" + formName + " input[type=file]").parents('.form-group').find('img').hide();
		$("form#" + formName + " input[type=file]").parents('.form-group').find('span[class=filename]').html('No File Selected');

		$('textarea.ckeditor').each(function () {
			var $textarea = $(this);
			CKEDITOR.instances[$textarea.attr('name')].setData("");
		});

		$("form#" + formName + " select").val('').trigger('change.select2');

		$("form#" + formName + " .validation-error-label").html('');
		CheckboxKeyGen();
		SwitcheryKeyGen();
		RadioKeyGen();
	}

	function DtFormFill(formName, data) {
		$.each(data, function (key, val) {
			//Get Form fields Type
			var inputType = $('form#' + formName + ' #' + key).prop("type");

			// CheckBox
			if (inputType == 'checkbox') {
				$('form#' + formName + ' #' + key).siblings().remove();
				if (val == 1) {
					$('form#' + formName + ' #' + key).prop("checked", true);
				} else {
					$('form#' + formName + ' #' + key).removeAttr('checked');
				}
			}
			//radio
			else if (inputType == 'radio') {
				$('form#' + formName + ' input[value="' + val + '"]').prop("checked", true);
			}
			//select2 or select or select multiple
			else if (inputType == 'select-one' || inputType == 'select-multiple') {
				if ($('form#' + formName + ' #' + key).length) {
					if (key == 'country_id') {
						var option = new Option(data['country_name'], data['country_id'], true, true);
						$('form#' + formName + ' #' + key).append(option).trigger('change');
					} else if (key == 'state_id') {
						var option = new Option(data['state_name'], data['state_id'], true, true);
						$('form#' + formName + '  #' + key).append(option).trigger('change');
					} else if (key == 'city_id') {
						var option = new Option(data['city_name'], data['city_id'], true, true);
						$('form#' + formName + '  #' + key).append(option).trigger('change');
					}
//                    else if (key == 'samaj_id') {
//                        var option = new Option(data['samaj_name'], data['surname_id'], true, true);
//                        $('form#' + formName + '  #' + key).append(option).trigger('change');
//                    }
					else {
						$('form#' + formName + '  #' + key).val(val).trigger('change');
					}
					$('#' + key + '-error').html("");
				}
			}
			//textarea or ckeditor
			else if (inputType == 'textarea') {
				if ($('form#' + formName + ' #' + key).length) {
					if ($('form#' + formName + ' #' + key).hasClass('ckeditor')) {
						CKEDITOR.instances[key].setData(val);
					} else {
						$('form#' + formName + ' #' + key).val(val);
					}
				}
			}
			//file
			else if (inputType == 'file') {
				if ($('form#' + formName + ' #' + key).length) {
					var path = '';
					if (formName == 'ManufacturerDetails') {
						path = "<?= base_url().$this->config->item('logo_path'); ?>";
					}
					console.log(val);
					if (path != '' && val != '') {
						$('form#' + formName + ' #' + key).parents('.form-group').find('img').attr('src', path + val);
						$('form#' + formName + ' #' + key).parents('.form-group').find('img').show();
						$("form#" + formName + " input[type=file]").parents('.form-group').find('span[class=filename]').html('No File Selected');
					} else {
						$('form#' + formName + ' #' + key).parents('.form-group').find('img').attr('src', null);
						$('form#' + formName + ' #' + key).parents('.form-group').find('img').hide();
						$("form#" + formName + " input[type=file]").parents('.form-group').find('span[class=filename]').html('No File Selected');
					}
//                    $('form#' + formName + ' #' + key).val(val);
				}
			}

			// /common
			else {
				if ($('form#' + formName + ' #' + key).length) {
					$('form#' + formName + ' #' + key).val(val);
				}
			}
		});
		CheckboxKeyGen();
		SwitcheryKeyGen();
		RadioKeyGen();
	}


	function ScrollToTop() {
		window.scroll({
			top: 0,
			left: 0,
			behavior: 'smooth'
		});
	}

	function TimePickerInit() {
		// Time picker
		$(".dtTimePicker").AnyTime_picker({
			format: "%H:%i"
		});
	}

	function FileValidate() {
		$(document).on('change', 'input[type="file"]', function () {
			if ($("#" + $(this).attr('id')).valid()) {
				$("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
			}
		});

	}

	function addValidation(type,selecter,rules){
		$(''+type+''+selecter+'').each(function () {
			$(this).rules('add', rules);
		});

	}

	jQuery.validator.addMethod("validEmail", function(value, element, param) {
		var reg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(reg.test(value)){
			return true;
		}else{
			return false;
		}
	}, "Please enter a valid email address");

	jQuery.validator.addMethod("aadhar", function(value, element) {
		return this.optional(element) || /^[0-9]{12}$/i.test(value);
	}, "Please Enter Valid Aadhar card no");

</script>
</html>


