<form id="form1" name="form1" method="post" action="<?=base_url()?>index.php/home/saveTodo">
 <input name="idproject_todo" type="hidden" id="idproject_todo" value="<?=$idproject_todo?>"> 
 <table width="100%" border="0">
    <tr>
      <td rowspan="3" valign="top"><img src="<?=base_url()?>res/img/ohgodwhy.jpg" width="200" height="200" /></td>
      <td valign="top">Todo</td>
      <td valign="top"><label>
        <input name="txtTitle" type="text" id="txtTitle" value="<?=$title?>" size="100">
      </label></td>
    </tr>
    <tr>
      <td valign="top">Type</td>
      <td valign="top"><?=form_dropdown('cboTodoType',$todoTypeList,$todoType)?></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top"><label>
        <input type="submit" name="Submit" value="Save" />
      </label></td>
    </tr>
  </table>
</form>