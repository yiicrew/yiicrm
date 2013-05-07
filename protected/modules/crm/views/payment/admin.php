<?php
/**
 * @var $this Controller
 * @var $model Payment
 */
$this->breadcrumbs = array(
    Yii::t('CrmModule.payment', 'Payments') => array('admin'),
    Yii::t('CrmModule.payment', 'Manage'),
);

Yii::app()->clientScript->registerScript(
    'search',
    "
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('payment-grid', {
        data: $(this).serialize()
    });
    return false;
});
"
);
Yii::app()->clientScript->registerCss(
    'all',
    '
   table.items a.sort-link {
       font-size: 80%;
       line-height: 12px;
   }
   '
);
$this->widget(
    'bootstrap.widgets.TbMenu',
    array(
        'type'        => 'tabs',
        'items'       => CrmHelper::projectItems(),
        'htmlOptions' => array('style' => 'font-size: 80%; margin-bottom: 0;')
    )
);
$this->widget(
    'CrmGridView',
    array(
        'id'           => 'payment-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'ajaxUrl'      => $this->createUrl('payment/admin', array('id' => $model->project_id)),
        'columns'      => array(
            /*array(
                'name'        => 'id',
                'htmlOptions' => array('style' => 'width:20px'),
            ),*/
            //'client_id',
            array(
                'name' => 'partner.project.name',
                'header' => Yii::t('CrmModule.payment', 'Project'),
                //'filter' => CHtml::listData(CrmHelper::projects(), 'id', 'name')
                //'filter' => CHtml::activeDropDownList($model, 'project_id', CHtml::listData(CrmHelper::projects(), 'id', 'name')),
            ),
            array(
                'name' => 'partner.name',
                'header' => Yii::t('CrmModule.payment', 'Partner'),
                'filter' => CHtml::activeDropDownList($model, 'partner_id', CHtml::listData(CrmHelper::partners(), 'id', 'name'), array('empty' => '')),
            ),
            'name_company',
            array(
                'name' => 'name_contact',
                'value' => 'CHtml::link($data->name_contact, array("client/update", "id" => $data->client_id), array("target" => "_blank"))',
                'type' => 'raw'
            ),
            'city',
            'comments',
            'payment_amount',
            'payment',
            'payment_remain',
            'calculation_percent',
            'agent_comission_percent',
            'agent_comission_amount',
            'agent_comission_received',
            'agent_comission_remain_amount',
            'agent_comission_remain_now',
            /*'error',
            'create_user_id',
            'update_user_id',
            'create_time',
            'update_time',*/
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
    )
);
