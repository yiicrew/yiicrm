<?php
/**
 * @var $this Controller
 * @var $model Payment
 */
$this->widget(
    'bootstrap.widgets.TbMenu',
    array(
        'type'  => 'tabs',
        'items' => CrmHelper::projectItems(array(1, 14, 15)),
        'id'    => 'projects-tab'
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
            array(
                'name'        => 'client_id',
                'value'       => 'isset($data->client) ? CHtml::link($data->client->client_id, array("client/update", "id" => $data->client_id), array("target" => "_blank")) : ""',
                'type'        => 'raw',
                'htmlOptions' => array('style' => 'width: 25px'),
            ),
            array(
                'name'    => 'partner.project.name',
                'header'  => Yii::t('CrmModule.payment', 'Project'),
                'visible' => $model->project_id == null,
            ),
            array(
                'name'   => 'partner.name',
                'header' => Yii::t('CrmModule.payment', 'Partner'),
                'filter' => CHtml::activeDropDownList($model, 'partner_id', CHtml::listData(CrmHelper::partners($model->project_id), 'id', 'name'), array('empty' => '')),
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
                'name'     => 'client.city',
                'class'    => 'TbEditableColumn',
                'filter'   => CHtml::activeTextField($model, 'city'),
                'editable' => array('url' => $this->createUrl('client/updateEditable')),
            ),
            array(
                'name'     => 'comments',
                'class'    => 'TbEditableColumn',
                'editable' => array(
                    'type'      => 'textarea',
                    'placement' => 'left',
                    'options'   => array(
                        'showbuttons' => true,
                        'display'     => 'js: function() {$(this).html("<i class=\"icon-list-alt\">_</i>");}',
                        'autotext'    => 'always'
                    )
                ),
            ),
            array(
                'name'     => 'payment_amount',
                'class'    => 'TbEditableColumn',
                'editable' => array('options' => array('inputclass' => 'input-small'))
            ),
            'payment',
            'payment_remain',
            'agent_comission_percent',
            array(
                'name'     => 'agent_comission_amount',
                'class'    => 'TbEditableColumn',
                'editable' => array('options' => array('inputclass' => 'input-small'))
            ),
            'agent_comission_received',
            'agent_comission_remain_amount',
            'agent_comission_remain_now',
            array(
                'name'     => 'paymentMoneyPartner.date',
                'header'   => Yii::t('CrmModule.paymentMoney', 'Date') . ' ' . Yii::t('CrmModule.payment', 'Partner'),
                'filter'   => CHtml::activeTextField($model, 'partner_date'),
                'class'    => 'TbEditableColumn',
                'editable' => array(
                    'url'        => $this->createUrl('paymentMoney/updateEditable'),
                    'type'       => 'date',
                    'placement'  => 'left',
                    'viewformat' => 'dd.mm.yy'
                ),
            ),
            array(
                'name'     => 'paymentMoneyPartner.amount',
                'header'   => Yii::t('CrmModule.paymentMoney', 'Payment Moneys') . ' ' . Yii::t('CrmModule.payment', 'Partner'),
                'filter'   => CHtml::activeTextField($model, 'partner_amount'),
                'class'    => 'TbEditableColumn',
                'editable' => array('url' => $this->createUrl('paymentMoney/updateEditable')),
            ),
            array(
                'name'     => 'paymentMoneyAgent.date',
                'header'   => Yii::t('CrmModule.paymentMoney', 'Date') . ' ' . Yii::t('CrmModule.payment', 'Reward'),
                'filter'   => CHtml::activeTextField($model, 'agent_date'),
                'class'    => 'TbEditableColumn',
                'editable' => array(
                    'url'        => $this->createUrl('paymentMoney/updateEditable'),
                    'type'       => 'date',
                    'placement'  => 'left',
                    'viewformat' => 'dd.mm.yy'
                ),
            ),
            array(
                'name'     => 'paymentMoneyAgent.amount',
                'header'   => Yii::t('CrmModule.paymentMoney', 'Payment Moneys') . ' ' . Yii::t('CrmModule.payment', 'Reward'),
                'filter'   => CHtml::activeTextField($model, 'agent_amount'),
                'class'    => 'TbEditableColumn',
                'editable' => array('url' => $this->createUrl('paymentMoney/updateEditable')),
            ),
            /*'error',
            'create_user_id',
            'update_user_id',
            'create_time',
            'update_time',*/
            array('class' => 'bootstrap.widgets.TbButtonColumn'),
        ),
    )
);
