<?php include 'admin/db_connect.php' ?>
<?php
if(isset($_GET['id'])){		// Check if an 'id' parameter is passed in the URL
	// Fetch career data from the database where the 'id' matches the passed parameter
	$qry = $conn->query("SELECT * FROM careers where id=".$_GET['id'])->fetch_array();
	// Loop through the fetched data and assign each field value to a variable
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

?>
<div class="container-fluid"> 	<!-- Career management form -->
	<form action="" id="manage-career">
		<!-- Hidden field for 'id', if editing an existing career -->
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id']:'' ?>" class="form-control">
		<div class="row form-group">		<!-- Company input field -->
			<div class="col-md-8">
				<label class="control-label">Company</label>
				<input type="text" name="company" class="form-control" value="<?php echo isset($company) ? $company:'' ?>">
			</div>
		</div>
		<div class="row form-group">		<!-- Job Title input field -->
			<div class="col-md-8">
				<label class="control-label">Job Title</label>
				<input type="text" name="title" class="form-control" value="<?php echo isset($title) ? $title:'' ?>">
			</div>
		</div>
		<div class="row form-group">		<!-- Job Location input field -->
			<div class="col-md-8">
				<label class="control-label">Location</label>
				<input type="text" name="location" class="form-control" value="<?php echo isset($location) ? $location:'' ?>">
			</div>
		</div>
		<div class="row form-group">		<!-- Job Description textarea -->
			<div class="col-md-12">
				<label class="control-label">Description</label>
				<textarea name="description" class="text-jqte"><?php echo isset($description) ? $description : '' ?></textarea>
			</div>
		</div>
	</form>
</div>

<script>
	$('.text-jqte').jqte();		// Initialize the rich-text editor for the description field
	$('#manage-career').submit(function(e){		// Handle the form submission
		e.preventDefault()		// Prevent the default form submission
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=save_career',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){	// If the server returns '1', indicating success
					alert_toast("Data successfully saved.",'success')
					setTimeout(function(){		// Reload the page after 1 second
						location.reload()		// Refresh the page to show the updated data
					},1000)
				}
			}
		})
	})
</script>