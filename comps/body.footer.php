    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding pt-0">
            <div class="container">
               <!--  -->
               <div class="row footer-wejed justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <!-- logo -->
                        <div class="footer-logo mb-20">
                        <a href="./"><img src="assets/img/logo/logo_footer.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <div class="footer-tittle-bottom">
                        <span>4</span>
                        <p>Hari Acara</p>
                    </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="footer-tittle-bottom">
                            <span><?= $database->numRows("participant") ?></span>
                            <p>Peserta Lomba</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <!-- Footer Bottom Tittle -->
                        <div class="footer-tittle-bottom">
                            <span><?= $database->numRows("competitions") ?> <sup class="text-danger rounded-circle fs-6">+6</sup></span>
                            <p>Perlombaan</p>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area footer-bg">
            <div class="container">
                <div class="footer-border">
                     <div class="row d-flex justify-content-between align-items-center">
                         <div class="col-xl-10 col-lg-8 ">
                             <div class="footer-copy-right">
                                 <p class="small"> Copyright <script>document.write(new Date().getFullYear());</script> <a href="//tripath.my.id" target="_blank" class="text-white">Tripath Projects</a>. All rights reserved.</p>
                             </div>
                         </div>
                         <div class="col-xl-2 col-lg-4">
                             <div class="footer-social f-right">
                                <a href="//x.com/fauzantrif" target="_blank"><i class="fab fa-x-twitter"></i></a>
                                <a href="//instagram.com/fauzantrif" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="//www.tripath.my.id" target="_blank"><i class="fas fa-globe"></i></a>
                                <?php /* <a href="//github.com/fauzantrif" target="_blank"><i class="fab fa-github"></i></a> */ ?>
                             </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>