<div align="center"><img src="<?=base_url()?>res/img/ow-yeah.jpg">
</div>
<form name="form1" method="post" action="<?=base_url()?>index.php/home/saveCompletion/<?=$idproject_todo?>">
  Any note for this awesome completion : 
  <label>
  <input name="txtOutcome" type="text" id="txtCompletion" size="100">
  </label>
  <label>
  <input name="Save" type="submit" id="Save" value="Save">
  </label>
</form>
