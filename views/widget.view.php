<?php

/**
 * @var CView $this
 * @var array $data
 */

$widget = new CWidgetView($data);

if (!empty($data['error'])) {
    $widget
        ->addItem(new CTag('div', true, $data['error']))
        ->show();
    return;
}

$columns = $data['columns'] ?? [];
$rows = $data['rows'] ?? [];

if (!empty($data['item_name'])) {
    $widget->addItem(new CTag('div', true, _('Item') . ': ' . $data['item_name']));
}

$table = (new CTableInfo())->setHeader($columns);

foreach ($rows as $row) {
    $table_row = [];

    foreach ($columns as $col) {
        $value = $row[$col] ?? '';

        if (is_array($value) || is_object($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        if ($value === null) {
            $value = '';
        }

        $table_row[] = (string) $value;
    }

    $table->addRow($table_row);
}

$widget
    ->addItem($table)
    ->show();
