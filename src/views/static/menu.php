
<?php

$padre="";
function printMenu($hijos) {
	global $padre;
	foreach($hijos as $key => $hijo) {

		if ($hijo["hijos"]){
			$padre=$hijo[0];

				echo '<div class="accordion-item border-0">
						<h2 class="m-0 " id="heading'.str_replace(" ","",$padre).'">
							<a class="btn accordion-button py-3 bg-white shadow " type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.str_replace(" ","",$padre).'" aria-expanded="false" aria-controls="collapse'.str_replace(" ","",$padre).'">
							'.$hijo[1].' <span class="ms-1">'.$hijo[0].'</span>
							</a>
						</h2>
						<div id="collapse'.str_replace(" ","",$padre).'" class="border-0 accordion-collapse collapse" aria-labelledby="heading'.str_replace(" ","",$padre).'" data-bs-parent="#accordi'.str_replace(" ","",$padre).'xample">
							<ul class="list-group border-0">';
										printMenu($hijo["hijos"]);
					echo '  </ul>
						</div>
					  </div>';
			$padre="";
		} else {
			$status=(strpos(URL,$key)!==false)?'fw-bold':'-';
			echo '<li class="list-group-item border-0 rounded-0 '.$status.'">
					<a  href="'.$key.'">
					'.$hijo[1].' '.$hijo[0].'
					</a> ';		

			if (URL==$key || strpos(URL,$key)!==false){
				echo '	<script type="text/javascript">
							setTimeout(()=>{
								$("#collapse'.str_replace(" ","",$padre).'").addClass("show");
								$("#heading'.str_replace(" ","",$padre).' button").attr("aria-expanded","true");
							},50)
						</script>';
			}
			echo '</li>';
		}
	}
}
 ?>
			<!-- Sidemenu -->
			<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
				<div class="offcanvas-header">
					<h5 class="offcanvas-title" id="offcanvasExampleLabel">Task Manager</h5>
					<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
					<div class="accordion " id="accordionExample">
						<?php printMenu($_MENU); ?>
						<a class="dropdown-item border py-3 border-0 shadow rounded-bottom " href="<?php echo RAIZ; ?>?P=logout">
							<i class="fa fa-power-off"></i> Sign Out
						</a>
					</div>
				</div>
			</div>
			<?php if (strpos($key, URL)!==false){ ?>
				<script type="text/javascript">
					setTimeout(()=>{
						$("#collapse'.str_replace(" ","",$padre).'").addClass("show");
						$("#heading'.str_replace(" ","",$padre).' button").attr("aria-expanded","true");
					},50)
				</script>';
			<?php } ?>
			
			<!-- End Sidemenu -->
