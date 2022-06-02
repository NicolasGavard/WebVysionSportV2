<?php
	session_start();
	include('i18/FR/header.php');
	
	include('_header.php');
	include('_headerMenuTop.php');
	include('_headerMenuLeft.php');
?>
  
  <div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<img class="InfoProfilPicture" src="" alt="" style='min-width: 160px; min-height: 160px; max-width: 160px; max-height: 160px;'>
							</div>
							<h5 class="text-center h5 mb-0 InfoProfilFullName"></h5>
							<p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue" style="font-size: 1.2rem;">
									<span class="micon dw dw-user1"></span>&nbsp;
									<span class="page_profil_title_presentation"></span>&nbsp;
								</h5>
								<ul>
									<li>
										<span class="page_profil_full_name"></span>
										<span class="InfoProfilFullName" style="color: #202342"></span>
									</li>
									<li>
										<span class="page_profil_email"></span>
										<span class="InfoProfilFormEmail" style="color: #202342"></span>
									</li>
									<li>
										<span class="page_profil_phone"></span>
										<span class="InfoProfilFormPhone" style="color: #202342"></span>
									</li>
									<li>
										<span class="page_profil_mobile"></span>
										<span class="InfoProfilFormMobile" style="color: #202342"></span>
									</li>
									<li>
										<span class="page_profil_address1"></span>
										<span class="InfoProfilFullAdresse" style="color: #202342"></span>1807 Holden Street
										<br>
										<span class="InfoProfilFullZipCity" style="color: #202342"></span>San Diego, CA 92115
									</li>
								</ul>
							</div>
							<div class="profile-social">
								<h5 class="mb-20 h5 text-blue" style="font-size: 1.1rem;">
									<span class="micon dw dw-link2"></span>&nbsp;
									<span class="page_profil_social_links"></span> 
								</h5>
								<ul class="clearfix">
									<li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i class="fa fa-dribbble"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i class="fa fa-dropbox"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"><i class="fa fa-pinterest-p"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i class="fa fa-skype"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"><i class="fa fa-vine"></i></a></li>
								</ul>
							</div>
							<div class="profile-skills">
								<h5 class="mb-20 h5 text-blue" style="font-size: 1.1rem;"><span class="micon dw dw-star"></span> Note</h5>
								<h6 class="mb-5 font-14">Activities</h6>
								<div class="progress mb-20">
									<div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">25%</div>
								</div>
								<h6 class="mb-5 font-14">Note Coach</h6>
								<div class="progress mb-20">
									<div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">50%</div>
								</div>
								<h6 class="mb-5 font-14">Note Elèves</h6>
								<div class="progress mb-20">
									<div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">75%</div>	
								</div>
								<h6 class="mb-5 font-14">General satisfaction</h6>
								<div class="progress mb-20">
									<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">100%</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active page_profil_title_settings" data-toggle="tab" href="#setting" role="tab" style="padding:10px 15px;"></a>
                    </li>
										<li class="nav-item">
											<a class="nav-link page_profil_title_tasks" data-toggle="tab" href="#tasks" role="tab" style="padding:10px 15px;"></a>
										</li>
										<li class="nav-item">
											<a class="nav-link page_profil_title_change_pass" data-toggle="tab" href="#security" role="tab" style="padding:10px 15px;"></a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Setting Tab start -->
										<div class="tab-pane show active" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form>
													<input class="form-control InfoProfilFormIdUser form-control-lg" type="hidden">
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20 page_profil_edit_settings"></h4>
															
															<div class="form-group">
																<label class="page_profil_gender"></label>
																<div class="d-flex">
																	<div class="custom-control custom-radio mb-5 mr-20">
																		<input type="radio" id="genreMal" name="customRadio" class="custom-control-input">
																		<label class="custom-control-label weight-400 page_profil_male" for="genreMal">Homme</label>
																	</div>
																	<div class="custom-control custom-radio mb-5">
																		<input type="radio" id="genreFemale" name="customRadio" class="custom-control-input">
																		<label class="custom-control-label weight-400 page_profil_female" for="genreFemale">Femme</label>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-md-6 col-sm-12">
																	<div class="form-group">
																		<label class="page_profil_name"></label>
																		<input class="form-control InfoProfilFormName form-control-lg" type="text">
																	</div>
																</div>
																<div class="col-md-6 col-sm-12">
																	<div class="form-group">
																		<label class="page_profil_firstname"></label>
																		<input class="form-control InfoProfilFormFirstName form-control-lg" type="text">
																	</div>
																</div>
															</div>

															<div class="form-group">
																<label class="page_profil_email"></label>
																<input class="form-control InfoProfilFormEmail form-control-lg" type="email">
															</div>

															<div class="form-group">
																<label class="page_profil_emailBackup"></label>
																<input class="form-control InfoProfilFormEmailBackup form-control-lg" type="email">
															</div>

															<div class="form-group">
																<label class="page_profil_date_of_birth"></label>
																<input class="form-control InfoProfilFormDateOfBirth form-control-lg date-picker" type="text">
															</div>
															
															<div class="form-group">
																<label class="page_profil_phone"></label>
																<input class="form-control InfoProfilFormPhone form-control-lg" type="text">
															</div>
															
															<div class="form-group">
																<label class="page_profil_mobile"></label>
																<input class="form-control InfoProfilFormMobile form-control-lg" type="text">
															</div>
															
															<div class="form-group">
																<label class="page_profil_address1"></label>
																<input class="form-control InfoProfilFormAdresse form-control-lg" type="text">
															</div>

															<div class="row">
																<div class="col-md-4 col-sm-12">
																	<div class="form-group">
																		<label class="page_profil_zip_code"></label>
																		<input class="form-control InfoProfilFormZip form-control-lg" type="text">
																	</div>
																</div>
																<div class="col-md-8 col-sm-12">
																	<div class="form-group">
																		<label class="page_profil_city"></label>
																		<input class="form-control InfoProfilFormCity form-control-lg" type="text">
																	</div>
																</div>
															</div>

															<div class="form-group">
																<label class="page_profil_country"></label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Pays">
																	<option>France</option>
																</select>
															</div>
															
															<div class="form-group">
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="customCheck1-1">
																	<label class="custom-control-label weight-400 page_profil_notifier" for="customCheck1-1"></label>
																</div>
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Update Information">
															</div>
														</li>

														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20 page_profil_photo_profil"></h4>
															<div class="pd-20 card-box mb-30">
																<form class="dropzone" action="#" id="my-awesome-dropzone">
																	<input class="form-control AddBrandFormId"       	type="hidden" name="id"         value="0">
																	<input class="form-control AddBrandFormTimestamp" type="hidden" name="timestamp"  value="0">
																	<input class="form-control AddBrandFormStatut"    type="hidden" name="statut"     value="0">
																	<div class="fallback">
																		<input type="file" name="file" class="AddBrandFormPicture" />
																	</div>
																</form>
															</div>
															
															<h4 class="text-blue h5 mb-20 page_profil_social_links"></h4>
															<div class="form-group">
																<table class="table">
																	<tbody>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i class="fa fa-dribbble"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i class="fa fa-dropbox"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-google-plus"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"><i class="fa fa-pinterest-p"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i class="fa fa-skype"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																		<tr>
																			<td style='padding:0rem; text-align: center;'><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"><i class="fa fa-vine"></i></a></th>
																			<td style='padding:0rem;'><input class="form-control form-control-lg" type="text" placeholder="Paste your link here"></td>
																		</tr>
																	</tbody>
																</table>
																<div class="form-group mb-0">
																	<input type="submit" class="btn btn-primary" value="Update Information">
																</div>
															</div>
														</li>
													</ul>
												</form>
											</div>
										</div>
                    <!-- Setting Tab End -->
										
										<!-- Tasks Tab start -->
										<div class="tab-pane fade" id="tasks" role="tabpanel">
											<div class="pd-20 profile-task-wrap">
												<div class="container pd-0">
													<!-- Open Task start -->
													<div class="task-title row align-items-center">
														<div class="col-md-8 col-sm-12">
															<h5>Open Tasks (4 Left)</h5>
														</div>
														<div class="col-md-4 col-sm-12 text-right">
															<a href="task-add" data-toggle="modal" data-target="#task-add" class="bg-light-blue btn text-blue weight-500"><i class="ion-plus-round"></i> Add</a>
														</div>
													</div>
													<div class="profile-task-list pb-30">
														<ul>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-1">
																	<label class="custom-control-label" for="task-1"></label>
																</div>
																<div class="task-type">BackOffice</div>
																Finir migration de l'administration sur la nouvelle template + 2 petits soucis sur l'ajout des aliments.
																<div class="task-assign">Assigné par Nicolas G. <div class="due-date"><span>22/05/2022</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-1">
																	<label class="custom-control-label" for="task-1"></label>
																</div>
																<div class="task-type">BackOffice</div>
																Voir pour développer un module de migration des aliments de openfoodfacts.
																<div class="task-assign">Assigné par Nicolas G. <div class="due-date"><span>22/05/2022</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-2">
																	<label class="custom-control-label" for="task-2"></label>
																</div>
																<div class="task-type">BackOffice</div>
																Finir migration du profil sur la nouvelle template.
																<div class="task-assign">Assigné par Nicolas G. <div class="due-date"><span>22/05/2022</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-3">
																	<label class="custom-control-label" for="task-3"></label>
																</div>
																<div class="task-type">BackOffice</div>
																Voir pour assigner un élève à un coach ... !!!
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-3">
																	<label class="custom-control-label" for="task-3"></label>
																</div>
																<div class="task-type">BackOffice</div>
																VOir pour mettre en place la possibilité de saisir plusieurs type d'adresses (Perso, facturation, livraison, ...)
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2019</span></div></div>
															</li>
														</ul>
													</div>
													<!-- Open Task End -->
													<!-- Close Task start -->
													<div class="task-title row align-items-center">
														<div class="col-md-12 col-sm-12">
															<h5>Closed Tasks</h5>
														</div>
													</div>
													<div class="profile-task-list close-tasks">
														<ul>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-close-1" checked="" disabled="">
																	<label class="custom-control-label" for="task-close-1"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea earum.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-close-2" checked="" disabled="">
																	<label class="custom-control-label" for="task-close-2"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-close-3" checked="" disabled="">
																	<label class="custom-control-label" for="task-close-3"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet, consectetur adipisicing elit.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
															</li>
															<li>
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="task-close-4" checked="" disabled="">
																	<label class="custom-control-label" for="task-close-4"></label>
																</div>
																<div class="task-type">Email</div>
																Lorem ipsum dolor sit amet. Id ea earum.
																<div class="task-assign">Assigned to Ferdinand M. <div class="due-date">due date <span>22 February 2018</span></div></div>
															</li>
														</ul>
													</div>
													<!-- Close Task start -->
													<!-- add task popup start -->
													<div class="modal fade customscroll" id="task-add" tabindex="-1" role="dialog">
														<div class="modal-dialog modal-dialog-centered" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="exampleModalLongTitle">Tasks Add</h5>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Close Modal">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
																<div class="modal-body pd-0">
																	<div class="task-list-form">
																		<ul>
																			<li>
																				<form>
																					<div class="form-group row">
																						<label class="col-md-4">Task Type</label>
																						<div class="col-md-8">
																							<input type="text" class="form-control">
																						</div>
																					</div>
																					<div class="form-group row">
																						<label class="col-md-4">Task Message</label>
																						<div class="col-md-8">
																							<textarea class="form-control"></textarea>
																						</div>
																					</div>
																					<div class="form-group row">
																						<label class="col-md-4">Assigned to</label>
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
																					<div class="form-group row mb-0">
																						<label class="col-md-4">Due Date</label>
																						<div class="col-md-8">
																							<input type="text" class="form-control date-picker">
																						</div>
																					</div>
																				</form>
																			</li>
																			<li>
																				<a href="javascript:;" class="remove-task"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remove Task"><i class="ion-minus-circled"></i></a>
																				<form>
																					<div class="form-group row">
																						<label class="col-md-4">Task Type</label>
																						<div class="col-md-8">
																							<input type="text" class="form-control">
																						</div>
																					</div>
																					<div class="form-group row">
																						<label class="col-md-4">Task Message</label>
																						<div class="col-md-8">
																							<textarea class="form-control"></textarea>
																						</div>
																					</div>
																					<div class="form-group row">
																						<label class="col-md-4">Assigned to</label>
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
																					<div class="form-group row mb-0">
																						<label class="col-md-4">Due Date</label>
																						<div class="col-md-8">
																							<input type="text" class="form-control date-picker">
																						</div>
																					</div>
																				</form>
																			</li>
																		</ul>
																	</div>
																	<div class="add-more-task">
																		<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Task"><i class="ion-plus-circled"></i> Add More Task</a>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-primary">Add</button>
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																</div>
															</div>
														</div>
													</div>
													<!-- add task popup End -->
												</div>
                        <!-- Tasks Tab End -->
											</div>
										</div>
										<!-- Tasks Tab End -->

										<!-- Security Tab start -->
										<div class="tab-pane fade" id="security" role="tabpanel">
											<div class="pd-20 profile-task-wrap">
												<div class="container pd-0">
													<!-- Open Task start -->
													<div class="task-title row align-items-center">
														<div class="col-md-12 col-sm-12">
															<h4 class="text-blue h5 mb-20 page_profil_edit_settings"></h4>
															<div class="form-group">
																<label class="page_profil_old_pass">Old pass</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label class="page_profil_new_pass">New pass</label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label class="page_profil_confirm_pass">Confirm pass</label>
																<input class="form-control form-control-lg" type="email">
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-warning" value="Update Information">
															</div>
														</li>
													</ul>
												</form>
											</div>
										</div>
                    <!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php
	include('_headerFooter.php');
?>