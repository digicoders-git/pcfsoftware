
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/vendors/js/vendors.min.js"></script>
<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/vendors/js/charts/raphael-min.js"></script>
<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/vendors/js/charts/morris.min.js"></script>
<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/vendors/js/extensions/unslider-min.js"></script>
<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/vendors/js/timeline/horizontal-timeline.js"></script>

<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/js/core/app-menu.min.js"></script>
<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/js/core/app.min.js"></script>
<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/js/scripts/customizer.min.js"></script>
<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>




<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/js/notifIt.js"></script>
<script src="<?= base_url($this->data->appTempletePath); ?>app-assets/js/core/notifIt.js"></script>

<!-- ScrollTo Linkin here-->
<script src="https://cdn.jsdelivr.net/npm/jquery.scrollto@2.1.3/jquery.scrollTo.min.js"></script>



<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
	// $(document).ready( function () {
	// $('#table_id').DataTable();
	// } );
	
	$(document).ready(function() {
		$('#table_id').DataTable({
			"bInfo" : false,
			"autoWidth":true,
			responsive:true,
			pageLength: 15,
			dom: 'iBfrtp',
			"buttons": [
			]
		});
	});
</script>

<script>
	$(document).ready( function () {
		$('#table_id2').DataTable();
	} );
</script>
<!--end here -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js" integrity="sha512-kZv5Zq4Cj/9aTpjyYFrt7CmyTUlvBday8NGjD9MxJyOY/f2UfRYluKsFzek26XWQaiAp7SZ0ekE7ooL9IYMM2A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- cdn here bootstrap5  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- ScrollTo Cdn Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.3/jquery.scrollTo.min.js"></script>





<!-- Logout Modal -->
<div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4><i class="fa fa-lock"></i> Logout</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
				<p><i class="fa fa-question-circle"></i> Are you sure you want to logout? <br /></p>
				<div class="actionsBtns">
					<a class="btn  btn-primary" href="<?= base_url($this->data->controller); ?>/AccountSettings/Logout">Logout</a>
					<button class="btn btn-default" data-dismiss="modal">Cancel</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>


<script>
    $(document).ready(function() {
	getCurrentTime()
	$('form').parsley();
	$('.summernote').summernote();
	$('.chosen-select').chosen();
	$('.dropify').dropify({
	messages: {
	'default': 'Drag and drop a file here or click',
	'replace': 'Drag and drop or click to replace',
	'remove': 'Remove',
	'error': 'Ooops, something wrong appended.'
	},
	error: {
	'fileSize': 'The file size is too big (2M max).'
	}
	});
	var table = $('#example').DataTable({
	responsive: true,
	lengthChange: true,
	buttons: ['excel', 'pdf']
	});
	table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
	});
</script>
<script>
    function btnRedirect(location) {
        window.location.href = location;
	}
</script>
<script>
    // $("#sectionid").change(function(){
    //     var sectionid=$('#sectionid').val();
    //     var classid=$('#classid').val();
    //     var branch=$('#branch').val();
    //   $("#EditModal").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
    //     $("#EditModal").load("<?php echo base_url($this->data->controller . '/' . $this->data->method . '/Edit/') ?>" + classid+'/'+ sectionid+'/'+branch);
    // });
</script>
<script>
    function Edit(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url($this->data->controller . '/' . $this->data->method . '/Edit/') ?>" + id);
	}
</script>

<script>
    function EditLoan(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url('Admin/Loans/Edit/') ?>" + id);
	}
</script>

<script>
    function Edit1(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url($this->data->controller . '/' . $this->data->method . '/') ?>" + id);
	}
</script>

<script>
    function subEdit(id) {
        $("#EditModal").modal("show");
        $("#EditModal .modal-body").html("<center><i class='fa fa-2x fa-spin fa-spinner'></i></center>");
        $("#EditModal .modal-body").load("<?php echo base_url($this->data->controller . '/' . $this->data->method . '/' . $this->uri->segment(3) . '/Edit/') ?>" + id);
	}
