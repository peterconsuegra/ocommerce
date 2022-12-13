<html>

	<head>
		
		<!-- CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

		<!-- jQuery and JS bundle w/ Popper.js -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		
	</head>

    <body>

		<div class="container">
			
			<br />		
			 <h3>All completed orders</h3>  
			 
			 
			
				
	  		  <table class="table table-hover">
				  
	  		    <thead>
	  		      <tr>
					<th>order_id</th>
	  		        <th>billing_first_name</th>
	  		        <th>billing_email</th>
	  		        <th>order_total</th>
	  		      </tr>
	  		    </thead>
	  		    
				<tbody>
					
					@while($row = $result->fetch_assoc()) 
					
  	  		      <tr>
  	  		        <td>{{$row["order_id"]}}</td>
					<td>{{$row["_billing_first_name"]}}</td>
  	  		        <td>{{$row["billing_email"]}}</td>
  	  		        <td>{{$row["order_total"]}}</td>
  	  		      </tr>
				  
				  	@endwhile
				
				 </tbody> 
  	
			</table>
			
		
			
			
		
		</div>
		
    </body>
</html>