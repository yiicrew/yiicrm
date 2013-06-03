<?php
/**
 * @var $this Controller
 * @var $model Payment
 */
Yii::app()->getClientScript()->registerCss('table', 'table.items {min-width: auto!important;}');
$this->widget(
    'bootstrap.widgets.TbTabs',
    array(
        'type'  => 'tabs',
        'tabs' => array_merge(
            CrmHelper::projectItems(array(1, 14, 15), true),
            array(array('label' => Yii::t('CrmModule.Payment', 'Расчеты'), 'url' => array('paymentMoney/admin')))
        ),
        'id'    => 'projects-tab',
        'htmlOptions' => array('style' => 'font-size: 90%')
    )
);
?>
<div class="row-fluid">
<div class="span9">
<?php
$this->widget(
    'CrmGridView',
    array(
        'id'                    => 'payment-grid',
        'dataProvider'          => $model->search(),
        'filter'                => $model,
        'ajaxUrl'               => $this->createUrl('payment/index', array('id' => $model->projectId)),
        'template'       => '{items}{pager}{summary}',
        'fixedHeader' => false,
        //'rowCssClassExpression' => '!$data->agent_comission_remain_amount ? "opacity" : ""',
        //'htmlOptions'           => array('style' => 'padding-top: 1px;'),
        'columns'               => array(
            array(
                'name'     => 'paymentMoneyPartner.date',
                'header'   => Yii::t('CrmModule.paymentMoney', 'Date') . ' ' . Yii::t('CrmModule.payment', 'Partner'),
                'filter'   => CHtml::activeTextField($model, 'partnerDate'),
                'class'    => 'bootstrap.widgets.TbEditableColumn',
                'editable' => array(
                    'url'        => $this->createUrl('paymentMoney/updateEditable'),
                    'type'       => 'date',
                    'placement'  => 'left',
                    'viewformat' => 'dd.mm.yy'
                ),
            ),
            array(
                'name'        => 'client_id',
                'value'       => 'isset($data->client) ? CHtml::link($data->client->client_id, array("client/update", "id" => $data->client_id), array("target" => "_blank")) : ""',
                'type'        => 'raw',
                'htmlOptions' => array('style' => 'width: 25px'),
            ),
            array(
                'name'  => 'name_company',
                'class' => 'bootstrap.widgets.TbEditableColumn',
            ),
            array(
                'name'  => 'name_contact',
                'class' => 'TbEditableColumn',
            ),
            array(
                'name'     => 'comments',
                'class'    => 'TbEditableColumn',
                'htmlOptions' => array('style' => 'width: 30px; text-align:center'),
                'editable' => array(
                    'type'      => 'textarea',
                    'placement' => 'left',
                    'options'   => array(
                        'showbuttons' => true,
                        //'display'     => 'js: function() {$(this).html("<i class=\"icon-list-alt\">_</i>");}',
                        //'autotext'    => 'always'
                    )
                ),
            ),
            array(
                'name'     => 'paymentMoneyPartner.method',
                'header'   => Yii::t('CrmModule.paymentMoney', 'Payment Method'),
                'filter'   => CHtml::activeDropDownList($model, 'partnerMethod', PaymentMoney::model()->statusMethod->getList(), array('empty' => '')),
            ),
            array(
                'name'     => 'payment_amount',
                'class'    => 'TbEditableColumn',
                'editable' => array('options' => array('inputclass' => 'input-small')),
            ),
            array(
                'name'        => 'payment',
                'htmlOptions' => array('style' => 'background-color: WhiteSmoke;')
            ),
            array(
                'name'     => 'agent_comission_amount',
                'class'    => 'TbEditableColumn',
                'editable' => array('options' => array('inputclass' => 'input-small')),
                'htmlOptions' => array('style' => 'background-color: WhiteSmoke')
            ),
            /*array(
                'name'        => 'agent_comission_received',
                'htmlOptions' => array('style' => 'background-color: WhiteSmoke')
            ),
            'error',
            'create_user_id',
            'update_user_id',
            'create_time',
            'update_time',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{update} {delete}'
            ),*/
        ),
    )
);
?>
    </div>
    <div class="span3">
<?php

$this->widget(
    'bootstrap.widgets.TbGroupGridView',
    array(
        'id'              => 'payment-money-grid',
        'type'            => 'striped condensed bordered',
        'dataProvider'    => $stat,
        'afterAjaxUpdate' => 'reinstallFilter',
        //'filter'          => $model,
        'template'       => '{items}{pager}{summary}',
        'mergeColumns'    => array('amount', 'date'),
        'columns'         => array(
            //'type',
            //'payment_id',
            array(
                'name'  => 'amount',
                'header' => 'Расчет по АВ'
                //'class' => 'bootstrap.widgets.TbTotalSumColumn',
            ),
            array(
                'name'   => 'date',
                'header' => 'Дата расчета по АВ',
                /*'filter' => $this->widget(
                    'bootstrap.widgets.TbDateRangePicker',
                    array(
                        'model'       => $paymentMoney,
                        'attribute'   => 'date',
                        'options'     => Client::$rangeOptions,
                        'htmlOptions' => array('id' => 'datepicker_for_update_time'),
                    ),
                    true
                ),*/
            ),
            /*'create_user_id',
            'update_user_id',
            'create_time',
            'update_time',
            */
            /*array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
            ),*/
        ),
    )
);
?>
    </div>
</div>