</script>
<script>
    function Status(e, table, where_column, where_value, column, value) {
        var status = true;
        var check = $(e).prop("checked");
        if (check) {
            swal({
                title: "Are you sure?",
                text: "You want to activate this !",
                icon: "warning",
                buttons: true,
                dangerMode: true
				}).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?php echo base_url("Auth/UpdateStatus"); ?>",
                        type: "post",
                        data: {
                            'table': table,
                            'column': column,
                            'value': check,
                            'where_column': where_column,
                            'where_value': where_value
						},
                        success: function(response) {
                            swal("Activated successfully !", {
                                icon: "success",
							});
                            location.reload();
						}
					});
				}
			});
			} else {
            swal({
                title: "Are you sure?",
                text: "You want to deactivate this !",
                icon: "warning",
                buttons: true,
                dangerMode: true
				}).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?php echo base_url("Auth/UpdateStatus"); ?>",
                        type: "post",
                        data: {
                            'table': table,
                            'column': column,
                            'value': 'false',
                            'where_column': where_column,
                            'where_value': where_value
						},
                        success: function(response) {
                            swal("Deactivated successfully !", {
                                icon: "success",
							});
                            location.reload();
						}
					});
				}
			});
		}
        return status;
	}
	
	
	
	function HOStatus(e, table, where_column, where_value, column, value) {
        var status = true;
        var check = $(e).prop("checked");
        if (check) {
            swal({
                title: "Are you sure?",
                text: "You want to activate this !",
                icon: "warning",
                buttons: true,
                dangerMode: true
				}).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?php echo base_url("Auth/HOStatus"); ?>",
                        type: "post",
                        data: {
                            'table': table,
                            'column': column,
                            'value': check,
                            'where_column': where_column,
                            'where_value': where_value
						},
                        success: function(response) {
							
                            swal("Activated successfully !", {
                                icon: "success",
							});
                            location.reload();
						}
					});
				}
			});
			} else {
            swal({
                title: "Are you sure?",
                text: "You want to deactivate this !",
                icon: "warning",
                buttons: true,
                dangerMode: true
				}).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?php echo base_url("Auth/HOStatus"); ?>",
                        type: "post",
                        data: {
                            'table': table,
                            'column': column,
                            'value': 'false',
                            'where_column': where_column,
                            'where_value': where_value
						},
                        success: function(response) {
                            swal("Deactivated successfully !", {
                                icon: "success",
							});
                            location.reload();
						}
					});
				}
			});
		}
        return status;
	}
	
	
	
	
	
	
	
	
	
	
	// end here 
	
    function isDone(e, table, where_column, where_value, column, value, title) {
        swal({
            title: "Are you sure?",
            text: "You want to " + title + " this !",
            icon: "warning",
            buttons: true,
            dangerMode: true
			}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "<?php echo base_url("Auth/UpdateStatus"); ?>",
                    type: "post",
                    data: {
                        'table': table,
                        'column': column,
                        'value': value,
                        'where_column': where_column,
                        'where_value': where_value
					},
                    success: function(response) {
                        swal("" + title + " successfully !", {
                            icon: "success",
						});
                        location.reload();
					}
				});
			}
		});
	}
	
    function Delete(e, table, where_column, where_value, unlink_folder, unlink_column) {
        var status = true;
        swal({
            title: "Are you sure?",
            text: "You want to delete this !",
            icon: "warning",
            buttons: true,
            dangerMode: true
			}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "<?php echo base_url("Auth/Delete"); ?>",
                    type: "post",
                    data: {
                        'table': table,
                        'where_column': where_column,
                        'where_value': where_value,
                        'unlink_folder': unlink_folder,
                        'unlink_column': unlink_column
					},
                    success: function(response) {
                        swal("Deleted successfully !", {
                            icon: "success",
						});
                        location.reload();
					}
				});
			}
		});
        return status;
	}
	
    // IaActiveMembers Code Start Here
    function ActiveInactiveMembers(e, table, where_column, where_value) {
        // alert(where_value); 
        var status = true;
        swal({
            title: "Are you sure?",
            text: "You want to Cancel this !",
            icon: "warning",
            buttons: true,
            dangerMode: true
			}).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "<?php echo base_url('Admin/ActiveInactiveMembers/'); ?>",
                    type: "post",
                    data: {
                        'table': table,
                        'where_value': where_value,
					},
                    success: function(response) {
                        swal("Cancelled successfully !", {
                            icon: "success",
						});
                        location.reload();
					}
				});
			}
		});
        return status;
	}
    // IaActiveMembers Code End Here
