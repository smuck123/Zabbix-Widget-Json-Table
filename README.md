# Zabbix JSON Table Widget

A custom Zabbix dashboard widget module that renders JSON data from a selected item into a readable table view.

## Features

- Converts JSON payloads into table rows and columns automatically.
- Optional summary cards for top-level metrics plus auto-generated row analytics (totals, unique hosts/processes, parsed counts, timestamp range).
- Optional grouping mode to summarize similar rows into one line with an `occurrences` counter.
- Optional expandable nested details per row.
- Optional inline chart blocks (bar/compact-bar/stacked-bar/dot/value-only/line/lollipop/soft-area).
- Status badges with configurable color mapping.
- Case-insensitive column matching for visible columns and chart selectors.
- Display controls for compact mode, dark header, visible columns, row filtering (errors/keywords), and row-limiting for very large payloads.

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
- **Summarize similar rows (group & count)**: Collapse repetitive rows into grouped entries with `occurrences`.
- **Group-by columns**: Optional comma-separated grouping keys (for example: `host,process,message`).
- **Normalize message text before grouping**: Replaces dynamic ids/timestamps/numbers in `message` so semantically similar lines group together.
- **Dark table header** / **Compact mode**: Visual style options.
- **Filter rows: errors only**: Show only rows containing error-like terms (for example: `error`, `failed`, `critical`).
- **Filter rows: keywords**: Optional comma-separated keywords to keep matching rows (for example: `timeout,denied,database`).
- **Visible table columns**: Comma-separated allow-list of columns.
- **Chart label/value columns**: Explicit chart column selection.
- **Chart type**: `bar`, `compact-bar`, `stacked-bar`, `dot`, `value-only`, `line`, `lollipop`, or `soft-area` (default: `bar`).
- **Show second chart panel**: Optional second chart block with its own label/value columns and chart type.
- **Max chart rows**: Limit number of plotted rows (default: `10`).
- **Max table rows**: Limit rendered rows for performance on large datasets; widget displays a truncation notice (default: `200`).
- **History values to merge**: Number of latest history values to parse and merge into one table so bursts of logs are shown together (default: `1`, latest value only).
- **Status colors**: Pick from a 15-color chooser (Green, Amber, Red, Blue, Violet, Cyan, Teal, Orange, Pink, Gray, Slate, Indigo, Lime, Brown, Black).
- **Color theme**: Choose one of 10 built-in chart palettes: `ocean`, `violet`, `forest`, `sunset`, `fire`, `ice`, `mono`, `neon`, `pastel`, `earth`.
- **Chart palette override**: Optional comma-separated HEX colors when you want custom colors.
- **Status color map**: Pairs like `OK=#22c55e,FAILED=#ef4444`.

## Notes

- The widget attempts to auto-detect row arrays in common keys such as `rows`, `data`, and similar list-like fields.
- If no obvious row list is found, it normalizes the JSON payload into a best-effort table representation.
- Non-JSON item values are shown as an error message in the widget.
