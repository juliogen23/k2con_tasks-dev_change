<?php include("./src/views/static/head.php"); ?>
      <!-- Page -->
      <div class="page main-signin-wrapper bg-gray-100 h-100">
         <!-- Row -->
         <!-- <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                  <div class="row justify-content-center py-5">
                     <div class="col-lg-5 text-center mx-auto p-5">
                     </div>
                  </div>
            </div>
         </div> -->
         <div class="container pb-5 h-100">
            <div class="row mt-lg-n10 mt-md-n12 h-100 align-items-center">
               <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                  <div class="card z-index-0 shadow rounded-4">

                     <div class="card-body mt-2 mb-2">
                        <form class="form" method="post" action="">
                           <div  class="mb-4">
                              <!-- <img src="<?php echo RAIZ ?>assets/images/login.svg" width="80"> -->
                           </div>
                           <h3 class="text-center">Sign in</h3>
                           <div class="mt-4">
                              <div class="form-group text-left mb-0">
                                 <input class="form-control" placeholder="username" name="email" id="email" type="text">
                              </div>
                              <div class="form-group text-left mb-0">
                                 <br>
                                 <input class="form-control" placeholder="password" name="password" id="id_password" type="password">
                              </div>
                           </div>
                           <div class="mt-4 text-center">
                                 <button class="btn btn-primary ">Sign in</button>
                           </div>
                        </form>
                     </div>

                  </div>
               </div>
            </div>
         </div>
         <!-- End Row -->
      </div>
      <!-- End Page -->
<?php include("./src/views/static/footer.php"); ?>
