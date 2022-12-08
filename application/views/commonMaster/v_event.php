<?php
if(isset($filterModel) && $filterModel != '') {
    echo $filterModel;
}
?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?= lang('event_index_heading') ?></h5>
        <div class="heading-elements">

            <a  href="<?= site_url('Event/manage'); ?>" data-popup='custom-tooltip' data-original-title="<?= lang('add_event') ?>"title="<?= lang('add_event') ?>" class="btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded"><i class="icon-plus3"></i></a>
            <a type="button" data-popup='custom-tooltip' data-original-title="<?= lang('delete_event') ?>" title="<?= lang('delete_event') ?>" class="btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded deleteRecord"><i class="icon-trash"></i></a>
        </div>
    </div>

    <div class="table-responsive">
        <table id="eventTable" class="table " cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><input id="checkAll" type="checkbox"  class="dt-checkbox styled"></th>
                <th><?= lang('samaj') ?></th>
                <th><?= lang('event_name') ?></th>
                <th><?= lang('location_general') ?></th>
                <th><?= lang('start_date') ?></th>
                <th><?= lang('end_date') ?></th>
                <th><?= lang('start_time') ?></th>
                <th><?= lang('end_time') ?></th>
                <th><?= lang('rsvp_required') ?></th>
                <th><?= lang('total_rsvp') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        dt_DataTable = $('#eventTable').DataTable({
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
                "url": "<?= site_url('Event/getEventListing'); ?>",
                "type": "post",
                "data": function (d) {
                    return $.extend({}, d, {
                        "<?= $this->security->get_csrf_token_name() ?>": '<?= $this->security->get_csrf_hash() ?>'

                    });
                }
            },
            "fnServerParams": function (aoData) { //send other data to server side
                var params = {};
                var filterData = $("#advanceFilter").serializeArray();
                $.each(filterData, function (i, val) {
                    var name = val.name;
                    if (typeof params[name] == 'undefined') {
                        params[name] = [];
                    }
                    params[name].push(val.value);
                });
                aoData.filterParams = params;
                server_params = aoData;
            },
            "iDisplayLength": "<?= PERPAGE_DISPLAY ?>",
            "order": [[1, "ASC"]],
            "stripeClasses": [ 'alpha-slate', 'even-row' ],
            "columns": [
                {"data": "event_id"},
                {"data": "samaj_name"},
                {"data": "event_name"},
                {"data": "location_general"},
                {"data": "start_date"},
                {"data": "end_date"},
                {"data": "start_time"},
                {"data": "end_time"},
                {"data": "is_required",
                    "render": function (data, type, row) {
                        var is_checked = '';
                        var id = row['event_id'];
                        if (data == 1) {
                            is_checked = 'checked="checked"';
                        }
                        var html = '';
                        html += '<div class="checkbox checkbox-switchery switchery-xs">';
                        html += '<label>';
                        html += '<input id="' + id + '" type="checkbox" class="dt_switchery isRequired" ' + is_checked + ' data-status="' + data + '"  >';
                        html += '</label>';
                        html += '</div>';
                        return html;
                    },
                    "searchable": false
                },
                {
                    "data": "null",
                    "render":function (data, type, row) {
                        var yes = row['total_yes'];
                        var no = row['total_no'];
                        var total = row['total_member'];
                        var remaining = row['remaining'];
                        var html = '';
                        html += '<div>';
                        html += '<label>';
                        html += 'Yes : ' + yes + '/' + total;
                        html += '</label>';
                        html += '</div>';
                        html += '<div>';
                        html += '<label>';
                        html += 'No : ' + no + '/' + total;
                        html += '</label>';
                        html += '</div>';
                        html += '<div>';
                        html += '<label>';
                        html += 'Remaining : ' + remaining + '/' + total;
                        html += '</label>';
                        html += '</div>';
                        return html;
                    },
                    "sortable": false,
                    "searchable": false
                },
                {
                    "data": "actions",
                    "render": function (data, type, row) {
                        var html = '';
                        var id = row['event_id'];
                        html += "<a href='<?= site_url('Event/eventData'); ?>?event_id=" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('view_event_wise_member') ?>' title='<?= lang('view_event_wise_member') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat  btn-icon btn-rounded showEvent'><i class='icon-eye'></i></button>";
                        html += "&nbsp";
                        html += "<a  href='<?= site_url('Event/manage/'); ?>" + id + "' data-popup='custom-tooltip' data-original-title='<?= lang('edit_event') ?>'  onclick='EditRecord(" + id + ")' title='<?= lang('edit_event') ?>' class='btn btn-xs border-slate-400 text-slate-400 btn-flat btn-icon btn-rounded'><i class='icon-pencil'></i></a>";
                        html += "&nbsp";
                        html += "<a href='javascript:void(0);' onclick='DeleteRecord(" + id + ")' data-popup='custom-tooltip' data-original-title='<?= lang('delete_event') ?>' title='<?= lang('delete_event') ?>'  class='btn btn-xs border-danger-400 text-danger-400 btn-flat btn-icon btn-rounded' ><i class='icon-trash'></i></a>";
                        return html;
                    },
                    "sortable": false,
                    "searchable": false
                }
            ],
            "columnDefs": [
                {
                    "targets": 0,
                    "width": "10%",
                    "render": function (data, type, row) {
                        return '<label><input type="checkbox" class="dt-checkbox styled" id="ids_' + row['event_id'] + '" name="ids[]" value="' + row['event_id'] + '"/></label>';
                    },
                    "sortable": false,
                    "searchable": false
                }
            ],
            fnDrawCallback: function (oSettings) {
                DtSwitcheryKeyGen();
                CheckboxKeyGen();
                CustomToolTip();
                ScrollToTop();
            }
        });
    });

