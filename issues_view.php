<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Issue View</title>
		<link rel="stylesheet" type="text/css" href="issues_report.css" />
	</head>
	
	<body>
		<style>
			/* Embedded CSS to style the link */
			a {
				color: purple; /* Set the link text color to purple */
				text-decoration: none; /* Remove the underline style */
			}
			
			/* Embedded CSS to style the button */
			input[type="button"] {
				background: linear-gradient(to bottom, #ccc, #666); /* Gradient grey background */
				color: white; /* Set text color to white */
				border: none; /* Remove the default button border */
				padding: 10px 20px; /* Add padding for a better visual appearance */
				border-radius: 10px; /* Rounded corners */
				cursor: pointer; /* Add a pointer cursor on hover */
				display: block; /* Make it a block element to center it */
				margin: 0 auto; /* Center the button horizontally */
				
				table {
					width: 100%;
					border-collapse: collapse;
					margin-top: 20px; /* Add spacing between the button and the table */
				}
				
				th, td {
					padding: 12px;
					border: 1px solid #ddd; /* Light gray border */
					text-align: left;
				}
				
				th {
					background-color: #f2f2f2; /* Light gray background for header */
				}
			}
		</style>
		
		<div class="container">
			<h2>View Submitted Issues</h2>
			<p>Below are the issues you have reported:</p>
			
			<form action="issue_view.php" method="post">
				<a href="issues_report.html"><input type="button" value="Report Another Issue"></a>
			</form>
			
			<?php
				// Open database connection
				$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "kiduss1", "kiduss1", "kiduss1");
				
				// Verify database connection 
				if ($db->connect_error) {
					die("Connection failed: " . $db->connect_error);
				}
				
				// Retrieve data from the database to display on issues_view.html
				$result = $db->query("SELECT * FROM Issues_Report");
				
				// Display the retrieved issues
				if ($result->num_rows > 0) {
					while ($row_array = mysqli_fetch_assoc($result)) {
						echo '<div class="issue">';
						echo 'Name: ' . $row_array['Name'] . '<br>';
						echo 'Email: ' . $row_array['Email'] . '<br>';
						echo 'Issue: ' . $row_array['Issue_type'] . '<br>';
						echo 'Description: ' . $row_array['Issue_description'] . '<br>';
						echo '----------------------';
						echo '</div>';
					}
				} else {
					echo "No issues have been reported.";
				}
				
				// Close the database connection
				$db->close();
			?>
			
		</div>
	</body>
	
</html>

