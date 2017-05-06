<?php
    include ("0_bd.php");
  	include ("0_bd_2.php");
   	$print='';
	$one=''; 

	
if(isset($_POST['sent01']))  {
	if (isset($_POST['sentOtdel']) and $_POST['sentOtdel'] <> "") {
		//отдельно выводим дирекцию
		if ($_POST['sentOtdel'] == 1) {
			$one .= '<tr bgcolor= "#FFE4E1"><td><button>-</button>10000</td><td>Дирекция</td></tr>';	
			$result1 = mysql_query('SELECT * FROM  otdel,sotrydniki WHERE state <> 1 AND state <> 2 AND sotrydniki.Otdel_id = otdel.id_otd AND otdel.Number_otd = 10000  ORDER BY  Fam',$db2);//выборка из таблицы  
			while ($row1 = mysql_fetch_array($result1)) //результаты каждой строки
		    { 
				$result2 = mysql_query ("SELECT * FROM comp_lk WHERE (vid_sot=".$row1['id_sot'].")",$db);
				$myrow = mysql_fetch_array($result2);
				if (!empty($myrow['id_lk'])) 
				{
					$one  .= '<tr> <td>  </td><td align="left"><a  style="color: #000000; " href="comp_LK.php?id='.$row1['id_sot'].'" target="_blank">'.$row1['Fam'].' '.$row1['Imya'].' '.$row1['Otch'].'</a></td></tr>';
				}  
				else
				{
					$one  .= '<tr> <td>  </td><td align="left"><a  style = "color: #FF6347" href="comp_LK.php?id='.$row1['id_sot'].'" target="_blank">'.$row1['Fam'].' '.$row1['Imya'].' '.$row1['Otch'].'</a></td></tr>';
				}	
			}  
		}
		else {
			$one .= '<tr bgcolor= "#FFE4E1"><td><button onclick="f1(1)">+</button>10000</td><td>Дирекция</td></tr>';
		}			
		$result = mysql_query("SELECT * FROM otdel WHERE Number_otd <> 10000 ORDER BY Number_otd ",$db2);//выборка из таблицы  
		while ($row = mysql_fetch_array($result)) //результаты каждой строки
		{   
		    $otdel = $row['id_otd'];
			if ($_POST['sentOtdel'] == $row['id_otd']) {
				$one .= '<tr><td  bgcolor= "#FFE4E1"><button>-</button>'.$row['Number_otd'].'</td><td  bgcolor= "#FFE4E1"><a  style="color: #000000; " href="comp_LK_ot.php?id='.$row['id_otd'].'" target="_blank">'.$row['Name_otd'].' </a></td></tr>';
				$result1 = mysql_query('SELECT * FROM sotrydniki WHERE (Otdel_id= '.$row['id_otd'].') ORDER BY Fam',$db2);//выборка из таблицы  
				while ($row1 = mysql_fetch_array($result1)) //результаты каждой строки
				{ 
					$result2 = mysql_query ("SELECT * FROM comp_lk WHERE (vid_sot=".$row1['id_sot'].")",$db);
					$myrow = mysql_fetch_array($result2);						
					//список сотрудников
					if (!empty($myrow['id_lk'])) 
					{
						$one  .= '<tr><td>   </td><td align="left"><a  style="color: #000000; " href="comp_LK.php?id='.$row1['id_sot'].'" target="_blank">'.$row1['Fam'].' '.$row1['Imya'].' '.$row1['Otch'].'</a></td></tr>';
					} 
					else				
					{
						$one  .= '<tr><td>   </td><td align="left"><a  style="color: #FF6347; " href="comp_LK.php?id='.$row1['id_sot'].'" target="_blank">'.$row1['Fam'].' '.$row1['Imya'].' '.$row1['Otch'].'</a></td></tr>';
					} 				
				}
			}
            else {
				$one .= '<tr><td  bgcolor= "#FFE4E1"><button onclick="f1('.$otdel.')">+</button>'.$row['Number_otd'].'</td><td  bgcolor= "#FFE4E1"><a  style="color: #000000; " href="comp_LK_ot.php?id='.$row['id_otd'].'">'.$row['Name_otd'].' </a></td></tr>';
            }
		}			
	}		
	elseif ($_POST['sent01'] == 1 and isset($_POST['sentOtdel']) and $_POST['sentOtdel'] == "") {
	    //отдельно выводим дирекцию
		$one .= '<tr bgcolor= "#FFE4E1"><td><button>-</button>10000</td><td>Дирекция</td></tr>';
		$result1 = mysql_query('SELECT * FROM  otdel,sotrydniki WHERE state <> 1 AND state <> 2 AND sotrydniki.Otdel_id = otdel.id_otd AND otdel.Number_otd = 10000  ORDER BY  Fam',$db2);//выборка из таблицы  
		while ($row1 = mysql_fetch_array($result1)) //результаты каждой строки
		{ 
		    $result2 = mysql_query ("SELECT * FROM comp_lk WHERE (vid_sot=".$row1['id_sot'].")",$db);
			$myrow = mysql_fetch_array($result2);
			if (!empty($myrow['id_lk'])) {			
				$one  .= '<tr> <td>  </td><td align="left"><a  style="color: #000000; " href="comp_LK.php?id='.$row1['id_sot'].'" target="_blank">'.$row1['Fam'].' '.$row1['Imya'].' '.$row1['Otch'].'</a></td></tr>';
			}  
			else {
				$one  .= '<tr> <td>  </td><td align="left"><a  style = "color: #FF6347" href="comp_LK.php?id='.$row1['id_sot'].'" target="_blank">'.$row1['Fam'].' '.$row1['Imya'].' '.$row1['Otch'].'</a></td></tr>';
			}			
		}
		// формируем список при загрузке страницы
		$result = mysql_query("SELECT * FROM otdel WHERE Number_otd <> 10000 ORDER BY Number_otd ",$db2);//выборка из таблицы  
		while ($row = mysql_fetch_array($result)) { //результаты каждой строки
			//список отдела
			$one .= '<tr><td  bgcolor= "#FFE4E1"><button>-</button>'.$row['Number_otd'].'</td><td  bgcolor= "#FFE4E1"><a  style="color: #000000; " href="comp_LK_ot.php?id='.$row['id_otd'].'">'.$row['Name_otd'].' </a></td></tr>';
			$result1 = mysql_query('SELECT * FROM sotrydniki WHERE (Otdel_id= '.$row['id_otd'].') ORDER BY Fam',$db2);//выборка из таблицы  
			while ($row1 = mysql_fetch_array($result1)) //результаты каждой строки
			{ 
				$result2 = mysql_query ("SELECT * FROM comp_lk WHERE (vid_sot=".$row1['id_sot'].")",$db);
				$myrow = mysql_fetch_array($result2);						
				//список сотрудников
				if (!empty($myrow['id_lk'])) {
					$one  .= '<tr><td>   </td><td align="left"><a  style="color: #000000; " href="comp_LK.php?id='.$row1['id_sot'].'" target="_blank">'.$row1['Fam'].' '.$row1['Imya'].' '.$row1['Otch'].'</a></td></tr>';
				} 
                else {				
					$one  .= '<tr><td>   </td><td align="left"><a  style="color: #FF6347; " href="comp_LK.php?id='.$row1['id_sot'].'" target="_blank">'.$row1['Fam'].' '.$row1['Imya'].' '.$row1['Otch'].'</a></td></tr>';
				} 				
			}
		} 
	}
	elseif ($_POST['sent01'] == 2 and isset($_POST['sentOtdel']) and $_POST['sentOtdel'] == "") {
		$one .= '<tr bgcolor= "#FFE4E1"><td><button onclick="f1(1)">+</button>10000</td><td>Дирекция</td></tr>';			
		$result = mysql_query("SELECT * FROM otdel WHERE Number_otd <> 10000 ORDER BY Number_otd ",$db2);//выборка из таблицы  
		while ($row = mysql_fetch_array($result)) //результаты каждой строки
			//список отдела
			{
				$otdel = $row['id_otd'];
				$one .= '<tr><td  bgcolor= "#FFE4E1"><button onclick="f1('.$otdel.')">+</button>'.$row['Number_otd'].'</td><td  bgcolor= "#FFE4E1"><a  style="color: #000000; " href="comp_LK_ot.php?id='.$row['id_otd'].'">'.$row['Name_otd'].' </a></td></tr>';		
			}
	}
}
else {
	//отдельно выводим дирекцию
	$one .= '<tr bgcolor= "#FFE4E1"><td><button onclick="f1(1)">+</button>10000</td><td>Дирекция</td></tr>';  
	$result = mysql_query('SELECT * FROM otdel WHERE Number_otd <> 10000 ORDER BY Number_otd ',$db2);//выборка из таблицы  
	while ($row = mysql_fetch_array($result)) //результаты каждой строки
	   {
			$otdel = $row['id_otd'];
			$one .= '<tr bgcolor= "#FFE4E1"><td><button onclick="f1('.$otdel.')">+</button>'.$row['Number_otd'].'</td><td><a  style="color: #000000; " href="comp_LK_ot.php?id='.$row['id_otd'].'" >'.$row['Name_otd'].' </a></td></tr>'; 
	    }
}

    // формируем список отделов при загрузке страницы для модального окна
	$result2 = mysql_query("SELECT * FROM otdel  ORDER BY Name_otd",$db2);
	$select_otdel = "<select class='chosen-select' class='select-mini' name='otdel' id='otdel'><option> отдел </option>";
	while ($row = mysql_fetch_array($result2)) {
		$select_otdel.= "<option value=".$row['id_otd'].">".$row['Number_otd'].' '.$row['Name_otd']."</option>";
	}
	$select_otdel.= "</select>";
  
	if (isset($_POST['sentOtdel']) and $_POST['sentOtdel'] <> "")
	{
		$input= " <input type='hidden' name='sent01' value = '2'> ";  
	}
	elseif (isset($_POST['sent01']) and $_POST['sent01'] == 1 )
	{
		$input= " <input type='hidden' name='sent01' value = '2'> ";
	}
	elseif (isset($_POST['sent01']) and $_POST['sent01'] == 2 )
	{
		$input= " <input type='hidden' name='sent01' value = '1'> ";
	}
	else 
	{
		$input= " <input type='hidden' name='sent01' value = '1'> ";
	}
  	
	$link = "comp_LK_list.html";
	$title = "Список личных карточек";
	include('index.php');
?>