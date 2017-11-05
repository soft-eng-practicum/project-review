<div class="row">
	<div class="col-sm-2">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							Filter by Department:
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">
						<div class="form-group">
							<label class="control-label" for="username">Department#:</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Department#">	
						</div>
						<div class="form-group">
							<label class="control-label" for="password">Narrow by Course:</label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Course#">
						</div>
						<button type="button" class="btn btn-info pull-right" onClick="change('department')">Submit</button>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							Filter By Course:
						</a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					<div class="panel-body">
						<div class="form-group">
							<label class="control-label" for="username">Course#:</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Course#">	
						</div>
						<div class="form-group">
							<label class="control-label" for="password">Taught in last year?:</label>
							<input type="checkbox"> YES
						</div>
						<button type="button" class="btn btn-info pull-right" onClick="change('course')">Submit</button>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingThree">
					<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							Find Expired Instructors:
						</a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
					<div class="panel-body">
						<button type="button" class="btn btn-primary" onClick="change('expired')">Show Me the Slackers</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-10">
		<div class="row" id="department" hidden="true">
			<h3>BY DEPARTMENT</h3>
			<table class="table">
				<tr class="active"><td>test</td></tr>
				<tr class="success"><td>test</td></tr>
				<tr class="warning"><td>test</td></tr>
				<tr class="danger"><td>test</td></tr>
				<tr class="info"><td>test</td></tr>
			</table>
		</div>
		<div class="row" id="course" hidden="true">
			<h3>BY COURSE</h3>
			<table class="table">
				<tr class="active"><td>test</td></tr>
				<tr class="success"><td>test</td></tr>
				<tr class="warning"><td>test</td></tr>
				<tr class="danger"><td>test</td></tr>
				<tr class="info"><td>test</td></tr>
			</table>
		</div>
		<div class="row" id="expired" hidden="true">
			<h3>EXPIRED</h3>
			<table class="table">
				<tr class="active"><td>test</td></tr>
				<tr class="success"><td>test</td></tr>
				<tr class="warning"><td>test</td></tr>
				<tr class="danger"><td>test</td></tr>
				<tr class="info"><td>test</td></tr>
			</table>
		</div>
	</div>
</div>

