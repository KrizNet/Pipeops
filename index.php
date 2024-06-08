<?php 
ob_start();
@session_start();
require_once("config.php");
function format_names($name=NULL) 
{
	/* Formats a first or last name, and returns the formatted version */
	if (empty($name))
		return false;
		
	// Initially set the string to lower, to work on it
	$name = strtolower($name);
	// Run through and uppercase any multi-barrelled name
	$names_array = explode('-',$name);
	for ($i = 0; $i < count($names_array); $i++) 
	{	
		// "McDonald", "O'Conner"..
		if (strncmp($names_array[$i],'mc',2) == 0 || preg_match('/^[oO]\'[a-zA-Z]/',$names_array[$i])) 
		{
			$names_array[$i][2] = strtoupper($names_array[$i][2]);
		}
		// Always set the first letter to uppercase, no matter what
		$names_array[$i] = ucfirst($names_array[$i]);
	}
	// Piece the names back together
	$name = implode('-',$names_array);
	// Return upper-casing on all missed (but required) elements of the $name var
	return ucwords($name);
}

function trash_puller($value) {
$value = @trim($value);
if(get_magic_quotes_gpc()){
$value = stripslashes($value);
}
return mysql_real_escape_string($value);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php $select_fetch_schoolname="SELECT * FROM schoolname limit 1"; $query_select_fetch_schoolname = @mysql_query($select_fetch_schoolname); while ($row = @mysql_fetch_array($query_select_fetch_schoolname)){ $School_Name = $row['School_Name'] ;} echo $School_Name; ?></title>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/style2.css" type="text/css">
	<link rel="stylesheet" href="css/style3.css" type="text/css">
	<link rel="stylesheet" href="css/style4.css" type="text/css">
	<link rel="stylesheet" href="css/stylemp.css" type="text/css">
	<link rel="stylesheet" href="css/stylealert.min.css" type="text/css">
	<link href="css/style5.css" rel="stylesheet" type="text/css" media='all'/>
	<link href="css/style6.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" type="text/css">
	<link rel='stylesheet' id='responsive-css-css'  href='css/responsive.css' type='text/css' media='all' />
	<link href='favicon.ico' sizes="16x16 32x32 64x64" rel='icon' type='image/x-icon'/>
    <script type='text/javascript' src='jquery/jquery.js'></script>
<style>
.sectionG {
  background-image: url("picture/sectionG.jpg");
  min-height: 50px; 
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>

<body class="" data-spy="scroll" data-target="#navbar-spy" data-offset="100">
	<header id="header" class="header header-inverse">
		<nav class="banner" role="navigation">
			<div class="content">
				<a href="javascript:void(0);" class="logo">
					<img src="picture/school_logo.png" />
				</a>
		         <span class="desktop-navigation pull-right hidden-mobile">
					<?php
					if(@$_SESSION['LASTNAME'] == "" && @$_SESSION['FIRSTNAME'] == ""){ 
					}else{
					?>
					<a>
					<input class="buttons" title="Click to logout" type="button" value="Logout" onclick="if(confirm('Do you really mean to logout? If YES then click on the OK button otherwise click on the Cancel button to stop.')){
					window.location.replace('logout.php');
					} 
					return false;"
					style="cursor:pointer; padding:7px;">
					</a>
					<?php
					}
					?>
					<a>
					<?php
					if(@$_SESSION['LASTNAME'] == "" && @$_SESSION['FIRSTNAME'] == ""){ 
					}else{
					if(empty($_SESSION['PHOTO'])){
					   $pix="avatar.jpg";
					   }else{
					   $pix=$_SESSION['PHOTO'];
					   }
					echo "<img src='Uploads/".$pix."' style='height:35px; width:35px; border-radius:40px; float:right;'/><br/>";
					}
					?>
					</a>
				</span>
			</div>
		</nav>
	</header>
<!--mobile navigation-->
<div class="bs-btn-icon-toggle fixed pull-right hidden-desktop">
	<button id="toggle-xs-menu" type="button" class="tcon tcon-menu--xcross pointer" aria-label="toggle menu" data-bs="offCanvas" data-backdrop="true" data-menu-id="#offcanvas">
	<?php
		if(@$_SESSION['LASTNAME'] == "" && @$_SESSION['FIRSTNAME'] == ""){ 
	?>
		<span class="tcon-menu__lines" aria-hidden="true"></span>
		<span class="tcon-visuallyhidden">toggle menu</span>
	<?php
		}else{
	?>
		<span class="" style="">
			<?php
				if(empty($_SESSION['PHOTO'])){
				$pix="avatar.jpg";
				}else{
				$pix=$_SESSION['PHOTO'];
				}
				echo "<img src='Uploads/".$pix."' style='height:40px; width:40px; border-radius:40px; float:right;'/><br/>";
			?>
		</span>
	<?php
		}
	?>
	</button>
</div>
<div id="offcanvas" class="offcanvas-pane hidden-desktop left-side close-option" style="background-color:;">
<?php
	if(@$_SESSION['LASTNAME'] == "" && @$_SESSION['FIRSTNAME'] == ""){ 
?>
	<div class="inner-menu text-uppercase" id="xs-menu" role="tablist" aria-multiselectable="true">
	        <div class="panel panel-menu">
			<a class="no-collapse" href="index.php">
				Home
			</a>
	        </div>
       </div>
<?php
	}else{
?>
	<div class="inner-menu text-uppercase" id="xs-menu" role="tablist" aria-multiselectable="true">
	        <div class="panel panel-menu">
			<a class="no-collapse" href="index.php">
				Home
			</a>
	        </div>
	        <div class="panel panel-menu">
			<div class="input-group" style="">
				<input class="buttons" title="Click to logout" type="button" value="Logout" onclick="if(confirm('Do you really mean to logout? If YES then click on the OK button otherwise click on the Cancel button to stop.')){
				window.location.replace('logout.php');
				} 
				return false;"
				style="cursor:pointer; padding:7px;">
			</div>
	        </div>
       </div>
<?php
	}