</script>

<script>
    $(document).on('click', '.cancel', function () {
        $('#eventTable input[class="dt-checkbox styled"]').prop('checked', false);
        CheckboxKeyGen();
    });

    $(document).ready(function () {
        SwitcheryKeyGen();
        CheckboxKeyGen('checkAll');
        CustomToolTip();
        samajDD('','#samaj_id');
        $('#date').val('');
        $('#checkAll').click(function () {
            var checkedStatus = this.checked;
            $('#eventTable tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
            CheckboxKeyGen();
        });
    });

    $(document).on('click', '.isRequired', function () {
        var eventId = $(this).attr('id');
        var isRequired   = $(this).data("status");
        $.ajax({
            type: "post",
            url: "<?= site_url("Event/changeRequiredStatus")?>",
            dataType: "json",
            data: {eventId: eventId, status: isRequired},
            success: function (data) {
                if (data) {
                    swal({
                        title: "<?= ucwords(lang('success')); ?>",
                        text: data['msg'],
                        confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                        type: "<?= lang('success'); ?>"
                    },function(){
                        dt_DataTable.ajax.reload(null,false);
                    });
                } else {
                    swal({
                        title: "<?= ucwords(lang('error')); ?>",
                        text: data['msg'],
                        type: "<?= lang('error'); ?>",
                        confirmButtonColor: "<?= BTN_ERROR; ?>"
                    });
                }
            }
        });
    });

    function DeleteRecord(eventId) {
        $('#eventTable tbody input[class="dt-checkbox styled"]').prop('checked', false);
        $('#ids_' + eventId).prop('checked', true);
        $('.deleteRecord').click();
        CheckboxKeyGen();
    }

    $(document).on('click', '.deleteRecord', function () {
        var deleteElement = $('#eventTable tbody input[class="dt-checkbox styled"]:checked');
        var selectedLength = deleteElement.size();
        if (selectedLength == 0) {
            swal({
                title: "<?= ucwords(lang('info')); ?>",
                text: "<?= lang('delete_info'); ?>",
                confirmButtonColor: "<?= BTN_DELETE_INFO; ?>",
                type: "<?= lang('info'); ?>"
            },function(){
                return false;
            });
        } else {
            var deleteId = [];
            $.each(deleteElement, function (i, ele) {
                deleteId.push($(ele).val());
            });
            swal({
                    title: "<?= ucwords(lang('delete')); ?>",
                    text: "<?= lang('delete_warning'); ?>",
                    type: "<?= lang('warning'); ?>",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonColor: "<?= BTN_DELETE_WARNING; ?>",
                    showLoaderOnConfirm: true
                },
                function () {
                    $.ajax({
                        type: "post",
                        url: "<?= site_url("Event/delete")?>",
                        dataType: "json",
                        data: {deleteId: deleteId},
                        success: function (data) {
                            if (data['success']) {
                                swal({
                                    title: "<?= ucwords(lang('success'))?>",
                                    text: data['msg'],
                                    type: "<?= lang('success')?>",
                                    confirmButtonColor: "<?= BTN_SUCCESS; ?>",
                                });
                                dt_DataTable.ajax.reload();
                                //$('#checkAll').prop('checked', false);
                                CheckboxKeyGen('checkAll');
                            } else {
                                swal({
                                    title: "<?= ucwords(lang('error')); ?>",
                                    text: data['msg'],
                                    type: "<?= lang('error'); ?>",
                                    confirmButtonColor: "<?= BTN_ERROR; ?>"
                                });
                                dt_DataTable.ajax.reload();
                                CheckboxKeyGen('checkAll');
                            }
                        }
                    });
                });
        }
    });


//    $(document).on('click','.showEvent', function () {
//        var eventId = $(this).attr('id');
//        $.ajax({
//            type: "post",
//            url: "<?//= site_url("Event/getEventDetails")?>//",
//            dataType: "json",
//            data: {event_id: eventId},
//            success: function (data) {
//                var Html = '';
//                if(data != '') {
//                    Html += '<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Sr. No.</th>';
//                    $.each(data[0], function (key, value) {
//                        var replaceKey = key.replace(/_/g, ' ');
//                        var upperKey = replaceKey.charAt(0).toUpperCase() + replaceKey.slice(1);
//                        Html += '<th>' + upperKey + '</th>'
//                    });
//                    Html += '</tr></thead>';
//                    $.each(data, function (key, value) {
//                        Html += '<tr><td>' + parseFloat(key + 1) + '</td>';
//                        $.each(value, function (column, Fieldvalue) {
//                            Html += '<td>' + Fieldvalue + '</td>'
//                        });
//                        Html += '</tr>';
//                    });
//                    Html += '</table></div>';
//                } else {
//                    var count = 3;
//                    Html += '<table class="table table-bordered"><thead><tr colspan='+count+'>';
//                    Html += 'No Data Found</tr></table>';
//                }
//                $('.showEventModal').html(Html);
//            }
//        });
//        $('#eventDetail').modal('show');
//    });


//    function eventDataExport() {
//
//        $.ajax({
//            type: "post",
//            url: "<?//= site_url("Event/getEventDetails")?>//",
//            dataType: "html",
//            data: {event_id: eventId},
//            success:function(download_url_from_server){
//                document.location = download_url_from_server;
//            }
//        });
//    }

</script>

<?php if (isset($select2)) { ?>
    <?= $select2 ?>
<?php } ?>

<?php
if(isset($eventModal) && $eventModal != '') {
    echo $eventModal;
}
?>
