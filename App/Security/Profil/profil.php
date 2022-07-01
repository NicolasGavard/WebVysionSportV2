<?php
	session_start();
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/profil'.$i18cdlangue.'.php');
  include('../../Home/Template/_header.php');
	include('../../Home/Template/_headerMenuTop.php');
	include('../../Home/Template/_headerMenuLeft.php');
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
									<span><?php echo $page_title_presentation; ?></span>&nbsp;
								</h5>
								<ul>
									<li>
										<span><?php echo $page_full_name; ?></span>
										<span class="InfoProfilFullName" style="color: #202342"></span>
									</li>
									<li>
										<span><?php echo $page_email; ?></span>
										<span class="InfoProfilFormEmail" style="color: #202342"></span>
									</li>
									<li>
										<span><?php echo $page_phone; ?></span>
										<span class="InfoProfilFormPhone" style="color: #202342"></span>
									</li>
									<li>
										<span><?php echo $page_mobile; ?></span>
										<span class="InfoProfilFormMobile" style="color: #202342"></span>
									</li>
									<li>
										<span><?php echo $page_address1; ?></span>
										<span class="InfoProfilFullAdresse" style="color: #202342"></span>1807 Holden Street
										<br>
										<span class="InfoProfilFullZipCity" style="color: #202342"></span>San Diego, CA 92115
									</li>
								</ul>
							</div>
							<div class="profile-social">
								<h5 class="mb-20 h5 text-blue" style="font-size: 1.1rem;">
									<span class="micon dw dw-link2"></span>&nbsp;
									<span><?php echo $page_social_links; ?></span> 
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
                      <a class="nav-link active page_title_settings" data-toggle="tab" href="#setting" role="tab" style="padding:10px 15px;"><?php echo $page_title_settings; ?></a>
                    </li>
										<li class="nav-item">
											<a class="nav-link page_title_change_pass" data-toggle="tab" href="#security" role="tab" style="padding:10px 15px;"><?php echo $page_title_change_pass; ?></a>
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
															<h4 class="text-blue h5 mb-20"><?php echo $page_edit_settings; ?></h4>
															
															<div class="form-group">
																<label><?php echo $page_gender; ?></label>
																<div class="d-flex">
																	<div class="custom-control custom-radio mb-5 mr-20">
																		<input type="radio" id="genreMal" name="customRadio" class="custom-control-input">
																		<label class="custom-control-label weight-400 page_male" for="genreMal"><?php echo $page_male; ?></label>
																	</div>
																	<div class="custom-control custom-radio mb-5">
																		<input type="radio" id="genreFemale" name="customRadio" class="custom-control-input">
																		<label class="custom-control-label weight-400 page_female" for="genreFemale"><?php echo $page_female; ?></label>
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-md-6 col-sm-12">
																	<div class="form-group">
																		<label><?php echo $page_name; ?></label>
																		<input class="form-control InfoProfilFormName form-control-lg" type="text">
																	</div>
																</div>
																<div class="col-md-6 col-sm-12">
																	<div class="form-group">
																		<label><?php echo $page_firstname; ?></label>
																		<input class="form-control InfoProfilFormFirstName form-control-lg" type="text">
																	</div>
																</div>
															</div>

															<div class="form-group">
																<label><?php echo $page_email; ?></label>
																<input class="form-control InfoProfilFormEmail form-control-lg" type="email">
															</div>

															<div class="form-group">
																<label><?php echo $page_emailBackup; ?></label>
																<input class="form-control InfoProfilFormEmailBackup form-control-lg" type="email">
															</div>

															<div class="form-group">
																<label><?php echo $page_date_of_birth; ?></label>
																<input class="form-control InfoProfilFormDateOfBirth form-control-lg date-picker" type="text">
															</div>
															
															<div class="form-group">
																<label><?php echo $page_phone; ?></label>
																<input class="form-control InfoProfilFormPhone form-control-lg" type="text">
															</div>
															
															<div class="form-group">
																<label><?php echo $page_mobile; ?></label>
																<input class="form-control InfoProfilFormMobile form-control-lg" type="text">
															</div>
															
															<div class="form-group">
																<label><?php echo $page_address1; ?></label>
																<input class="form-control InfoProfilFormAdresse form-control-lg" type="text">
															</div>

															<div class="row">
																<div class="col-md-4 col-sm-12">
																	<div class="form-group">
																		<label><?php echo $page_zip_code; ?></label>
																		<input class="form-control InfoProfilFormZip form-control-lg" type="text">
																	</div>
																</div>
																<div class="col-md-8 col-sm-12">
																	<div class="form-group">
																		<label><?php echo $page_city; ?></label>
																		<input class="form-control InfoProfilFormCity form-control-lg" type="text">
																	</div>
																</div>
															</div>

															<div class="form-group">
																<label><?php echo $page_country; ?></label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Pays">
																	<option>France</option>
																</select>
															</div>
															
															<div class="form-group">
																<div class="custom-control custom-checkbox mb-5">
																	<input type="checkbox" class="custom-control-input" id="customCheck1-1">
																	<label class="custom-control-label weight-400" for="customCheck1-1"><?php echo $page_notifier; ?></label>
																</div>
															</div>
															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Update Information">
															</div>
														</li>

														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20 page_photo_profil"></h4>
															<div class="pd-20 card-box mb-30">
																<form class="dropzone" action="#" id="my-awesome-dropzone">
																	<input class="form-control AddBrandFormId"       	type="hidden" name="id"         value="0">
																	<input class="form-control AddBrandFormTimestamp" type="hidden" name="timestamp"  value="0">
																	<input class="form-control AddBrandFormStatut"    type="hidden" name="elemState"     value="0">
																	<div class="fallback">
																		<input type="file" name="file" class="AddBrandFormPicture" />
																	</div>
																</form>
															</div>
															
															<h4 class="text-blue h5 mb-20 page_social_links"></h4>
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
										
										<!-- Security Tab start -->
										<div class="tab-pane fade" id="security" role="tabpanel">
											<div class="pd-20 profile-task-wrap">
												<div class="container pd-0">
													<!-- Open Task start -->
													<div class="task-title row align-items-center">
														<div class="col-md-12 col-sm-12">
															<h4 class="text-blue h5 mb-20 page_edit_settings"></h4>
															<div class="form-group">
																<label><?php echo $page_old_pass; ?></label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label><?php echo $page_new_pass; ?></label>
																<input class="form-control form-control-lg" type="text">
															</div>
															<div class="form-group">
																<label><?php echo $page_confirm_pass; ?></label>
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
			include('../../Home/Template/_headerFooter.php');
		?>

		<script src="profil.js?v=<?php echo APP_VERSION;?>"></script>
  </body>
</html>