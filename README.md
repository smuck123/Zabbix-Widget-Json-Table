# Zabbix JSON Table Widget

A custom Zabbix dashboard widget module that renders JSON data from a selected item into a readable table view.

## Features

- Converts JSON payloads into table rows and columns automatically.
- Optional summary cards for top-level metrics.
- Optional expandable nested details per row.
- Optional inline chart block (bar/compact-bar/stacked-bar/dot/value-only).
- Status badges with configurable color mapping.
- Case-insensitive column matching for visible columns and chart selectors.
- Display controls for compact mode, dark header, and visible columns.

## Requirements

- Zabbix with support for custom dashboard widgets.
- An item that returns valid JSON in its latest value.

## Installation

1. Copy this module directory into your Zabbix modules path.
2. Ensure the directory name is `Zabbix-Widget-Json-Table` (or your preferred module folder name).
3. Enable the module in Zabbix (Administration → General → Modules).
4. Add the **JSON Table** widget to a dashboard.

## Widget Configuration

When editing the widget, configure these main fields:

- **Item**: Source item containing JSON data.
- **Show summary counters**: Render compact summary cards.
- **Show nested detail rows**: Enable row expansion for nested data.
- **Show chart**: Display chart section above the table.
- **Dark table header** / **Compact mode**: Visual style options.
- **Visible table columns**: Comma-separated allow-list of columns.
- **Chart label/value columns**: Explicit chart column selection.
- **Chart type**: `bar`, `compact-bar`, `stacked-bar`, `dot`, or `value-only` (default: `bar`).
- **Max chart rows**: Limit number of plotted rows (default: `10`).
- **Color theme**: Choose one of 10 built-in palettes: `ocean`, `violet`, `forest`, `sunset`, `fire`, `ice`, `mono`, `neon`, `pastel`, `earth`.
- **Chart palette override**: Optional comma-separated HEX colors when you want custom colors.
- **Status color map**: Pairs like `OK=#22c55e,FAILED=#ef4444`.

## Notes

- The widget attempts to auto-detect row arrays in common keys such as `rows`, `data`, and similar list-like fields.
- If no obvious row list is found, it normalizes the JSON payload into a best-effort table representation.
- Non-JSON item values are shown as an error message in the widget.
