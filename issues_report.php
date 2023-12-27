


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="issues_report.css" />
		
		<title>Issue Reporting</title>
		<script src = "issues_report.js"></script>
		
	</head>
	<body>
		<div class="container">
			<h2>Report an Issue</h2>
			<p>Welcome to our dynamic IT issue reporting system</p>
			<form action="issues_report.php" method="post">
				<label for="name">Name:</label>
				<input type="text" name="name" id="name" required><br>
				
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" required><br>
				
				<label for="issueType">Issue Type:</label>
				<input type="text" name="issueType" id="issueType" required>
				
				<p> Suggestions: <span id="txtHint"></span></p>
				
				<div id="possibleTypes"></div><br>
				
				<label for="description">Issue Description:</label>
				<textarea name="description" id="description" required></textarea><br>
				
				<div class="button">
					<input type="submit" value="Submit">
					<input type="reset" value="Reset">
					<a href="issues_view.php">View Issue Submissions</a>
				</div>
			</form>
		</div>
		
		<!--<div id="txtHint"></div> -->
		<?php
			//php for issue reporting (saving issues to the database)
			
			//open database connection
			$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "kiduss1", "kiduss1", "kiduss1");
			//verify database connection 
			if($db -> connect_error){
				die("Connection failed: " . $db ->connect_error);
			}
			
			//retrieve values from the form
			
			$name = mysqli_real_escape_string($db, $_POST['name']); // add security against sql injections
			$email = mysqli_real_escape_string($db, $_POST['email']);
			$issueType = mysqli_real_escape_string($db, $_POST['issueType']);
			$description = mysqli_real_escape_string($db, $_POST['description']);
			
			
			// Check for empty values
			if (empty($name) || empty($email) || empty($issueType) || empty($description)) {
				echo "All fields are required";
			} else {
				// Use parameterized query to insert data into the database
				$sql = "INSERT INTO Issues_Report (Name, Email, Issue_type, Issue_description) VALUES (?, ?, ?, ?)";
				$stmt = $db->prepare($sql);
				
				// Bind parameters
				$stmt->bind_param("ssss", $name, $email, $issueType, $description);
				
				// Execute the statement
				if ($stmt->execute()) {
					echo "Issue submitted successfully";
				} else {
					echo "Error: " . $stmt->error;
				}
				
				// Close the statement
				$stmt->close();
			}            
			// Close the database connection
			$db->close();
		?>
	</body>
</html>