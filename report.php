<?php  
	session_start();
	$id = $_GET['id'];
	$indate = $_GET['indate'];
	$outdate = $_GET['outdate'];
	
	if(isset($_SESSION['admin']))
	{
			ob_start();
			///storage/ssd4/360/8172360/public_html/fpdf/fpdf.php
			require('fpdf/fpdf.php');
			require_once('connection.php');
            $con = mysqli_connect($host,$name,$pass,$db);

			date_default_timezone_set("Asia/Calcutta");

			if($con)
			{

				//$pdf->Cell(0,7.5,"Date : ".date('Y-m-d'),0,1,'R');
				//width,height,content,border,newline(1)/-toappend, alignment(center(c) leftright)

				$sql = "select * from rooms where id='$id'";
      			$rows = mysqli_query($con,$sql);

				$pdf = new FPDF();
				$pdf->AddPage();
				
				$pdf->SetFont("Arial","",9);
				$pdf->Cell(47.5,6,"",0,0,'L');
				$pdf->Cell(47.5,6,"",0,0,'L');

				$pdf->Cell(47.5,6,"Cr No : ",1,0,'L');
				$pdf->Cell(47.5,6,"Dated : ".date('d-m-Y'),1,1,'L');

				$pdf->Cell(0,7.5,"",0,1,'C');

				$pdf->SetFont("Arial","B",12);

				$pdf->Cell(0,7.5,"K. E. Society's",0,1,'C');
				$pdf->Cell(0,7.5,"Student Hostel R.I.T Rajaramnagar",0,1,'C');
				$pdf->Cell(0,7.5,"Sakhrale, Tal - Walwa, Dist - Sangli.",0,1,'C');
				$pdf->Cell(0,7.5,"Guest House",0,1,'C');


				$pdf->SetFont("Arial","",10);
				$pdf->Cell(47.5,6,"",0,0,'L');
				$pdf->Cell(47.5,6,"",0,0,'L');
				$pdf->Cell(47.5,6,"",0,0,'L');
				$pdf->Cell(47.5,6,"No : ",0,1,'L');

				$pdf->SetFont("Arial","",10);

				foreach ($rows as $row) {
				
					$pdf->Cell(95,10,"     Name : ".$row['guest_name'],1,0,'L');
					$pdf->Cell(95,10,"     Host Dept : ",1,1,'L');

					$pdf->Cell(95,10,"     Arrival Date : ".$indate,1,0,'L');
					$pdf->Cell(95,10,"     Departure Date : ".$outdate,1,1,'L');

					$pdf->Cell(95,10,"     Type of Room : ".$row['type'],1,0,'L');
					$pdf->Cell(95,10,"     Room No : ".$row['number'],1,1,'L');


					$pdf->Cell(95,10,"",0,1,'L');

					

					$pdf->Cell(95,10,"                                Room Rent : ",0,0,'L');

					$datetime1 = new DateTime($indate);
					$datetime1->setTime(10, 0, 0);

					$datetime2 = new DateTime($outdate);
					$date = date('Y-m-d H:i:s');
					$datetime2 = new DateTime($date);

					$difference = $datetime1->diff($datetime2);

					$days = $difference->d;
					$hours = $difference->h;

					if ($days == 1 && $hours <= 2) {
						$hours = 0;
					}
					else if ($hours > 0) {
						$days += 1;
						$hours = 0;
					}

					if ($days == 1) {
						$pdf->Cell(47.5,10,($days * $row['booking_price']) . '  (' . $days . ' day)',1,1,'C');
					} else {
						$pdf->Cell(47.5,10,($days * $row['booking_price']) . '  (' . $days . ' days)',1,1,'C');
					}
					
						
					$pdf->Cell(95,10,"                                Food Charges : ",0,0,'L');
					$pdf->Cell(47.5,10,"",1,1,'L');

					$pdf->Cell(95,10,"                                Miscellaneous Charges : ",0,0,'L');
					$pdf->Cell(47.5,10,"",1,1,'L');


					$pdf->SetFont("Arial","B",10);
					$pdf->Cell(95,10,"                                Total : ",0,0,'L');
					$pdf->Cell(47.5,10,"",1,1,'L');

					$pdf->Cell(95,10,"",0,1,'L');
					$pdf->Cell(95,10,"",0,1,'L');
					$pdf->Cell(95,10,"",0,1,'L');
					
					$pdf->Cell(95,10,"               Manager Guest House",0,0,'L');
					$pdf->Cell(95,10,"                                                       Rector",0,1,'L');
					$pdf->Cell(95,10,"                   Date : ".date('d-m-Y'),0,0,'L');
					$pdf->Cell(95,10,"                                   Student Hostel Rajaramnagar",0,1,'L');
					$pdf->Output();	
				}			
				$pdf->Output();
				ob_end_flush(); 
			}
	}
	else
	{
		echo "<script>window.close()</script>";
	}
?>