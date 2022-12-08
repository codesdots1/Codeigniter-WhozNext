<!--<a class='btn btn-sm btn-icon btn-warning btn-round waves-effect editMasterRecord' >Edit</a>&nbsp-->

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Advanced Filter</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-toggle="collapse" data-target="#advance_filter"><i
                                class="glyphicon glyphicon-chevron-down"></i></a></li>

                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body collapse" id="advance_filter">
        <form id="form_story" name="form_story" method="post" enctype="multipart/form-data">


            <div class="col-md-3">
                <div class="form-group">
                    <label>Created Date : </label>
                    <div class="input-group">
                        <input type="text" id="created_date" name="created_date" readonly
                               class="btn btn-default daterange-predefined">
                    </div>
                </div>
            </div>
            <div class="text-right">
                <br><br>
                <button type="button" class="btn btn-primary legitRipple clearFormData">Clear</button>
                <button type="button" class="btn btn-primary legitRipple filterButton">Filter<i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </form>
    </div>
</div>


<div class="panel panel-flat" xmlns="http://www.w3.org/1999/html">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('notification_heading') ?></h5>
        <div class="heading-elements">
            <?php if($this->dt_ci_acl->checkAccess('PushNotification|modify')){ ?>
            <button type="button" data-popup='custom-tooltip'
                    class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded addPushNotification"  title="<?= lang('add_notification') ?>" data-original-title="<?= lang('add_notification') ?>">
                <i class="icon-plus3"></i>
            </button>
            <?php }?>
            <?php if($this->dt_ci_acl->checkAccess('PushNotification|delete')){ ?>
            <button type="button" data-popup='custom-tooltip' class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteMasterRecord"  title="<?= lang('delete_notification') ?>" data-original-title="<?= lang('delete_notification') ?>">
                <i class="icon-trash"></i>
            </button>
            <?php }?>
        </div>
    </div>
    <div class="table-responsive">
        <table id="pushNotificationTable" class="table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><label><input id="checkAll" type="checkbox" class="dt-checkbox styled"></label></th>
                <th><?= lang('notification_image') ?></th>
                <th><?= lang('notification_title') ?></th>
                <th><?= lang('send_to') ?></th>
                <th><?= lang('description') ?></th>
                <th><?= lang('notification_type') ?></th>
                <th><?= lang('date') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#created_date').val("");

        $(document).on('click', '.filterButton', function () {
            dt_DataTable.ajax.reload();
        });


        $(document).on('click', '.clearFormData', function () {
            $("form").trigger("reset");
            $('.select').select2({
                minimumResultsForSearch: Infinity
            });

        });



    });

    $(document).on('click', '.cancel', function () {
        clearAllCheckbox();
    });

    $('#checkAll').click(function () {
        var checkedStatus = this.checked;
        $('#pushNotificationTable tbody tr').find('td:first :checkbox').each(function () {
            $(this).prop('checked', checkedStatus);
        });
        CheckboxKeyGen();
    });


    var dt_DataTable;
    $(document).ready(function () {

        dt_DataTable = $('#pushNotificationTable').DataTable({
            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('PushNotification/getTableListing'); ?>",
                "type": "post",
                "data": function (d) {
                    return $.extend({}, d, {
                        "<?= $this->security->get_csrf_token_name() ?>": '<?= $this->security->get_csrf_hash() ?>',
                        "user_name": $('#user_name').val(),
                        "created_date": $("#created_date").val(),
                    });
                }
            },
            "iDisplayLength": "<?= PERPAGE_DISPLAY ?>",
            "order": [[1, "ASC"]],
            "columns": [

                {
                    "data": "notification_id",
                    "render": function (data, type, row) {

                        if (row['send_type'] == 'Schedule' && row['dt_now'] == 1) {
                            return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['notification_id'] + '" name="ids[]" value="' + row['notification_id'] + '"/><span class="lbl"></span></label>';
                        }
                        else
                        {
                            return '';
                        }

                    },

                    "sortable": false,
                    "searchable": false
                },
                {
                    "data": "notification_image",
                    "width": "10%",
                    "render": function (data, type, row) {
                        if (row['notification_image'] == '') {
//                            console.log(row['notification_image']);
                            return "<a href='#' data-popup='lightbox'><img height='50' width='50' src='#'></a>";
                        } else {

                            return "<a href='<?php echo site_url().$this->config->item('notification_image');?>" + row['notification_image'] + "' data-popup='lightbox'><img height='50' width='50' src='<?php echo base_url().$this->config->item('notification_image');?>" + row['notification_image'] + "' ></a>";
                        }
                    },
                    "sortable": false,
                    "searchable": false
                },
                {"data": "notification_title"},
                {"data": "send_to"},
                {"data": "description"},
                {"data": "notification_type"},
                {"data": "created_at"},
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['notification_id'];
                        <?php if($this->dt_ci_acl->checkAccess('PushNotification|modify')){ ?>
                        html += "<button value='" + id + "' title='<?= lang('edit_notification')?>' data-popup='custom-tooltip' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded editMasterRecord'  ><i class='icon-pencil'></i></button>";
                        html += "&nbsp";
                        <?php }?>
                        <?php if($this->dt_ci_acl->checkAccess('PushNotification|delete')){ ?>
                        html += "<button class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' data-popup='custom-tooltip' title='<?= lang('delete_notification')?>' onclick='DeleteRecord(" + id + ")' ><i class='icon-trash'></i></button>";
                        <?php }?>
                        if (row['send_type'] == 'Schedule' && row['dt_now'] == 1) {
                            return html;

                        } else {
                            return '';
                        }
                    },
                    "sortable": false,
                    "searchable": false
                }

            ],

            fnDrawCallback: function (oSettings) {
                // Switchery
                // Initialize multiple switches
                DtSwitcheryKeyGen();
                CheckboxKeyGen('checkAll');
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

</script>

<script>

    $(document).ready(function () {
        $('#checkAll').prop('checked', false);
        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#pushNotificationTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
        });

        $(document).on('click', '.editMasterRecord', function () {

            $('#stateTable tbody input[class="dt-checkbox"]').prop('checked', false);
            var id = $(this).val();
            $("#checkAll").prop("checked", false);
            $("#ids_" + id).prop("checked", true);

            var edit_val = $('.dt-checkbox:checked').val();
            var loc_address = "<?php echo site_url();?>PushNotification/add_edit/" + edit_val;
            window.location = loc_address;
        });


        //add model
        $('.addPushNotification').click(function () {
            window.location = "<?php echo site_url() . "PushNotification/add_edit";?>";
        });


        $(document).on('click', '.deleteMasterRecord', function () {
            $('form#PushNotificationDetails #is_active').siblings().remove();
            var delete_ele = $('#pushNotificationTable tbody input[class="dt-checkbox styled"]:checked');

            var selected_length = delete_ele.size();

            if (0==selected_length) {
                swal({
                    title: "<?= ucwords(lang('info')); ?>",
                    text: "Select at least one record(s)",
                    confirmButtonColor: "<?= BTN_DELETE_INFO; ?>",
                    type: "<?= lang('info'); ?>"
                });
                return false;
            } else {
                var delete_id = [];
                $.each(delete_ele, function (i, ele) {
                    delete_id.push($(ele).val());
                });

                swal({
                        title: "Delete",
                        text: "Are you sure you want to delete record/s?",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonColor: "#ff7043",
                        showLoaderOnConfirm: true
                    },
                    function () {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url();?>/PushNotification/delete/",
                            dataType: "json",
                            data: {id: delete_id},
                            success: function (resObj, statusText) {
                                if (resObj.success) {
                                    swal({title: "Success", text: resObj.msg, type: "success",confirmButtonColor: "<?= BTN_SUCCESS; ?>"}, function () {
                                        dt_DataTable.ajax.reload();
                                    });
                                    $('#checkAll').prop('checked', false);
                                } else {
                                    swal({title: "Error", text: resObj.msg, type: "error"});
                                }
                            }
                        });
                    });

            }
        });


        $(document).on('click', '.active-class', function () {
            var id = $(this).attr("id");
            var status = $(this).data("status");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>PushNotification/isActiveChange/",
                dataType: "json",
                data: {id: id, status: status},
                success: function (data) {
                    if (data) {
                        swal({
                            title: "Success",
                            text: "Status has been Changed",
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        }, function () {
                            dt_DataTable.ajax.reload(null, false);
                        });
                    } else {
                        swal({
                            title: "Error",
                            text: "Status Change Error.",
                            confirmButtonColor: "#66BB6A",
                            type: "error",
                        });
                    }
                }
            });
        });
    });

    function DeleteRecord(pushNotificationId) {

        $('#pushNotificationTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + pushNotificationId).prop('checked', true);
        $('.deleteMasterRecord').click();
        CheckboxKeyGen();
    }

    function SwitcheryKeyGen() {
        if (Array.prototype.forEach) {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            elems.forEach(function (html) {
                var switchery = new Switchery(html);
            });
        }
        else {
            var elems = document.querySelectorAll('.switchery');
            for (var i = 0; i < elems.length; i++) {
                var switchery = new Switchery(elems[i]);
            }
        }
    }



</script>