?>
</div>
<div id="offcanvas-backdrop" class="offcanvas-backdrop"></div>
<div id="main-content" role="main">

        <section class="hero course left with-affix">
		<div class="content">
			
		</div>
		<div class="video">
			<div class="image sectionG" style="background-image: url('picture/school_banner.jpg')"></div>
		</div>
	</section>
	<section id="Overview" class="features">
		<div class="container-fluid sectionG">
			<div class="row" style="">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
					<div class="row" style="padding:30px 10px 40px 10px;">
						<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0">
						</div>
						<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
							<div>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<center><h2 style="color:red; font-weight:bold; font-family: Gabriela;">Staff Portal</h2></center>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:20px;">
										<div>
											<div class="row">
												<div class="col-lg-3 col-md-2 col-sm-2 col-xs-0">
												</div>
												<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
													<form method="post" action="staff_process_login.php">
														<div class="row" style="box-shadow:15px 25px 25px #000; margin:20px 10px 30px 10px; border-radius:20px;">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
																<center>
																	<p style="font-family:Century; color:green; font-size:16px; border-bottom:1px solid #ccc;">
																		Please Log In or Sign Up if you are a new staff here.
																	</p>
																</center>
															</div>
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
																<div class="container-fluid">
																	<div class="row">
																		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">
																		</div>
																		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
																			<center>
																				<div class="input-group" style="">
																					<span class="input-group-addon" style="font-weight:bold; color:black; background-color:#CCCCCC;">Staff ID</span>
																					<input type="text" name="staffid" id="staffid" required="" placeholder="Staff ID" class="form-control" title="Enter Your Staff ID"/>
																				</div>
																			</center>
																		</div>
																		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px; margin-bottom:10px;">
																<div class="container-fluid">
																	<div class="row">
																		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">
																		</div>
																		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
																			<center>
																				<div class="input-group" style="">
																					<span class="input-group-addon" style="font-weight:bold; color:black; background-color:#CCCCCC;">Password</span>
																					<input type="password" name="staffpswd" id="myInputB" required="" placeholder="Password" class="form-control" title="Enter Your Password"/>
																					<span class="input-group-addon" style="font-weight:bold; color:black; background-color:#eee;"><input type="checkbox" onclick="myFunctionB()" title="click on the checkbox to see password"> <span style="color:#000; font-weight:normal; font-size:14px;"><i class="glyphicon glyphicon-eye-open"></i></span></span>
																				</div>
																			</center>
																		</div>
																		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:20px">
																<div class="row">
																	<div class="col-xs-0 col-sm-0 col-md-0 col-lg-1"> 	        
																	</div>
																	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"> 
																		<input type="submit" name="stafflogin" id="stafflogin" value="Login" class="form-control btn-success"/>
																	</div>
																	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-5"> 
																		<a href="staff_forget_password.php" style="text-decoration:none;">
																			<input type="button" name="staff_forget_password" id="staff_forget_password" value="Forget Password?" class="form-control btn-primary"/>
																		</a>
																	</div>
																	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
																		<input type="reset" name="staff_cancel" id="staff_cancel" value="Cancel" class="pull-right form-control btn-danger"/>
																	</div>
																</div>		
															</div>
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
																<div class="container-fluid">
																	<div class="row">
																		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-1">
																		</div>
																		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-11">
																			<center><span style="font-weight:bold; font-size:15px;">First Time Using This? Please Click</span>&nbsp;&nbsp;<i class="glyphicon glyphicon-hand-right" style="color:red; font-weight:bold; font-size:20px;">&nbsp;</i><a href="staff_register.php" class="register1" style="color:blue; font-size:21px;">REGISTER NOW</a></center>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px; margin-bottom:20px;">
																  <?php
																	if(isset($_GET['msg']) && !empty($_GET['msg'])){
																		echo $_GET['msg'];
																	 }
																  ?>
															</div>
														</form>
													</div>
												</div>
												<div class="col-lg-3 col-md-2 col-sm-2 col-xs-0">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-1 col-md-1 col-sm-0 col-xs-0">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
  <!-- FOOTER -->
	  <?php
		include('footer.php');
	  ?>
  <!-- END FOOTER -->
</div>

<script type="text/javascript" src="js/grunticon.logos.loader.min.js"></script>
<script type="text/javascript">
    grunticon(["css/grunticon.icons.data.svg.css",
        "css/grunticon.icons.data.png.css",
        "css/grunticon.icons.fallback.css"
    ]);
</script>

<script type="text/javascript" src="js/vendor.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/sweet-alert.min.js"></script>
<script type="text/javascript" src="js/app.min.js"></script>

<script type="text/javascript" src="js/modal-submit.js"></script>


<div id="fb-root"></div>
<script></script>

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunctionB() {
  var x = document.getElementById("myInputB");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>