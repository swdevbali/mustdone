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
    <!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
 <p align="center">
    <form name="form1" method="post" action="<?=base_url()?>index.php/login/doLogin">
      <div align="center">
        <table width="412" border="0" align="center">
          <tr>
            <td width="59">Username</td>
            <td width="146"><label>
              <input name="txtUsername" type="text" id="txtUsername">
            </label></td>
            <td width="193" rowspan="3"><img src="<?=base_url()?>res/img/cereal-guy.jpg"/><br>
            I know your password! </td>
          </tr>
          <tr>
            <td>Password</td>
            <td><label>
              <input name="txtPassword" type="password" id="txtPassword">
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input type="submit" name="Submit" value="Login">
            </label></td>
          </tr>
        </table>
        <br>
        </div>
    </form>
  <p align="center"><?php if($this->session->flashdata('message')) : ?>
    <p align="center"><?=$this->session->flashdata('message')?></p>
    <div align="center">
      <?php endif; ?>
      </p>
      </p>
    </div>
  <!-- InstanceEndEditable --></div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
<!-- InstanceEnd --></html>