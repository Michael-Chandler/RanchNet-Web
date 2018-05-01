<div class="modal fade" id="cattleModal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $cattleTag; ?> Full Details</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button> 
			</div>
			<div class="modal-body">
				<!-- Name, Sex, Animal Type details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Name: </strong></label>
							<label class="form-control-label"><?php echo $mcattleName; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Sex: </strong></label>
							<label class="form-control-label"><?php echo $mcattleSex; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Animal Type: </strong></label>
							<label class="form-control-label"><?php echo $mcattleAnimalType; ?></label>
						</div>
					</div>
				</div>
				<!-- Tag, Reg Num, Elec ID details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Tag: </strong></label>
							<label class="form-control-label"><?php echo $mcattleTag; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Registered Number: </strong></label>
							<label class="form-control-label"><?php echo $mcattleRegisteredNumber; ?></label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Electronic ID: </strong></label>
							<label class="form-control-label"><?php echo $mcattleElectronicId; ?></label>
						</div>
					</div>
				</div>
				<!-- Sire details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Sire Name: </strong></label>
							<label class="form-control-label"><?php echo $mcattleSireName; ?></label>
						</div>
						<div class="col-md-8">
							<label class="form-control-label"><strong>Sire Registered Number: </strong></label>
							<label class="form-control-label"><?php echo $mcattleSireRegisteredNumber; ?></label>
						</div>
					</div>
				</div>
				<!-- Dam details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Dam Name: </strong></label>
							<label class="form-control-label"><?php echo $mcattleDamName; ?></label>
						</div>
						<div class="col-md-8">
							<label class="form-control-label"><strong>Dam Registered Number: </strong></label>
							<label class="form-control-label"><?php echo $mcattleDamRegisteredNumber; ?></label>
						</div>
					</div>
				</div>
				<!-- DOB, Contraception, Breeder, Pregnant details -->
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-3">
							<label class="form-control-label"><strong>Date of Birth: </strong></label>
							<label class="form-control-label"><?php echo date("Y-m-d", strtotime($mcattleDateOfBirth)); ?></label>
						</div>
						<div class="col-md-3">
							<label class="form-control-label"><strong>Contraception: </strong></label>
							<label class="form-control-label"><?php echo $mcattleContraception; ?></label>
						</div>
						<div class="col-md-3">
							<label class="form-control-label"><strong>Breeder: </strong></label>
							<label class="form-control-label"><?php echo $mcattleBreeder; ?></label>
						</div>
						<div class="col-md-3">
							<label class="form-control-label"><strong>Pregnant: </strong></label>
							<label class="form-control-label">
							<?php 
							if($mcattlePregnant == 0) {
								echo "No";
							} else {
								echo "Yes";
							}
							?>
							</label>
						</div>
					</div>
				</div>
				<!-- Height, Weight, Pasture details -->
                <div class="form-group">
					<div class="form-row">
						<div class="col-md-4">
							<label class="form-control-label"><strong>Height: </strong></label>
							<label class="form-control-label">
							<?php 
							if(isset($_SESSION["measure"]) && $_SESSION["measure"] == "Metric") {
								echo $mcattleHeight * 2.54;
							} else {
								echo $mcattleHeight;
							}
							?>
							</label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Weight: </strong></label>
							<label class="form-control-label">
							<?php 
							if(isset($_SESSION["measure"]) && $_SESSION["measure"] == "Metric") {
								echo $mcattleWeight * 0.453592;
							} else {
								echo $mcattleWeight;
							}
							?>
							</label>
						</div>
						<div class="col-md-4">
							<label class="form-control-label"><strong>Pasture: </strong></label>
							<label class="form-control-label"><?php echo $mpastureName; ?></label>
						</div>
					</div>
				</div>               
			</div>
			<div class="modal-footer">
				<a class="btn btn-secondary" href="index.php?edit=<?php echo $mcattleId; ?>">Edit</a>
				<a class="btn btn-primary" href="process.php?del=<?php echo $mcattleId; ?>">Delete</a>
			</div>
		</div>
	</div>
</div>
