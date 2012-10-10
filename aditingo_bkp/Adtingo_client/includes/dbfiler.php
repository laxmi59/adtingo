<?php
/*=========================================================================================
//=========================================================================================
	@AUTHOR 	-	Sandeep Kumar (san4u49@gmail.com) (0091-09461392706)
	Date     	-	1-June-2009
	File des.	-	=======================================================================
					This file is used to handle all insertation, delete and select records.
//========================================================================================*/
//=========================================================================================
include_once("dbclass.php");

class DBFilter extends DBConnect
{
	
	/* This is a constructor which can be used to initialize variables.*/
	function DBFilter()
	{

	}


	/* This is a function to start the transaction */
	function TransBegin()
	{
		$this->StartTransaction();
	}
	
	/* This is a function to End the transaction */
	function TransEnd()
	{
		$this->EndTransaction();
	}
	/***************************************************************************************************
		@para
		@$table : String( Name of table)
		@$data  : Array of data that needed tobe enter in database
		@Description : this function is used to take data as formof array and gerates a insert query.
	***************************************************************************************************/
	function InsertRecord($table,$data)
	{
	
		if($table=='contacts')
		{
			if($data && is_array($data))
				$data['insdate']=date('Y-m-d');
		}	
			
		if($table=='')
		{
			return false;
		}	
		else
		{
			if($data=='')
			{
				return false;
			}
			else
			{
				
				$resource=$this->ExecuteQuery("SHOW COLUMNS FROM ".PREFIX.$table);
			
				if($resource)
				{
					$fields="";
					$values="";
					
					while($row = $this->FetchArray($resource))
					{
					
						if(array_key_exists($row['Field'],$data))
						{
						 	 $fields.=$row['Field'].",";
							
							if(is_array($data[$row['Field']]))
							{
							   // $data[$row['Field']]=array_values(array_filter($data[$row['Field']]));
								//print_r($data[$row['Field']]);
								$data[$row['Field']]=implode(",",$data[$row['Field']]);
							}
							
							$values.="'".addslashes($data[$row['Field']])."',";
						}
					}
					
					if($fields)
					{
						$fields=substr($fields,0,strlen($fields)-1);
						$values=substr($values,0,strlen($values)-1);					
					  	$query="Insert into ".PREFIX.$table."(".$fields.") values(".$values.")";
						$id=$this->ExecuteQuery($query);
						return $id;
/*						if($DB->ExecuteQuery($query))
						{
							return $DB->InsertId();
						}
						return false;
*/
					}
					
				}
				
			}
		}
		return false;			
	}

	/*
		@para
		@$table : String( Name of table)
		@$data  : Array of data that needed tobe enter in database
		@$cond  : it will be an array. 'or' or 'and' will also be part of array as
			  element like array{ 'name'=> Sandeep, 'or' => 'or', 'country' => 'India'  }
		@Description : this function is used to take data as formof array and gerates a update query.

	*/




	function UpdateRecord($table,$data,$cond='')
	{

		
		if($table=='')
		{  
			return false;
		}	
		else
		{
			if($data=='')
			{  
				return false;
			}
			else	
			{
				$resource= $this->ExecuteQuery("SHOW COLUMNS FROM ".PREFIX.$table);
				if($resource)
				{
					$sql="";
							
					while($row = $this->FetchArray($resource))
					{
						if(array_key_exists($row['Field'],$data))
						{
						     if(is_array($data[$row['Field']]))
							 {
							     $data[$row['Field']]=array_values(array_filter($data[$row['Field']]));
								 $data[$row['Field']]=implode(",",$data[$row['Field']]);
							  } 	
						 $sql.=$row['Field']."='".addslashes($data[$row['Field']])."',";
						}
					}
					//echo $sql; 
					if($sql)
					{
						$sql=substr($sql,0,strlen($sql)-1);
											
						$query="update ".PREFIX.$table." set ".$sql;
						if($cond)
						{
							if(!is_array($cond))
							{
								$query.=" where ".$cond;
							}
							else
							{
									$count=count($cond);
									if($count)
									{
										$fields=@array_keys($cond);
										$query.=" where ";
										for($counter=0;$counter<$count;$counter++)
										{
											
											if($fields[$counter]=='or' || $fields[$counter]=='and')
											{
													 $query.=" ".$fields[$counter]." "; exit;
											}
											else
											{
												
													 $query.=" ".$fields[$counter]."='".$cond[$fields[$counter]]."'"; exit;
											}		
										}
									}
								}		
						}
						
						if($this->ExecuteQuery($query))
						{
							return true;
						}
						return false;
					}
					
				}
				
			}
		}
		return false;			
	}	


