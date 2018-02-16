<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($utilisateur['idRole'] < 2) {
	echo "<button>Admin</button>";
}
?>
<h1 id="page-title"><span><img class="logo" src="<?=base_url();?>images/global/logo.svg" alt="logo"></span><?=$titre?></h1>