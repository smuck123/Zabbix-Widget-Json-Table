<?php

/**
 * @var CView $this
 * @var array $data
 */

$form = new CWidgetFormView($data);

if (array_key_exists('itemid', $data['fields'])) {
	$form->addField(new CWidgetFieldMultiSelectItemView($data['fields']['itemid']));
}

if (array_key_exists('show_summary', $data['fields'])) {
	$form->addField(new CWidgetFieldCheckBoxView($data['fields']['show_summary']));
}

if (array_key_exists('show_expand', $data['fields'])) {
	$form->addField(new CWidgetFieldCheckBoxView($data['fields']['show_expand']));
}

if (array_key_exists('show_chart', $data['fields'])) {
	$form->addField(new CWidgetFieldCheckBoxView($data['fields']['show_chart']));
}

if (array_key_exists('aggregate_similar', $data['fields'])) {
	$form->addField(new CWidgetFieldCheckBoxView($data['fields']['aggregate_similar']));
}

if (array_key_exists('aggregate_columns', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['aggregate_columns']));
}

if (array_key_exists('normalize_messages', $data['fields'])) {
	$form->addField(new CWidgetFieldCheckBoxView($data['fields']['normalize_messages']));
}

if (array_key_exists('dark_header', $data['fields'])) {
	$form->addField(new CWidgetFieldCheckBoxView($data['fields']['dark_header']));
}

if (array_key_exists('compact_mode', $data['fields'])) {
	$form->addField(new CWidgetFieldCheckBoxView($data['fields']['compact_mode']));
}

if (array_key_exists('filter_errors_only', $data['fields'])) {
	$form->addField(new CWidgetFieldCheckBoxView($data['fields']['filter_errors_only']));
}

if (array_key_exists('filter_keywords', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['filter_keywords']));
}

if (array_key_exists('visible_columns', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['visible_columns']));
}

if (array_key_exists('chart_label_column', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['chart_label_column']));
}

if (array_key_exists('chart_value_columns', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['chart_value_columns']));
}

if (array_key_exists('chart_type', $data['fields'])) {
	$form->addField(new CWidgetFieldSelectView($data['fields']['chart_type']));
}

if (array_key_exists('show_second_chart', $data['fields'])) {
	$form->addField(new CWidgetFieldCheckBoxView($data['fields']['show_second_chart']));
}

if (array_key_exists('chart2_label_column', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['chart2_label_column']));
}

if (array_key_exists('chart2_value_columns', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['chart2_value_columns']));
}

if (array_key_exists('chart2_type', $data['fields'])) {
	$form->addField(new CWidgetFieldSelectView($data['fields']['chart2_type']));
}

if (array_key_exists('max_chart_rows', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['max_chart_rows']));
}

if (array_key_exists('max_table_rows', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['max_table_rows']));
}

if (array_key_exists('history_values_limit', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['history_values_limit']));
}

if (array_key_exists('color_theme', $data['fields'])) {
	$form->addField(new CWidgetFieldSelectView($data['fields']['color_theme']));
}

if (array_key_exists('chart_palette', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['chart_palette']));
}

if (array_key_exists('color_ok', $data['fields'])) {
	$form->addField(new CWidgetFieldSelectView($data['fields']['color_ok']));
}

if (array_key_exists('color_warn', $data['fields'])) {
	$form->addField(new CWidgetFieldSelectView($data['fields']['color_warn']));
}

if (array_key_exists('color_error', $data['fields'])) {
	$form->addField(new CWidgetFieldSelectView($data['fields']['color_error']));
}

if (array_key_exists('color_info', $data['fields'])) {
	$form->addField(new CWidgetFieldSelectView($data['fields']['color_info']));
}

if (array_key_exists('status_color_map', $data['fields'])) {
	$form->addField(new CWidgetFieldTextBoxView($data['fields']['status_color_map']));
}

$form->show();
