<?php
  session_start();
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/ActivityTicketList'.$i18cdlangue.'.php');
  include('../../Home/Template/_header.php');
	include('../../Home/Template/_headerMenuTop.php');
	include('../../Home/Template/_headerMenuLeft.php');
?>
  <div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="task-title row align-items-center">
							<div class="col-md-8 col-sm-12">
								<h5>
                  <?php echo $page_title_opened; ?>
                  <span class="NbTicketsOpened"> (0)</span>
                </h5>
							</div>
							<div class="col-md-4 col-sm-12 text-right">
								<a href="task-add" data-toggle="modal" data-target="#task-add" class="bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i> <?php echo $page_add_title; ?></a>
							</div>
						</div>

						<div class="pb-20">
							<div class="profile-task-list pb-30">
								<ul id="SeeActivitiesOpened"></ul>
							</div>
							
              <div class="task-title row align-items-center">
								<div class="col-md-12 col-sm-12">
									<h5>
										<?php echo $page_title_closed; ?>
										<span class="NbTicketsClosed"> (0)</span>
									</h5>
								</div>
							</div>

							<div class="profile-task-list close-tasks">
                <ul id="SeeActivitiesClosed"></ul>
              </div>
							
              <!-- add task popup start -->
							<div class="modal fade customscroll" id="task-add" tabindex="-1" role="dialog">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle"><?php echo $page_add_title; ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $page_close_modal; ?>">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body pd-0">
											<div class="task-list-form">
												<ul>
													<li>
														<form>
															<div class="form-group row">
																<label class="col-md-4"><?php echo $page_type; ?></label>
																<div class="col-md-8">
																	<input type="text" class="form-control">
																</div>
															</div>
															<div class="form-group row">
																<label class="col-md-4"><?php echo $page_title; ?></label>
																<div class="col-md-8">
                                <input type="text" class="form-control">
																</div>
															</div>
															<div class="form-group row">
																<label class="col-md-4"><?php echo $page_desc; ?></label>
																<div class="col-md-8">
																	<textarea class="form-control"></textarea>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-md-4"><?php echo $page_assigned_to; ?></label>
																<div class="col-md-8">
																	<select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple="" data-selected-text-format="count" data-count-selected-text= "{0} people selected">
																		<option>Ferdinand M.</option>
																		<option>Don H. Rabon</option>
																		<option>Ann P. Harris</option>
																		<option>Katie D. Verdin</option>
																		<option>Christopher S. Fulghum</option>
																		<option>Matthew C. Porter</option>
																	</select>
																</div>
															</div>
														</form>
													</li>
                        </ul>
											</div>
										</div>
										<div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $page_all_close; ?></button>
											<button type="button" class="btn btn-primary"><?php echo $page_all_add; ?></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

		<?php
			include('../../Home/Template/_headerFooter.php');
		?>
    <script src="ticketList.js?v=<?php echo APP_VERSION;?>"></script>
  </body>
</html>