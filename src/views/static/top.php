<?php /*
SELECT `id_fma`, `id_fm`, `usuario_id`, `status_fma` FROM `files_managers_approved` WHERE 1
*/
$id_usuario=$_SESSION["id_usuario"];
$usuario_tipo=$_SESSION["usuario_tipo"];
$count_fm=$CRUD->Written("SELECT COUNT(*) FROM files_managers WHERE id_fm IN (SELECT MAX(id_fm)
														FROM files_managers GROUP BY codigo_fm) AND status_fm>0
														AND approved_by LIKE '%$usuario_tipo%'
														AND id_fm NOT IN (SELECT id_fm FROM files_managers_approved WHERE usuario_id=$id_usuario)
														ORDER BY group_fm,titulo_fm ASC",null, true)[0];
 ?>
<!-- Main Header-->
			<div class="main-header side-header sticky">
				<div class="container-fluid">
					<div class="main-header-left">
						<a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
					</div>
					<!-- <img src="<?php echo RAIZ; ?>assets/images/logo-mc.svg" height="80%">
					<img src="<?php echo RAIZ; ?>assets/images/logo-paysend.svg" height="50%" class="ms-4">
								 -->
								 <img src="<?php echo RAIZ; ?>assets/images/Mastercard-Logo.png" height="50%">
					<div class="main-header-center">
					</div>
					<div class="main-header-right">
						<div class="dropdown main-profile-menu mpm-show">
							<a class="d-flex position-relative" style="padding-right: 11px;">
								<i class="fa fa-bell" style="font-size: 25px;color:black"></i>
								<?php if ($count_fm["COUNT(*)"]>0) { ?>
									<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="background:#dc100c !important;">
										<?php echo $count_fm["COUNT(*)"] ?>
									</span>
								<?php } ?>
							</a>
							<div class="dropdown-menu p-1">
								<?php if ($count_fm["COUNT(*)"]>0) { ?>
									<div class="alert alert-danger mt-2 m-1 p-2" role="alert">
									  <a class="link-secondary" href="<?php echo RAIZ_HTTPS."viewCreativeMaterialsCenter" ?>">(<?php echo $count_fm["COUNT(*)"] ?>) Files Pending Approval</a>
									</div>
								<?php }else{ ?>
									<div class="alert alert-light mt-2 m-1 p-2" role="alert">
										No pending alerts
									</div>
								<?php } ?>
							</div>
						</div>

						<div class="ms-2 ps-2">
							<b>HI <?php echo strtoupper(explode(" ",$_SESSION["usuario_nombre"])[0]); ?>!</b>
						</div>
						<div class="dropdown header-search">
							<a class="nav-link icon header-search">
								<i class="fe fe-search header-icons"></i>
							</a>
							<div class="dropdown-menu">
								<div class="main-form-search p-2">
									<div class="input-group">
										<div class="input-group-btn search-panel">
											<select class="form-control select2">
												<option label="All categories">
												</option>
												<option value="IT Projects">
													IT Projects
												</option>
												<option value="Business Case">
													Business Case
												</option>
												<option value="Microsoft Project">
													Microsoft Project
												</option>
												<option value="Risk Management">
													Risk Management
												</option>
												<option value="Team Building">
													Team Building
												</option>
											</select>
										</div>
										<input type="search" class="form-control" placeholder="Search for anything...">
										<button class="btn search-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
									</div>
								</div>
							</div>
						</div>
						<div class="dropdown main-profile-menu">
							<a class="d-flex" href="">
								<span class="main-img-user" ><img alt="avatar" src="<?php echo RAIZ; ?>assets/images/login.svg"></span>
							</a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<h6 class="main-notification-title"><?php echo $_SESSION["usuario_nombre"]; ?></h6>
									<p class="main-notification-text"><?php echo $_SESSION["usuario_email"]; ?></p>
								</div>
								<a class="dropdown-item" href="<?php echo RAIZ; ?>change-password">
									<i class="fas fa-key"></i> Change Password
								</a>
								<a class="dropdown-item" href="<?php echo RAIZ; ?>?P=logout">
									<i class="fas fa-power-off"></i> Sign Out
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Main Header-->
