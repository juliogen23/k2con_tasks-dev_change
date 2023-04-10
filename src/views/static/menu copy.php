
<?php

$padre="";
function printMenu($hijos) {
	global $padre;
	foreach($hijos as $key => $hijo) {

		if ($hijo["hijos"]){
			$padre=$hijo[0];

				echo '<li class="nav-item" id="li'.str_replace(" ","",$padre).'">
				 				<a class="nav-link with-sub" href="#">
				 					'.$hijo[1].'
				 					<span class="sidemenu-label">'.$hijo[0].'</span>
				 					<i class="angle fe fe-chevron-right"></i>
				 				</a>
				 				<ul class="nav-sub">
				 					<li class="side-menu-label1"><a href="#">Crypto Currencies</a></li>';
									printMenu($hijo["hijos"]);
				echo '	</ul>
							</li>';
							$padre="";

			// echo '<li class="nav-item " id="li'.str_replace(" ","",$padre).'" style="top: 5px;">
			// 				<span class=" nav-link with-sub">
			// 					'.$hijo[1].'
			// 					<span class="sidemenu-label">'.$hijo[0].'</span>
			// 					<i class="angle fe fe-chevron-right"></i>
			// 				</span>
			// 				<ul class="nav-sub">';
			// 				printMenu($hijo["hijos"]);
			//
			// echo '	</ul>
			// 			</li>';
						// $padre="";
		} else {
			$status=(strpos(URL,$key)!==false)?'active':'-';
			echo '<li class="nav-sub-item '.$status.'">
							<a class="nav-sub-link" href="'.$key.'">
							'.$hijo[1].' '.$hijo[0].'
							</a>';

			if (URL==$key || strpos(URL,$key)!==false){
				echo '	<script type="text/javascript">
									$(()=>{
											setTimeout(()=>{
												$("#li'.str_replace(" ","",$padre).'").addClass("show");
											 	$("#li'.str_replace(" ","",$padre).'").last().addClass("active");
											},50)
									});
								</script>';
			}

			echo '</li>';
		}
	}
}
// echo "<pre>";
// print_r($_MENU);
 ?>
			<!-- Sidemenu -->
			<div class="main-sidebar main-sidebar-sticky side-menu">
				<div class="sidemenu-logo">
					<a class="main-logo" href="<?php echo RAIZ; ?>">
						<img src="<?php echo RAIZ; ?>assets/images/masamo dash.png" class="header-brand-img desktop-logo" alt="logo">
						<img src="<?php echo RAIZ; ?>assets/images/masamo dash.png" class="header-brand-img icon-logo" alt="logo">
						<img src="<?php echo RAIZ; ?>assets/images/masamo dash.png" class="header-brand-img desktop-logo theme-logo" alt="logo">
						<img src="<?php echo RAIZ; ?>assets/images/masamo dash.png" class="header-brand-img icon-logo theme-logo" alt="logo">
					</a>
				</div>
				<div class="main-sidebar-body">
					<ul class="nav">
						<?php printMenu($_MENU); ?>
					</ul>
				</div>
			</div>zzz
			<?php if (strpos($key, URL)!==false){ ?>
				<script type="text/javascript">
						$(()=>{
								setTimeout(()=>{
									$("#li'.str_replace(" ","",$padre).'").addClass("show");
								 	$("#li'.str_replace(" ","",$padre).'").last().addClass("active");
								},50)
						});
				</script>';
			<?php } ?>
			<!-- End Sidemenu -->
