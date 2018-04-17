<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="margin-bottom: 20px;margin-left: 20px;">Add Cattle</button>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="width:150%;">
			
			<?php if($edit_state): ?>
				<h2 style="
				    padding-left: 20px;
				    padding-top: 20px;
				    margin-bottom: 0px;
					">Edit Cattle</h2>
			<?php else: ?>
				<h2 style="
				    padding-left: 20px;
				    padding-top: 20px;
				    margin-bottom: 20px;
					">Add Cattle</h2>
			<?php endif ?>
			
			<!-- Cattle Input Form -->
			<form method="POST" action="process.php" style="
			    margin-bottom: 0px;
			    margin-top: 0px;
			">
				<input type ="hidden" name="cattleId" value="<?php echo $cattleId; ?>">
				<label type="text" class="form-control-label"><strong>Measurement System: 
				<?php 
				if(isset($_SESSION["measure"])) {
					echo $_SESSION["measure"];
				} else {
					echo "English (default)";
				}
				?>
				</strong></label>
				<br>
				<!-- Name, Sex, Animal Type input -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label for="cattleName" class="form-control-label"><strong>Name: </strong></label>
							<input type="text" class="form-control" id="cattleName" name="cattleName" maxlength="64" value="<?php echo $cattleName; ?>" placeholder="Enter Cattle Name here" required>
						</div>
						<div class="col-md-4">
							<label for="cattleSex" class="form-control-label"><strong>Sex: </strong></label>
							<select class="form-control" id="cattleSex" name="cattleSex">
							<?php if($cattleSex == "M"): ?>
								<option value="M" selected>M</option>
								<option value="F">F</option>
							<?php else: ?>
								<option value="M">M</option>
								<option value="F" selected>F</option>
							<?php endif ?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="cattleAnimalType" class="form-control-label"><strong>Animal Type: </strong></label>
							<input type="text" class="form-control" id="cattleAnimalType" name="cattleAnimalType" maxlength="128" value="<?php echo $cattleAnimalType; ?>" placeholder="Enter Animal Type here">
						</div>
					</div>
				</div>
				<!-- Tag, Reg Num, Elec ID input -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label for="cattleTag" class="form-control-label"><strong>Tag: </strong></label>
							<input type="text" class="form-control" id="cattleTag" name="cattleTag" maxlength="128" value="<?php echo $cattleTag; ?>" placeholder="Enter Cattle Tag here"> 
						</div>
						<div class="col-md-4">
							<label for="cattleRegisteredNumber" class="form-control-label"><strong>Registered Number: </strong></label>
							<input type="text" class="form-control" id="cattleRegisteredNumber" name="cattleRegisteredNumber" maxlength="128" value="<?php echo $cattleRegisteredNumber; ?>" placeholder="Enter Cattle Registered Number here">
						</div>
						<div class="col-md-4">
							<label for="cattleElectronicId" class="form-control-label"><strong>Electronic ID: </strong></label>
							<input type="text" class="form-control" id="cattleElectronicId" name="cattleElectronicId" maxlength="128" value="<?php echo $cattleElectronicId; ?>" placeholder="Enter Cattle Electronic ID here">
						</div>
					</div>
				</div>
				<!-- Sire input -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label for="cattleSireName" class="form-control-label"><strong>Sire Name: </strong></label>
							<input type="text" class="form-control" id="cattleSireName" name="cattleSireName" maxlength="64" value="<?php echo $cattleSireName; ?>" placeholder="Enter Sire Name here">
						</div>
						<div class="col-md-8">
							<label for="cattleSireRegisteredNumber" class="form-control-label"><strong>Sire Registered Number: </strong></label>
							<input type="text" class="form-control" id="cattleSireRegisteredNumber" name="cattleSireRegisteredNumber" maxlength="128" value="<?php echo $cattleSireRegisteredNumber; ?>" placeholder="Enter Sire Registered Number here">
						</div>
					</div>
				</div>
				<!-- Dam input -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label for="cattleDamName" class="form-control-label"><strong>Dam Name: </strong></label>
							<input type="text" class="form-control" id="cattleDamName" name="cattleDamName" maxlength="64" value="<?php echo $cattleDamName; ?>" placeholder="Enter Dam Name here">
						</div>
						<div class="col-md-8">
							<label for="cattleDamRegisteredNumber" class="form-control-label"><strong>Dam Registered Number: </strong></label>
							<input type="text" class="form-control" id="cattleDamRegisteredNumber" name="cattleDamRegisteredNumber" maxlength="128" value="<?php echo $cattleDamRegisteredNumber; ?>" placeholder="Enter Dam Registered Number here">
						</div>
					</div>
				</div>
				<!-- DOB, Contraception, Breeder, Pregnant input -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-3">
							<label for="cattleDateOfBirth" class="form-control-label"><strong>Date of Birth: </strong></label>
							<input type="date" class="form-control" id="cattleDateOfBirth" name="cattleDateOfBirth" value="<?php echo date($cattleDateOfBirth); ?>">
						</div>
						<div class="col-md-3">
							<label for="cattleContraception" class="form-control-label"><strong>Contraception: </strong></label>
							<input type="text" class="form-control" id="cattleContraception" name="cattleContraception" maxlength="64" value="<?php echo $cattleContraception; ?>" placeholder="Enter Cattle Contraception here">
						</div>
						<div class="col-md-3">
							<label for="cattleBreeder" class="form-control-label"><strong>Breeder: </strong></label>
							<input type="text" class="form-control" id="cattleBreeder" name="cattleBreeder" maxlength="64" value="<?php echo $cattleBreeder; ?>" placeholder="Enter Cattle Breeder here">
						</div>
						<div class="col-md-3">
							<label for="cattlePregnant" class="form-control-label"><strong>Pregnant: </strong></label>
							<select class="form-control" id="cattlePregnant" name="cattlePregnant">
							<?php if($cattlePregnant == 0): ?>
								<option value="0" selected>No</option>
								<option value="1">Yes</option>
							<?php else: ?>
								<option value="0">No</option>
								<option value="1" selected>Yes</option>
							<?php endif ?>
							</select>
						</div>
					</div>
				</div>
				<!-- Height, Weight, Pasture input -->
                <div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label for="cattleHeight" class="form-control-label"><strong>Height: </strong></label>
							<input type="text" class="form-control" id="cattleHeight" name="cattleHeight" maxlength="64" value="<?php echo $cattleHeight; ?>" placeholder="Enter Cattle Height here">
						</div>
						<div class="col-md-4">
							<label for="cattleWeight" class="form-control-label"><strong>Weight: </strong></label>
							<input type="text" class="form-control" id="cattleWeight" name="cattleWeight" maxlength="64" value="<?php echo $cattleWeight; ?>" placeholder="Enter Cattle Weight here">
						</div>
						<div class="col-md-4">
							<label for="pastureId" class="form-control-label"><strong>Pasture ID: </strong></label>
							<select class="form-control" id="pastureId" name="pastureId">
								<?php foreach ($pastures as $pastureObj) { ?>
									<option value = <?php 
										echo $pastureObj->pastureId;
										echo '>';
										echo $pastureObj->pastureName;
										?></option>
								<?php } ?>
							    
							  </select>
						</div>
					</div>
				</div>
                <!-- From buttons -->
				<?php if($edit_state): ?>
					<button type="submit" class="form-control" id="update" name="update" class="btn">Update Cattle</button>
				<?php else: ?>
					<button type="submit" class="form-control" id="add" name="add" class="btn">Add Cattle</button>
				<?php endif ?>
                <a href="/cattlemanager" id="cancel" name="cancel" class="form-control btn">Cancel</a>
            </form>
        </div>
    </div>
</div>