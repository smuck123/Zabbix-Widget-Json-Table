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
$sparkline_cells = $data['sparkline_cells'] ?? [];

if (!empty($data['item_name'])) {
    $widget->addItem(new CTag('div', true, _('Item') . ': ' . $data['item_name']));
}

$table = (new CTableInfo())->setHeader($columns);

foreach ($rows as $row_index => $row) {
    $table_row = [];

    foreach ($columns as $col) {
        $sparkline_payload = $sparkline_cells[$row_index][$col] ?? null;

        if ($sparkline_payload !== null) {
            $summary = sprintf(
                'min: %s / max: %s / current: %s',
                $sparkline_payload['summary']['min'],
                $sparkline_payload['summary']['max'],
                $sparkline_payload['summary']['current']
            );

            if (!empty($sparkline_payload['points'])
                    && !empty($sparkline_payload['width'])
                    && !empty($sparkline_payload['height'])) {
                $svg = (new CTag('svg', true))
                    ->setAttribute('viewBox', '0 0 '.$sparkline_payload['width'].' '.$sparkline_payload['height'])
                    ->setAttribute('width', (string) $sparkline_payload['width'])
                    ->setAttribute('height', (string) $sparkline_payload['height'])
                    ->setAttribute('role', 'img')
                    ->setAttribute('aria-label', _('Sparkline'));

                $svg->addItem(
                    (new CTag('polyline', true))
                        ->setAttribute('fill', 'none')
                        ->setAttribute('stroke', $sparkline_payload['color'])
                        ->setAttribute('stroke-width', '1.5')
                        ->setAttribute('points', $sparkline_payload['points'])
                );

                $cell = new CDiv();
                $cell->addItem($svg);
                $cell->addItem(new CTag('small', true, $summary));
                $table_row[] = $cell;
                continue;
            }

            $table_row[] = $summary;
            continue;
        }

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
