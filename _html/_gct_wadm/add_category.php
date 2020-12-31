<html>
<head>
</head>
<body>
<form action="{script_tag}" method="POST" name="frm_category">
<table border="0" cellspacing="2" cellpadding="4">
<tr>
   <td colspan="2">ADD NEW CATEGORY</td>
</tr>
<tr>
   <td>Category Title: </td>
   <td><input type="text" name="title" value="{title}" maxlength="{title_max}"></td>
</tr>
<tr>
   <td>Category Icon: </td>
   <td><input type="text" name="icon" value="{icon}" maxlength="{icon_max}"></td>
</tr>
<tr>
   <td></td>
   <td></td>
</tr>
<tr>   
   <td colspan="2"><input type="submit" name="submit" value="Create/Add"></td>
</tr>
<tr>
   <td colspan="2"><a href="index.php?ac=list-category">List Category</a> | <a href="index.php?ac=add-category">Add New Category</a></td>
</tr>
</table>
<input type="hidden" name="ac" value="{ac}">
</form>
</body>
</html>
