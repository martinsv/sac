<?php 
	require_once dirname(__FILE__).'/layout.php';

	use App\Helpers\View;

	layoutHeader('Restrito');
	
	echo '<div class="jumbotron">';
		echo '<div class="container">';
			echo '<h1>Restrito!</h1>';
			echo '<p>Você não tem permissão para acessar a página solicitada.</p>';
		echo '</div>';
	echo '</div>';

	echo '<div class="row">';
		echo '<div class="span12">';
		echo '</div>';
	echo '</div>';
	
	layoutFooter();
?>