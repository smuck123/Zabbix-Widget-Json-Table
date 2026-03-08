<?php

namespace Modules\JsonTableWidget\Includes;

use Zabbix\Widgets\CWidgetForm;
use Zabbix\Widgets\CWidgetField;
use Zabbix\Widgets\Fields\CWidgetFieldMultiSelectItem;
use Zabbix\Widgets\Fields\CWidgetFieldCheckBox;
use Zabbix\Widgets\Fields\CWidgetFieldSelect;
use Zabbix\Widgets\Fields\CWidgetFieldTextBox;

class WidgetForm extends CWidgetForm {

	private const CHART_TYPE_OPTIONS = [
		'bar' => 'Bar',
		'compact-bar' => 'Compact bar',
		'stacked-bar' => 'Stacked bar',
		'dot' => 'Dot',
		'value-only' => 'Value only'
	];

	private const COLOR_THEME_OPTIONS = [
		'ocean' => 'Ocean',
		'violet' => 'Violet',
		'forest' => 'Forest',
		'sunset' => 'Sunset',
		'fire' => 'Fire',
		'ice' => 'Ice',
		'mono' => 'Mono',
		'neon' => 'Neon',
		'pastel' => 'Pastel',
		'earth' => 'Earth'
	];

	public function addFields(): self {
		return $this
			->addField(
				(new CWidgetFieldMultiSelectItem('itemid', _('Item')))
					->setFlags(CWidgetField::FLAG_NOT_EMPTY | CWidgetField::FLAG_LABEL_ASTERISK)
					->setMultiple(false)
			)
			->addField((new CWidgetFieldCheckBox('show_summary', _('Show summary counters')))->setDefault(1))
			->addField((new CWidgetFieldCheckBox('show_expand', _('Show nested detail rows')))->setDefault(1))
			->addField((new CWidgetFieldCheckBox('show_chart', _('Show chart')))->setDefault(0))
			->addField((new CWidgetFieldCheckBox('dark_header', _('Dark table header')))->setDefault(1))
			->addField((new CWidgetFieldCheckBox('compact_mode', _('Compact mode')))->setDefault(0))
			->addField(new CWidgetFieldTextBox('visible_columns', _('Visible table columns (comma-separated)')))
			->addField(new CWidgetFieldTextBox('chart_label_column', _('Chart label column')))
			->addField(new CWidgetFieldTextBox('chart_value_columns', _('Chart value columns (comma-separated)')))
			->addField((new CWidgetFieldSelect('chart_type', _('Chart type'), self::CHART_TYPE_OPTIONS))->setDefault('bar'))
			->addField((new CWidgetFieldTextBox('max_chart_rows', _('Max chart rows')))->setDefault('10'))
			->addField((new CWidgetFieldSelect('color_theme', _('Color theme'), self::COLOR_THEME_OPTIONS))->setDefault('ocean'))
			->addField((new CWidgetFieldTextBox('chart_palette', _('Chart palette override (#hex,#hex,...)')))->setDefault(''))
			->addField((new CWidgetFieldTextBox('color_ok', _('OK color')))->setDefault('#5cb85c'))
			->addField((new CWidgetFieldTextBox('color_warn', _('Warn color')))->setDefault('#f0ad4e'))
			->addField((new CWidgetFieldTextBox('color_error', _('Error color')))->setDefault('#d9534f'))
			->addField((new CWidgetFieldTextBox('color_info', _('Info color')))->setDefault('#5bc0de'))
			->addField(new CWidgetFieldTextBox('status_color_map', _('Status color map (VALUE=#hex,VALUE=#hex)')));
	}
}