	/*
		@para
		@$table : String( Name of table)
		
		@$cond  : condtion to delte reocrd
		@Description : this function is used to delte record
	
	*/
	function DeleteRecord($table,$cond='')
	{
 
	  //echo $table;


	
		if($table)
		{
			$query="delete from ".PREFIX.$table;
			if($cond)
			{
				 $query.=" where ".$cond;
			}
			if($this->ExecuteQuery($query))
			{
				return true;
			}
		}
		return false;
	}


	/*
		@para
		@$table : String( Name of table)
		@$cond  : condtion to select recorde reocrd
		@$fields : name of fields data are needed from query
		@backqury : It wil be include in end of query like order by statement
	
		@Description : this function is used to select multiple records
	
	*/
	function SelectRecords($table,$cond='',$fields='*',$backquery='')
	{
		global $frmdata;	
		if($table)
		{
			if($fields)
			{		
				if(is_array($fields))
				{
					$fields=implode(",",$fields);
				}
				
				$query="select ".$fields." from ".PREFIX.$table." ";
				
				if($cond)
				{
					 $query.="where ".$cond." ";
				}
				if($backquery)
				{
					    $query.=$backquery;
				}
			
				if($result= $this->ExecuteQuery($query))
				{
					if($this->NumRows($result) > 0)
					{
						$arr=array();
				  		while($row=$this->FetchObject($result)) 
				  		{
				         $arr[]=$row;
					    }
						return $arr;
					}		
				 	 
				}
				
			}
		}
		return false;
	}


	/*
		@para
		@$table : String( Name of table)
		@$cond  : condtion to select recorde reocrd
		@$fields : name of fields data are needed from query
		@backqury : It wil be include in end of query like order by statement
		@totalcount : to count of records
		
		@Description : this function is used to select multiple records with pagination work
					
	
	*/
	function SelectRecordsWithPagination($table,$cond='',$fields='*',$backquery='',&$totalCount)
	{
		global $frmdata;
		
		
		if($table)
		{
			if($fields)
			{		
					if(is_array($fields))
					{
						$fields=implode(",",$fields);
					}
					
					$query="select ".$fields." from ".PREFIX.$table." ";
					
					if($cond)
					{
						 $query.="where ".$cond." ";
					}
					
					if($backquery)
					{
							$query.=$backquery;
					}
					//echo $query;
					if($result=$this->ExecuteQuery($query))
					{
						$totalCount=$this->NumRows($result);
						if( $totalCount > 0)
						{
							//print_r($frmdata);
							if($frmdata['from'] && $frmdata['from']<$totalCount)
								mysql_data_seek($result,$frmdata['from']);
							
							$countRows=1;
							
							$arr=array();
							while($row=$this->FetchObject($result)) 
							{	
								//print_r($row);
								if($countRows <= $frmdata['to'])
									$arr[]=$row;
								$countRows++;
								//print_r($arr);
							}
							return $arr;
						}		
						 
					}
					
			}
		}
		return false;
	}
	/*
		@para
		@$table : String( Name of table)
		@$cond  : condtion to select recorde reocrd
		@$fields : name of fields data are needed from query
		
		
		@Description : this function is used to select single record
	
	*/
	function SelectRecord($table,$cond='',$fields='*')
	{
		
		
		
		if($table)
		{
			if($fields)
			{		
					if(is_array($fields))
					{
						 $fields=implode(",",$fields);
					}
					
					 $query="select ".$fields." from ".$table." ";
					
					if($cond)
					{
						 $query.="where ".$cond;
					}
					//echo $query;
					if($result=$this->ExecuteQuery($query,$table))
					{ 
						if($this->NumRows($result) > 0)
						{
							
							$row=$this->FetchObject($result); 
							
							return $row;
						}		
						 
					}
					
			}
		}
		return false;
	}
	
