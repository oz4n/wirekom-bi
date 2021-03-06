<?php
$this->breadcrumbs = array(
    'Kpis' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Kpi', 'url' => array('index')),
    array('label' => 'Create Kpi', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('kpi-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Kpis</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'kpi-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'name',
        'target',
        array(
            'header' => 'Jumlah',
            'value' => '$data->getHasil()',
            'type' => 'raw',
        ),
        array(
            'header' => 'Status',
            'value' => '$data->getStatus()',
            'type' => 'raw',
        ),
        array(
            'name' => 'user',
            'value' => '$data->user->username',
            'type' => 'raw',
        ),
        'advice',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
