			<footer class="short">
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="span1">
								<a href="index.php" class="logo">
									<img alt="Porto Website Template" src="img/spring_auction_logo_footer.png">
								</a>
							</div>
							<div class="span7">
								<p>Changing lives one diaper at a time&nbsp;|&nbsp;another site by <a href="http://www.chuckcastle.me">chuckcastle.me</a></p>
							</div>
							<div class="span4">
								<nav id="sub-menu">
									<ul>
										<li><a href="index.php">Home</a></li>
										<?php	if($_SESSION['id']){ ?>
										<li><a href="index.php?logoff">Logout</a></li>
										<?php } else { ?>
										<li><a href="#login" data-toggle="modal">Login</a></li>
										<?php } ?>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Libs -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="vendor/jquery.js"><\/script>')</script>
		<script src="vendor/jquery.easing.js"></script>
		<script src="vendor/jquery.appear.js"></script>
		<script src="vendor/jquery.cookie.js"></script>
		<script src="vendor/bootstrap.js"></script>
		<script src="vendor/selectnav.js"></script>
		<script src="vendor/twitterjs/twitter.js"></script>
		<script src="vendor/jquery.tablesorter.js"></script>
		<script src="vendor/jquery.tablecloth.js"></script>
		<script src="vendor/revolution-slider/js/jquery.themepunch.plugins.js"></script>
		<script src="vendor/revolution-slider/js/jquery.themepunch.revolution.js"></script>
		<script src="vendor/flexslider/jquery.flexslider.js"></script>
		<script src="vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script>
		<script src="vendor/magnific-popup/magnific-popup.js"></script>
		<script src="vendor/jquery.validate.js"></script>
		<script src="vendor/simple-pagination/simple-pagination.js"></script>

		<script src="js/plugins.js"></script>

		<!-- Current Page Scripts -->
		<script src="js/views/view.home.js"></script>

		<!-- Theme Initializer -->
		<script src="js/theme.js"></script>

		<!-- Custom JS -->
		<script src="js/custom.js"></script>

	</body>
</html>