<?php

namespace Modules\JsonTableWidget\Actions;

use CControllerDashboardWidgetView;
use CControllerResponseData;

class WidgetView extends CControllerDashboardWidgetView {

    protected function doAction(): void {
        $itemids = $this->fields_values['itemid'] ?? [];
        $enable_sparklines = (bool) ($this->fields_values['enable_sparklines'] ?? 1);
        $sparkline_height = (int) ($this->fields_values['sparkline_height'] ?? 28);
        $sparkline_color = $this->sanitizeColor((string) ($this->fields_values['sparkline_color'] ?? '#2F7ED8'));

        $rows = [];
        $columns = [];
        $sparkline_cells = [];
        $error = null;
        $item_name = '';

        if (!$itemids) {
            $error = _('No item selected.');
        }
        else {
            $items = \API::Item()->get([
                'output' => ['itemid', 'name', 'lastvalue', 'value_type'],
                'itemids' => $itemids,
                'webitems' => true
            ]);

            if (!$items) {
                $error = _('Selected item not found.');
            }
            else {
                $item = $items[0];
                $item_name = $item['name'];
                $raw = $item['lastvalue'];

                if ($raw === '' || $raw === null) {
                    $error = _('Item has no value.');
                }
                else {
                    $decoded = json_decode($raw, true);

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $error = _('Item does not contain valid JSON.');
                    }
                    else {
                        if (is_array($decoded)) {
                            $is_list = array_keys($decoded) === range(0, count($decoded) - 1);

                            if (!$is_list) {
                                $decoded = [$decoded];
                            }

                            foreach ($decoded as $entry) {
                                if (is_array($entry)) {
                                    $rows[] = $entry;

                                    foreach (array_keys($entry) as $key) {
                                        if (!in_array($key, $columns, true)) {
                                            $columns[] = $key;
                                        }
                                    }
                                }
                                else {
                                    $rows[] = ['value' => $entry];
                                    if (!in_array('value', $columns, true)) {
                                        $columns[] = 'value';
                                    }
                                }
                            }
                        }
                        else {
                            $rows[] = ['value' => $decoded];
                            $columns[] = 'value';
                        }

                        if (!$rows) {
                            $error = _('JSON contains no rows.');
                        }
                    }
                }
            }
        }

        if ($rows && $columns) {
            foreach ($rows as $row_index => $row) {
                foreach ($columns as $column) {
                    $value = $row[$column] ?? null;
                    $series = $this->extractNumericSeries($value);

                    if ($series === null) {
                        continue;
                    }

                    $sparkline_cells[$row_index][$column] = $this->buildSparklinePayload(
                        $series,
                        $enable_sparklines,
                        $sparkline_height,
                        $sparkline_color
                    );
                }
            }
        }

        $this->setResponse(new CControllerResponseData([
            'name' => $this->getInput('name', _('JSON Table')),
            'item_name' => $item_name,
            'rows' => $rows,
            'columns' => $columns,
            'sparkline_cells' => $sparkline_cells,
            'error' => $error,
            'user' => [
                'debug_mode' => $this->getDebugMode()
            ]
        ]));
    }

    private function extractNumericSeries($value): ?array {
        if (is_array($value) && $this->isNumericArray($value)) {
            return array_map('floatval', $value);
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && $this->isNumericArray($decoded)) {
                return array_map('floatval', $decoded);
            }
        }

        return null;
    }

    private function isNumericArray(array $value): bool {
        if ($value === [] || array_keys($value) !== range(0, count($value) - 1)) {
            return false;
        }

        foreach ($value as $point) {
            if (!is_numeric($point)) {
                return false;
            }
        }

        return true;
    }

    private function buildSparklinePayload(array $series, bool $enabled, int $height, string $color): array {
        $height = max(12, min(120, $height));
        $count = count($series);
        $min = min($series);
        $max = max($series);
        $current = $series[$count - 1];

        $payload = [
            'summary' => [
                'min' => $min,
                'max' => $max,
                'current' => $current
            ],
            'points' => null,
            'width' => null,
            'height' => $height,
            'color' => $color
        ];

        if (!$enabled || $count < 2) {
            return $payload;
        }

        $width = max(40, ($count - 1) * 8);
        $range = $max - $min;
        $points = [];

        foreach ($series as $index => $point) {
            $x = $count > 1 ? ($index * ($width / ($count - 1))) : 0;
            $y = $range == 0.0
                ? ($height / 2)
                : ($height - (($point - $min) / $range) * $height);

            $points[] = round($x, 2) . ',' . round($y, 2);
        }

        $payload['width'] = $width;
        $payload['points'] = implode(' ', $points);

        return $payload;
    }

    private function sanitizeColor(string $color): string {
        $color = trim($color);

        if (preg_match('/^#[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/', $color)) {
            return $color;
        }

        return '#2F7ED8';
    }
}
