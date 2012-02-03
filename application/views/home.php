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
    <!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>

<div id="container">
	<h1>MustDone! </h1>

  <div id="body"><!-- InstanceBeginEditable name="content" -->
    <form name="form1" method="post" action="<?=base_url()?>index.php/home/doOpenProject">
      Select your project : 
      <label>
     <?=form_dropdown('cboProject',$project)?>
      </label>
            <label>
            <input name="OpenProject" type="submit" id="OpenProject" value="Open">
            </label>
    </form>
    <table width="100%" border="0">
      <tr>
        <td width="28%" valign="top"><table width="100%" border="0">
		<? foreach ($subsystem as $key => $val) { ?>
          <tr>
            <td valign="top"><?=$key?></td>
            <td valign="top"><a href="<?=base_url()?>index.php/home/doOpenTodo/<?=$key?>"><?=$val?></a></td>
          </tr>
		  <? } ?>
        </table></td>
        <td width="72%" valign="top"><table width="100%" border="0">
		<? foreach($todo as $key=>$value) { ?>
          <tr>
            <td>&nbsp;</td>
            <td><?=$value?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  <? } ?>
        </table></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p><a href="<?=base_url()?>index.php/login/doLogout">Logout</a></p>
  <!-- InstanceEndEditable --></div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
<!-- InstanceEnd --></html>