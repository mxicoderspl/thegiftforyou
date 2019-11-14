


<?php 
            #!/usr/bin/php

            //Create mysql connect variable

            $conn = mysqli_connect('localhost', 'root', '');


            //kill connection if error occurs

            if(!$conn){

                die('Error: Unable to connect. <br/>' . mysqli_error());

            } 
            //connect to mysql database

            mysqli_select_db($conn,"hrms");

            $current_date = date('Y-m-d');
            $prev_date = date('Y-m-d', strtotime("-1 days"));
            $query="SELECT * FROM `local_attendance_managers` WHERE  hours_worked= ''";
            $attend = mysqli_query($conn,$query);
            if (!empty($attend)) {
                     while($row = mysqli_fetch_array($attend)){
                        $id = $row['id'];
                        $intime = strtotime($row['in_time']);
                        $outtime = '18:30:00';
                        $out_time = strtotime($outtime);
                        
                         $s =$out_time-$intime;
                         $h = ($s/(60*60))%24;
                         $m = ($s/60)%60;
                         $hours_workeds = "$h:$m";
                        $updatetime="UPDATE local_attendance_managers SET out_time='$outtime' ,hours_worked ='$hours_workeds' WHERE id = '$id'";
                        if ($conn->query($updatetime) === TRUE) {
                            echo "Record updated successfully";
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
             
             
                    
                    
                
                        }
        
            }
        

          



        ?>
