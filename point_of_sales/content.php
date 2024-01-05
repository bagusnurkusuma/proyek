<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php include "../asset_default/side_bar.php"; ?>

<body class="nav-md">
	<div class="container body">

		<!-- page content -->
		<div class="right_col" role="main">
			<div class="content">
				<div class="page-title">
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12 ">
						<div class="x_panel">
							<div class="x_title">
								<h2>Form Design <small>different form elements</small></h2>
								<ul class="nav navbar-right panel_toolbox">
									<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</li>
								</ul>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<br />
								<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

									<div class="item form-group">
										<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 ">
											<input type="text" id="first-name" required="required" class="form-control ">
										</div>
									</div>
									<div class="item form-group">
										<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 ">
											<input type="text" id="last-name" name="last-name" required="required" class="form-control">
										</div>
									</div>
									<div class="item form-group">
										<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Middle Name / Initial</label>
										<div class="col-md-6 col-sm-6 ">
											<input id="middle-name" class="form-control" type="text" name="middle-name">
										</div>
									</div>
									<div class="item form-group">
										<label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
										<div class="col-md-6 col-sm-6 ">
											<div id="gender" class="btn-group" data-toggle="buttons">
												<label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
													<input type="radio" name="gender" value="male" class="join-btn"> &nbsp; Male &nbsp;
												</label>
												<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
													<input type="radio" name="gender" value="female" class="join-btn"> Female
												</label>
											</div>
										</div>
									</div>
									<div class="item form-group">
										<label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 ">
											<input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
											<script>
												function timeFunctionLong(input) {
													setTimeout(function() {
														input.type = 'text';
													}, 60000);
												}
											</script>
										</div>
									</div>
									<div class="ln_solid"></div>
									<div class="item form-group">
										<div class="col-md-6 col-sm-6 offset-md-3">
											<button class="btn btn-primary" type="button">Cancel</button>
											<button class="btn btn-primary" type="reset">Reset</button>
											<button type="submit" class="btn btn-success">Submit</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /page content -->
	</div>
</body>

</html>