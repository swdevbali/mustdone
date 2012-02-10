<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/seriously.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	<link REL="SHORTCUT ICON" HREF="<?=base_url()?>res/img/icon.png">
	<meta charset="utf-8">
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>MustDone!</title>
	<!-- InstanceEndEditable -->
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
	<link type="text/css" href="<?=base_url()?>res/css/thickbox.css" rel="stylesheet"/>
	<script src="<?=base_url()?>res/js/jquery.js" type="text/javascript"></script>
	<script src="<?=base_url()?>res/js/thickbox.js" type="text/javascript"></script>
    <!-- InstanceBeginEditable name="head" -->
    <style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style3 {font-size: 36px; font-weight: bold; }
-->
    </style>
    <!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<div id="container">
	<table width="100%" border="0">
      <tr>
        <td><h1>MustDone! - ... well, maybe you're not going to like me bro.. </h1></td>
        <td align="right"><strong>
        <?=date("D, d M Y")?></strong></td>
      </tr>
    </table>

    <div id="body"><!-- InstanceBeginEditable name="content" -->
    <form name="form1" method="post" action="<?=base_url()?>index.php/home/doOpenProject">
      Select your project : 
      <label>
     <?=form_dropdown('cboProject',$project,$this->session->userdata('openProject'))?>
      </label>
            <label>
            <input name="OpenProject" type="submit" id="OpenProject" value="Open">
            </label>
<a href="<?=base_url()?>index.php/home/openProjectForm/-1?width=800&height=150" class="thickbox">Create New Project</a>
            <a href="<?=base_url()?>index.php/login/confirmLogout?width=400&height=350" class="thickbox">Logout</a>
    </form>

	 <table width="100%" border="0">
  <tr>
    <td valign="top"> Working on : 
	  <table width="100%" border="0">
        <? $i=0; foreach($progressTodo as $t) { $i++; ?>
	    <tr>
          <td>
            <? if($t->username==$this->session->userdata('user_credential')->username || $this->session->userdata('user_credential')->role=='admin') { ?>
            <a href="<?=base_url()?>index.php/home/toggleProgress/<?=$t->idproject_todo?>/<?=$t->onProgress?>"><img src="<?=base_url()?>res/img/pause.jpg"></a> <a href="<?=base_url()?>index.php/home/openCompletionForm/<?=$t->idproject_todo?>/<?=$t->status?>?width=700&height=300" class="thickbox"><img src="<?=base_url()?>res/img/done.jpg" width="16" height="16"></a><? } ?>
			<strong><i><?=$t->title?></i></strong></td>
        </tr>
        <? } ?>
	  </table></td>
    <td valign="top">	  <? if($i==0) {?>
	  <p align="center">
	  <img src="<?=base_url()?>res/img/dafuq.jpg" width="108" height="76"/> <strong><br>
	  NO ONE IS WORKING???</strong>
	  </p>
    <? } else { ?>
	<p align="center">
	<img src="<?=base_url()?>res/img/fubintang.jpg" width="103" height="100"/>
	
	<br>
	<strong>	Working it is... </strong>
	</p>
	<? } ?>
</td>
    <td valign="top"> Recent updates: 
	  <table width="100%" border="0">
        <? $i=0; foreach($recentUpdates as $t) { $i++; ?>
	    <tr>
          <td><i><?=$t->title?>
             <a href="<?=base_url()?>index.php/home/showOutcome/<?=$t->idproject_todo?>?width=200&height=100" class="thickbox"><img src="<?=base_url()?>res/img/open.jpg" width="16" height="16" border="0"></a></i></td>
        </tr>
        <? } ?>
	  </table></td>
  </tr>
