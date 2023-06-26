<?php
$db = pg_connect("host =  port =  dbname =  user =  password = ");
if (isset($_POST['insert']))
{
    echo "masuk iff";
    $query = "INSERT INTO employee (fname, minit, lname, ssn, bdate, address, sex, salary, superssn, dno)
    VALUES ('$_POST[fname]','$_POST[minit]','$_POST[lname]','$_POST[ssn]','$_POST[bdate]','$_POST[address]',
    '$_POST[sex]','$_POST[salary]','$_POST[superssn]','$_POST[dno]')";

$result_insert = pg_query($query); 
    if (!$result_insert)
    {
        echo "Insert failed!!";
    } else {
        echo "Insert successfull;";
    }
}

$result_ssn = pg_query($db, "select ssn,sname from emp_supervisor");
$result_dno = pg_query($db, "select dnumber,dname from department");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enter New Employee</title>
</head>
<body>
<h2>Enter New Employee Data</h2>
<form name="insert" action="employee-insert.php" method="POST" >
    <table>
        <tr> 
            <th>Name</th>
            <td><input type="text" name="fname" placeholder="First Name"><input type="text" name="minit"
            placeholder="Middle Name Initial"><input type="text" name="lname" placeholder="Last Name"></td>
        </tr>
        <tr>
            <th>SSN</th>
            <td><input type="text" name="ssn" placeholder="Ssn"></td>
        </tr>
        <tr>
            <th>Birth Date</th>
            <td><input type="date" id="bdate" name="bdate"></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><input type="text" name="address" placeholder="Address"></td>
        </tr>
        <tr>
            <th>Sex</th>
            <td><select name="sex" id="sex">
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select></td>
        </tr>
        <tr>
            <th>Salary</th>
            <td><input type="number" id="salary" name="salary"></td>
        </tr>
        <tr>
            <th>Supervisor</th>
            <td><select name="superssn">
<?php while ($row = pg_fetch_row($result_ssn)) { ?>
                    <option value="<?php print($row[0]); ?>"><?php print($row[1]); ?></option>
<?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Department</th>
            <td><select name="dno">
<?php while ($row = pg_fetch_row($result_dno)) { ?>
                    <option value="<?php print($row[0]); ?>"><?php print($row[1]); ?></option>
<?php } ?>
                </select>
            </td>
        </tr>
        <tr><td colspan="2"><input type="submit" name="insert" value="Add Employee"></td></tr>
    </table>
</form>
</body>
</html>