</script>
<script type="text/javascript">
    $('#addForm').on('submit', function(e) {
		
        var formAction = $(this);
        var btnAction = $('#addBtn');
        var spinAction = $('#addSpin');
        e.preventDefault();
		
        var data = new FormData(this);
        if ($(formAction).parsley().isValid() == true) {
            $.ajax({
                type: 'POST',
                url: $(formAction).attr('action'),
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
					
                    $(btnAction).attr("disabled", true);
                    $(spinAction).show();
				},
                success: function(response) {
                    console.log(response);
                    var response = JSON.parse(response);
                    $(btnAction).removeAttr("disabled");
                    $(spinAction).hide();
                    if (response[0].res == 'success') {
                        $('.notifyjs-wrapper').remove();
                        $.notify("" + response[0].msg + "", "success");
						
                        window.setTimeout(function() {
                            window.location.reload();
						}, 1000);
                        if (response[0].redirect) {
                            window.setTimeout(function() {
								
                                window.location.href = response[0].redirect;
							}, 1000);
							} else {
                            window.setTimeout(function() {
                                window.location.reload();
							}, 1000);
						}
						
						} else if (response[0].res == 'error') {
                        $('.notifyjs-wrapper').remove();
                        $.notify("" + response[0].msg + "", "error");
					}
				},
                error: function() {
                    window.location.reload();
				}
			});
		}
	});
    $('#updateForm').on('submit', function(e) {
        e.preventDefault();
        var data = new FormData(this);
        var formAction = $(this);
        var btnAction = $('#updateBtn');
        var spinAction = $('#updateSpin');
        if ($(formAction).parsley().isValid() == true) {
            $.ajax({
                type: 'POST',
                url: $(formAction).attr('action'),
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(btnAction).attr("disabled", true);
                    $(spinAction).show();
				},
                success: function(response) {
                    console.log(response);
                    var response = JSON.parse(response);
                    $(btnAction).removeAttr("disabled");
                    $(spinAction).hide();
                    if (response[0].res == 'success') {
                        $('.notifyjs-wrapper').remove();
                        $.notify("" + response[0].msg + "", "success");
                        if (response[0].redirect) {
                            window.setTimeout(function() {
                                window.location.href = response[0].redirect;
							}, 1000);
							} else {
                            window.setTimeout(function() {
                                window.location.reload();
							}, 1000);
						}
						} else if (response[0].res == 'error') {
                        $('.notifyjs-wrapper').remove();
                        $.notify("" + response[0].msg + "", "error");
					}
				},
                error: function() {
                    window.location.reload();
				}
			});
		}
	})
</script>
<script>
    var alldays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	
    function getCurrentTime() {
        var d = new Date();
		
        var dayno = d.getDay();
		
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
		
        var h = d.getHours();
        var i = d.getMinutes();
        var s = d.getSeconds();
		
        var ampm = "AM";
        if (h > 12) {
            ampm = "PM";
            h = h - 12;
		}
		
        var datetime = alldays[dayno] + " " + getTwoDigit(day) + "-" + getTwoDigit(month) + "-" + year + " " + getTwoDigit(h) + ":" + getTwoDigit(i) + ":" + getTwoDigit(s) + " " + ampm;
		
        document.getElementById("showdatetime").innerHTML = datetime;
		
        setTimeout(getCurrentTime, 1000);
		
	}
	
    function getTwoDigit(digit) {
        if (digit < 10) {
            digit = "0" + digit;
		}
        return digit;
	}
</script>


<?php
	if ($this->session->flashdata('res') == 'success')
	{
		echo '<script>$.notify("' . $this->session->flashdata('msg') . '","success")</script>';
	}
	else if ($this->session->flashdata('res') == 'error')
	{
		echo '<script>$.notify("' . $this->session->flashdata('msg') . '","error")</script>';
	}
	?>			