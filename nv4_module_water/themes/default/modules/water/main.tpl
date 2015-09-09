<!-- BEGIN: main -->
    	<form name="f1" class="form-wrapper w1" action="{ACTION_FILE}" method="post">
    	   <input id="search" name="maso" type="text"/>
    	   <input id="submit" type="submit" name="confirm" value="{LANG.search}" />
    	</form>
    
    <h2>{NOTICE}</h2>
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<colgroup>
				<col style="width:30%">
				<col style="width:30%">
			</colgroup>

			<!-- BEGIN: loop -->
			<tbody>
				<tr>
					<td>{LANG.mkh}</td>
					<td>{TABLE.mkh}</td>
				</tr>
				<tr>
					<td>{LANG.hoten}</td>
					<td>{TABLE.hoten}</td>
				</tr>
				<tr>	
					<td>{LANG.addold}</td>
					<td>{TABLE.addold}</td>
				</tr>
				<tr>	
					<td>{LANG.addnew}</td>
					<td>{TABLE.addnew}</td>
				</tr>
				<tr>	
					<td>{LANG.mobile}</td>
					<td>{TABLE.mobile}</td>
				</tr>
				<tr>	
					<td>{LANG.numlast}</td>
					<td>{TABLE.numlast}</td>
				</tr>
				<tr>	
					<td>{LANG.timelast}</td>
					<td>{TABLE.timelast}</td>
				</tr>
				<tr>	
					<td>{LANG.status}</td>
					<td>{TABLE.status}</td>
				</tr>
				<tr>	
					<td>{LANG.nummont} {LANG.mont} {TABLE.mont}</td>
					<td>{TABLE.nummont}</td>
				</tr>
				<tr>	
					<td>{LANG.flow} {LANG.mont} {TABLE.mont} </td>
					<td>{TABLE.flow}</td>
				</tr>
				<tr>	
					<td>{LANG.price}</td>
					<td>{TABLE.price}</td>
				</tr>
				<tr>	
					<td>{LANG.totalmont} {LANG.mont} {TABLE.mont}</td>
					<td>{TABLE.totalmont} </td>
				</tr>
				<tr>	
					<td>{LANG.debt}</td>
					<td>{TABLE.debt}</td>
				</tr>
				<tr>	
					<td>{LANG.total}</td>
					<td>{TABLE.total}</td>        
				</tr>
			</tbody>
			<!-- END: loop -->
			<!-- BEGIN: icon -->
					<span class="print_icon"><a href="{PRINT}" target="_blank">{LANG.print}</a></span><br />
			<!-- END: icon -->
		</table>
	</div>

<!-- END: main -->