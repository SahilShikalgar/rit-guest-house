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

			date_default_timezone_set("Indian/Christmas");

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

				// $pdf->Cell(47.5,7.5,"Name : ",0,0,'L');
				// $pdf->Cell(47.5,7.5,"Host Dept: ",0,1,'L');
				// $pdf->Cell(47.5,7.5,"Sakhrale, Tal - Walwa, Dist - Sangli.",0,0,'L');
				// $pdf->Cell(47.5,7.5,"Guest House",0,1,'L');


				foreach ($rows as $row) {
				
				// 	$pdf->Cell(95,10,"Room Number : ".$row['number'],1,0,'C');
				// 	$pdf->Cell(95,10,"Guest Name : ".$row['guest_name'],1,1,'C');
				// 	$pdf->Cell(95,10,"Guest In-Date : ".$row['intime'],1,0,'C');
				// 	$pdf->Cell(95,10,"Guest Out-Date : ".date('Y-m-d'),1,1,'C');
				// 	$pdf->Cell(95,10,"Room Booked By : ".$row['bookedby'],1,0,'C');
                    

                    
				// 	$datetime1 = new DateTime($row['intime']);

				// 	$datetime2 = new DateTime(date('Y-m-d'));

				// 	$difference = $datetime1->diff($datetime2);

				// 	if($difference->d<=0)
				// 		$pdf->Cell(0,10,"Days Stayed : "."1",1,1,'C');
				// 	else
				// 		$pdf->Cell(0,10,"Days Stayed : ".($difference->d+1),1,1,'C');
						
				
				// if($row['type']=="AC")
				// {
				//     if($difference->d<=0)
				//         $pdf->Cell(0,15,"Bill Amount (in RS) : ". $row['booking_price'],0,1,'C');
				//     else
				//         $pdf->Cell(0,15,"Bill Amount (in RS) : ".($difference->d+1) * $row['booking_price'],0,1,'C');
				// }
				// else
				// {
				//     if($difference->d<=0)
				//         $pdf->Cell(0,15,"Bill Amount (in RS) : ". $row['booking_price'],0,1,'C');
				//     else
				//         $pdf->Cell(0,15,"Bill Amount (in RS) : ".($difference->d+1) * $row['booking_price'],0,1,'C');
				// }


				$pdf->Cell(95,10,"     Name : ".$row['guest_name'],1,0,'L');
				$pdf->Cell(95,10,"     Host Dept : ",1,1,'L');

				$pdf->Cell(95,10,"     Arrival Date : ".$indate,1,0,'L');
				$pdf->Cell(95,10,"     Departure Date : ".$outdate,1,1,'L');

				$pdf->Cell(95,10,"     Type of Room : ".$row['type'],1,0,'L');
				$pdf->Cell(95,10,"     Room No : ".$row['number'],1,1,'L');


				$pdf->Cell(95,10,"",0,1,'L');

				

				$pdf->Cell(95,10,"                                Room Rent : ",0,0,'L');

				$datetime1 = new DateTime($indate);

				$datetime2 = new DateTime($outdate);

				$difference = $datetime1->diff($datetime2);

				$days = -1;

				if($difference->d <= 0)
					$days = 1;
				else
					$days = $difference->d + 1;

				$pdf->Cell(47.5,10,$days * $row['booking_price'],1,1,'C');
                    
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

				

				//$pdf = new FPDF();
				//$pdf->AddPage();
				//$pdf->SetFont("Arial","B",16);
				// font-name , weight(B,I,U) , font-size

// 				$pdf->Cell(0,15,"RIT Guest House Bill",0,1,'C');
// 				//width,height,content,border,newline(1)/-toappend, alignment(center(c) leftright)

// 				$pdf->SetFont("Arial","",12);

// 				$pdf->Cell(0,7.5,"Date : ".date('Y-m-d'),0,1,'R');
// 				$pdf->Cell(0,7.5,"Kasegaon Education Society's ,",0,1,'R');
// 				$pdf->Cell(0,7.5,"Rajarambapu Institute Of
// Technology Rajaramnagar,",0,1,'R');
// 				$pdf->Cell(0,7.5,"Islampur, Dist. Sangli,",0,1,'R');
// 				$pdf->Cell(0,7.5,"Maharashtra, India - 415414.",0,1,'R');
									

// 				$pdf->SetFont("Arial","",12);
// 				$pdf->Cell(0,15,"",0,1,'C');
			
                
				// $pdf->Cell(0,15,"",0,1,'C');

				// $pdf->Cell(0,15,"Terms and Conditions : ",0,1,'C');

				// $pdf->Cell(0,15,"1) A new college guest house has been commissioned for the visiting guest and for the parents. ",0,1,'C');
				// $pdf->Cell(0,15,"2) Parents can stay in a guest house for maximum 3 days only They are welcome to stay beyond",0,1,'C');
				// $pdf->Cell(0,15,"3 days provided if they pay the double amount.",0,1,'C');
			  
					
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