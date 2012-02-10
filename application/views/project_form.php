<form action="<?=base_url()?>index.php/home/saveProject" method="post">
<input type="hidden" name="oldCodename" id="oldCodename" value="<?=$codename?>"/>
<table width="100%" border="0">
  <tr>
    <td width="10%">Codename</td>
    <td width="90%"><input name="codename" type="text" id="codename" value="<?=$codename?>" size="10"/></td>
  </tr>
  <tr>
    <td>Title</td>
    <td><input name="title" type="text" id="title" value="<?=$title?>" size="50"/></td>
  </tr>
  <tr>
    <td>Description</td>
    <td><input name="description" type="text" id="description" value="<?=$description?>" size="100"/></td>
  </tr>
</table>
<br/>
<input type="submit" value="Save"/>
</form>