	/*
		@para
		qury : query statement
		
		@Description : this function is used to run join or other complex quries
	
	*/
	function RunSelectQuery($query)
	{
		//echo $query;
		
		
		if($result=$this->ExecuteQuery($query))
		{
			// echo $query;
			if($this->NumRows($result) > 0)
			{
				//if(mysql_num_rows($result) > 1)
				//{
					$arr=array();
					while($row=$this->FetchObject($result)) 
					{	
						$arr[]=$row;
					}
				//}
				//else
				//{	
					//$row=mysql_fetch_object($result);
					//$arr=$row;
				/*}*/
				return $arr;
			}		
						 
		}
		return false;
	}
	
	
	
	 
	
	function RunSelectQueryWithPagination($query,&$totalCount)
	{
		//echo $query;
		global $frmdata;
		
		
		if($result=$this->ExecuteQuery($query))
		{
			if($this->NumRows($result) > 0)
			{
				//if(mysql_num_rows($result) > 1)
				//{
					$totalCount=$this->NumRows($result);
					
					if($frmdata['from'] && $frmdata['from']<$totalCount)
								mysql_data_seek($result,$frmdata['from']);
							
					$countRows=1;
					
					$arr=array();
					while($row=$this->FetchObject($result)) 
					{	
						if($countRows <= $frmdata['to'])
							$arr[]=$row;
						$countRows++;
					}
				//}
				//else
				//{	
					//$row=mysql_fetch_object($result);
					//$arr=$row;
				/*}*/
				return $arr;
			}		
						 
		}
		return false;
	}
	
	/*
		@para
		qury : query statement
		
		@Description : this function is used to select multiple records .will return only single record
	
	*/
	function RunSelectQuerySigle($query)
	{
		//echo $query;
		
		
		if($result=$this->ExecuteQuery($query))
		{
			$row=$this->FetchObject($result);
			if($row)
				return $row;		
		}
		return false;
	} 
	
	
	/*
		@para
		@$table : String( Name of table)
		@$value  : single value
		@$cond  : condition for updation
		@Description : this function is used to take data as formof array and gerates a update status query.
	
	*/
	function UpdateStatus($table,$value,$cond,$field='statusval')
	{
		
		if($table=='')
		{
			return false;
		}	
		else
		{
			if($value=='')
			{
				return false;
			}
			else
			{
					$query="update ".PREFIX.$table." set ".$field."='".$value."'";
					if($cond)
					{
						 $query.=" where ".$cond;
					}
					//echo $query;
					if($this->ExecuteQuery($query))
					{
						return true;
					}
			}
		}
		return false;	
		
	}
	
