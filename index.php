<?php
include 'Connection.php';
$db = new Connection();

if(isset($_POST['filter']))
{
    $emp = $_POST['employee'];
    $event = $_POST['event'];
    $ev_date = $_POST['ev_date'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `events` WHERE (employee_name = '$emp'
    OR event_name ='$event'
    OR event_date ='$ev_date')";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `events`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "test");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Data Show</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="fontawesome-free/css/all.css">
	</head>
	<body class="table-success">
		<h1 class="text-center">Events List</h1>
		<div class="container mt-3">
			
			<div class="d-flex mb-2">
				<form action="index.php" method="post">
					<div class="mb-3">
						<label for="employee">Employee Name:</label>
						<select name="employee" id="employee">
							<option value="">Select</option>
							<?php $employees = $db->getEmployees(); 
								foreach($employees as $emp){
									echo $emp['employee_name'];
							?>
							<option value="<?php echo $emp['employee_name']; ?>"><?php echo $emp['employee_name']; ?></option>
							<?php } ?>
						</select>

						<label for="event">Event Name:</label>
						<select name="event" id="event">
							<option value="">Select</option>
							<?php $events = $db->getEvents(); 
								foreach($events as $ev){
							?>
							<option value="<?php echo $ev['event_name']; ?>"><?php echo $ev['event_name']; ?></option>
							<?php } ?>
						</select>

						<label for="ev_date">Event Date:</label>
						<select name="ev_date" id="ev_date">
							<option value="">Select</option>
							<?php $dates = $db->getEventDates(); 
								foreach($dates as $d){
							?>
							<option value="<?php echo $d['event_date']; ?>"><?php echo $d['event_date']; ?></option>
							<?php } ?>
						</select>

						<input type="submit" name="filter" value="Filter">
					</div>
					
					<div>
						<table  class="container table table-striped">
							<tr>
								<th>Participation Id</th>
								<th>Employee Name</th>
								<th>Employee Mail</th>
								<th>Event Id</th>
								<th>Event Name</th>
								<th>Participation Fee</th>
								<th>Event Date</th>
							</tr>
							<?php
								while($row = mysqli_fetch_array($search_result)):
							?>
								<tr>
									<td><?php echo $row['participation_id'] ?></td>
									<td><?php echo $row['employee_name'] ?></td>
									<td><?php echo $row['employee_mail'] ?></td>
									<td><?php echo $row['event_id'] ?></td>
									<td><?php echo $row['event_name'] ?></td>
									<td><?php echo $row['participation_fee'] ?></td>
									<td><?php echo $row['event_date'] ?></td>
								</tr>
							<?php
								endwhile;
							?>
						</table>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
