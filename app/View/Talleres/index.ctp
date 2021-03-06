<?php
#Metadatos
$this->set('title_for_layout', 'ADSL - Listado de talleres disponibles '.date('Y-m') );
$this->Html->meta('description', 'Listado de talleres disponibles '.date('Y-m'), array('inline' => false));
#Sección Javascript
$this->Html->script(array(
											'activar.top.menu.jquery',
											'talleres',
											), array('inline' => false));
?>

<div class="talleres index">
	<h1>Lista de talleres</h1>
	<?php
	foreach ($talleres as $taller): ?>
	<section itemscope itemtype="http://schema.org/Event" itemclass="EducationEvent">
	<h2 itemprop="name"><?php 
	echo $this->Html->link($taller['Taller']['nombre'],
		array('action' => 'ver', $taller['Taller']['slug_dst']),
		array('itemprop' => 'url')); ?></h2>
	<dl>
		<dt>Imparte:</dt>
		<dd itemprop="attendee" itemscope itemtype="http://schema.org/Person">
		<span itemprop="name"><?php 
		echo $this->Html->link($taller['User']['username'],
		array('controller'=>'users','action' => 'ver', $taller['User']['username']),
		array('itemprop' => 'url')); ?>&nbsp;</span>
		</dd>
		<dt>Horario:</dt>
		<dd><?php echo h($taller['Taller']['horario']); ?>&nbsp;</dd>
		<dt>Fecha de inicio:</dt>
		<dd itemprop="startDate"><?php echo h($taller['Taller']['fecha_inicio']); ?>&nbsp;</dd>
		<dt>Fecha Final:</dt>
		<dd itemprop="endDate"><?php echo h($taller['Taller']['fecha_final']); ?>&nbsp;</dd>
		<dt>Número de Horas:</dt>
		<dd><?php echo h($taller['Taller']['numero_total_horas']); ?>&nbsp;</dd>
		<dt>Estado actual:</dt>
		<dd><?php echo h($taller['Taller']['status']); ?>&nbsp;</dd>
	</dl><br />
	<p><?php echo h($taller['Taller']['resumen']); ?>&nbsp;</p>
	<?php echo $this->Html->link('Ver más',
	array('action' => 'ver', $taller['Taller']['slug_dst']),
	array('class' => 'boton_naranja')
	); ?>
	</section>
	<br /><br />
<?php endforeach; ?>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => 'Página %page% de %pages%, viendo %current% registros de un total %count%, iniciando en %start% acabando en %end%'
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< Anterior', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next('Siguiente >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="acciones">
	<h3>Acciones</h3>
	<ul>
		<?php
			if( $this->Session->read('Auth.User.role') == 'miembro' ||  $this->Session->read('Auth.User.role') == 'admin' ):
		?>
		<li><?php echo $this->Html->link('Agregar Taller', array('action' => 'agregar', 'admin'=> true)); ?></li>
		<?php endif; ?>
		<!--
		<li><?php /*echo $this->Html->link('Listar Etiquetas', array('controller' => 'etiquetas', 'action' => 'index'));*/ ?> </li>
		<li><?php /*echo $this->Html->link('Agregar Etiqueta', array('controller' => 'etiquetas', 'action' => 'agregar'));*/ ?> </li>
		-->
	</ul>
</div>
