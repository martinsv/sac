<?php 

	use App\Helpers\View;
	use App\Helpers\UtilsHelper;

	require_once dirname(__FILE__).'/layout.php';
	
	layoutHeader('Programação');
	$aData 			= View::data();
	$aEvents 		= $aData['events'];
	$aAttending 	= $aData['authenticated'] ? $aData['attending'] : array();
	$aIsAdmin 		= $aData['isAdmin'];

    ?>
	<div class="container schedule">
		<div class="row">
            <div class="col-md-12" style="text-align: center;">
                <img src="<?= UtilsHelper::base_url('/img/sac.png')?>" />
            </div>
		</div>
	</div>
	
	<?php if($aData['authenticated']): ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12" id="payment-panel">
				</div>
			</div>
		</div>
    <?php endif; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php foreach($aEvents as $aDate => $aList): ?>
					<div class="panel panel-default item-descriptor">
						<div class="panel-heading"><strong><?= $aDate ?></strong></div>
						<div class="panel-body">
							<table class="table table-hover event-schedule">
								<thead>
									<th>Horário</th>
									<th>Atividade</th>
									<th>Local</th>
									<th>Custo</th>
									<th>Vagas</th>
									
									<?php if($aData['authenticated']): ?>
										<th style="width: 10%; text-align: center;">Participar</th>
                                    <?php endif; ?>
								</thead>
								<tbody>
									<?php foreach($aList as $aIdEvent => $event): ?>
										<tr>
											<td><?= $event->time ?></td>
                                            <td><strong><?= $event->title ?> </strong>
                                            <br/><p class="event-description"> <?= $event->description ?></p></td>
											<td><?= $event->place ?></td>
											<td><?= ($event->price > 0 ? 'R$ ' . $event->price : '-') ?></td>
											<td><?= ($event->capacity != 0 ? $event->capacity : '-') ?></td>
											
											<?php if ($aData['authenticated']): ?>
												<td id="panel-event-'.$aIdEvent.'" style="text-align: center;" class="panel-event">
													<?php if (is_numeric($event->fk_competition)): ?>
														<a href="competition.php?competition=<?= $event->fk_competition ?>"><i class="fa fa-info-circle"></i> Infos</a>
														<?= $aIsAdmin ? ' <a href="competition-manager.php?id='.$event->fk_competition.'"><i class="fa fa-edit"></i></a>' : '' ?>
                                                    <?php elseif($event->ghost == 0): ?>
														<?php if (isset($aAttending[$aIdEvent])): ?>
															<span class="label label-success"><i class="fa fa-check-square"></i> Inscrito</span>
															 <a href="javascript:void(0);" onclick="SAC.unsubscribe('.$aIdEvent.')" title="Clique para remover sua inscrição dessa atividade."><i class="fa fa-remove"></i></a>
                                                        <?php else: ?>
															<a href="javascript:void(0);" onclick="SAC.subscribe(<?=$aIdEvent ?>, <?= ($event->capacity != 0 ? 'true' : 'false') ?>)" title="Clique para se inscrever nessa atividade."><i class="fa fa-square-o"></i></a>
                                                        <?php endif; ?>
													<?php else: ?>
														-
                                                    <? endif; ?>
												</td>
                                            <?php endif; ?>
										</tr>
                                    <?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
                <?php endforeach; ?>
			</div>
		</div>
	</div>
	
	<div class="container footer-partners" style="margin-top: 30px;">
		<div class="row">
				<div class="col-md-4">
					<p><strong>Realização:</strong></p>
				</div>
				<div class="col-md-8">
					<p><strong>Apoio:</strong></p>
				</div>
		</div>
		<div class="row">
			<div class="col-md-2 staff-logo">
				<a href="http://cc.uffs.edu.br" target="_blank"><img src="<?= UtilsHelper::base_url('/img/ca.png') ?>" border="0" /></a>
				<a href="http://cc.uffs.edu.br" target="_blank"><img src="<?= UtilsHelper::base_url('/img/logo_cc.png') ?>" border="0" /></a>
			</div>
			<div class="col-md-1 staff-logo">
				<a href="http://www.uffs.edu.br" target="_blank"><img src="<?= UtilsHelper::base_url('/img/uffs.png') ?>" class="logo-uffs" border="0" /></a>
			</div>
			<div class="col-md-1 staff-logo">
			</div>
			
			<div class="col-md-5 partner-logo">
				<a href="http://stmaria.com.br" target="_blank"><img src="<?= UtilsHelper::base_url('/img/santamaria.jpg') ?>" class="logo-santamaria" border="0" /></a>
			</div>
			<div class="col-md-3">
				<a href="https://www.facebook.com/GAMDIASGAMING.BR" target="_blank"><img src="<?= UtilsHelper::base_url('/img/gambdias_small.png') ?>" class="logo-gambdias" border="0" /></a><br/>
				<a href="http://fronteiratec.com" target="_blank"><img src="<?= UtilsHelper::base_url('/img/fronteiratec.png') ?>" class="logo-fronteiratec" /></a>
				<a href="http://www.donsini.com.br/" target="_blank"><img src="<?= UtilsHelper::base_url('/img/donsini.jpg') ?>" class="logo-donsini" /></a>
				<img src="<?= UtilsHelper::base_url('/img/tomray.jpg') ?>" class="logo-tomray" />
			</div>
		</div>
	</div>
	
	<script>SAC.loadPaymentInfo('payment-panel');</script>
	
	<?php layoutFooter(); ?>