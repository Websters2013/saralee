<?php
/*
Template Name: Contact
*/
get_header();

$current_id = get_the_ID();
?>
	<!-- contact-us -->
	<div class="contact-us">

		<!-- main-title -->
		<h2 class="main-title">
			<?= get_field('title', $current_id); ?>
		</h2>
		<!-- main-title -->

		<!-- contact-us__wrap -->
		<div class="contact-us__wrap">

			<!-- contact-us__form -->
			<div class="contact-us__form">

				<p>
					<span>If you have questions or comments about Sara Lee Desserts products, please share them with us!</span>
					<span>We are always interested to hear from our valued customers.</span>
				</p>

				<p>
          <span>You may find the answer to your question on our <a href="#">Frequently Asked Questions.</a></span>
					<span>But if not, shoot us a note using the form below and we’ll get back to you as soon as possible.</span>
				</p>

				<?= do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]');?>
			</div>
			<!-- /contact-us__form -->

			<!-- contact-us__aside -->
			<aside class="contact-us__aside">
				<dl>
					<dt>Telephone</dt>
					<dd>
						<a href="tel:+18003237117">+1 800-323-7117</a>
					</dd>
				</dl>
				<dl>
					<dt>Address</dt>
					<dd>
						<address>
							<span>Sara Lee Desserts</span>
							<span>Consumer Affairs</span>
							<span>P.O. Box 3901</span>
							<span>Peoria, IL 61612</span>
						</address>
					</dd>
				</dl>
				<dl>
					<dt>Connect With Us</dt>
					<dd>
						<!-- social -->
						<div class="social">
							<a href="#" class="social__item social__item-facebook">
								<svg enable-background="new 0 0 56.693 56.693" viewBox="0 0 56.693 56.693">
									<path d="M40.43,21.739h-7.645v-5.014c0-1.883,1.248-2.322,2.127-2.322c0.877,0,5.395,0,5.395,0V6.125l-7.43-0.029  c-8.248,0-10.125,6.174-10.125,10.125v5.518h-4.77v8.53h4.77c0,10.947,0,24.137,0,24.137h10.033c0,0,0-13.32,0-24.137h6.77  L40.43,21.739z"/>
								</svg>
							</a>
							<a href="#" class="social__item social__item-twetter">
								<svg enable-background="new 0 0 56.693 56.693" viewBox="0 0 56.693 56.693">
									<path d="M52.837,15.065c-1.811,0.805-3.76,1.348-5.805,1.591c2.088-1.25,3.689-3.23,4.444-5.592c-1.953,1.159-4.115,2-6.418,2.454  c-1.843-1.964-4.47-3.192-7.377-3.192c-5.581,0-10.106,4.525-10.106,10.107c0,0.791,0.089,1.562,0.262,2.303  c-8.4-0.422-15.848-4.445-20.833-10.56c-0.87,1.492-1.368,3.228-1.368,5.082c0,3.506,1.784,6.6,4.496,8.412  c-1.656-0.053-3.215-0.508-4.578-1.265c-0.001,0.042-0.001,0.085-0.001,0.128c0,4.896,3.484,8.98,8.108,9.91  c-0.848,0.23-1.741,0.354-2.663,0.354c-0.652,0-1.285-0.063-1.902-0.182c1.287,4.015,5.019,6.938,9.441,7.019  c-3.459,2.711-7.816,4.327-12.552,4.327c-0.815,0-1.62-0.048-2.411-0.142c4.474,2.869,9.786,4.541,15.493,4.541  c18.591,0,28.756-15.4,28.756-28.756c0-0.438-0.009-0.875-0.028-1.309C49.769,18.873,51.483,17.092,52.837,15.065z"/>
								</svg>
							</a>
							<a href="#" class="social__item social__item-pinterest">
								<svg enable-background="new 0 0 56.693 56.693" viewBox="0 0 56.693 56.693">
									<g>
										<path d="M28.348,5.158c-13.599,0-24.625,11.023-24.625,24.625c0,10.082,6.063,18.744,14.739,22.553   c-0.069-1.721-0.012-3.783,0.429-5.654c0.473-2,3.168-13.418,3.168-13.418s-0.787-1.572-0.787-3.896   c0-3.648,2.115-6.373,4.749-6.373c2.24,0,3.322,1.682,3.322,3.695c0,2.252-1.437,5.619-2.175,8.738   c-0.616,2.613,1.31,4.744,3.887,4.744c4.665,0,7.808-5.992,7.808-13.092c0-5.397-3.635-9.437-10.246-9.437   c-7.47,0-12.123,5.57-12.123,11.792c0,2.146,0.633,3.658,1.624,4.83c0.455,0.537,0.519,0.754,0.354,1.371   c-0.118,0.453-0.389,1.545-0.501,1.977c-0.164,0.625-0.669,0.848-1.233,0.617c-3.44-1.404-5.043-5.172-5.043-9.408   c0-6.994,5.899-15.382,17.599-15.382c9.4,0,15.588,6.804,15.588,14.107c0,9.658-5.369,16.875-13.285,16.875   c-2.659,0-5.16-1.438-6.016-3.068c0,0-1.43,5.674-1.732,6.768c-0.522,1.9-1.545,3.797-2.479,5.275   c2.215,0.654,4.554,1.01,6.979,1.01c13.598,0,24.623-11.023,24.623-24.623C52.971,16.181,41.945,5.158,28.348,5.158z"/>
									</g>
								</svg>
							</a>
						</div>
						<!-- /social -->
					</dd>
				</dl>
			</aside>
			<!-- /contact-us__aside -->

		</div>
		<!-- /contact-us__wrap -->

	</div>
	<!-- /contact-us -->
<?php
get_footer();