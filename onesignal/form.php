<html>
<head>
    <title>Download Script Form Input Data | PHP MySQL Tutorial</title>
    <style type="text/css" media="screen">
        table {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;}
        input {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;height: 20px;}
    </style>
</head>
<body>
<div style="border:0; padding:10px; width:760px; height:auto;">
<form action="sendpush.php" method="POST" name="form-input-data">
    <table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr height="46">
                <td width="10%"> </td>
                <td width="25%"> </td>
                <td width="65%"><font color="orange" size="2">Form Notification</font></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>Heading</td>
            <td><input type="text" name="heading" size="50" maxlength="50" /></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>Contents</td>
            <td><input type="text" name="contents" size="50" maxlength="50" /></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>url</td>
            <td><input type="text" name="url" size="50" maxlength="50" /></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>largeicon</td>
            <td><input type="text" name="largeicon" size="30" maxlength="30" /></td>
        </tr>
        <tr height="46">
            <td> </td>
            <td>bigpicture</td>
            <td><input type="text" name="bigpicture" size="30" maxlength="30" /></td>
        </tr>
        
        <tr height="46">
            <td> </td>
            <td> </td>
            <td><input type="submit" name="Submit" value="Submit">   
                <input type="reset" name="reset" value="Cancel"></td>
        </tr>
    </table>
</form>
</div>
</body>
</html>