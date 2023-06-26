<?php
try {
	$dbuser = '';
	$dbpass = '';
	$dbhost = '';
	$dbname = '';
	$connec = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
}catch (PDOException $e) 
{
	echo "Error : " . $e->getMessage() . "<br/>";
	die();
}

$sql = "select concat(e1.fname, ' ', e1.minit, ' ', e1.lname) as empname, e1.ssn, e1.bdate, e1.address, e1.sex, e1.salary, concat(e2.fname, ' ', e2.minit, ' ', e2.lname) as supname, dname
		from employee e1 inner join employee e2 on (e1.superssn = e2.ssn) inner join department on (e1.dno = department.dnumber)";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		table {
		  border-collapse: collapse;
		  width: 100%;
		}

		th, td {
		  text-align: left;
		  padding: 8px;
		}

		tr:nth-child(even) {background-color: #f2f2f2;}
	</style
</head>
<body>
<table>
	<tr>
		<th>Name</th>
		<th>SSN</th>
		<th>Birth Date</th>
		<th>Address</th>
		<th>Sex</th>
		<th>Salary</th>
		<th>Supervisor</th>
		<th>Department</th>
	</tr>
<?php
foreach ($connec->query($sql) as $row) 
{
	?>
	<tr>
		<td> <?php print $row['empname'] ?> </td>
		<td> <?php print $row['ssn'] ?> </td>		
		<td> <?php print $row['bdate'] ?> </td>
		<td> <?php print $row['address'] ?> </td>
		<td> <?php print $row['sex'] ?> </td>
		<td> <?php print $row['salary'] ?> </td>
		<td> <?php print $row['supname'] ?> </td>
		<td> <?php print $row['dname'] ?> </td>
	<?php 
}
?>
</table>
</body>
</html>