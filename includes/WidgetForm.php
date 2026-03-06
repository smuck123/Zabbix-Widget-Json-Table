<?php

namespace Modules\JsonTableWidget\Includes;

use Zabbix\Widgets\{
    CWidgetField,
    CWidgetForm
};

use Zabbix\Widgets\Fields\CWidgetFieldMultiSelectItem;
use Zabbix\Widgets\Fields\CWidgetFieldCheckBox;
use Zabbix\Widgets\Fields\CWidgetFieldIntegerBox;
use Zabbix\Widgets\Fields\CWidgetFieldTextBox;

class WidgetForm extends CWidgetForm {

    public function addFields(): self {
        return $this
            ->addField(
                (new CWidgetFieldMultiSelectItem('itemid', _('Item')))
                    ->setFlags(CWidgetField::FLAG_NOT_EMPTY | CWidgetField::FLAG_LABEL_ASTERISK)
                    ->setMultiple(false)
            )
            ->addField(
                (new CWidgetFieldCheckBox('enable_sparklines', _('Enable sparklines')))
                    ->setDefault(1)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('sparkline_height', _('Sparkline height'), 12, 120))
                    ->setDefault(28)
            )
            ->addField(
                (new CWidgetFieldTextBox('sparkline_color', _('Sparkline line color')))
                    ->setDefault('#2F7ED8')
            );
    }
}
