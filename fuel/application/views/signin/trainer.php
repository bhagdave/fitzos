<div class="row">
	<div class="span12">
		<div class="row">
			<div class="col-md-4 signin">
				<?php $this->load->view('_blocks/all-members');?>
			  						<div class="control-group">
										<label class="control-label">Which major certifying agency(ies) are you certified through?</label>
										<div class="controls">	
				  							<select name="agencies" multiple="multiples">
												<option value="NCSA">NCSA</option>
												<option value="ASCM">ASCM</option>
												<option value="NASM">NASM</option>
												<option value="ISSA">ISSA</option>
												<option value="RRCA">RRCA</option>
												<option value="USATF">USATF</option>
				  							</select>
				  						</div>	
			  						</div>
			  						<div class="control-group">
										<label class="control-label">What are your speciality certfications in?</label>
										<div class="controls">	
				  							<select name="specialism" multiple="multiples">
												<option value="strength">Strength and conditioning</option>
												<option value="endurance">Endurance enhancement</option>
												<option value="injPrevention">Injury Prevention</option>
												<option value="injRehab">Injury post-rehab</option>
												<option value="health">Health & wellness</option>
												<option value="senior">Senior training</option>
												<option value="senior">Post/pre pardum</option>
											</select>
				  						</div>	
			  						</div>
									<div class="control-group">	
										<label class="control-label">Are you a one-on-one or a group trainer, or both?</label>
										<div class="controls">
											<select name="group">
												<option value="one">One on one</option>
												<option value="group">Group</option>
												<option value="both">Both</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">How many paid sessions have you done in the last month?</label>
										<div class="controls">
											<select name="paidSessions">
												<option value="20">Less than 20</option>
												<option value="50">20-50</option>
												<option value="80">50-80</option>
												<option value="100">80-100</option>
												<option value="120">100-120</option>
												<option value="121">121+</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Are you more comfortable/familiar training athletes of social sports (football, baseball, basketball) or endurance sports (running, swimming, cycling, cliff diving)?</label>
										<div class="controls">
											<select name="trainingType">
												<option value="team">Team</option>
												<option value="endurance">Endurance</option>
												<option value="both">Both</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Are you more of a drill sergeant or teddy bear?</label>
										<div class="controls">
											<select name="characterType">
												<option value="team">Sergeant</option>
												<option value="teddy">Teddy Bear</option>
											</select>
										</div>
					  				</div>
									<div class="control-group">	
										<label class="control-label">Are you more artistic/creative or logic/research minded?</label>
										<div class="controls">
											<select name="mindType">
												<option value="creative">Artistic/Creative</option>
												<option value="logic">Logi/Research </option>
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
								<button class="btn btn-success btn-mini">Submit</button>
							</div>
							</fieldset>
						</form>
					</section>
				</div>
			<div class="span8 top-right">
				<?php echo fuel_block('profile');?>
			</div>		
		</div>
	</div>
</div>
