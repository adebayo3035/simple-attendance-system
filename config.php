<?php	
$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "plusone_attendance";

								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
                                }
                                else{
                                    // echo "<script>alert('Database Connection was successful');</script>";
                                }
						?>	