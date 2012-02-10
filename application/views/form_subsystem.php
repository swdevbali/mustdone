<form action="<?=base_url()?>index.php/home/saveSubsystem" method="post">
<input type="hidden" name="oldSubsystemcode" id="oldSubsystemcode" value="<?=$subsystemcode?>"/>
<table width="100%" border="0">
  <tr>
    <td width="12%">Subsystem Code</td>
    <td width="88%"><input name="subsystemcode" type="text" id="subsystemcode" value="<?=$subsystemcode?>" size="5"/></td>
  </tr>
  <tr>
    <td>Title</td>
    <td><input name="title" type="text" id="title" value="<?=$title?>" size="30"/></td>
  </tr>
  <tr>
    <td>Description</td>
    <td><input name="description" type="text" id="description" value="<?=$description?>" size="100"/></td>
  </tr>
</table>
:<br/>
<input type="submit" value="Save"/>
</form>