</table>

	
	<p align="right">Project Completion :<span class="style1"> 
	  <?=$projectCompletion?>
	  %
    </span></p>
	<p><br/>
    </p>
	<hr>
	<table width="100%" border="0">
      <tr>
        <td width="28%" valign="top"><a href="<?=base_url()?>index.php/home/openSubsystemForm/-1?width=800&height=150" class="thickbox">New subsystem</a><table width="100%" border="0">
		<? foreach ($subsystem as $s) { ?>
          <tr>
            <td valign="top"><?=$s->subsystemcode?></td>
            <td valign="top"><a href="<?=base_url()?>index.php/home/doOpenSubsystem/<?=$s->subsystemcode?>"><?=$s->title?></a></td>
          </tr>
		  <? } ?>
        </table></td>
        <td width="72%" valign="top">
		<?
		if($this->session->userdata('openSubsystem')!=null)
		{
		?>
		
		Subsystem   : <?=$this->session->userdata('openSubsystem')->title?><br/>
		Description : <?=$this->session->userdata('openSubsystem')->description?><br/>
		Completion  : <?=$subsystemCompletion?>%<br/><hr/>
		<div align="right"><a href="<?=base_url()?>index.php/home/openTodoForm/-1?width=900&height=250" class="thickbox">New todo</a>		  </div>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#66FF00">
		<? $i=0; foreach($todo as $t) { ?>
          <tr>
            <td width="4%" align="right" valign="top">.</td>
            <td width="96%" valign="top"><strong>[<?=$t->todo_type?>]</strong>
              <?=$t->title?> (<?=$t->username?>)
              <? if($t->status=='DONE') { ?>
              <img src="<?=base_url()?>res/img/done.jpg" width="16" height="16"> <a href="<?=base_url()?>index.php/home/showOutcome/<?=$t->idproject_todo?>?width=200&height=100" class="thickbox"><i><a href="<?=base_url()?>index.php/home/showOutcome/<?=$t->idproject_todo?>?width=200&height=100" class="thickbox"><img src="<?=base_url()?>res/img/open.jpg" alt="s" width="16" height="16" border="0"></a>
              <? } else { ?>
              <? if ($t->username==$this->session->userdata('user_credential')->username || $this->session->userdata('user_credential')->role=='admin'  ) {?>
              <a href="<?=base_url()?>index.php/home/openCompletionForm/<?=$t->idproject_todo?>/<?=$t->status?>?width=700&height=300" class="thickbox">
              <? if($t->status=='Waiting') {?>
              <img src="<?=base_url()?>res/img/wait.jpg" width="16" height="16">
              <? } else { ?>
              <? } ?>
              <? } ?>
              <? } ?>
			  </a>
			   <? if($this->session->userdata('user_credential')->username==$t->username || $this->session->userdata('user_credential')->role=='admin') { ?>	
              <? if($t->status=='Waiting') { ?>
			  <a href="<?=base_url()?>index.php/home/toggleProgress/<?=$t->idproject_todo?>/<?=$t->onProgress?>"><img src="<?=base_url()?>res/img/go.jpg" width="16" height="16"></a>
			 
			  <a href="<?=base_url()?>index.php/home/openTodoForm/<?=$t->idproject_todo?>?width=900&height=250" class="thickbox""><img src="<?=base_url()?>res/img/edit.jpg" alt="f" width="16" height="16"></a>   
			  <a href="<?=base_url()?>index.php/home/confirmTodoDelete/<?=$t->idproject_todo?>?width=700&height=350" class="thickbox""><img src="<?=base_url()?>res/img/delete.jpg" width="16" height="16"></a>
			   <? } ?>
			  <? } ?>			  </td>
            </tr>
		  <? } ?>
        </table></td>
      </tr>
    </table>
	<div align="center">
	  <p>
	    <? } ?>
	    
	    <br>
      </p>
	  <p>&nbsp;</p>
	  <p><span class="style3">
	    <?=strtoupper($this->session->userdata('user_credential')->username)?>
	    </span></p>
	  <p><br>
	    <img src="<?=base_url()?>res/img/y-u-no-guy.jpg"/>    <br>
	      <span class="style1">Y U NO WORK HARDER??? </span></p>
	</div>
	<hr/>
  <!-- InstanceEndEditable --></div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
<!-- InstanceEnd --></html>