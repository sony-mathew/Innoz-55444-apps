<?php
			   

	if ( isset( $_GET[ 'mobile' ] ) && isset( $_GET[ 'message' ] ) )
		{	
			   // result page url
			   $url = "http://210.212.24.27/mgcbcss/result.php" ;
			   
 				
 				//setting curl parameters
 			
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Accepts all CAs 
                curl_setopt($ch, CURLOPT_URL, $url); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Tells cURL to follow redirects 
                curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0");
#to filter data from html file recieved
               	$arr_remove = array("\r", "\n", "\t", "\s");
               	$match = array();

#Executing Curl to get the result page
                $output1 = curl_exec($ch); 

//                echo $output1;
                $result = '';


      if( strlen($output1) > 2000 )
            {          
        			  $output1 = str_replace($arr_remove, '', $output1);
                preg_match_all('/<br>(.*?)<\\/a>/i', $output1 , $match) ;
            
                for( $i = 1 ; $i < 6 ; ++$i )
                  {     $result = $result.'
'.$i.'.'.strip_tags( $match[1][$i] ) ;
                }

                $result = str_replace('Semester', 'Sem', str_replace('EXAMINATION RESULT', 'exam Rslt', $result));

                $numbers = array('First' , 'Second', 'Third' , 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eight', 'Semester' , 'EXAMINATION RESULT', 
                                  'January', 'February', 'March', 'April', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
                                  'Regular', 'Supplementary', 'Admissions','Examination','College','semesters','Exam') ;
                $corresp = array( '1st', '2nd' , '3rd', '4th', '5th', '6th', '7th', '8th', 'Sem' , 'Xam Rslt',
                                  'Jan', 'Feb', 'Mar', 'Apr', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec',
                                  'Reg', 'Suppli', 'Admsns','Xam','Colg','sem','xam') ;


                for ($i=0; $i < 28; $i++) 
                  { $result = str_replace($numbers[$i], $corresp[$i], $result); }    
            }    
    echo '
          <response>
                <content> '.$result.'(ynos)
                </content>
          </response> ';
        }
        
    else
    	{
    		echo 'Sorry this request is not intended to process(error #45 : no parameters).(ynos)';
    	}           			
?> 

