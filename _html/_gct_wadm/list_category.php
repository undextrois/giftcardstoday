<html>
<head>
</head>
<body>
<table border="0" cellspacing="2" cellpadding="4">
<tr bgcolor="#aaaaaa">
   <td colspan="3">CATEGORY LISTING</td>
</tr>
<tr>
   <td></td>
   <td></td>
   <td></td>
</tr>
<tr bgcolor="#3859AF">
   <td align="center">Category ID</td>
   <td align="center">Category Title</td>
   <td align="center">Option</td>
</tr>
<!-- BEGIN GCTStoreCategoryBlock -->
<tr bgcolor="#cccccc" onMouseOver="this.bgColor='#aaaaaa'" onMouseOut="this.bgColor='#cccccc'">
   <td>{category_id}</td>
   <td>{category_title}</td>
   <td>
   <a href="index.php?ac=drop-category&categoryid={category_id}">drop</a> | <a href="index.php?ac=edit-category&categoryid={category_id}">edit</a>
   </td>
</tr>
<!-- END GCTStoreCategoryBlock -->
<tr>
   <td colspan="3"><a href="index.php?ac=list-category">List Category</a> | <a href="index.php?ac=add-category">Add New Category</a></td>
</tr>
</table>
</form>
</body>
</html>
