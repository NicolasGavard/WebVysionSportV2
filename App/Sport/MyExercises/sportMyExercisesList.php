<?php
	session_start();
  $i18cdlangue    = 'FR';
  // If ($user->->getIdLanguage() == 2) $i18cdlangue = 'EN';
	include('../../Home/Template/i18/'.$i18cdlangue.'/header'.$i18cdlangue.'.php');
	include('i18/'.$i18cdlangue.'/sportMyExercisesList'.$i18cdlangue.'.php');
  include('../../Home/Template/_header.php');
	include('../../Home/Template/_headerMenuTop.php');
	include('../../Home/Template/_headerMenuLeft.php');
?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
        <div class="pd-20 card-box mb-30">
					<div class="clearfix">
            <div class="pull-left">
              <h4 class="text-blue h4"><?php echo $page_title; ?></h4>
            </div>
              
            <div class="pull-right">
              <!-- <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-info AddSearchMyExercises" data-toggle="modal" data-target="#modalSearchMyExercises"><i class="icon-copy dw-info dw dw-search"></i> <?php echo $page_all_filter; ?></buttons> -->
              <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-success disabled"><i class="icon-copy dw-success dw dw-checked"></i> <?php echo $page_all_active; ?></buttons>
              <button type="button" style="margin-top: 5px; margin-right: 5px;" class="btn btn-warning"><i class="icon-copy dw-warning dw dw-ban"></i> <?php echo $page_all_inactive; ?></button>
              <button type="button" style="margin-top: 5px; margin-right: 0px;" class="btn btn-primary AddNewMyExercise" data-toggle="modal" data-target="#modalAddMyExercise"><i class="fa fa-plus"></i> <?php echo $page_all_add; ?></button>
            </div>
          </div>
          
          <div class="pb-20"></div>
          <div class="pb-20">
            <table class="display responsive nowrap" width="100%" id="datatable">
							<thead>
								<tr>
                  <th width="15%" class="table-plus"><span><?php echo $page_name; ?></span></th>
                  <th width="20%"><span><?php echo $page_muscles; ?></span></th>
                  <th width="25%"><span><?php echo $page_exercise_type; ?></span></th>
                  <th width="10%"><span><?php echo $page_media_type; ?></span></th>
                  <th width="30%"><span><?php echo $page_description; ?></span></th>
                  <th width="10%" class="datatable-nosort"><span><?php echo $page_action; ?></span></th>
								</tr>
							</thead>
						</table>
          </div>
				</div>
			</div>
      
      <div class="modal fade bs-example-modal-lg" id="modalAddMyExercise" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center font-18">
              <h4 class="padding-top-30 mb-30 weight-500 add_title d-none"><?php echo $page_add_title; ?></h4>
              <h4 class="padding-top-30 mb-30 weight-500 update_title d-none"><?php echo $page_update_title; ?></h4>
              <form class="FormAddMyExercise" action="#" id="FormAddMyExercise">
                <input class="form-control AddMyExerciseFormId"            type="hidden" name="id"           value="0">
                <input class="form-control AddMyExerciseFormIdUserCoatch"  type="hidden" name="idUserCoach"  value="0">
                <input class="form-control AddMyExerciseFormTimestamp"     type="hidden" name="timestamp"    value="0">
                <input class="form-control AddMyExerciseFormStatut"        type="hidden" name="elemState"    value="0">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_name; ?></label>
                      <input class="form-control AddMyExerciseFormName" id="name" placeholder="<?php echo $page_name; ?>" type="text" name="name">
                      <div class="form-control-feed back danger-name has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_name; ?> </div>
                    </div>
                  </div>
                
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_muscles; ?></label>
                      <select class="custom-select2 form-control AddMyExerciseFormMuscles" multiple="multiple" data-style="btn-outline-danger" id="listMuscles" name="idMuscle" style="width: 100%; height: 30px;">  
                      </select>
                      <div class="form-control-feed back danger-template has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_muscles; ?> </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_exercise_type; ?></label>
                      <select class="custom-select2 form-control AddMyExerciseFormNameExercicesTypes" id="listExercisesTypes" name="idExerciseType" style="width: 100%; height: 38px;">
                        <option value="0"><?php echo $page_all_choice; ?></option>
                      </select>
                      <div class="form-control-feed back danger-student has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_exercise_type; ?> </div>
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label><?php echo $page_description; ?></label>
                      <textarea class="form-control AddMyExerciseFormDecription" id="description" placeholder="<?php echo $page_description; ?>" name="description"></textarea>
                    </div>
                  </div>
                  
                  <div class="col-md-12 col-sm-12 padding-bottom-30 add_title">
                    
                    <div id="accordion">
                      <div class="card">
                        <div class="card-header">
                          <button class="btn btn-block" data-toggle="collapse" data-target="#<?php echo $page_video_title; ?>">
                          <i class="dw dw-video-player" aria-hidden="true"></i>
                            <?php echo $page_video_title; ?>
                          </button>
                        </div>
                        <div id="<?php echo $page_video_title; ?>" class="collapse show" data-parent="#accordion">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                  <label><?php echo $page_player_type; ?></label>
                                  <select class="custom-select2 form-control AddMyExerciseFormVideoPlayerType" id="playerType" name="playerType" style="width: 100%; height: 38px;">
                                    <option value="<?php echo strtolower($page_player_type_youtube); ?>"><?php echo $page_player_type_youtube; ?></option>
                                    <option value="<?php echo strtolower($page_player_type_vimeo); ?>"><?php echo $page_player_type_vimeo; ?></option>
                                    <option value="" selected><?php echo $page_player_type_other; ?></option>
                                  </select>
                                  <div class="form-control-feed back danger-player_type  has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_player_type; ?> </div>
                                </div>
                              </div>

                              <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                  <label><?php echo $page_player_id; ?></label>
                                  <input class="form-control AddMyExerciseFormVideoPlayerId" id="playerId" placeholder="<?php echo $page_player_id; ?>" type="text" name="playerId">
                                  <div class="form-control-feed back danger-player_id has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_player_id; ?> </div>
                                </div>
                              </div>
                              
                              <hr width=45%>&nbsp;&nbsp;<?php echo $page_choice_or; ?>&nbsp;&nbsp;<hr width=45%>

                              <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                  <label><?php echo $page_linkToPicture; ?></label>
                                  <input class="form-control AddMyExerciseFormVideoLinkToPicture" id="linkToPicture" placeholder="<?php echo $page_linkToPicture; ?>" type="file" name="linkToPicture">
                                  <div class="form-control-feed back danger-link_to_picture has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_link_to_picture; ?> </div>
                                </div>
                              </div>

                              <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                  <label><?php echo $page_linkToMedia; ?></label>
                                  <input class="form-control AddMyExerciseFormVideoLinkToMedia" id="linkToMedia" placeholder="<?php echo $page_linkToMedia; ?>" type="file" name="linkToMedia">
                                  <div class="form-control-feed back danger-link_to_media has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_link_to_media; ?> </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header">
                          <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#<?php echo $page_audio_title; ?>">
                            <i class="dw dw-music" aria-hidden="true"></i>
                            <?php echo $page_audio_title; ?>
                          </button>
                        </div>
                        <div id="<?php echo $page_audio_title; ?>" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                  <label><?php echo $page_player_type; ?></label>
                                  <select class="custom-select2 form-control AddMyExerciseFormAudioPlayerType" id="playerType" name="playerType" style="width: 100%; height: 38px;">
                                    <option value="<?php echo strtolower($page_player_type_youtube); ?>"><?php echo $page_player_type_youtube; ?></option>
                                    <option value="<?php echo strtolower($page_player_type_vimeo); ?>"><?php echo $page_player_type_vimeo; ?></option>
                                    <option value=""><?php echo $page_player_type_other; ?></option>
                                  </select>
                                  <div class="form-control-feed back danger-player_type  has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_player_type; ?> </div>
                                </div>
                              </div>

                              <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                  <label><?php echo $page_player_id; ?></label>
                                  <input class="form-control AddMyExerciseFormAudioPlayerId" id="playerId" placeholder="<?php echo $page_player_id; ?>" type="text" name="playerId">
                                  <div class="form-control-feed back danger-player_id has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_player_id; ?> </div>
                                </div>
                              </div>

                              <hr width=45%>&nbsp;&nbsp;<?php echo $page_choice_or; ?>&nbsp;&nbsp;<hr width=45%>

                              <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                  <label><?php echo $page_linkToMedia; ?></label>
                                  <input class="form-control AddMyExerciseFormAudioLinkToMedia" id="linkToMedia" placeholder="<?php echo $page_linkToMedia; ?>" type="file" name="linkToMedia">
                                  <div class="form-control-feed back danger-link_to_media has-danger d-none" style='font-size: 14px;'><?php echo $errorData_txt_link_to_media; ?> </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-12 col-sm-12 padding-bottom-30 update_title">
                    <div class="col-md-12 col-sm-12 video"></div>
                  </div>
                </form>
              </div>
              
              <div class="padding-bottom-30 row" style="margin: 0 auto;">
                <div class="col-12">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;<?php echo $page_all_close; ?></button>
                  <button type="button" class="btn btn-primary btnAddMyExercise" id="btnAddMyExercise"><i class="fa fa-check"></i>&nbsp;<?php echo $page_all_confirm; ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 

      <?php
        include('../../Home/Template/_headerFooter.php');
      ?>
      
      <script src="sportMyExercisesList.js?v=<?php echo APP_VERSION;?>"></script>
  </body>
</html>