	function CountNumRows($table,$cond='',$fields='*',$backquery='')
	{
		global $frmdata;
	
		if($table)
		{
			if($fields)
			{		
				if(is_array($fields))
				{
					$fields=implode(",",$fields);
				}
				
				$query="select ".$fields." from ".PREFIX.$table." ";
				
				if($cond)
				{
					 $query.="where ".$cond." ";
				}
				
				if($backquery)
				{
					    $query.=$backquery;
				}
				//echo $query;
				if($result= $this->ExecuteQuery($query))
				{
					if($this->NumRows($result) > 0)
					{
						return $this->NumRows($result);
					}		
				 	else
					{
						return 0;
					}
				}
				
			}
		}
		
	}
	
	
	
	
//function used for avoiding injections...
function stripper($variable){
    /*if (1 == get_magic_quotes_gpc()){
    $returnValue = is_array($variable) ?
                array_map('stripper', $variable) :
                addslashes($variable);

    }
    else
    $returnValue=mysql_real_escape_string($variable);*/
    return $variable;
}

/*
Uploading the Image
*/

function upload($filedir,$source,$source_name,$up_flag,$lastname)
{
    if (!file_exists($filedir))
    {
            mkdir($filedir,0777);
    }
    @chmod($filedir,0777);
    if (!$lastname)
    {
        $lastname=$source_name;
    }
    if (file_exists($filedir.$lastname))
    {
        if ($up_flag=="y")
        {
	$dest=$filedir.$lastname;
            @unlink("$filedir/$lastname");
            return(move_uploaded_file($source,$dest));
            return true;
        }
        else
        echo false;
    }
    else
    {
	$dest= $filedir.$lastname;
       return move_uploaded_file($source,"$dest");
    }
}

/*
 Image Resize (Thumbnail)

*/
	function resize_img ($input_file_name, $imagetype,$foldername,$width,$height,$resize_by,$thumb)
	{
		$input_file_path=$foldername;
		// resizes image using the GD library
		global $config;
		$quality=100;
		
		// Specify your file details
		$current_file = $input_file_path . $input_file_name;
		$max_width = $width;
		$max_height = $height;
		$resize_by = $resize_by;
	
		// Get the current info on the file
		$imagedata = getimagesize($current_file);
		$imagewidth = $imagedata[0];
		$imageheight = $imagedata[1];
		$imagetype = $imagedata[2];
	
		if ($resize_by == 'width') {
			$shrinkage = $imagewidth / $max_width;
			$new_img_width = $max_width;
			$new_img_height = round($imageheight / $shrinkage);
		} 
		elseif ($resize_by == 'height') 
		{
			$shrinkage = $imageheight / $max_height;
			$new_img_height = $max_height;
			$new_img_width = round($imagewidth / $shrinkage);
		} 
		elseif ($resize_by == 'both') 
		{
			$new_img_width = $max_width;
			$new_img_height = $max_height;
		} 
		elseif ($resize_by == 'bestfit') 
		{
			$shrinkage_width = $imagewidth / $max_width;
			$shrinkage_height = $imageheight / $max_height;
			$shrinkage = max($shrinkage_width, $shrinkage_height);
			$new_img_height = round($imageheight / $shrinkage);
			$new_img_width = round($imagewidth / $shrinkage);
		}
		// type definitions
		// 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP
		// 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order)
		// 9 = JPC, 10 = JP2, 11 = JPX
		$img_name = $input_file_name; //by default
		// the GD library, which this uses, can only resize GIF, JPG and PNG
		if ($imagetype == 1) {
			// it's a GIF
			// see if GIF support is enabled
			if (imagetypes() &IMG_GIF) {
				$src_img = imagecreatefromgif($current_file);
				$dst_img = imageCreate($new_img_width, $new_img_height);
				// copy the original image info into the new image with new dimensions
				ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $new_img_width, $new_img_height, $imagewidth, $imageheight);
				$thumb_name = "$thumb" . "$input_file_name";
				$img_name = "$thumb" ."$input_file_name";
				imagegif($dst_img, "$input_file_path/$img_name");
				imagedestroy($src_img);
				imagedestroy($dst_img);
			} //end if GIF support is enabled
		} // end if $imagetype == 1
		elseif ($imagetype == 2) {
			// it's a JPG
		
			$src_img = imagecreatefromjpeg($current_file);
			$dst_img = imageCreateTrueColor($new_img_width, $new_img_height);
			
			// copy the original image info into the new image with new dimensions
			// checking to see which function is available
			ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $new_img_width, $new_img_height, $imagewidth, $imageheight);
			
			$img_name = "$thumb" ."$input_file_name";
			imagejpeg($dst_img, "$input_file_path/$img_name", $quality);
			imagedestroy($src_img);
			imagedestroy($dst_img);
		} // end if $imagetype == 2
		elseif ($imagetype == 3) {
			// it's a PNG
			$src_img = imagecreatefrompng($current_file);
			$dst_img = imagecreate($new_img_width, $new_img_height);
			imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $new_img_width, $new_img_height, $imagewidth, $imageheight);
			$img_name = "$thumb" ."$input_file_name";
			imagepng($dst_img, "$input_file_path/$img_name");
			imagedestroy($src_img);
			imagedestroy($dst_img);
		} // end if $imagetype == 3
	return "$thumb" .$img_name;
	} // end function resize_img_gd	

}
$object=new DBFilter;
?>