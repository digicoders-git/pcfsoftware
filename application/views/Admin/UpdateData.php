<?php defined("BASEPATH") or exit("No direct scripts allowed here"); ?>
<?php
	if (isset($action))
	{
		switch ($action)
		{
			
			case 'EditCar';
		?>
		<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
		
		<div class="form-group">
			<label class="col-form-label">Shopkeeper Name <span class="text-danger">*</span></label>
			<input type="text" class="form-control text-capitalize" name="shop" value="<?php echo $list[0]->shopkeeper_name; ?>" placeholder="Shopkeeper Name" required>
			<?php echo form_error("shop", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">Sankhya <span class="text-danger">*</span></label>
			<input type="text" class="form-control text-capitalize" name="Sankhya" value="<?php echo $list[0]->sankhya; ?>" placeholder="Sankhya" required>
			<?php echo form_error("Sankhya", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">Quantity <span class="text-danger">*</span></label>
			<input type="number" class="form-control text-capitalize" value="<?php echo $list[0]->quantity; ?>" name="Quantity" placeholder="Quantity" required>
			<?php echo form_error("Quantity", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">Amount <span class="text-danger">*</span></label>
			<input type="number" class="form-control text-capitalize" value="<?php echo $list[0]->amount; ?>" name="Amount" placeholder="Amount" required>
			<?php echo form_error("Amount", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">GST <span class="text-danger">*</span></label>
			<input type="number" class="form-control text-capitalize" value="<?php echo $list[0]->gst; ?>" name="GST" placeholder="GST" required>
			<?php echo form_error("GST", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">Total <span class="text-danger">*</span></label>
			<input type="number" class="form-control text-capitalize" value="<?php echo $list[0]->total; ?>" name="Total" placeholder="Total" required>
			<?php echo form_error("Total", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">Description <span class="text-danger">*</span></label>
			<textarea type="text" class="form-control text-capitalize" name="Description" placeholder="Description" required><?php echo $list[0]->description; ?></textarea>
			<?php echo form_error("Description", "<p class='text-danger' >", "</p>"); ?>
		</div>
        <?php
            break;
			
			// case 'EditMember';
			case 'EditMember';
		?>
		<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
		
		
		<div class="form-group">
			<label class="col-form-label">PF Number(unique) <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="pf_number" minlength="6" maxlength="6" placeholder="PF Number" value="<?php echo $list[0]->pf_number; ?>">
		</div>
		
		
		<div class="form-group">
			<label class="col-form-label">Member Name  <span class="text-danger">*</span></label>
			<input type="text" class="form-control text-capitalize" name="name" placeholder="Member Name" value="<?php echo $list[0]->name; ?>">
		</div>
		<div class="form-group">
			<label class="col-form-label">Per Month Savings<span class="text-danger">*</span></label>
			<input type="text" class="form-control" value="<?php echo $list[0]->pm_saving; ?>" name="pm_saving" placeholder="Per Month Savings" required>
		</div>
		
		
		
		<div class="form-group">
			<label class="col-form-label">Savings<span class="text-danger">*</span></label>
			<input type="text" class="form-control" value="<?php echo $list[0]->savings; ?>" id="savings" name="savings" placeholder="Savings">
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Loan Debit<span class="text-danger">*</span></label>
			<input type="text" class="form-control" value="<?php echo $list[0]->loan; ?>" id="loan" name="loan" placeholder="Loan Debit">
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Loan Credit<span class="text-danger">*</span></label>
			<input type="text" class="form-control" value="<?php echo $list[0]->loan_credit; ?>" id="loan" name="loan_credit" placeholder="Loan Credit">
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Shares<span class="text-danger">*</span></label>
			<input type="text" class="form-control" value="<?php echo $list[0]->shares; ?>" id="shares" name="shares" placeholder="Shares">
		</div>
		
		
		
		
		
		
		
		
		
		<!--<div class="form-group">
			<label class="col-form-label">Per Month Savings <span class="text-danger">*</span></label>
			<select id="disabledSelect" class="form-select form-control" name="pm_saving">
			<option selected disabled>Choose Savings</option>
			<option <?//php
				if ($list[0]->pm_saving == '300')
				{
					echo "selected";
				}
			?>>300</option>
			<option <?//php
				if ($list[0]->pm_saving == '500')
				{
					echo "selected";
				}
			?>>500</option>
			<option <?//php
				if ($list[0]->pm_saving == '1000')
				{
					echo "selected";
				}
			?>>1000</option>
			</select>
		</div>-->
		
		<!--<div class="form-group">
			<label class="col-form-label">Designation<span class="text-danger">*</span></label>
			<input type="text" class="form-control text-capitalize" name="designation" placeholder="Designation" value="<?//php echo $list[0]->designation; ?>">
			<?//php echo form_error("designation", "<p class='text-danger' >", "</p>"); ?>
			</div>
			
			<div class="form-group">
			<label class="col-form-label">Mobile Number<span class="text-danger">*</span></label>
			<input type="text" class="form-control text-capitalize" name="mobile" placeholder="Mobile Number" value="<?//php echo $list[0]->mobile; ?>" minlength="10" maxlength="10">
			<?//php echo form_error("mobile", "<p class='text-danger' >", "</p>"); ?>
		</div>-->
		
		
        <?php
            break;
			
			
			// case 'EditEntry';
			case 'EditEntry';
		?>
		<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
		
		<div class="form-group">
			<input type="text" class="form-control" name="pf_no" placeholder="pf_no" value="<?php echo $list[0]->pf_no; ?>" >
		</div>
		
		<div class="form-group">
			<label class="col-form-label">V.NO.<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="vno" placeholder="V.NO." value="<?php echo $list[0]->vno; ?>">
		</div>
		<div class="form-group">
			<label class="col-form-label">Entry Type<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="entry_type" placeholder="V.NO." value="<?php echo $list[0]->entry_type; ?>">
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Debit<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="debit" placeholder="Debit" value="<?php echo $list[0]->debit; ?>">
		</div>
		<div class="form-group">
			<label class="col-form-label">Credit<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="credit" placeholder="Credit" value="<?php echo $list[0]->credit; ?>">
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Entry Code<span class="text-danger">*</span></label>
			<input type="text" class="form-control entrycode entry_code" name="entrycode"  value="<?php echo $list[0]->entrycode; ?>" list="entry" onchange="getEntry(this, this.value)">
			<span class="entry_code_name">ENTRY_DESCRIPTION</span>
		</div>
		<div class="form-group">
			<label class="col-form-label">Description<span class="text-danger">*</span></label>
			<input type="text" class="form-control desc entry_desc" value="<?php echo $list[0]->entrydesc; ?>" name="entrydesc" placeholder="Description" />
		</div>
		
		
		<!-- DataList for entry type Start Here-->
		<datalist id="entry">
			<?php 
				$list = $this->db->get('entriesmaster')->result();
				foreach ($list as $item)
				{
					$name=$item->entrycode;
				?>
				<option><?= $name ?></option>
				<?php 
				}
			?>
		</datalist>
		<!-- DataList for entry type End Here-->
		
		
        <?php
            break;
			
			case 'EditCashbook';
		?>
		<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
		
		<div class="form-group">
			<input type="text" class="form-control" name="pf_no" placeholder="pf_no" value="<?php echo $list[0]->pf_no; ?>" >
		</div>
		
		<div class="form-group">
			<label class="col-form-label">V.NO.<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="vno" placeholder="V.NO." value="<?php echo $list[0]->vno; ?>">
		</div>
		<div class="form-group">
			<label class="col-form-label">Entry Type<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="entry_type" placeholder="V.NO." value="<?php echo $list[0]->entry_type; ?>">
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Debit<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="debit" placeholder="Debit" value="<?php echo $list[0]->debit; ?>">
		</div>
		<div class="form-group">
			<label class="col-form-label">Credit<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="credit" placeholder="Credit" value="<?php echo $list[0]->credit; ?>">
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Entry Code<span class="text-danger">*</span></label>
			<input type="text" class="form-control entrycode entry_code" name="entrycode"  value="<?php echo $list[0]->entrycode; ?>" list="entry" onchange="getEntry(this, this.value)">
			<span class="entry_code_name">ENTRY_DESCRIPTION</span>
		</div>
		<div class="form-group">
			<label class="col-form-label">Description<span class="text-danger">*</span></label>
			<input type="text" class="form-control desc entry_desc" value="<?php echo $list[0]->entrydesc; ?>" name="entrydesc" placeholder="Description" />
		</div>
		
		
		<!-- DataList for entry type Start Here-->
		<datalist id="entry">
			<?php 
				$list = $this->db->get('entriesmaster')->result();
				foreach ($list as $item)
				{
					$name=$item->entrycode;
				?>
				<option><?= $name ?></option>
				<?php 
				}
			?>
		</datalist>
		<!-- DataList for entry type End Here-->
		
		
        <?php
            break;
			
			# 12B Start Here 
			case 'Edit12B';
		?>
		<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
		
		<div class="form-group">
			<input type="text" class="form-control" name="pf_no" placeholder="pf_no" value="<?php echo $list[0]->pf_no; ?>" >
		</div>
		
		<div class="form-group">
			<label class="col-form-label">V.NO.<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="vno" placeholder="V.NO." value="<?php echo $list[0]->vno; ?>">
		</div>
		<div class="form-group">
			<label class="col-form-label">Entry Type<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="entry_type" placeholder="V.NO." value="<?php echo $list[0]->entry_type; ?>">
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Debit<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="debit" placeholder="Debit" value="<?php echo $list[0]->debit; ?>">
		</div>
		<div class="form-group">
			<label class="col-form-label">Credit<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="credit" placeholder="Credit" value="<?php echo $list[0]->credit; ?>">
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Entry Code<span class="text-danger">*</span></label>
			<input type="text" class="form-control entrycode entry_code" name="entrycode"  value="<?php echo $list[0]->entrycode; ?>" list="entry" onchange="getEntry(this, this.value)">
			<span class="entry_code_name">ENTRY_DESCRIPTION</span>
		</div>
		<div class="form-group">
			<label class="col-form-label">Description<span class="text-danger">*</span></label>
			<input type="text" class="form-control desc entry_desc" value="<?php echo $list[0]->entrydesc; ?>" name="entrydesc" placeholder="Description" />
		</div>
		
		
		<!-- DataList for entry type Start Here-->
		<datalist id="entry">
			<?php 
				$list = $this->db->get('entriesmaster')->result();
				foreach ($list as $item)
				{
					$name=$item->entrycode;
				?>
				<option><?= $name ?></option>
				<?php 
				}
			?>
		</datalist>
		<!-- DataList for entry type End Here-->
		
		
        <?php
            break;
			# 12B End Here 
			
			
			case 'EditBill';
		?>
		<input type="text" name="id" value="<?php echo $list[0]->id; ?>" />
		<div class="form-group">
			<label class="col-form-label">bill Name <span class="text-danger">*</span></label>
			<input type="text" class="form-control text-capitalize" value="<?php echo $list[0]->name; ?>" name="name" placeholder="User Name" required>
			<?php echo form_error("name", "<p class='text-danger' >", "</p>"); ?>
		</div>
		
        <?php
            break;
			
			
			// case 'EditCategory';
			case 'EditLoan';
		?>
		<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
		
		<div class="form-group">
			<label class="col-form-label">Loan Amount  <span class="text-danger">*</span></label>
			<input type="text" class="form-control text-capitalize" name="loan_amount" value="<?php echo $list[0]->loan_amount; ?>">
			<?php echo form_error("loan_amount", "<p class='text-danger' >", "</p>"); ?>
		</div>
		
		
		<div class="form-group">
			<label class="col-form-label">No Of Months<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="no_of_months" value="<?php echo $list[0]->no_of_months; ?>" >
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Interest (%)<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="interest"  value="<?php echo $list[0]->interest; ?>">
			<?php echo form_error("interest", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">EMI Amount<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="emi_amount"  value="<?php echo $list[0]->emi_amount; ?>">
			<?php echo form_error("emi_amount", "<p class='text-danger' >", "</p>"); ?>
		</div>
		
		<div class="form-group">
			<label class="col-form-label">Remark<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="remark"  value="<?php echo $list[0]->remark; ?>">
			<?php echo form_error("remark", "<p class='text-danger' >", "</p>"); ?>
		</div>
		
        <?php
            break;
			
			
			
			// end 
			
			case 'EditSlider':
		?>
		<input type="hidden" name="id" value="<?php echo $list[0]->id; ?>" />
		
		<div class="form-group">
			<label class="col-form-label"> Icon <span class="text-danger"></span></label>
			<input type="file" class="form-control dropify" data-height="100" name="icon" Title="Choose Icon" accept="image/jpg, image/png, image/jpeg, image/gif" data-default-file="<?php echo base_url('uploads/' . $this->data->folder . '/' . $list[0]->icon . '') ?>">
			<?php echo form_error("icon", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">username <span class="text-danger"></span></label>
			<input type="text" class="form-control" placeholder="Enter username" name="username" value="<?php echo $list[0]->username; ?>">
			<?php echo form_error("username", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">email <span class="text-danger"></span></label>
			<input type="text" class="form-control" placeholder="Enter email" name="email" value="<?php echo $list[0]->email; ?>">
			<?php echo form_error("email", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">mobile <span class="text-danger"></span></label>
			<input type="number" class="form-control" placeholder="Enter mobile" name="mobile" value="<?php echo $list[0]->mobile; ?>">
			<?php echo form_error("mobile", "<p class='text-danger' >", "</p>"); ?>
		</div>
		<div class="form-group">
			<label class="col-form-label">password <span class="text-danger"></span></label>
			<input type="text" class="form-control" placeholder="Enter password" name="password" value="<?php echo $list[0]->password; ?>">
			<?php echo form_error("password", "<p class='text-danger' >", "</p>"); ?>
		</div>
		
		
		<?php
			$value = explode(',', $list[0]->permissions);
            // var_dump($value);die();
		?>
		
		<div class="form-group">
			<label class="col-form-label">Permissions<span class="text-danger"></span></label>
			<select data-placeholder="Choose tags ..." name="tags[]" multiple class="chosen-select">
				
				<?php foreach ($value as $classes) : ?>
				<option <?php if (in_array($classes['permissions'], $value))
					{
						echo "selected";
					} ?> value="<?= $classes['id'] ?>"><?= $classes['permissions'] ?>
				</option>
				<?php endforeach; ?>
			</select>
			<?php echo form_error("permissions", "<p class='text-danger' >", "</p>"); ?>
		</div>
		
		
		<?php
            // end heresubadmin
		}
	}
	else
	{
		echo 'Action is required.';
	}
?>
<script>
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
    $('.summernote').summernote();
    $('.chosen-select').chosen();
</script>
<script>
	
	function getEntry(e,id){
		
		var dist=id;
		$.ajax({
			url: "<?= base_url('Admin/getEntry')?>",
			type: 'post',
			data: {id:id},
			cache: false,
			success: function(response){
				$(e).parent().find(".entry_code_name").text(response);
				// end here 
			}
		});
	}
</script>
<script src="<?= base_url($this->data->appTempletePath); ?>js/scripts/forms/checkbox-radio.min.js"></script>