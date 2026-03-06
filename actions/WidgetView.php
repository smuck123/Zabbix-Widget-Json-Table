<?php

namespace Modules\JsonTableWidget\Actions;

use CControllerDashboardWidgetView;
use CControllerResponseData;

class WidgetView extends CControllerDashboardWidgetView {

    protected function doAction(): void {
        $itemids = $this->fields_values['itemid'] ?? [];

        $rows = [];
        $columns = [];
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

        $this->setResponse(new CControllerResponseData([
            'name' => $this->getInput('name', _('JSON Table')),
            'item_name' => $item_name,
            'rows' => $rows,
            'columns' => $columns,
            'error' => $error,
            'user' => [
                'debug_mode' => $this->getDebugMode()
            ]
        ]));
    }
}
