<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span4 signin">
				<?php $this->load->view('_blocks/all-members');?>
							<div class="control-group">	
								<label class="control-label">Are you currently active?</label>
								<div class="controls">
									<select id='active' name="active">
										<option value="no">No</option>
										<option value="yes">Yes</option>
									</select>
								</div>
			  				</div>
			  					<div class="current-activities" style="display:none;">
			  						<div class="control-group">
										<label class="control-label">Activities?</label>
										<div class="controls">	
				  							<select name="activities" multiple="multiples">
				  								<?php
				  									foreach($activities as $activity){
														echo("<option value='". $activity->id ."'>$activity->name</option> ");
													} 
				  								?>
				  							</select>
				  						</div>	
			  						</div>
			  						<div class="control-group">
										<label class="control-label">How often do you do these activities?</label>
										<div class="controls">	
				  							<select name="often">
												<option value="1">1-2 Times a Week</option>
												<option value="3">3-4 Times a Week</option>
												<option value="5">5-6 Times a Week</option>
												<option value="7">I am active every day</option>
											</select>
				  						</div>	
			  						</div>
			  						<div class="control-group">
										<label class="control-label">On a scale of 1-5 (five being the highest) how intensely are you performing these activities?</label>
										<div class="controls">	
				  							<select name="intensity" multiple="multiples">
												<option value="1">1 Heart rate is hovering</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5 Feel the burn</option>
											</select>
				  						</div>	
			  						</div>
			  						<div class="control-group">
										<label class="control-label">How long are you performing these activities for during each event?</label>
										<div class="controls">	
				  							<select name="duration" multiple="multiples">
												<option value="1">10-20 Minutes</option>
												<option value="2">20-40 Minutes</option>
												<option value="3">40-60 Minutes</option>
												<option value="4">60-90 Minutes</option>
												<option value="5">90+ Minutes</option>
											</select>
				  						</div>	
			  						</div>
			  						</div>
									<div class="control-group">	
										<label class="control-label">Are you social or Independent?</label>
										<div class="controls">
											<select name="social">
												<option value="social">Social</option>
												<option value="independent">Independent</option>
											</select>
										</div>
					  				</div>
			  						<div class="control-group">
										<label class="control-label">How often do you engage with others in a fun social setting per month?  (not including family and work related activities)</label>
										<div class="controls">	
				  							<select name="socialnumber" multiple="multiples">
												<option value="1">1-4 Times</option>
												<option value="5">5-8 Times</option>
												<option value="9">9-12 Times</option>
												<option value="13">13+ Times</option>
											</select>
				  						</div>	
			  						</div>
									<div class="control-group">	
										<label class="control-label">Do you want to increase your social active lifestyle activities?</label>
										<div class="controls">
											<select name="increaseSocial">
												<option value="yes">Yes</option>
												<option value="no">No</option>
												<option value="unsure">Not Sure</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">When it comes to participation, are you more into social sports (football, soccer, baseball) or endurance (are using endurance or adventure?)  sports (running, swimming, cycling)?</label>
										<div class="controls">
											<select name="sportsType">
												<option value="social">Social</option>
												<option value="endurance">Endurance</option>
												<option value="both">Both</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">On the days you are training, how much time will you be able to commit?</label>
										<div class="controls">
											<select name="time">
												<option value="30">30 Minutes</option>
												<option value="60">60 Minutes</option>
												<option value="90">90 Minutes</option>
											</select>
										</div>
					  				</div>
									<div class="control-group socialSports">	
										<label class="control-label">Are you looking for a new team in your area?</label>
										<div class="controls">
											<select name="lookingForSocial">
												<option value="yes">Yes</option>
												<option value="no">No</option>
												<option value="unsure">Not Sure</option>
											</select>
										</div>
					  				</div>
									<div class="control-group enduranceSports">	
										<label class="control-label">Are you looking for others to engage with in your area?</label>
										<div class="controls">
											<select name="lookingForSocial">
												<option value="yes">Yes</option>
												<option value="no">No</option>
												<option value="unsure">Not Sure</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Do you consider yourself more competitive against others or more of an achiever who likes to compete against themselves?</label>
										<div class="controls">
											<select name="competitive">
												<option value="competitive">Competitive against others</option>
												<option value="achievement">Achieve against myself</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Would you do a bungee jump?</label>
										<div class="controls">
											<select name="bungee">
												<option value="yes">Yes I love adrenaline</option>
												<option value="no">No I rather play it safe</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Do you do strength or cardio training?</label>
										<div class="controls">
											<select name="exerciseType">
												<option value="strength">Strength</option>
												<option value="cardio">Cardio</option>
												<option value="both">Both</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Do you watch traditional team sports on TV (Football, Basketball, Hockey) or (Adventure sports (Skiing, Cycling, Olympics) </label>
										<div class="controls">
											<select name="watchTV">
												<option value="team">Team</option>
												<option value="adventure">Adventure</option>
												<option value="none">I don&apos;t have time for TV</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Are you the type of person to get the latest and greatest technology as soon as it comes out, or do you wait until it is more mainstream to hear other people&apos;s opinion?</label>
										<div class="controls">
											<select name="exerciseType">
												<option value="cutting">I am cutting edge</option>
												<option value="wait">I rather wait and hear what others have to say</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Are you a traveler or a homebody?</label>
										<div class="controls">
											<select name="travelType">
												<option value="travel">Show me the world!</option>
												<option value="stay">I rather stay in my safe neighborhood</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Sports car or Off-road Truck/SUV?</label>
										<div class="controls">
											<select name="carType">
												<option value="sports">I&apos;m fast and flashy</option>
												<option value="suv"> I&apos;m tough and rugged</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Do you like answering all of these questions?</label>
										<div class="controls">
											<select name="answering">
												<option value="yes">Hell yea</option>
												<option value="no">This was a waste</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Have you ever worked with a personal trainer personal coach before?</label>
										<div class="controls">
											<select id='active' name="usedPersonalCoach">
												<option value="no">No</option>
												<option value="yes">Yes</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Do you prefer your coach to be male or female?</label>
										<div class="controls">
											<select id='active' name="genderTrainer">
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Do you respond better to an in our face personality or a laid back pesronality?</label>
										<div class="controls">
											<select id='active' name="personalityType">
												<option value="inFace">In your face</option>
												<option value="laidBack">Laid back</option>
												<option value="unknown">I don&apos;t know</option>
												<option value="depends">It depends</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Do you prefer your schedule to be spontaneous or rigid?</label>
										<div class="controls">
											<select id='active' name="schedule">
												<option value="spontaneous">Spontaneous</option>
												<option value="rigid">Rigid</option>
											</select>
										</div>
					  				</div>

									<div class="control-group">	
										<label class="control-label">Have you ever played on a team sport before?</label>
										<div class="controls">
											<select name="playedTeam">
												<option value="recent">Yes recently</option>
												<option value="past">Yes but a long time ago</option>
												<option value="never">No never</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Do you understand and like to use and receive sarcasm?</label>
										<div class="controls">
											<select name="sarcasm">
												<option value="hate">I get sarcasm but I hate it</option>
												<option value="past">I want a sarcastic trainer</option>
												<option value="never">What&apos;s sarcasm</option>
											</select>
										</div>
					  				</div>
								<button class="btn btn-success btn-mini">Submit</button>
							</div>
							</fieldset>
							<input type="hidden" name="member_id" value="<?=$id ?>">
						</form>
					</section>
				</div>
			<div class="span8 top-right">
				<?php echo fuel_block('profile');?>
			</div>		
		</div>
	</div>
</div>
