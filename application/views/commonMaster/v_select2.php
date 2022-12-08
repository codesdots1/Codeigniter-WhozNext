<script>

<?php if(isset($business)) {  ?>
    function businessDD(businessId= '',select="#business_id") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Business/getBusinessDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
						business_id : businessId,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows
                        }
                    };
                }
            },
            placeholder: 'Search For Business',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

<?php if(isset($bookingMonth)) {  ?>
    function getBookingMonthsDD(bookingMonthId= '',select="#bookingMonthId") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Business/getBookingMonthsDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
						bookingMonthId : bookingMonthId,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows
                        }
                    };
                }
            },
            placeholder: 'Search For Booking Months',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

    <?php if(isset($cancellationPolicy)) {  ?>
    function getCancellationPolicyDD(cancellationPolicyId= '',select="#cancellationPolicyId") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Business/getCancellationPolicyDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
						cancellationPolicyId : cancellationPolicyId,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows
                        }
                    };
                }
            },
            placeholder: 'Search For Cancellation Policy',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

    <?php if(isset($bookingIntervals)) {  ?>
    function getbookingIntervalsDD(bookingIntervalsId= '',select="#bookingIntervalsId") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Business/getbookingIntervalsDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
						bookingIntervalsId : bookingIntervalsId,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows
                        }
                    };
                }
            },
            placeholder: 'Search For Booking Intervals',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

    <?php if(isset($serviceStaff)) {  ?>
    function serviceStaffDD(serviceId= '',select="#serviceId") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Services/getServiceDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
                        business_id: $("#business_id").val(),
                        serviceId : <?= isset($getMemberData['service']) && ($getMemberData['service'] != '') ? $getMemberData['service'] : 0 ?>,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows
                        }
                    };
                }
            },
            placeholder: 'Search For Serivces',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

    <?php if(isset($categories)) { ?>
    function categoriesDD(categoriesId= '',select="#categories_id") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Categories/getCategoriesDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
                        business_id: $("#business_id").val(),
                        categories_id : <?= isset($getMemberData['categories']) && ($getMemberData['categories'] != '') ? $getMemberData['categories'] : 0 ?>,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                }
            },
            placeholder: 'Search For Your Categories',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

    <?php if(isset($staff)) { ?>
    function staffDD(staffId= '',select="#staff_id") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Staff/getStaffDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                   return {
                        filter_param: params.term || '',
                        business_id: $("#business_id").val(),
                        staff_id : <?= isset($getMemberData['staff']) && ($getMemberData['staff'] != '') ? $getMemberData['staff'] : 0 ?>,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                }
            },
            placeholder: 'Search For Your Staff',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

    <?php if(isset($city)) { ?>
    function cityDD(cityId= '',select="#city_id") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('City/getCityDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
                        city_id : cityId,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                }
            },
            placeholder: 'Search For Your City',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

	<?php if(isset($role)) { ?>
    function roleDD(roleId= '',select="#role_id") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Role/getRoleDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
						role_id : roleId,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows
                        }
                    };
                }
            },
            placeholder: 'Search For Your Role',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

    <?php if(isset($maritalStatus)) { ?>
    function maritalStatusDD(maritalStatusId= '',select="#marital_status_id") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('MaritalStatus/getMaritalStatusDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
                        marital_status_id : maritalStatusId,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                }
            },
            placeholder: 'Search For Your Marital Status',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

    <?php if(isset($gender)) { ?>
    function genderDD(genderId= '',select="#gender_id") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Gender/getGenderDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
                        gender_id : genderId,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                }
            },
            placeholder: 'Search For Your Gender',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>

    <?php if(isset($student)) { ?>
    function studentDD(studentId= '',select="#student_id") {
        $(select).select2({
            ajax: {
                url: "<?= site_url('Employee/getStudentDD') ?>",
                dataType: 'json',
                type: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        filter_param: params.term || '',
                        student_id : studentId,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.result,
                        pagination: {
                            more: (data.page * 10) < data.totalRows

                        }
                    };
                }
            },
            placeholder: 'Search For Your Student',
            escapeMarkup: function (markup) {
                return markup;
            }
        }).on('select2:select', function () {
            if ($("#" + $(this).attr('id')).valid()) {
                $("#" + $(this).attr('id')).removeClass('invalid').addClass('success');
            }
        });
    }
    <?php } ?>
</script>



