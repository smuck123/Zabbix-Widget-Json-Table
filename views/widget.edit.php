<?php

/**
 * @var CView $this
 * @var array $data
 */

(new CWidgetFormView($data))
    ->addField(
        new CWidgetFieldMultiSelectItemView($data['fields']['itemid'])
    )
    ->addField(
        new CWidgetFieldCheckBoxView($data['fields']['enable_sparklines'])
    )
    ->addField(
        new CWidgetFieldIntegerBoxView($data['fields']['sparkline_height'])
    )
    ->addField(
        new CWidgetFieldTextBoxView($data['fields']['sparkline_color'])
    )
    ->show();
