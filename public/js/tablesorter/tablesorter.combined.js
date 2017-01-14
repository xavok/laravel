/**!
 * TableSorter 2.16.1 - Client-side table sorting with ease!
 * @requires jQuery v1.2.6+
 *
 * Copyright (c) 2007 Christian Bach
 * Examples and docs at: http://tablesorter.com
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * @type jQuery
 * @name tablesorter
 * @cat Plugins/Tablesorter
 * @author Christian Bach/christian.bach@polyester.se
 * @contributor Rob Garrison/https://github.com/Mottie/tablesorter
 */
/*jshint browser:true, jquery:true, unused:false, expr: true */
/*global console:false, alert:false */
!(function($) {
    "use strict";
    $.extend({
        /*jshint supernew:true */
        tablesorter: new function() {

            var ts = this;

            ts.version = "2.16.1";

            ts.parsers = [];
            ts.widgets = [];
            ts.defaults = {

                // *** appearance
                theme            : 'default',  // adds tablesorter-{theme} to the table for styling
                widthFixed       : false,      // adds colgroup to fix widths of columns
                showProcessing   : false,      // show an indeterminate timer icon in the header when the table is sorted or filtered.

                headerTemplate   : '{content}',// header layout template (HTML ok); {content} = innerHTML, {icon} = <i/> (class from cssIcon)
                onRenderTemplate : null,       // function(index, template){ return template; }, (template is a string)
                onRenderHeader   : null,       // function(index){}, (nothing to return)

                // *** functionality
                cancelSelection  : true,       // prevent text selection in the header
                tabIndex         : true,       // add tabindex to header for keyboard accessibility
                dateFormat       : 'mmddyyyy', // other options: "ddmmyyy" or "yyyymmdd"
                sortMultiSortKey : 'shiftKey', // key used to select additional columns
                sortResetKey     : 'ctrlKey',  // key used to remove sorting on a column
                usNumberFormat   : true,       // false for German "1.234.567,89" or French "1 234 567,89"
                delayInit        : false,      // if false, the parsed table contents will not update until the first sort
                serverSideSorting: false,      // if true, server-side sorting should be performed because client-side sorting will be disabled, but the ui and events will still be used.

                // *** sort options
                headers          : {},         // set sorter, string, empty, locked order, sortInitialOrder, filter, etc.
                ignoreCase       : true,       // ignore case while sorting
                sortForce        : null,       // column(s) first sorted; always applied
                sortList         : [],         // Initial sort order; applied initially; updated when manually sorted
                sortAppend       : null,       // column(s) sorted last; always applied
                sortStable       : false,      // when sorting two rows with exactly the same content, the original sort order is maintained

                sortInitialOrder : 'asc',      // sort direction on first click
                sortLocaleCompare: false,      // replace equivalent character (accented characters)
                sortReset        : false,      // third click on the header will reset column to default - unsorted
                sortRestart      : false,      // restart sort to "sortInitialOrder" when clicking on previously unsorted columns

                emptyTo          : 'bottom',   // sort empty cell to bottom, top, none, zero
                stringTo         : 'max',      // sort strings in numerical column as max, min, top, bottom, zero
                textExtraction   : 'basic',    // text extraction method/function - function(node, table, cellIndex){}
                textAttribute    : 'data-text',// data-attribute that contains alternate cell text (used in textExtraction function)
                textSorter       : null,       // choose overall or specific column sorter function(a, b, direction, table, columnIndex) [alt: ts.sortText]
                numberSorter     : null,       // choose overall numeric sorter function(a, b, direction, maxColumnValue)

                // *** widget options
                widgets: [],                   // method to add widgets, e.g. widgets: ['zebra']
                widgetOptions    : {
                    zebra : [ 'even', 'odd' ]    // zebra widget alternating row class names
                },
                initWidgets      : true,       // apply widgets on tablesorter initialization

                // *** callbacks
                initialized      : null,       // function(table){},

                // *** extra css class names
                tableClass       : '',
                cssAsc           : '',
                cssDesc          : '',
                cssNone          : '',
                cssHeader        : '',
                cssHeaderRow     : '',
                cssProcessing    : '', // processing icon applied to header during sort/filter

                cssChildRow      : 'tablesorter-childRow', // class name indiciating that a row is to be attached to the its parent
                cssIcon          : 'tablesorter-icon',     //  if this class exists, a <i> will be added to the header automatically
                cssInfoBlock     : 'tablesorter-infoOnly', // don't sort tbody with this class name (only one class name allowed here!)

                // *** selectors
                selectorHeaders  : '> thead th, > thead td',
                selectorSort     : 'th, td',   // jQuery selector of content within selectorHeaders that is clickable to trigger a sort
                selectorRemove   : '.remove-me',

                // *** advanced
                debug            : false,

                // *** Internal variables
                headerList: [],
                empties: {},
                strings: {},
                parsers: []

                // deprecated; but retained for backwards compatibility
                // widgetZebra: { css: ["even", "odd"] }

            };

            // internal css classes - these will ALWAYS be added to
            // the table and MUST only contain one class name - fixes #381
            ts.css = {
                table      : 'tablesorter',
                cssHasChild: 'tablesorter-hasChildRow',
                childRow   : 'tablesorter-childRow',
                header     : 'tablesorter-header',
                headerRow  : 'tablesorter-headerRow',
                headerIn   : 'tablesorter-header-inner',
                icon       : 'tablesorter-icon',
                info       : 'tablesorter-infoOnly',
                processing : 'tablesorter-processing',
                sortAsc    : 'tablesorter-headerAsc',
                sortDesc   : 'tablesorter-headerDesc',
                sortNone   : 'tablesorter-headerUnSorted'
            };

            // labels applied to sortable headers for accessibility (aria) support
            ts.language = {
                sortAsc  : 'Ascending sort applied, ',
                sortDesc : 'Descending sort applied, ',
                sortNone : 'No sort applied, ',
                nextAsc  : 'activate to apply an ascending sort',
                nextDesc : 'activate to apply a descending sort',
                nextNone : 'activate to remove the sort'
            };

            /* debuging utils */
            function log() {
                var a = arguments[0],
                    s = arguments.length > 1 ? Array.prototype.slice.call(arguments) : a;
                if (typeof console !== "undefined" && typeof console.log !== "undefined") {
                    console[ /error/i.test(a) ? 'error' : /warn/i.test(a) ? 'warn' : 'log' ](s);
                } else {
                    alert(s);
                }
            }

            function benchmark(s, d) {
                log(s + " (" + (new Date().getTime() - d.getTime()) + "ms)");
            }

            ts.log = log;
            ts.benchmark = benchmark;

            // $.isEmptyObject from jQuery v1.4
            function isEmptyObject(obj) {
                /*jshint forin: false */
                for (var name in obj) {
                    return false;
                }
                return true;
            }

            function getElementText(table, node, cellIndex) {
                if (!node) { return ""; }
                var c = table.config,
                    t = c.textExtraction || '',
                    text = "";
                if (t === "basic") {
                    // check data-attribute first
                    text = $(node).attr(c.textAttribute) || node.textContent || node.innerText || $(node).text() || "";
                } else {
                    if (typeof(t) === "function") {
                        text = t(node, table, cellIndex);
                    } else if (typeof(t) === "object" && t.hasOwnProperty(cellIndex)) {
                        text = t[cellIndex](node, table, cellIndex);
                    } else {
                        // previous "simple" method
                        text = node.textContent || node.innerText || $(node).text() || "";
                    }
                }
                return $.trim(text);
            }

            function detectParserForColumn(table, rows, rowIndex, cellIndex) {
                var cur,
                    i = ts.parsers.length,
                    node = false,
                    nodeValue = '',
                    keepLooking = true;
                while (nodeValue === '' && keepLooking) {
                    rowIndex++;
                    if (rows[rowIndex]) {
                        node = rows[rowIndex].cells[cellIndex];
                        nodeValue = getElementText(table, node, cellIndex);
                        if (table.config.debug) {
                            log('Checking if value was empty on row ' + rowIndex + ', column: ' + cellIndex + ': "' + nodeValue + '"');
                        }
                    } else {
                        keepLooking = false;
                    }
                }
                while (--i >= 0) {
                    cur = ts.parsers[i];
                    // ignore the default text parser because it will always be true
                    if (cur && cur.id !== 'text' && cur.is && cur.is(nodeValue, table, node)) {
                        return cur;
                    }
                }
                // nothing found, return the generic parser (text)
                return ts.getParserById('text');
            }

            function buildParserCache(table) {
                var c = table.config,
                // update table bodies in case we start with an empty table
                    tb = c.$tbodies = c.$table.children('tbody:not(.' + c.cssInfoBlock + ')'),
                    rows, list, l, i, h, ch, p, time,
                    j = 0,
                    parsersDebug = "",
                    len = tb.length;
                if ( len === 0) {
                    return c.debug ? log('Warning: *Empty table!* Not building a parser cache') : '';
                } else if (c.debug) {
                    time = new Date();
                    log('Detecting parsers for each column');
                }
                list = [];
                while (j < len) {
                    rows = tb[j].rows;
                    if (rows[j]) {
                        l = rows[j].cells.length;
                        for (i = 0; i < l; i++) {
                            // tons of thanks to AnthonyM1229 for working out the following selector (issue #74) to make this work in IE8!
                            // More fixes to this selector to work properly in iOS and jQuery 1.8+ (issue #132 & #174)
                            h = c.$headers.filter(':not([colspan])');
                            h = h.add( c.$headers.filter('[colspan="1"]') ) // ie8 fix
                                .filter('[data-column="' + i + '"]:last');
                            ch = c.headers[i];
                            // get column parser
                            p = ts.getParserById( ts.getData(h, ch, 'sorter') );
                            // empty cells behaviour - keeping emptyToBottom for backwards compatibility
                            c.empties[i] = ts.getData(h, ch, 'empty') || c.emptyTo || (c.emptyToBottom ? 'bottom' : 'top' );
                            // text strings behaviour in numerical sorts
                            c.strings[i] = ts.getData(h, ch, 'string') || c.stringTo || 'max';
                            if (!p) {
                                p = detectParserForColumn(table, rows, -1, i);
                            }
                            if (c.debug) {
                                parsersDebug += "column:" + i + "; parser:" + p.id + "; string:" + c.strings[i] + '; empty: ' + c.empties[i] + "\n";
                            }
                            list.push(p);
                        }
                    }
                    j += (list.length) ? len : 1;
                }
                if (c.debug) {
                    log(parsersDebug ? parsersDebug : "No parsers detected");
                    benchmark("Completed detecting parsers", time);
                }
                c.parsers = list;
            }

            /* utils */
            function buildCache(table) {
                var cc, t, v, i, j, k, $row, rows, cols, cacheTime,
                    totalRows, rowData, colMax,
                    c = table.config,
                    $tb = c.$table.children('tbody'),
                    parsers = c.parsers;
                c.cache = {};
                // if no parsers found, return - it's an empty table.
                if (!parsers) {
                    return c.debug ? log('Warning: *Empty table!* Not building a cache') : '';
                }
                if (c.debug) {
                    cacheTime = new Date();
                }
                // processing icon
                if (c.showProcessing) {
                    ts.isProcessing(table, true);
                }
                for (k = 0; k < $tb.length; k++) {
                    colMax = []; // column max value per tbody
                    cc = c.cache[k] = {
                        normalized: [] // array of normalized row data; last entry contains "rowData" above
                        // colMax: #   // added at the end
                    };

                    // ignore tbodies with class name from c.cssInfoBlock
                    if (!$tb.eq(k).hasClass(c.cssInfoBlock)) {
                        totalRows = ($tb[k] && $tb[k].rows.length) || 0;
                        for (i = 0; i < totalRows; ++i) {
                            rowData = {
                                // order: original row order #
                                // $row : jQuery Object[]
                                child: [] // child row text (filter widget)
                            };
                            /** Add the table data to main data array */
                            $row = $($tb[k].rows[i]);
                            rows = [ new Array(c.columns) ];
                            cols = [];
                            // if this is a child row, add it to the last row's children and continue to the next row
                            // ignore child row class, if it is the first row
                            if ($row.hasClass(c.cssChildRow) && i !== 0) {
                                t = cc.normalized.length - 1;
                                cc.normalized[t][c.columns].$row = cc.normalized[t][c.columns].$row.add($row);
                                // add "hasChild" class name to parent row
                                if (!$row.prev().hasClass(c.cssChildRow)) {
                                    $row.prev().addClass(ts.css.cssHasChild);
                                }
                                // save child row content (un-parsed!)
                                rowData.child[t] = $.trim( $row[0].textContent || $row[0].innerText || $row.text() || "" );
                                // go to the next for loop
                                continue;
                            }
                            rowData.$row = $row;
                            rowData.order = i; // add original row position to rowCache
                            for (j = 0; j < c.columns; ++j) {
                                if (typeof parsers[j] === 'undefined') {
                                    if (c.debug) {
                                        log('No parser found for cell:', $row[0].cells[j], 'does it have a header?');
                                    }
                                    continue;
                                }
                                t = getElementText(table, $row[0].cells[j], j);
                                // allow parsing if the string is empty, previously parsing would change it to zero,
                                // in case the parser needs to extract data from the table cell attributes
                                v = parsers[j].format(t, table, $row[0].cells[j], j);
                                cols.push(v);
                                if ((parsers[j].type || '').toLowerCase() === "numeric") {
                                    // determine column max value (ignore sign)
                                    colMax[j] = Math.max(Math.abs(v) || 0, colMax[j] || 0);
                                }
                            }
                            // ensure rowData is always in the same location (after the last column)
                            cols[c.columns] = rowData;
                            cc.normalized.push(cols);
                        }
                        cc.colMax = colMax;
                    }
                }
                if (c.showProcessing) {
                    ts.isProcessing(table); // remove processing icon
                }
                if (c.debug) {
                    benchmark("Building cache for " + totalRows + " rows", cacheTime);
                }
            }

            // init flag (true) used by pager plugin to prevent widget application
            function appendToTable(table, init) {
                var c = table.config,
                    wo = c.widgetOptions,
                    b = table.tBodies,
                    rows = [],
                    cc = c.cache,
                    n, totalRows, $bk, $tb,
                    i, k, appendTime;
                // empty table - fixes #206/#346
                if (isEmptyObject(cc)) {
                    // run pager appender in case the table was just emptied
                    return c.appender ? c.appender(table, rows) :
                        table.isUpdating ? c.$table.trigger("updateComplete", table) : ''; // Fixes #532
                }
                if (c.debug) {
                    appendTime = new Date();
                }
                for (k = 0; k < b.length; k++) {
                    $bk = $(b[k]);
                    if ($bk.length && !$bk.hasClass(c.cssInfoBlock)) {
                        // get tbody
                        $tb = ts.processTbody(table, $bk, true);
                        n = cc[k].normalized;
                        totalRows = n.length;
                        for (i = 0; i < totalRows; i++) {
                            rows.push(n[i][c.columns].$row);
                            // removeRows used by the pager plugin; don't render if using ajax - fixes #411
                            if (!c.appender || (c.pager && (!c.pager.removeRows || !wo.pager_removeRows) && !c.pager.ajax)) {
                                $tb.append(n[i][c.columns].$row);
                            }
                        }
                        // restore tbody
                        ts.processTbody(table, $tb, false);
                    }
                }
                if (c.appender) {
                    c.appender(table, rows);
                }
                if (c.debug) {
                    benchmark("Rebuilt table", appendTime);
                }
                // apply table widgets; but not before ajax completes
                if (!init && !c.appender) { ts.applyWidget(table); }
                if (table.isUpdating) {
                    c.$table.trigger("updateComplete", table);
                }
            }

            function formatSortingOrder(v) {
                // look for "d" in "desc" order; return true
                return (/^d/i.test(v) || v === 1);
            }

            function buildHeaders(table) {
                var ch, $t,
                    h, i, t, lock, time,
                    c = table.config;
                c.headerList = [];
                c.headerContent = [];
                if (c.debug) {
                    time = new Date();
                }
                // children tr in tfoot - see issue #196 & #547
                c.columns = ts.computeColumnIndex( c.$table.children('thead, tfoot').children('tr') );
                // add icon if cssIcon option exists
                i = c.cssIcon ? '<i class="' + ( c.cssIcon === ts.css.icon ? ts.css.icon : c.cssIcon + ' ' + ts.css.icon ) + '"></i>' : '';
                c.$headers = $(table).find(c.selectorHeaders).each(function(index) {
                    $t = $(this);
                    ch = c.headers[index];
                    c.headerContent[index] = $(this).html(); // save original header content
                    // set up header template
                    t = c.headerTemplate.replace(/\{content\}/g, $(this).html()).replace(/\{icon\}/g, i);
                    if (c.onRenderTemplate) {
                        h = c.onRenderTemplate.apply($t, [index, t]);
                        if (h && typeof h === 'string') { t = h; } // only change t if something is returned
                    }
                    $(this).html('<div class="' + ts.css.headerIn + '">' + t + '</div>'); // faster than wrapInner

                    if (c.onRenderHeader) { c.onRenderHeader.apply($t, [index]); }
                    this.column = parseInt( $(this).attr('data-column'), 10);
                    this.order = formatSortingOrder( ts.getData($t, ch, 'sortInitialOrder') || c.sortInitialOrder ) ? [1,0,2] : [0,1,2];
                    this.count = -1; // set to -1 because clicking on the header automatically adds one
                    this.lockedOrder = false;
                    lock = ts.getData($t, ch, 'lockedOrder') || false;
                    if (typeof lock !== 'undefined' && lock !== false) {
                        this.order = this.lockedOrder = formatSortingOrder(lock) ? [1,1,1] : [0,0,0];
                    }
                    $t.addClass(ts.css.header + ' ' + c.cssHeader);
                    // add cell to headerList
                    c.headerList[index] = this;
                    // add to parent in case there are multiple rows
                    $t.parent().addClass(ts.css.headerRow + ' ' + c.cssHeaderRow).attr('role', 'row');
                    // allow keyboard cursor to focus on element
                    if (c.tabIndex) { $t.attr("tabindex", 0); }
                }).attr({
                    scope: 'col',
                    role : 'columnheader'
                });
                // enable/disable sorting
                updateHeader(table);
                if (c.debug) {
                    benchmark("Built headers:", time);
                    log(c.$headers);
                }
            }

            function commonUpdate(table, resort, callback) {
                var c = table.config;
                // remove rows/elements before update
                c.$table.find(c.selectorRemove).remove();
                // rebuild parsers
                buildParserCache(table);
                // rebuild the cache map
                buildCache(table);
                checkResort(c.$table, resort, callback);
            }

            function updateHeader(table) {
                var s, $th, c = table.config;
                c.$headers.each(function(index, th){
                    $th = $(th);
                    s = ts.getData( th, c.headers[index], 'sorter' ) === 'false';
                    th.sortDisabled = s;
                    $th[ s ? 'addClass' : 'removeClass' ]('sorter-false').attr('aria-disabled', '' + s);
                    // aria-controls - requires table ID
                    if (table.id) {
                        if (s) {
                            $th.removeAttr('aria-controls');
                        } else {
                            $th.attr('aria-controls', table.id);
                        }
                    }
                });
            }

            function setHeadersCss(table) {
                var f, i, j, l,
                    c = table.config,
                    list = c.sortList,
                    none = ts.css.sortNone + ' ' + c.cssNone,
                    css = [ts.css.sortAsc + ' ' + c.cssAsc, ts.css.sortDesc + ' ' + c.cssDesc],
                    aria = ['ascending', 'descending'],
                // find the footer
                    $t = $(table).find('tfoot tr').children().removeClass(css.join(' '));
                // remove all header information
                c.$headers
                    .removeClass(css.join(' '))
                    .addClass(none).attr('aria-sort', 'none');
                l = list.length;
                for (i = 0; i < l; i++) {
                    // direction = 2 means reset!
                    if (list[i][1] !== 2) {
                        // multicolumn sorting updating - choose the :last in case there are nested columns
                        f = c.$headers.not('.sorter-false').filter('[data-column="' + list[i][0] + '"]' + (l === 1 ? ':last' : '') );
                        if (f.length) {
                            for (j = 0; j < f.length; j++) {
                                if (!f[j].sortDisabled) {
                                    f.eq(j).removeClass(none).addClass(css[list[i][1]]).attr('aria-sort', aria[list[i][1]]);
                                    // add sorted class to footer, if it exists
                                    if ($t.length) {
                                        $t.filter('[data-column="' + list[i][0] + '"]').eq(j).addClass(css[list[i][1]]);
                                    }
                                }
                            }
                        }
                    }
                }
                // add verbose aria labels
                c.$headers.not('.sorter-false').each(function(){
                    var $this = $(this),
                        nextSort = this.order[(this.count + 1) % (c.sortReset ? 3 : 2)],
                        txt = $this.text() + ': ' +
                            ts.language[ $this.hasClass(ts.css.sortAsc) ? 'sortAsc' : $this.hasClass(ts.css.sortDesc) ? 'sortDesc' : 'sortNone' ] +
                            ts.language[ nextSort === 0 ? 'nextAsc' : nextSort === 1 ? 'nextDesc' : 'nextNone' ];
                    $this.attr('aria-label', txt );
                });
            }

            // automatically add col group, and column sizes if set
            function fixColumnWidth(table) {
                if (table.config.widthFixed && $(table).find('colgroup').length === 0) {
                    var colgroup = $('<colgroup>'),
                        overallWidth = $(table).width();
                    // only add col for visible columns - fixes #371
                    $(table.tBodies[0]).find("tr:first").children("td:visible").each(function() {
                        colgroup.append($('<col>').css('width', parseInt(($(this).width()/overallWidth)*1000, 10)/10 + '%'));
                    });
                    $(table).prepend(colgroup);
                }
            }

            function updateHeaderSortCount(table, list) {
                var s, t, o, c = table.config,
                    sl = list || c.sortList;
                c.sortList = [];
                $.each(sl, function(i,v){
                    // ensure all sortList values are numeric - fixes #127
                    s = [ parseInt(v[0], 10), parseInt(v[1], 10) ];
                    // make sure header exists
                    o = c.$headers[s[0]];
                    if (o) { // prevents error if sorton array is wrong
                        c.sortList.push(s);
                        t = $.inArray(s[1], o.order); // fixes issue #167
                        o.count = t >= 0 ? t : s[1] % (c.sortReset ? 3 : 2);
                    }
                });
            }

            function getCachedSortType(parsers, i) {
                return (parsers && parsers[i]) ? parsers[i].type || '' : '';
            }

            function initSort(table, cell, event){
                var arry, indx, col, order, s,
                    c = table.config,
                    key = !event[c.sortMultiSortKey],
                    $table = c.$table;
                // Only call sortStart if sorting is enabled
                $table.trigger("sortStart", table);
                // get current column sort order
                cell.count = event[c.sortResetKey] ? 2 : (cell.count + 1) % (c.sortReset ? 3 : 2);
                // reset all sorts on non-current column - issue #30
                if (c.sortRestart) {
                    indx = cell;
                    c.$headers.each(function() {
                        // only reset counts on columns that weren't just clicked on and if not included in a multisort
                        if (this !== indx && (key || !$(this).is('.' + ts.css.sortDesc + ',.' + ts.css.sortAsc))) {
                            this.count = -1;
                        }
                    });
                }
                // get current column index
                indx = cell.column;
                // user only wants to sort on one column
                if (key) {
                    // flush the sort list
                    c.sortList = [];
                    if (c.sortForce !== null) {
                        arry = c.sortForce;
                        for (col = 0; col < arry.length; col++) {
                            if (arry[col][0] !== indx) {
                                c.sortList.push(arry[col]);
                            }
                        }
                    }
                    // add column to sort list
                    order = cell.order[cell.count];
                    if (order < 2) {
                        c.sortList.push([indx, order]);
                        // add other columns if header spans across multiple
                        if (cell.colSpan > 1) {
                            for (col = 1; col < cell.colSpan; col++) {
                                c.sortList.push([indx + col, order]);
                            }
                        }
                    }
                    // multi column sorting
                } else {
                    // get rid of the sortAppend before adding more - fixes issue #115 & #523
                    if (c.sortAppend && c.sortList.length > 1) {
                        for (col = 0; col < c.sortAppend.length; col++) {
                            s = ts.isValueInArray(c.sortAppend[col][0], c.sortList);
                            if (s >= 0) {
                                c.sortList.splice(s,1);
                            }
                        }
                    }
                    // the user has clicked on an already sorted column
                    if (ts.isValueInArray(indx, c.sortList) >= 0) {
                        // reverse the sorting direction
                        for (col = 0; col < c.sortList.length; col++) {
                            s = c.sortList[col];
                            order = c.$headers[s[0]];
                            if (s[0] === indx) {
                                // order.count seems to be incorrect when compared to cell.count
                                s[1] = order.order[cell.count];
                                if (s[1] === 2) {
                                    c.sortList.splice(col,1);
                                    order.count = -1;
                                }
                            }
                        }
                    } else {
                        // add column to sort list array
                        order = cell.order[cell.count];
                        if (order < 2) {
                            c.sortList.push([indx, order]);
                            // add other columns if header spans across multiple
                            if (cell.colSpan > 1) {
                                for (col = 1; col < cell.colSpan; col++) {
                                    c.sortList.push([indx + col, order]);
                                }
                            }
                        }
                    }
                }
                if (c.sortAppend !== null) {
                    arry = c.sortAppend;
                    for (col = 0; col < arry.length; col++) {
                        if (arry[col][0] !== indx) {
                            c.sortList.push(arry[col]);
                        }
                    }
                }
                // sortBegin event triggered immediately before the sort
                $table.trigger("sortBegin", table);
                // setTimeout needed so the processing icon shows up
                setTimeout(function(){
                    // set css for headers
                    setHeadersCss(table);
                    multisort(table);
                    appendToTable(table);
                    $table.trigger("sortEnd", table);
                }, 1);
            }

            // sort multiple columns
            function multisort(table) { /*jshint loopfunc:true */
                var i, k, num, col, sortTime, colMax,
                    cache, order, sort, x, y,
                    dir = 0,
                    c = table.config,
                    cts = c.textSorter || '',
                    sortList = c.sortList,
                    l = sortList.length,
                    bl = table.tBodies.length;
                if (c.serverSideSorting || isEmptyObject(c.cache)) { // empty table - fixes #206/#346
                    return;
                }
                if (c.debug) { sortTime = new Date(); }
                for (k = 0; k < bl; k++) {
                    colMax = c.cache[k].colMax;
                    cache = c.cache[k].normalized;

                    cache.sort(function(a, b) {
                        // cache is undefined here in IE, so don't use it!
                        for (i = 0; i < l; i++) {
                            col = sortList[i][0];
                            order = sortList[i][1];
                            // sort direction, true = asc, false = desc
                            dir = order === 0;

                            if (c.sortStable && a[col] === b[col] && l === 1) {
                                return a[c.columns].order - b[c.columns].order;
                            }

                            // fallback to natural sort since it is more robust
                            num = /n/i.test(getCachedSortType(c.parsers, col));
                            if (num && c.strings[col]) {
                                // sort strings in numerical columns
                                if (typeof (c.string[c.strings[col]]) === 'boolean') {
                                    num = (dir ? 1 : -1) * (c.string[c.strings[col]] ? -1 : 1);
                                } else {
                                    num = (c.strings[col]) ? c.string[c.strings[col]] || 0 : 0;
                                }
                                // fall back to built-in numeric sort
                                // var sort = $.tablesorter["sort" + s](table, a[c], b[c], c, colMax[c], dir);
                                sort = c.numberSorter ? c.numberSorter(a[col], b[col], dir, colMax[col], table) :
                                    ts[ 'sortNumeric' + (dir ? 'Asc' : 'Desc') ](a[col], b[col], num, colMax[col], col, table);
                            } else {
                                // set a & b depending on sort direction
                                x = dir ? a : b;
                                y = dir ? b : a;
                                // text sort function
                                if (typeof(cts) === 'function') {
                                    // custom OVERALL text sorter
                                    sort = cts(x[col], y[col], dir, col, table);
                                } else if (typeof(cts) === 'object' && cts.hasOwnProperty(col)) {
                                    // custom text sorter for a SPECIFIC COLUMN
                                    sort = cts[col](x[col], y[col], dir, col, table);
                                } else {
                                    // fall back to natural sort
                                    sort = ts[ 'sortNatural' + (dir ? 'Asc' : 'Desc') ](a[col], b[col], col, table, c);
                                }
                            }
                            if (sort) { return sort; }
                        }
                        return a[c.columns].order - b[c.columns].order;
                    });
                }
                if (c.debug) { benchmark("Sorting on " + sortList.toString() + " and dir " + order + " time", sortTime); }
            }

            function resortComplete($table, callback){
                var table = $table[0];
                if (table.isUpdating) {
                    $table.trigger('updateComplete');
                }
                if ($.isFunction(callback)) {
                    callback($table[0]);
                }
            }

            function checkResort($table, flag, callback) {
                var sl = $table[0].config.sortList;
                // don't try to resort if the table is still processing
                // this will catch spamming of the updateCell method
                if (flag !== false && !$table[0].isProcessing && sl.length) {
                    $table.trigger("sorton", [sl, function(){
                        resortComplete($table, callback);
                    }, true]);
                } else {
                    resortComplete($table, callback);
                    ts.applyWidget($table[0], false);
                }
            }

            function bindMethods(table){
                var c = table.config,
                    $table = c.$table;
                // apply easy methods that trigger bound events
                $table
                    .unbind('sortReset update updateRows updateCell updateAll addRows updateComplete sorton appendCache updateCache applyWidgetId applyWidgets refreshWidgets destroy mouseup mouseleave '.split(' ').join(c.namespace + ' '))
                    .bind("sortReset" + c.namespace, function(e, callback){
                        e.stopPropagation();
                        c.sortList = [];
                        setHeadersCss(table);
                        multisort(table);
                        appendToTable(table);
                        if ($.isFunction(callback)) {
                            callback(table);
                        }
                    })
                    .bind("updateAll" + c.namespace, function(e, resort, callback){
                        e.stopPropagation();
                        table.isUpdating = true;
                        ts.refreshWidgets(table, true, true);
                        ts.restoreHeaders(table);
                        buildHeaders(table);
                        ts.bindEvents(table, c.$headers);
                        bindMethods(table);
                        commonUpdate(table, resort, callback);
                    })
                    .bind("update" + c.namespace + " updateRows" + c.namespace, function(e, resort, callback) {
                        e.stopPropagation();
                        table.isUpdating = true;
                        // update sorting (if enabled/disabled)
                        updateHeader(table);
                        commonUpdate(table, resort, callback);
                    })
                    .bind("updateCell" + c.namespace, function(e, cell, resort, callback) {
                        e.stopPropagation();
                        table.isUpdating = true;
                        $table.find(c.selectorRemove).remove();
                        // get position from the dom
                        var v, row, icell,
                            $tb = $table.find('tbody'),
                            $cell = $(cell),
                        // update cache - format: function(s, table, cell, cellIndex)
                        // no closest in jQuery v1.2.6 - tbdy = $tb.index( $(cell).closest('tbody') ),$row = $(cell).closest('tr');
                            tbdy = $tb.index( $cell.parents('tbody').filter(':first') ),
                            $row = $cell.parents('tr').filter(':first');
                        cell = $cell[0]; // in case cell is a jQuery object
                        // tbody may not exist if update is initialized while tbody is removed for processing
                        if ($tb.length && tbdy >= 0) {
                            row = $tb.eq(tbdy).find('tr').index( $row );
                            icell = $cell.index();
                            c.cache[tbdy].normalized[row][c.columns].$row = $row;
                            v = c.cache[tbdy].normalized[row][icell] = c.parsers[icell].format( getElementText(table, cell, icell), table, cell, icell );
                            if ((c.parsers[icell].type || '').toLowerCase() === "numeric") {
                                // update column max value (ignore sign)
                                c.cache[tbdy].colMax[icell] = Math.max(Math.abs(v) || 0, c.cache[tbdy].colMax[icell] || 0);
                            }
                            checkResort($table, resort, callback);
                        }
                    })
                    .bind("addRows" + c.namespace, function(e, $row, resort, callback) {
                        e.stopPropagation();
                        table.isUpdating = true;
                        if (isEmptyObject(c.cache)) {
                            // empty table, do an update instead - fixes #450
                            updateHeader(table);
                            commonUpdate(table, resort, callback);
                        } else {
                            var i, j, l, rowData, cells,
                                rows = $row.filter('tr').length,
                                tbdy = $table.find('tbody').index( $row.parents('tbody').filter(':first') );
                            // fixes adding rows to an empty table - see issue #179
                            if (!(c.parsers && c.parsers.length)) {
                                buildParserCache(table);
                            }
                            // add each row
                            for (i = 0; i < rows; i++) {
                                l = $row[i].cells.length;
                                cells = [];
                                rowData = {
                                    child: [],
                                    $row : $row.eq(i),
                                    order: c.cache[tbdy].normalized.length
                                };
                                // add each cell
                                for (j = 0; j < l; j++) {
                                    cells[j] = c.parsers[j].format( getElementText(table, $row[i].cells[j], j), table, $row[i].cells[j], j );
                                    if ((c.parsers[j].type || '').toLowerCase() === "numeric") {
                                        // update column max value (ignore sign)
                                        c.cache[tbdy].colMax[j] = Math.max(Math.abs(cells[j]) || 0, c.cache[tbdy].colMax[j] || 0);
                                    }
                                }
                                // add the row data to the end
                                cells.push(rowData);
                                // update cache
                                c.cache[tbdy].normalized.push(cells);
                            }
                            // resort using current settings
                            checkResort($table, resort, callback);
                        }
                    })
                    .bind("updateComplete" + c.namespace, function(){
                        table.isUpdating = false;
                    })
                    .bind("sorton" + c.namespace, function(e, list, callback, init) {
                        var c = table.config;
                        e.stopPropagation();
                        $table.trigger("sortStart", this);
                        // update header count index
                        updateHeaderSortCount(table, list);
                        // set css for headers
                        setHeadersCss(table);
                        // fixes #346
                        if (c.delayInit && isEmptyObject(c.cache)) { buildCache(table); }
                        $table.trigger("sortBegin", this);
                        // sort the table and append it to the dom
                        multisort(table);
                        appendToTable(table, init);
                        $table.trigger("sortEnd", this);
                        ts.applyWidget(table);
                        if ($.isFunction(callback)) {
                            callback(table);
                        }
                    })
                    .bind("appendCache" + c.namespace, function(e, callback, init) {
                        e.stopPropagation();
                        appendToTable(table, init);
                        if ($.isFunction(callback)) {
                            callback(table);
                        }
                    })
                    .bind("updateCache" + c.namespace, function(e, callback){
                        // rebuild parsers
                        if (!(c.parsers && c.parsers.length)) {
                            buildParserCache(table);
                        }
                        // rebuild the cache map
                        buildCache(table);
                        if ($.isFunction(callback)) {
                            callback(table);
                        }
                    })
                    .bind("applyWidgetId" + c.namespace, function(e, id) {
                        e.stopPropagation();
                        ts.getWidgetById(id).format(table, c, c.widgetOptions);
                    })
                    .bind("applyWidgets" + c.namespace, function(e, init) {
                        e.stopPropagation();
                        // apply widgets
                        ts.applyWidget(table, init);
                    })
                    .bind("refreshWidgets" + c.namespace, function(e, all, dontapply){
                        e.stopPropagation();
                        ts.refreshWidgets(table, all, dontapply);
                    })
                    .bind("destroy" + c.namespace, function(e, c, cb){
                        e.stopPropagation();
                        ts.destroy(table, c, cb);
                    });
            }

            /* public methods */
            ts.construct = function(settings) {
                return this.each(function() {
                    var table = this,
                    // merge & extend config options
                        c = $.extend(true, {}, ts.defaults, settings);
                    // create a table from data (build table widget)
                    if (!table.hasInitialized && ts.buildTable && this.tagName !== 'TABLE') {
                        // return the table (in case the original target is the table's container)
                        ts.buildTable(table, c);
                    } else {
                        ts.setup(table, c);
                    }
                });
            };

            ts.setup = function(table, c) {
                // if no thead or tbody, or tablesorter is already present, quit
                if (!table || !table.tHead || table.tBodies.length === 0 || table.hasInitialized === true) {
                    return c.debug ? log('ERROR: stopping initialization! No table, thead, tbody or tablesorter has already been initialized') : '';
                }

                var k = '',
                    $table = $(table),
                    m = $.metadata;
                // initialization flag
                table.hasInitialized = false;
                // table is being processed flag
                table.isProcessing = true;
                // make sure to store the config object
                table.config = c;
                // save the settings where they read
                $.data(table, "tablesorter", c);
                if (c.debug) { $.data( table, 'startoveralltimer', new Date()); }

                // removing this in version 3 (only supports jQuery 1.7+)
                c.supportsDataObject = (function(version) {
                    version[0] = parseInt(version[0], 10);
                    return (version[0] > 1) || (version[0] === 1 && parseInt(version[1], 10) >= 4);
                })($.fn.jquery.split("."));
                // digit sort text location; keeping max+/- for backwards compatibility
                c.string = { 'max': 1, 'min': -1, 'max+': 1, 'max-': -1, 'zero': 0, 'none': 0, 'null': 0, 'top': true, 'bottom': false };
                // add table theme class only if there isn't already one there
                if (!/tablesorter\-/.test($table.attr('class'))) {
                    k = (c.theme !== '' ? ' tablesorter-' + c.theme : '');
                }
                c.$table = $table
                    .addClass(ts.css.table + ' ' + c.tableClass + k)
                    .attr({ role : 'grid'});

                // give the table a unique id, which will be used in namespace binding
                if (!c.namespace) {
                    c.namespace = '.tablesorter' + Math.random().toString(16).slice(2);
                } else {
                    // make sure namespace starts with a period & doesn't have weird characters
                    c.namespace = '.' + c.namespace.replace(/\W/g,'');
                }

                c.$tbodies = $table.children('tbody:not(.' + c.cssInfoBlock + ')').attr({
                    'aria-live' : 'polite',
                    'aria-relevant' : 'all'
                });
                if (c.$table.find('caption').length) {
                    c.$table.attr('aria-labelledby', 'theCaption');
                }
                c.widgetInit = {}; // keep a list of initialized widgets
                // change textExtraction via data-attribute
                c.textExtraction = c.$table.attr('data-text-extraction') || c.textExtraction || 'basic';
                // build headers
                buildHeaders(table);
                // fixate columns if the users supplies the fixedWidth option
                // do this after theme has been applied
                fixColumnWidth(table);
                // try to auto detect column type, and store in tables config
                buildParserCache(table);
                // build the cache for the tbody cells
                // delayInit will delay building the cache until the user starts a sort
                if (!c.delayInit) { buildCache(table); }
                // bind all header events and methods
                ts.bindEvents(table, c.$headers);
                bindMethods(table);
                // get sort list from jQuery data or metadata
                // in jQuery < 1.4, an error occurs when calling $table.data()
                if (c.supportsDataObject && typeof $table.data().sortlist !== 'undefined') {
                    c.sortList = $table.data().sortlist;
                } else if (m && ($table.metadata() && $table.metadata().sortlist)) {
                    c.sortList = $table.metadata().sortlist;
                }
                // apply widget init code
                ts.applyWidget(table, true);
                // if user has supplied a sort list to constructor
                if (c.sortList.length > 0) {
                    $table.trigger("sorton", [c.sortList, {}, !c.initWidgets, true]);
                } else {
                    setHeadersCss(table);
                    if (c.initWidgets) {
                        // apply widget format
                        setTimeout(function(){
                            ts.applyWidget(table, false);
                        }, 0);
                    }
                }

                // show processesing icon
                if (c.showProcessing) {
                    $table
                        .unbind('sortBegin' + c.namespace + ' sortEnd' + c.namespace)
                        .bind('sortBegin' + c.namespace + ' sortEnd' + c.namespace, function(e) {
                            ts.isProcessing(table, e.type === 'sortBegin');
                        });
                }

                // initialized
                table.hasInitialized = true;
                table.isProcessing = false;
                if (c.debug) {
                    ts.benchmark("Overall initialization time", $.data( table, 'startoveralltimer'));
                }
                $table.trigger('tablesorter-initialized', table);
                if (typeof c.initialized === 'function') { c.initialized(table); }
            };


            // computeTableHeaderCellIndexes from:
            // http://www.javascripttoolbox.com/lib/table/examples.php
            // http://www.javascripttoolbox.com/temp/table_cellindex.html
            ts.computeColumnIndex = function(trs) {
                var matrix = [],
                    lookup = {},
                    cols = 0, // determine the number of columns
                    i, j, k, l, $cell, cell, cells, rowIndex, cellId, rowSpan, colSpan, firstAvailCol, matrixrow;
                for (i = 0; i < trs.length; i++) {
                    cells = trs[i].cells;
                    for (j = 0; j < cells.length; j++) {
                        cell = cells[j];
                        $cell = $(cell);
                        rowIndex = cell.parentNode.rowIndex;
                        cellId = rowIndex + "-" + $cell.index();
                        rowSpan = cell.rowSpan || 1;
                        colSpan = cell.colSpan || 1;
                        if (typeof(matrix[rowIndex]) === "undefined") {
                            matrix[rowIndex] = [];
                        }
                        // Find first available column in the first row
                        for (k = 0; k < matrix[rowIndex].length + 1; k++) {
                            if (typeof(matrix[rowIndex][k]) === "undefined") {
                                firstAvailCol = k;
                                break;
                            }
                        }
                        lookup[cellId] = firstAvailCol;
                        cols = Math.max(firstAvailCol, cols);
                        // add data-column
                        $cell.attr({ 'data-column' : firstAvailCol }); // 'data-row' : rowIndex
                        for (k = rowIndex; k < rowIndex + rowSpan; k++) {
                            if (typeof(matrix[k]) === "undefined") {
                                matrix[k] = [];
                            }
                            matrixrow = matrix[k];
                            for (l = firstAvailCol; l < firstAvailCol + colSpan; l++) {
                                matrixrow[l] = "x";
                            }
                        }
                    }
                }
                // may not be accurate if # header columns !== # tbody columns
                return cols + 1; // add one because it's a zero-based index
            };

            // *** Process table ***
            // add processing indicator
            ts.isProcessing = function(table, toggle, $ths) {
                table = $(table);
                var c = table[0].config,
                // default to all headers
                    $h = $ths || table.find('.' + ts.css.header);
                if (toggle) {
                    // don't use sortList if custom $ths used
                    if (typeof $ths !== 'undefined' && c.sortList.length > 0) {
                        // get headers from the sortList
                        $h = $h.filter(function(){
                            // get data-column from attr to keep  compatibility with jQuery 1.2.6
                            return this.sortDisabled ? false : ts.isValueInArray( parseFloat($(this).attr('data-column')), c.sortList) >= 0;
                        });
                    }
                    $h.addClass(ts.css.processing + ' ' + c.cssProcessing);
                } else {
                    $h.removeClass(ts.css.processing + ' ' + c.cssProcessing);
                }
            };

            // detach tbody but save the position
            // don't use tbody because there are portions that look for a tbody index (updateCell)
            ts.processTbody = function(table, $tb, getIt){
                table = $(table)[0];
                var holdr;
                if (getIt) {
                    table.isProcessing = true;
                    $tb.before('<span class="tablesorter-savemyplace"/>');
                    holdr = ($.fn.detach) ? $tb.detach() : $tb.remove();
                    return holdr;
                }
                holdr = $(table).find('span.tablesorter-savemyplace');
                $tb.insertAfter( holdr );
                holdr.remove();
                table.isProcessing = false;
            };

            ts.clearTableBody = function(table) {
                $(table)[0].config.$tbodies.empty();
            };

            ts.bindEvents = function(table, $headers){
                table = $(table)[0];
                var downTime,
                    c = table.config;
                // apply event handling to headers and/or additional headers (stickyheaders, scroller, etc)
                $headers
                // http://stackoverflow.com/questions/5312849/jquery-find-self;
                    .find(c.selectorSort).add( $headers.filter(c.selectorSort) )
                    .unbind('mousedown mouseup sort keyup '.split(' ').join(c.namespace + ' '))
                    .bind('mousedown mouseup sort keyup '.split(' ').join(c.namespace + ' '), function(e, external) {
                        var cell, type = e.type;
                        // only recognize left clicks or enter
                        if ( ((e.which || e.button) !== 1 && !/sort|keyup/.test(type)) || (type === 'keyup' && e.which !== 13) ) {
                            return;
                        }
                        // ignore long clicks (prevents resizable widget from initializing a sort)
                        if (type === 'mouseup' && external !== true && (new Date().getTime() - downTime > 250)) { return; }
                        // set timer on mousedown
                        if (type === 'mousedown') {
                            downTime = new Date().getTime();
                            return e.target.tagName === "INPUT" ? '' : !c.cancelSelection;
                        }
                        if (c.delayInit && isEmptyObject(c.cache)) { buildCache(table); }
                        // jQuery v1.2.6 doesn't have closest()
                        cell = /TH|TD/.test(this.tagName) ? this : $(this).parents('th, td')[0];
                        // reference original table headers and find the same cell
                        cell = c.$headers[ $headers.index( cell ) ];
                        if (!cell.sortDisabled) {
                            initSort(table, cell, e);
                        }
                    });
                if (c.cancelSelection) {
                    // cancel selection
                    $headers
                        .attr('unselectable', 'on')
                        .bind('selectstart', false)
                        .css({
                            'user-select': 'none',
                            'MozUserSelect': 'none' // not needed for jQuery 1.8+
                        });
                }
            };

            // restore headers
            ts.restoreHeaders = function(table){
                var c = $(table)[0].config;
                // don't use c.$headers here in case header cells were swapped
                c.$table.find(c.selectorHeaders).each(function(i){
                    // only restore header cells if it is wrapped
                    // because this is also used by the updateAll method
                    if ($(this).find('.' + ts.css.headerIn).length){
                        $(this).html( c.headerContent[i] );
                    }
                });
            };

            ts.destroy = function(table, removeClasses, callback){
                table = $(table)[0];
                if (!table.hasInitialized) { return; }
                // remove all widgets
                ts.refreshWidgets(table, true, true);
                var $t = $(table), c = table.config,
                    $h = $t.find('thead:first'),
                    $r = $h.find('tr.' + ts.css.headerRow).removeClass(ts.css.headerRow + ' ' + c.cssHeaderRow),
                    $f = $t.find('tfoot:first > tr').children('th, td');
                if (removeClasses === false && $.inArray('uitheme', c.widgets) >= 0) {
                    // reapply uitheme classes, in case we want to maintain appearance
                    $t.trigger('applyWidgetId', ['uitheme']);
                    $t.trigger('applyWidgetId', ['zebra']);
                }
                // remove widget added rows, just in case
                $h.find('tr').not($r).remove();
                // disable tablesorter
                $t
                    .removeData('tablesorter')
                    .unbind('sortReset update updateAll updateRows updateCell addRows updateComplete sorton appendCache updateCache applyWidgetId applyWidgets refreshWidgets destroy mouseup mouseleave keypress sortBegin sortEnd '.split(' ').join(c.namespace + ' '));
                c.$headers.add($f)
                    .removeClass( [ts.css.header, c.cssHeader, c.cssAsc, c.cssDesc, ts.css.sortAsc, ts.css.sortDesc, ts.css.sortNone].join(' ') )
                    .removeAttr('data-column')
                    .removeAttr('aria-label')
                    .attr('aria-disabled', 'true');
                $r.find(c.selectorSort).unbind('mousedown mouseup keypress '.split(' ').join(c.namespace + ' '));
                ts.restoreHeaders(table);
                $t.toggleClass(ts.css.table + ' ' + c.tableClass + ' tablesorter-' + c.theme, removeClasses === false);
                // clear flag in case the plugin is initialized again
                table.hasInitialized = false;
                delete table.config.cache;
                if (typeof callback === 'function') {
                    callback(table);
                }
            };

            // *** sort functions ***
            // regex used in natural sort
            ts.regex = {
                chunk : /(^([+\-]?(?:0|[1-9]\d*)(?:\.\d*)?(?:[eE][+\-]?\d+)?)?$|^0x[0-9a-f]+$|\d+)/gi, // chunk/tokenize numbers & letters
                chunks: /(^\\0|\\0$)/, // replace chunks @ ends
                hex: /^0x[0-9a-f]+$/i // hex
            };

            // Natural sort - https://github.com/overset/javascript-natural-sort (date sorting removed)
            ts.sortNatural = function(a, b) {
                if (a === b) { return 0; }
                var xN, xD, yN, yD, xF, yF, i, mx,
                    r = ts.regex;
                // first try and sort Hex codes
                if (r.hex.test(b)) {
                    xD = parseInt(a.match(r.hex), 16);
                    yD = parseInt(b.match(r.hex), 16);
                    if ( xD < yD ) { return -1; }
                    if ( xD > yD ) { return 1; }
                }
                // chunk/tokenize
                xN = a.replace(r.chunk, '\\0$1\\0').replace(r.chunks, '').split('\\0');
                yN = b.replace(r.chunk, '\\0$1\\0').replace(r.chunks, '').split('\\0');
                mx = Math.max(xN.length, yN.length);
                // natural sorting through split numeric strings and default strings
                for (i = 0; i < mx; i++) {
                    // find floats not starting with '0', string or 0 if not defined
                    xF = isNaN(xN[i]) ? xN[i] || 0 : parseFloat(xN[i]) || 0;
                    yF = isNaN(yN[i]) ? yN[i] || 0 : parseFloat(yN[i]) || 0;
                    // handle numeric vs string comparison - number < string - (Kyle Adams)
                    if (isNaN(xF) !== isNaN(yF)) { return (isNaN(xF)) ? 1 : -1; }
                    // rely on string comparison if different types - i.e. '02' < 2 != '02' < '2'
                    if (typeof xF !== typeof yF) {
                        xF += '';
                        yF += '';
                    }
                    if (xF < yF) { return -1; }
                    if (xF > yF) { return 1; }
                }
                return 0;
            };

            ts.sortNaturalAsc = function(a, b, col, table, c) {
                if (a === b) { return 0; }
                var e = c.string[ (c.empties[col] || c.emptyTo ) ];
                if (a === '' && e !== 0) { return typeof e === 'boolean' ? (e ? -1 : 1) : -e || -1; }
                if (b === '' && e !== 0) { return typeof e === 'boolean' ? (e ? 1 : -1) : e || 1; }
                return ts.sortNatural(a, b);
            };

            ts.sortNaturalDesc = function(a, b, col, table, c) {
                if (a === b) { return 0; }
                var e = c.string[ (c.empties[col] || c.emptyTo ) ];
                if (a === '' && e !== 0) { return typeof e === 'boolean' ? (e ? -1 : 1) : e || 1; }
                if (b === '' && e !== 0) { return typeof e === 'boolean' ? (e ? 1 : -1) : -e || -1; }
                return ts.sortNatural(b, a);
            };

            // basic alphabetical sort
            ts.sortText = function(a, b) {
                return a > b ? 1 : (a < b ? -1 : 0);
            };

            // return text string value by adding up ascii value
            // so the text is somewhat sorted when using a digital sort
            // this is NOT an alphanumeric sort
            ts.getTextValue = function(a, num, mx) {
                if (mx) {
                    // make sure the text value is greater than the max numerical value (mx)
                    var i, l = a ? a.length : 0, n = mx + num;
                    for (i = 0; i < l; i++) {
                        n += a.charCodeAt(i);
                    }
                    return num * n;
                }
                return 0;
            };

            ts.sortNumericAsc = function(a, b, num, mx, col, table) {
                if (a === b) { return 0; }
                var c = table.config,
                    e = c.string[ (c.empties[col] || c.emptyTo ) ];
                if (a === '' && e !== 0) { return typeof e === 'boolean' ? (e ? -1 : 1) : -e || -1; }
                if (b === '' && e !== 0) { return typeof e === 'boolean' ? (e ? 1 : -1) : e || 1; }
                if (isNaN(a)) { a = ts.getTextValue(a, num, mx); }
                if (isNaN(b)) { b = ts.getTextValue(b, num, mx); }
                return a - b;
            };

            ts.sortNumericDesc = function(a, b, num, mx, col, table) {
                if (a === b) { return 0; }
                var c = table.config,
                    e = c.string[ (c.empties[col] || c.emptyTo ) ];
                if (a === '' && e !== 0) { return typeof e === 'boolean' ? (e ? -1 : 1) : e || 1; }
                if (b === '' && e !== 0) { return typeof e === 'boolean' ? (e ? 1 : -1) : -e || -1; }
                if (isNaN(a)) { a = ts.getTextValue(a, num, mx); }
                if (isNaN(b)) { b = ts.getTextValue(b, num, mx); }
                return b - a;
            };

            ts.sortNumeric = function(a, b) {
                return a - b;
            };

            // used when replacing accented characters during sorting
            ts.characterEquivalents = {
                "a" : "\u00e1\u00e0\u00e2\u00e3\u00e4\u0105\u00e5", // ÃƒÂ¡Ãƒ ÃƒÂ¢ÃƒÂ£ÃƒÂ¤Ã„â€¦ÃƒÂ¥
                "A" : "\u00c1\u00c0\u00c2\u00c3\u00c4\u0104\u00c5", // ÃƒÂÃƒâ‚¬Ãƒâ€šÃƒÆ’Ãƒâ€žÃ„â€žÃƒâ€¦
                "c" : "\u00e7\u0107\u010d", // ÃƒÂ§Ã„â€¡Ã„Â
                "C" : "\u00c7\u0106\u010c", // Ãƒâ€¡Ã„â€ Ã„Å’
                "e" : "\u00e9\u00e8\u00ea\u00eb\u011b\u0119", // ÃƒÂ©ÃƒÂ¨ÃƒÂªÃƒÂ«Ã„â€ºÃ„â„¢
                "E" : "\u00c9\u00c8\u00ca\u00cb\u011a\u0118", // Ãƒâ€°ÃƒË†ÃƒÅ Ãƒâ€¹Ã„Å¡Ã„Ëœ
                "i" : "\u00ed\u00ec\u0130\u00ee\u00ef\u0131", // ÃƒÂ­ÃƒÂ¬Ã„Â°ÃƒÂ®ÃƒÂ¯Ã„Â±
                "I" : "\u00cd\u00cc\u0130\u00ce\u00cf", // ÃƒÂÃƒÅ’Ã„Â°ÃƒÅ½ÃƒÂ
                "o" : "\u00f3\u00f2\u00f4\u00f5\u00f6", // ÃƒÂ³ÃƒÂ²ÃƒÂ´ÃƒÂµÃƒÂ¶
                "O" : "\u00d3\u00d2\u00d4\u00d5\u00d6", // Ãƒâ€œÃƒâ€™Ãƒâ€Ãƒâ€¢Ãƒâ€“
                "ss": "\u00df", // ÃƒÅ¸ (s sharp)
                "SS": "\u1e9e", // Ã¡ÂºÅ¾ (Capital sharp s)
                "u" : "\u00fa\u00f9\u00fb\u00fc\u016f", // ÃƒÂºÃƒÂ¹ÃƒÂ»ÃƒÂ¼Ã…Â¯
                "U" : "\u00da\u00d9\u00db\u00dc\u016e" // ÃƒÅ¡Ãƒâ„¢Ãƒâ€ºÃƒÅ“Ã…Â®
            };
            ts.replaceAccents = function(s) {
                var a, acc = '[', eq = ts.characterEquivalents;
                if (!ts.characterRegex) {
                    ts.characterRegexArray = {};
                    for (a in eq) {
                        if (typeof a === 'string') {
                            acc += eq[a];
                            ts.characterRegexArray[a] = new RegExp('[' + eq[a] + ']', 'g');
                        }
                    }
                    ts.characterRegex = new RegExp(acc + ']');
                }
                if (ts.characterRegex.test(s)) {
                    for (a in eq) {
                        if (typeof a === 'string') {
                            s = s.replace( ts.characterRegexArray[a], a );
                        }
                    }
                }
                return s;
            };

            // *** utilities ***
            ts.isValueInArray = function(column, arry) {
                var indx, len = arry.length;
                for (indx = 0; indx < len; indx++) {
                    if (arry[indx][0] === column) {
                        return indx;
                    }
                }
                return -1;
            };

            ts.addParser = function(parser) {
                var i, l = ts.parsers.length, a = true;
                for (i = 0; i < l; i++) {
                    if (ts.parsers[i].id.toLowerCase() === parser.id.toLowerCase()) {
                        a = false;
                    }
                }
                if (a) {
                    ts.parsers.push(parser);
                }
            };

            ts.getParserById = function(name) {
                var i, l = ts.parsers.length;
                for (i = 0; i < l; i++) {
                    if (ts.parsers[i].id.toLowerCase() === (name.toString()).toLowerCase()) {
                        return ts.parsers[i];
                    }
                }
                return false;
            };

            ts.addWidget = function(widget) {
                ts.widgets.push(widget);
            };

            ts.getWidgetById = function(name) {
                var i, w, l = ts.widgets.length;
                for (i = 0; i < l; i++) {
                    w = ts.widgets[i];
                    if (w && w.hasOwnProperty('id') && w.id.toLowerCase() === name.toLowerCase()) {
                        return w;
                    }
                }
            };

            ts.applyWidget = function(table, init) {
                table = $(table)[0]; // in case this is called externally
                var c = table.config,
                    wo = c.widgetOptions,
                    widgets = [],
                    time, w, wd;
                // prevent numerous consecutive widget applications
                if (init !== false && table.hasInitialized && (table.isApplyingWidgets || table.isUpdating)) { return; }
                if (c.debug) { time = new Date(); }
                if (c.widgets.length) {
                    table.isApplyingWidgets = true;
                    // ensure unique widget ids
                    c.widgets = $.grep(c.widgets, function(v, k){
                        return $.inArray(v, c.widgets) === k;
                    });
                    // build widget array & add priority as needed
                    $.each(c.widgets || [], function(i,n){
                        wd = ts.getWidgetById(n);
                        if (wd && wd.id) {
                            // set priority to 10 if not defined
                            if (!wd.priority) { wd.priority = 10; }
                            widgets[i] = wd;
                        }
                    });
                    // sort widgets by priority
                    widgets.sort(function(a, b){
                        return a.priority < b.priority ? -1 : a.priority === b.priority ? 0 : 1;
                    });
                    // add/update selected widgets
                    $.each(widgets, function(i,w){
                        if (w) {
                            if (init || !(c.widgetInit[w.id])) {
                                if (w.hasOwnProperty('options')) {
                                    wo = table.config.widgetOptions = $.extend( true, {}, w.options, wo );
                                }
                                if (w.hasOwnProperty('init')) {
                                    w.init(table, w, c, wo);
                                }
                                c.widgetInit[w.id] = true;
                            }
                            if (!init && w.hasOwnProperty('format')) {
                                w.format(table, c, wo, false);
                            }
                        }
                    });
                }
                setTimeout(function(){
                    table.isApplyingWidgets = false;
                }, 0);
                if (c.debug) {
                    w = c.widgets.length;
                    benchmark("Completed " + (init === true ? "initializing " : "applying ") + w + " widget" + (w !== 1 ? "s" : ""), time);
                }
            };

            ts.refreshWidgets = function(table, doAll, dontapply) {
                table = $(table)[0]; // see issue #243
                var i, c = table.config,
                    cw = c.widgets,
                    w = ts.widgets, l = w.length;
                // remove previous widgets
                for (i = 0; i < l; i++){
                    if ( w[i] && w[i].id && (doAll || $.inArray( w[i].id, cw ) < 0) ) {
                        if (c.debug) { log( 'Refeshing widgets: Removing "' + w[i].id + '"' ); }
                        // only remove widgets that have been initialized - fixes #442
                        if (w[i].hasOwnProperty('remove') && c.widgetInit[w[i].id]) {
                            w[i].remove(table, c, c.widgetOptions);
                            c.widgetInit[w[i].id] = false;
                        }
                    }
                }
                if (dontapply !== true) {
                    ts.applyWidget(table, doAll);
                }
            };

            // get sorter, string, empty, etc options for each column from
            // jQuery data, metadata, header option or header class name ("sorter-false")
            // priority = jQuery data > meta > headers option > header class name
            ts.getData = function(h, ch, key) {
                var val = '', $h = $(h), m, cl;
                if (!$h.length) { return ''; }
                m = $.metadata ? $h.metadata() : false;
                cl = ' ' + ($h.attr('class') || '');
                if (typeof $h.data(key) !== 'undefined' || typeof $h.data(key.toLowerCase()) !== 'undefined'){
                    // "data-lockedOrder" is assigned to "lockedorder"; but "data-locked-order" is assigned to "lockedOrder"
                    // "data-sort-initial-order" is assigned to "sortInitialOrder"
                    val += $h.data(key) || $h.data(key.toLowerCase());
                } else if (m && typeof m[key] !== 'undefined') {
                    val += m[key];
                } else if (ch && typeof ch[key] !== 'undefined') {
                    val += ch[key];
                } else if (cl !== ' ' && cl.match(' ' + key + '-')) {
                    // include sorter class name "sorter-text", etc; now works with "sorter-my-custom-parser"
                    val = cl.match( new RegExp('\\s' + key + '-([\\w-]+)') )[1] || '';
                }
                return $.trim(val);
            };

            ts.formatFloat = function(s, table) {
                if (typeof s !== 'string' || s === '') { return s; }
                // allow using formatFloat without a table; defaults to US number format
                var i,
                    t = table && table.config ? table.config.usNumberFormat !== false :
                        typeof table !== "undefined" ? table : true;
                if (t) {
                    // US Format - 1,234,567.89 -> 1234567.89
                    s = s.replace(/,/g,'');
                } else {
                    // German Format = 1.234.567,89 -> 1234567.89
                    // French Format = 1 234 567,89 -> 1234567.89
                    s = s.replace(/[\s|\.]/g,'').replace(/,/g,'.');
                }
                if(/^\s*\([.\d]+\)/.test(s)) {
                    // make (#) into a negative number -> (10) = -10
                    s = s.replace(/^\s*\(([.\d]+)\)/, '-$1');
                }
                i = parseFloat(s);
                // return the text instead of zero
                return isNaN(i) ? $.trim(s) : i;
            };

            ts.isDigit = function(s) {
                // replace all unwanted chars and match
                return isNaN(s) ? (/^[\-+(]?\d+[)]?$/).test(s.toString().replace(/[,.'"\s]/g, '')) : true;
            };

        }()
    });

    // make shortcut
    var ts = $.tablesorter;

    // extend plugin scope
    $.fn.extend({
        tablesorter: ts.construct
    });

    // add default parsers
    ts.addParser({
        id: "text",
        is: function() {
            return true;
        },
        format: function(s, table) {
            var c = table.config;
            if (s) {
                s = $.trim( c.ignoreCase ? s.toLocaleLowerCase() : s );
                s = c.sortLocaleCompare ? ts.replaceAccents(s) : s;
            }
            return s;
        },
        type: "text"
    });

    ts.addParser({
        id: "digit",
        is: function(s) {
            return ts.isDigit(s);
        },
        format: function(s, table) {
            var n = ts.formatFloat((s || '').replace(/[^\w,. \-()]/g, ""), table);
            return s && typeof n === 'number' ? n : s ? $.trim( s && table.config.ignoreCase ? s.toLocaleLowerCase() : s ) : s;
        },
        type: "numeric"
    });

    ts.addParser({
        id: "currency",
        is: function(s) {
            return (/^\(?\d+[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]|[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]\d+\)?$/).test((s || '').replace(/[+\-,. ]/g,'')); // Ã‚Â£$Ã¢â€šÂ¬Ã‚Â¤Ã‚Â¥Ã‚Â¢
        },
        format: function(s, table) {
            var n = ts.formatFloat((s || '').replace(/[^\w,. \-()]/g, ""), table);
            return s && typeof n === 'number' ? n : s ? $.trim( s && table.config.ignoreCase ? s.toLocaleLowerCase() : s ) : s;
        },
        type: "numeric"
    });

    ts.addParser({
        id: "ipAddress",
        is: function(s) {
            return (/^\d{1,3}[\.]\d{1,3}[\.]\d{1,3}[\.]\d{1,3}$/).test(s);
        },
        format: function(s, table) {
            var i, a = s ? s.split(".") : '',
                r = "",
                l = a.length;
            for (i = 0; i < l; i++) {
                r += ("00" + a[i]).slice(-3);
            }
            return s ? ts.formatFloat(r, table) : s;
        },
        type: "numeric"
    });

    ts.addParser({
        id: "url",
        is: function(s) {
            return (/^(https?|ftp|file):\/\//).test(s);
        },
        format: function(s) {
            return s ? $.trim(s.replace(/(https?|ftp|file):\/\//, '')) : s;
        },
        type: "text"
    });

    ts.addParser({
        id: "isoDate",
        is: function(s) {
            return (/^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}/).test(s);
        },
        format: function(s, table) {
            return s ? ts.formatFloat((s !== "") ? (new Date(s.replace(/-/g, "/")).getTime() || s) : "", table) : s;
        },
        type: "numeric"
    });

    ts.addParser({
        id: "percent",
        is: function(s) {
            return (/(\d\s*?%|%\s*?\d)/).test(s) && s.length < 15;
        },
        format: function(s, table) {
            return s ? ts.formatFloat(s.replace(/%/g, ""), table) : s;
        },
        type: "numeric"
    });

    ts.addParser({
        id: "usLongDate",
        is: function(s) {
            // two digit years are not allowed cross-browser
            // Jan 01, 2013 12:34:56 PM or 01 Jan 2013
            return (/^[A-Z]{3,10}\.?\s+\d{1,2},?\s+(\d{4})(\s+\d{1,2}:\d{2}(:\d{2})?(\s+[AP]M)?)?$/i).test(s) || (/^\d{1,2}\s+[A-Z]{3,10}\s+\d{4}/i).test(s);
        },
        format: function(s, table) {
            return s ? ts.formatFloat( (new Date(s.replace(/(\S)([AP]M)$/i, "$1 $2")).getTime() || s), table) : s;
        },
        type: "numeric"
    });

    ts.addParser({
        id: "shortDate", // "mmddyyyy", "ddmmyyyy" or "yyyymmdd"
        is: function(s) {
            // testing for ##-##-#### or ####-##-##, so it's not perfect; time can be included
            return (/(^\d{1,2}[\/\s]\d{1,2}[\/\s]\d{4})|(^\d{4}[\/\s]\d{1,2}[\/\s]\d{1,2})/).test((s || '').replace(/\s+/g," ").replace(/[\-.,]/g, "/"));
        },
        format: function(s, table, cell, cellIndex) {
            if (s) {
                var c = table.config,
                    ci = c.$headers.filter('[data-column=' + cellIndex + ']:last'),
                    format = ci.length && ci[0].dateFormat || ts.getData( ci, c.headers[cellIndex], 'dateFormat') || c.dateFormat;
                s = s.replace(/\s+/g," ").replace(/[\-.,]/g, "/"); // escaped - because JSHint in Firefox was showing it as an error
                if (format === "mmddyyyy") {
                    s = s.replace(/(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/, "$3/$1/$2");
                } else if (format === "ddmmyyyy") {
                    s = s.replace(/(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/, "$3/$2/$1");
                } else if (format === "yyyymmdd") {
                    s = s.replace(/(\d{4})[\/\s](\d{1,2})[\/\s](\d{1,2})/, "$1/$2/$3");
                }
            }
            return s ? ts.formatFloat( (new Date(s).getTime() || s), table) : s;
        },
        type: "numeric"
    });

    ts.addParser({
        id: "time",
        is: function(s) {
            return (/^(([0-2]?\d:[0-5]\d)|([0-1]?\d:[0-5]\d\s?([AP]M)))$/i).test(s);
        },
        format: function(s, table) {
            return s ? ts.formatFloat( (new Date("2000/01/01 " + s.replace(/(\S)([AP]M)$/i, "$1 $2")).getTime() || s), table) : s;
        },
        type: "numeric"
    });

    ts.addParser({
        id: "metadata",
        is: function() {
            return false;
        },
        format: function(s, table, cell) {
            var c = table.config,
                p = (!c.parserMetadataName) ? 'sortValue' : c.parserMetadataName;
            return $(cell).metadata()[p];
        },
        type: "numeric"
    });

    // add default widgets
    ts.addWidget({
        id: "zebra",
        priority: 90,
        format: function(table, c, wo) {
            var $tb, $tv, $tr, row, even, time, k, l,
                child = new RegExp(c.cssChildRow, 'i'),
                b = c.$tbodies;
            if (c.debug) {
                time = new Date();
            }
            for (k = 0; k < b.length; k++ ) {
                // loop through the visible rows
                $tb = b.eq(k);
                l = $tb.children('tr').length;
                if (l > 1) {
                    row = 0;
                    $tv = $tb.children('tr:visible').not(c.selectorRemove);
                    // revered back to using jQuery each - strangely it's the fastest method
                    /*jshint loopfunc:true */
                    $tv.each(function(){
                        $tr = $(this);
                        // style children rows the same way the parent row was styled
                        if (!child.test(this.className)) { row++; }
                        even = (row % 2 === 0);
                        $tr.removeClass(wo.zebra[even ? 1 : 0]).addClass(wo.zebra[even ? 0 : 1]);
                    });
                }
            }
            if (c.debug) {
                ts.benchmark("Applying Zebra widget", time);
            }
        },
        remove: function(table, c, wo){
            var k, $tb,
                b = c.$tbodies,
                rmv = (wo.zebra || [ "even", "odd" ]).join(' ');
            for (k = 0; k < b.length; k++ ){
                $tb = $.tablesorter.processTbody(table, b.eq(k), true); // remove tbody
                $tb.children().removeClass(rmv);
                $.tablesorter.processTbody(table, $tb, false); // restore tbody
            }
        }
    });

})(jQuery);
/*! tableSorter 2.16+ widgets - updated 4/23/2014 (v2.16.0)
 *
 * Column Styles
 * Column Filters
 * Column Resizing
 * Sticky Header
 * UI Theme (generalized)
 * Save Sort
 * [ "columns", "filter", "resizable", "stickyHeaders", "uitheme", "saveSort" ]
 */
/*jshint browser:true, jquery:true, unused:false, loopfunc:true */
/*global jQuery: false, localStorage: false, navigator: false */
;(function($) {
    "use strict";
    var ts = $.tablesorter = $.tablesorter || {};

    ts.themes = {
        "bootstrap" : {
            table      : 'table table-bordered table-striped',
            caption    : 'caption',
            header     : 'bootstrap-header', // give the header a gradient background
            footerRow  : '',
            footerCells: '',
            icons      : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
            sortNone   : 'bootstrap-icon-unsorted',
            sortAsc    : 'icon-chevron-up glyphicon glyphicon-chevron-up',
            sortDesc   : 'icon-chevron-down glyphicon glyphicon-chevron-down',
            active     : '', // applied when column is sorted
            hover      : '', // use custom css here - bootstrap class may not override it
            filterRow  : '', // filter row class
            even       : '', // even row zebra striping
            odd        : ''  // odd row zebra striping
        },
        "jui" : {
            table      : 'ui-widget ui-widget-content ui-corner-all', // table classes
            caption    : 'ui-widget-content ui-corner-all',
            header     : 'ui-widget-header ui-corner-all ui-state-default', // header classes
            footerRow  : '',
            footerCells: '',
            icons      : 'ui-icon', // icon class added to the <i> in the header
            sortNone   : 'ui-icon-carat-2-n-s',
            sortAsc    : 'ui-icon-carat-1-n',
            sortDesc   : 'ui-icon-carat-1-s',
            active     : 'ui-state-active', // applied when column is sorted
            hover      : 'ui-state-hover',  // hover class
            filterRow  : '',
            even       : 'ui-widget-content', // even row zebra striping
            odd        : 'ui-state-default'   // odd row zebra striping
        }
    };

    $.extend(ts.css, {
        filterRow : 'tablesorter-filter-row',   // filter
        filter    : 'tablesorter-filter',
        wrapper   : 'tablesorter-wrapper',      // ui theme & resizable
        resizer   : 'tablesorter-resizer',      // resizable
        grip      : 'tablesorter-resizer-grip',
        sticky    : 'tablesorter-stickyHeader', // stickyHeader
        stickyVis : 'tablesorter-sticky-visible'
    });

// *** Store data in local storage, with a cookie fallback ***
    /* IE7 needs JSON library for JSON.stringify - (http://caniuse.com/#search=json)
     if you need it, then include https://github.com/douglascrockford/JSON-js

     $.parseJSON is not available is jQuery versions older than 1.4.1, using older
     versions will only allow storing information for one page at a time

     // *** Save data (JSON format only) ***
     // val must be valid JSON... use http://jsonlint.com/ to ensure it is valid
     var val = { "mywidget" : "data1" }; // valid JSON uses double quotes
     // $.tablesorter.storage(table, key, val);
     $.tablesorter.storage(table, 'tablesorter-mywidget', val);

     // *** Get data: $.tablesorter.storage(table, key); ***
     v = $.tablesorter.storage(table, 'tablesorter-mywidget');
     // val may be empty, so also check for your data
     val = (v && v.hasOwnProperty('mywidget')) ? v.mywidget : '';
     alert(val); // "data1" if saved, or "" if not
     */
    ts.storage = function(table, key, value, options) {
        table = $(table)[0];
        var cookieIndex, cookies, date,
            hasLocalStorage = false,
            values = {},
            c = table.config,
            $table = $(table),
            id = options && options.id || $table.attr(options && options.group ||
                    'data-table-group') || table.id || $('.tablesorter').index( $table ),
            url = options && options.url || $table.attr(options && options.page ||
                    'data-table-page') || c && c.fixedUrl || window.location.pathname;
        // https://gist.github.com/paulirish/5558557
        if ("localStorage" in window) {
            try {
                window.localStorage.setItem('_tmptest', 'temp');
                hasLocalStorage = true;
                window.localStorage.removeItem('_tmptest');
            } catch(error) {}
        }
        // *** get value ***
        if ($.parseJSON) {
            if (hasLocalStorage) {
                values = $.parseJSON(localStorage[key] || '{}');
            } else {
                // old browser, using cookies
                cookies = document.cookie.split(/[;\s|=]/);
                // add one to get from the key to the value
                cookieIndex = $.inArray(key, cookies) + 1;
                values = (cookieIndex !== 0) ? $.parseJSON(cookies[cookieIndex] || '{}') : {};
            }
        }
        // allow value to be an empty string too
        if ((value || value === '') && window.JSON && JSON.hasOwnProperty('stringify')) {
            // add unique identifiers = url pathname > table ID/index on page > data
            if (!values[url]) {
                values[url] = {};
            }
            values[url][id] = value;
            // *** set value ***
            if (hasLocalStorage) {
                localStorage[key] = JSON.stringify(values);
            } else {
                date = new Date();
                date.setTime(date.getTime() + (31536e+6)); // 365 days
                document.cookie = key + '=' + (JSON.stringify(values)).replace(/\"/g,'\"') + '; expires=' + date.toGMTString() + '; path=/';
            }
        } else {
            return values && values[url] ? values[url][id] : '';
        }
    };

// Add a resize event to table headers
// **************************
    ts.addHeaderResizeEvent = function(table, disable, settings) {
        var headers,
            defaults = {
                timer : 250
            },
            options = $.extend({}, defaults, settings),
            c = table.config,
            wo = c.widgetOptions,
            checkSizes = function(triggerEvent) {
                wo.resize_flag = true;
                headers = [];
                c.$headers.each(function() {
                    var $header = $(this),
                        sizes = $header.data('savedSizes') || [0,0], // fixes #394
                        width = this.offsetWidth,
                        height = this.offsetHeight;
                    if (width !== sizes[0] || height !== sizes[1]) {
                        $header.data('savedSizes', [ width, height ]);
                        headers.push(this);
                    }
                });
                if (headers.length && triggerEvent !== false) {
                    c.$table.trigger('resize', [ headers ]);
                }
                wo.resize_flag = false;
            };
        checkSizes(false);
        clearInterval(wo.resize_timer);
        if (disable) {
            wo.resize_flag = false;
            return false;
        }
        wo.resize_timer = setInterval(function() {
            if (wo.resize_flag) { return; }
            checkSizes();
        }, options.timer);
    };

// Widget: General UI theme
// "uitheme" option in "widgetOptions"
// **************************
    ts.addWidget({
        id: "uitheme",
        priority: 10,
        format: function(table, c, wo) {
            var time, classes, $header, $icon, $tfoot,
                themesAll = ts.themes,
                $table = c.$table,
                $headers = c.$headers,
                theme = c.theme || 'jui',
                themes = themesAll[theme] || themesAll.jui,
                remove = themes.sortNone + ' ' + themes.sortDesc + ' ' + themes.sortAsc;
            if (c.debug) { time = new Date(); }
            // initialization code - run once
            if (!$table.hasClass('tablesorter-' + theme) || c.theme === theme || !table.hasInitialized) {
                // update zebra stripes
                if (themes.even !== '') { wo.zebra[0] += ' ' + themes.even; }
                if (themes.odd !== '') { wo.zebra[1] += ' ' + themes.odd; }
                // add caption style
                $table.find('caption').addClass(themes.caption);
                // add table/footer class names
                $tfoot = $table
                // remove other selected themes
                    .removeClass( c.theme === '' ? '' : 'tablesorter-' + c.theme )
                    .addClass('tablesorter-' + theme + ' ' + themes.table) // add theme widget class name
                    .find('tfoot');
                if ($tfoot.length) {
                    $tfoot
                        .find('tr').addClass(themes.footerRow)
                        .children('th, td').addClass(themes.footerCells);
                }
                // update header classes
                $headers
                    .addClass(themes.header)
                    .not('.sorter-false')
                    .bind('mouseenter.tsuitheme mouseleave.tsuitheme', function(event) {
                        // toggleClass with switch added in jQuery 1.3
                        $(this)[ event.type === 'mouseenter' ? 'addClass' : 'removeClass' ](themes.hover);
                    });
                if (!$headers.find('.' + ts.css.wrapper).length) {
                    // Firefox needs this inner div to position the resizer correctly
                    $headers.wrapInner('<div class="' + ts.css.wrapper + '" style="position:relative;height:100%;width:100%"></div>');
                }
                if (c.cssIcon) {
                    // if c.cssIcon is '', then no <i> is added to the header
                    $headers.find('.' + ts.css.icon).addClass(themes.icons);
                }
                if ($table.hasClass('hasFilters')) {
                    $headers.find('.' + ts.css.filterRow).addClass(themes.filterRow);
                }
            }
            $.each($headers, function() {
                $header = $(this);
                $icon = (ts.css.icon) ? $header.find('.' + ts.css.icon) : $header;
                if (this.sortDisabled) {
                    // no sort arrows for disabled columns!
                    $header.removeClass(remove);
                    $icon.removeClass(remove + ' ' + themes.icons);
                } else {
                    classes = ($header.hasClass(ts.css.sortAsc)) ?
                        themes.sortAsc :
                        ($header.hasClass(ts.css.sortDesc)) ? themes.sortDesc :
                            $header.hasClass(ts.css.header) ? themes.sortNone : '';
                    $header[classes === themes.sortNone ? 'removeClass' : 'addClass'](themes.active);
                    $icon.removeClass(remove).addClass(classes);
                }
            });
            if (c.debug) {
                ts.benchmark("Applying " + theme + " theme", time);
            }
        },
        remove: function(table, c, wo) {
            var $table = c.$table,
                theme = c.theme || 'jui',
                themes = ts.themes[ theme ] || ts.themes.jui,
                $headers = $table.children('thead').children(),
                remove = themes.sortNone + ' ' + themes.sortDesc + ' ' + themes.sortAsc;
            $table
                .removeClass('tablesorter-' + theme + ' ' + themes.table)
                .find(ts.css.header).removeClass(themes.header);
            $headers
                .unbind('mouseenter.tsuitheme mouseleave.tsuitheme') // remove hover
                .removeClass(themes.hover + ' ' + remove + ' ' + themes.active)
                .find('.' + ts.css.filterRow)
                .removeClass(themes.filterRow);
            $headers.find('.' + ts.css.icon).removeClass(themes.icons);
        }
    });

// Widget: Column styles
// "columns", "columns_thead" (true) and
// "columns_tfoot" (true) options in "widgetOptions"
// **************************
    ts.addWidget({
        id: "columns",
        priority: 30,
        options : {
            columns : [ "primary", "secondary", "tertiary" ]
        },
        format: function(table, c, wo) {
            var time, $tbody, tbodyIndex, $rows, rows, $row, $cells, remove, indx,
                $table = c.$table,
                $tbodies = c.$tbodies,
                sortList = c.sortList,
                len = sortList.length,
            // removed c.widgetColumns support
                css = wo && wo.columns || [ "primary", "secondary", "tertiary" ],
                last = css.length - 1;
            remove = css.join(' ');
            if (c.debug) {
                time = new Date();
            }
            // check if there is a sort (on initialization there may not be one)
            for (tbodyIndex = 0; tbodyIndex < $tbodies.length; tbodyIndex++ ) {
                $tbody = ts.processTbody(table, $tbodies.eq(tbodyIndex), true); // detach tbody
                $rows = $tbody.children('tr');
                // loop through the visible rows
                $rows.each(function() {
                    $row = $(this);
                    if (this.style.display !== 'none') {
                        // remove all columns class names
                        $cells = $row.children().removeClass(remove);
                        // add appropriate column class names
                        if (sortList && sortList[0]) {
                            // primary sort column class
                            $cells.eq(sortList[0][0]).addClass(css[0]);
                            if (len > 1) {
                                for (indx = 1; indx < len; indx++) {
                                    // secondary, tertiary, etc sort column classes
                                    $cells.eq(sortList[indx][0]).addClass( css[indx] || css[last] );
                                }
                            }
                        }
                    }
                });
                ts.processTbody(table, $tbody, false);
            }
            // add classes to thead and tfoot
            rows = wo.columns_thead !== false ? ['thead tr'] : [];
            if (wo.columns_tfoot !== false) {
                rows.push('tfoot tr');
            }
            if (rows.length) {
                $rows = $table.find( rows.join(',') ).children().removeClass(remove);
                if (len) {
                    for (indx = 0; indx < len; indx++) {
                        // add primary. secondary, tertiary, etc sort column classes
                        $rows.filter('[data-column="' + sortList[indx][0] + '"]').addClass(css[indx] || css[last]);
                    }
                }
            }
            if (c.debug) {
                ts.benchmark("Applying Columns widget", time);
            }
        },
        remove: function(table, c, wo) {
            var tbodyIndex, $tbody,
                $tbodies = c.$tbodies,
                remove = (wo.columns || [ "primary", "secondary", "tertiary" ]).join(' ');
            c.$headers.removeClass(remove);
            c.$table.children('tfoot').children('tr').children('th, td').removeClass(remove);
            for (tbodyIndex = 0; tbodyIndex < $tbodies.length; tbodyIndex++ ) {
                $tbody = ts.processTbody(table, $tbodies.eq(tbodyIndex), true); // remove tbody
                $tbody.children('tr').each(function() {
                    $(this).children().removeClass(remove);
                });
                ts.processTbody(table, $tbody, false); // restore tbody
            }
        }
    });

// Widget: filter
// **************************
    ts.addWidget({
        id: "filter",
        priority: 50,
        options : {
            filter_childRows     : false, // if true, filter includes child row content in the search
            filter_columnFilters : true,  // if true, a filter will be added to the top of each table column
            filter_cssFilter     : '',    // css class name added to the filter row & each input in the row (tablesorter-filter is ALWAYS added)
            filter_external      : '',    // jQuery selector string (or jQuery object) of external filters
            filter_filteredRow   : 'filtered', // class added to filtered rows; needed by pager plugin
            filter_formatter     : null,  // add custom filter elements to the filter row
            filter_functions     : null,  // add custom filter functions using this option
            filter_hideEmpty     : true,  // hide filter row when table is empty
            filter_hideFilters   : false, // collapse filter row when mouse leaves the area
            filter_ignoreCase    : true,  // if true, make all searches case-insensitive
            filter_liveSearch    : true,  // if true, search column content while the user types (with a delay)
            filter_onlyAvail     : 'filter-onlyAvail', // a header with a select dropdown & this class name will only show available (visible) options within the drop down
            filter_placeholder   : { search : '', select : '' }, // default placeholder text (overridden by any header "data-placeholder" setting)
            filter_reset         : null,  // jQuery selector string of an element used to reset the filters
            filter_saveFilters   : false, // Use the $.tablesorter.storage utility to save the most recent filters
            filter_searchDelay   : 300,   // typing delay in milliseconds before starting a search
            filter_selectSource  : null,  // include a function to return an array of values to be added to the column filter select
            filter_startsWith    : false, // if true, filter start from the beginning of the cell contents
            filter_useParsedData : false, // filter all data using parsed content
            filter_serversideFiltering : false, // if true, server-side filtering should be performed because client-side filtering will be disabled, but the ui and events will still be used.
            filter_defaultAttrib : 'data-value' // data attribute in the header cell that contains the default filter value
        },
        format: function(table, c, wo) {
            if (!c.$table.hasClass('hasFilters')) {
                ts.filter.init(table, c, wo);
            }
        },
        remove: function(table, c, wo) {
            var tbodyIndex, $tbody,
                $table = c.$table,
                $tbodies = c.$tbodies;
            $table
                .removeClass('hasFilters')
                // add .tsfilter namespace to all BUT search
                .unbind('addRows updateCell update updateRows updateComplete appendCache filterReset filterEnd search '.split(' ').join(c.namespace + 'filter '))
                .find('.' + ts.css.filterRow).remove();
            for (tbodyIndex = 0; tbodyIndex < $tbodies.length; tbodyIndex++ ) {
                $tbody = ts.processTbody(table, $tbodies.eq(tbodyIndex), true); // remove tbody
                $tbody.children().removeClass(wo.filter_filteredRow).show();
                ts.processTbody(table, $tbody, false); // restore tbody
            }
            if (wo.filter_reset) {
                $(document).undelegate(wo.filter_reset, 'click.tsfilter');
            }
        }
    });

    ts.filter = {

        // regex used in filter "check" functions - not for general use and not documented
        regex: {
            regex     : /^\/((?:\\\/|[^\/])+)\/([mig]{0,3})?$/, // regex to test for regex
            child     : /tablesorter-childRow/, // child row class name; this gets updated in the script
            filtered  : /filtered/, // filtered (hidden) row class name; updated in the script
            type      : /undefined|number/, // check type
            exact     : /(^[\"|\'|=]+)|([\"|\'|=]+$)/g, // exact match (allow '==')
            nondigit  : /[^\w,. \-()]/g, // replace non-digits (from digit & currency parser)
            operators : /[<>=]/g // replace operators
        },
        // function( filter, iFilter, exact, iExact, cached, index, table, wo, parsed )
        // filter = array of filter input values; iFilter = same array, except lowercase
        // exact = table cell text (or parsed data if column parser enabled)
        // iExact = same as exact, except lowercase
        // cached = table cell text from cache, so it has been parsed
        // index = column index; table = table element (DOM)
        // wo = widget options (table.config.widgetOptions)
        // parsed = array (by column) of boolean values (from filter_useParsedData or "filter-parsed" class)
        types: {
            // Look for regex
            regex: function( filter, iFilter, exact, iExact ) {
                if ( ts.filter.regex.regex.test(iFilter) ) {
                    var matches,
                        regex = ts.filter.regex.regex.exec(iFilter);
                    try {
                        matches = new RegExp(regex[1], regex[2]).test( iExact );
                    } catch (error) {
                        matches = false;
                    }
                    return matches;
                }
                return null;
            },
            // Look for operators >, >=, < or <=
            operators: function( filter, iFilter, exact, iExact, cached, index, table, wo, parsed ) {
                if ( /^[<>]=?/.test(iFilter) ) {
                    var cachedValue, result,
                        c = table.config,
                        query = ts.formatFloat( iFilter.replace(ts.filter.regex.operators, ''), table ),
                        parser = c.parsers[index],
                        savedSearch = query;
                    // parse filter value in case we're comparing numbers (dates)
                    if (parsed[index] || parser.type === 'numeric') {
                        cachedValue = parser.format( '' + iFilter.replace(ts.filter.regex.operators, ''), table, c.$headers.eq(index), index );
                        query = ( typeof query === "number" && cachedValue !== '' && !isNaN(cachedValue) ) ? cachedValue : query;
                    }
                    // iExact may be numeric - see issue #149;
                    // check if cached is defined, because sometimes j goes out of range? (numeric columns)
                    cachedValue = ( parsed[index] || parser.type === 'numeric' ) && !isNaN(query) && cached ? cached :
                        isNaN(iExact) ? ts.formatFloat( iExact.replace(ts.filter.regex.nondigit, ''), table) :
                            ts.formatFloat( iExact, table );
                    if ( />/.test(iFilter) ) { result = />=/.test(iFilter) ? cachedValue >= query : cachedValue > query; }
                    if ( /</.test(iFilter) ) { result = /<=/.test(iFilter) ? cachedValue <= query : cachedValue < query; }
                    // keep showing all rows if nothing follows the operator
                    if ( !result && savedSearch === '' ) { result = true; }
                    return result;
                }
                return null;
            },
            // Look for quotes or equals to get an exact match; ignore type since iExact could be numeric
            exact: function( filter, iFilter, exact, iExact, cached, index, table, wo, parsed, rowArray ) {
                /*jshint eqeqeq:false */
                if (ts.filter.regex.exact.test(iFilter)) {
                    var fltr = iFilter.replace(ts.filter.regex.exact, '');
                    return rowArray ? $.inArray(fltr, rowArray) >= 0 : fltr == iExact;
                }
                return null;
            },
            // Look for a not match
            notMatch: function( filter, iFilter, exact, iExact, cached, index, table, wo ) {
                if ( /^\!/.test(iFilter) ) {
                    iFilter = iFilter.replace('!', '');
                    var indx = iExact.search( $.trim(iFilter) );
                    return iFilter === '' ? true : !(wo.filter_startsWith ? indx === 0 : indx >= 0);
                }
                return null;
            },
            // Look for an AND or && operator (logical and)
            and : function( filter, iFilter, exact, iExact ) {
                if ( /\s+(AND|&&)\s+/g.test(filter) ) {
                    var query = iFilter.split( /(?:\s+(?:and|&&)\s+)/g ),
                        result = iExact.search( $.trim(query[0]) ) >= 0,
                        indx = query.length - 1;
                    while (result && indx) {
                        result = result && iExact.search( $.trim(query[indx]) ) >= 0;
                        indx--;
                    }
                    return result;
                }
                return null;
            },
            // Look for a range (using " to " or " - ") - see issue #166; thanks matzhu!
            range : function( filter, iFilter, exact, iExact, cached, index, table, wo, parsed ) {
                if ( /\s+(-|to)\s+/.test(iFilter) ) {
                    var result, tmp,
                        c = table.config,
                        query = iFilter.split(/(?: - | to )/), // make sure the dash is for a range and not indicating a negative number
                        range1 = ts.formatFloat(query[0].replace(ts.filter.regex.nondigit, ''), table),
                        range2 = ts.formatFloat(query[1].replace(ts.filter.regex.nondigit, ''), table);
                    // parse filter value in case we're comparing numbers (dates)
                    if (parsed[index] || c.parsers[index].type === 'numeric') {
                        result = c.parsers[index].format('' + query[0], table, c.$headers.eq(index), index);
                        range1 = (result !== '' && !isNaN(result)) ? result : range1;
                        result = c.parsers[index].format('' + query[1], table, c.$headers.eq(index), index);
                        range2 = (result !== '' && !isNaN(result)) ? result : range2;
                    }
                    result = ( parsed[index] || c.parsers[index].type === 'numeric' ) && !isNaN(range1) && !isNaN(range2) ? cached :
                        isNaN(iExact) ? ts.formatFloat( iExact.replace(ts.filter.regex.nondigit, ''), table) :
                            ts.formatFloat( iExact, table );
                    if (range1 > range2) { tmp = range1; range1 = range2; range2 = tmp; } // swap
                    return (result >= range1 && result <= range2) || (range1 === '' || range2 === '');
                }
                return null;
            },
            // Look for wild card: ? = single, * = multiple, or | = logical OR
            wild : function( filter, iFilter, exact, iExact, cached, index, table, wo, parsed, rowArray ) {
                if ( /[\?|\*]/.test(iFilter) || /\s+OR\s+/i.test(filter) ) {
                    var c = table.config,
                        query = iFilter.replace(/\s+OR\s+/gi,"|");
                    // look for an exact match with the "or" unless the "filter-match" class is found
                    if (!c.$headers.filter('[data-column="' + index + '"]:last').hasClass('filter-match') && /\|/.test(query)) {
                        query = $.isArray(rowArray) ? '(' + query + ')' : '^(' + query + ')$';
                    }
                    return new RegExp( query.replace(/\?/g, '\\S{1}').replace(/\*/g, '\\S*') ).test(iExact);
                }
                return null;
            },
            // fuzzy text search; modified from https://github.com/mattyork/fuzzy (MIT license)
            fuzzy: function( filter, iFilter, exact, iExact ) {
                if ( /^~/.test(iFilter) ) {
                    var indx,
                        patternIndx = 0,
                        len = iExact.length,
                        pattern = iFilter.slice(1);
                    for (indx = 0; indx < len; indx++) {
                        if (iExact[indx] === pattern[patternIndx]) {
                            patternIndx += 1;
                        }
                    }
                    if (patternIndx === pattern.length) {
                        return true;
                    }
                    return false;
                }
                return null;
            }
        },
        init: function(table, c, wo) {
            var options, string, $header, column, filters, time;
            if (c.debug) {
                time = new Date();
            }
            c.$table.addClass('hasFilters');

            ts.filter.regex.child = new RegExp(c.cssChildRow);
            ts.filter.regex.filtered = new RegExp(wo.filter_filteredRow);

            // don't build filter row if columnFilters is false or all columns are set to "filter-false" - issue #156
            if (wo.filter_columnFilters !== false && c.$headers.filter('.filter-false').length !== c.$headers.length) {
                // build filter row
                ts.filter.buildRow(table, c, wo);
            }

            c.$table.bind('addRows updateCell update updateRows updateComplete appendCache filterReset filterEnd search '.split(' ').join(c.namespace + 'filter '), function(event, filter) {
                c.$table.find('.' + ts.css.filterRow).toggle( !(wo.filter_hideEmpty && $.isEmptyObject(c.cache)) ); // fixes #450
                if ( !/(search|filter)/.test(event.type) ) {
                    event.stopPropagation();
                    ts.filter.buildDefault(table, true);
                }
                if (event.type === 'filterReset') {
                    ts.filter.searching(table, []);
                } else if (event.type === 'filterEnd') {
                    ts.filter.buildDefault(table, true);
                } else {
                    // send false argument to force a new search; otherwise if the filter hasn't changed, it will return
                    filter = event.type === 'search' ? filter : event.type === 'updateComplete' ? c.$table.data('lastSearch') : '';
                    if (/(update|add)/.test(event.type) && event.type !== "updateComplete") {
                        // force a new search since content has changed
                        c.lastCombinedFilter = null;
                    }
                    // pass true (skipFirst) to prevent the tablesorter.setFilters function from skipping the first input
                    // ensures all inputs are updated when a search is triggered on the table $('table').trigger('search', [...]);
                    ts.filter.searching(table, filter, true);
                }
                return false;
            });

            // reset button/link
            if (wo.filter_reset) {
                if (wo.filter_reset instanceof $) {
                    // reset contains a jQuery object, bind to it
                    wo.filter_reset.click(function(){
                        c.$table.trigger('filterReset');
                    });
                } else if ($(wo.filter_reset).length) {
                    // reset is a jQuery selector, use event delegation
                    $(document)
                        .undelegate(wo.filter_reset, 'click.tsfilter')
                        .delegate(wo.filter_reset, 'click.tsfilter', function() {
                            // trigger a reset event, so other functions (filterFormatter) know when to reset
                            c.$table.trigger('filterReset');
                        });
                }
            }
            if (wo.filter_functions) {
                // column = column # (string)
                for (column in wo.filter_functions) {
                    if (wo.filter_functions.hasOwnProperty(column) && typeof column === 'string') {
                        $header = c.$headers.filter('[data-column="' + column + '"]:last');
                        options = '';
                        if (wo.filter_functions[column] === true && !$header.hasClass('filter-false')) {
                            ts.filter.buildSelect(table, column);
                        } else if (typeof column === 'string' && !$header.hasClass('filter-false')) {
                            // add custom drop down list
                            for (string in wo.filter_functions[column]) {
                                if (typeof string === 'string') {
                                    options += options === '' ?
                                    '<option value="">' + ($header.data('placeholder') || $header.attr('data-placeholder') || wo.filter_placeholder.select || '') + '</option>' : '';
                                    options += '<option value="' + string + '">' + string + '</option>';
                                }
                            }
                            c.$table.find('thead').find('select.' + ts.css.filter + '[data-column="' + column + '"]').append(options);
                        }
                    }
                }
            }
            // not really updating, but if the column has both the "filter-select" class & filter_functions set to true,
            // it would append the same options twice.
            ts.filter.buildDefault(table, true);

            ts.filter.bindSearch( table, c.$table.find('.' + ts.css.filter), true );
            if (wo.filter_external) {
                ts.filter.bindSearch( table, wo.filter_external );
            }

            if (wo.filter_hideFilters) {
                ts.filter.hideFilters(table, c);
            }

            // show processing icon
            if (c.showProcessing) {
                c.$table.bind('filterStart' + c.namespace + 'filter filterEnd' + c.namespace + 'filter', function(event, columns) {
                    // only add processing to certain columns to all columns
                    $header = (columns) ? c.$table.find('.' + ts.css.header).filter('[data-column]').filter(function() {
                        return columns[$(this).data('column')] !== '';
                    }) : '';
                    ts.isProcessing(table, event.type === 'filterStart', columns ? $header : '');
                });
            }

            if (c.debug) {
                ts.benchmark("Applying Filter widget", time);
            }
            // add default values
            c.$table.bind('tablesorter-initialized pagerInitialized', function() {
                filters = ts.filter.setDefaults(table, c, wo) || [];
                if (filters.length) {
                    ts.setFilters(table, filters, true);
                }
                c.$table.trigger('filterFomatterUpdate');
                ts.filter.checkFilters(table, filters);
            });
            // filter widget initialized
            wo.filter_initialized = true;
            c.$table.trigger('filterInit');
        },
        setDefaults: function(table, c, wo) {
            var isArray, saved, indx,
            // get current (default) filters
                filters = ts.getFilters(table) || [];
            if (wo.filter_saveFilters && ts.storage) {
                saved = ts.storage( table, 'tablesorter-filters' ) || [];
                isArray = $.isArray(saved);
                // make sure we're not just getting an empty array
                if ( !(isArray && saved.join('') === '' || !isArray) ) { filters = saved; }
            }
            // if no filters saved, then check default settings
            if (filters.join('') === '') {
                for (indx = 0; indx < c.columns; indx++) {
                    filters[indx] = c.$headers.filter('[data-column="' + indx + '"]:last').attr(wo.filter_defaultAttrib) || filters[indx];
                }
            }
            c.$table.data('lastSearch', filters);
            return filters;
        },
        buildRow: function(table, c, wo) {
            var column, $header, buildSelect, disabled, name,
            // c.columns defined in computeThIndexes()
                columns = c.columns,
                buildFilter = '<tr class="' + ts.css.filterRow + '">';
            for (column = 0; column < columns; column++) {
                buildFilter += '<td></td>';
            }
            c.$filters = $(buildFilter += '</tr>').appendTo( c.$table.children('thead').eq(0) ).find('td');
            // build each filter input
            for (column = 0; column < columns; column++) {
                disabled = false;
                // assuming last cell of a column is the main column
                $header = c.$headers.filter('[data-column="' + column + '"]:last');
                buildSelect = (wo.filter_functions && wo.filter_functions[column] && typeof wo.filter_functions[column] !== 'function') ||
                    $header.hasClass('filter-select');
                // get data from jQuery data, metadata, headers option or header class name
                if (ts.getData) {
                    // get data from jQuery data, metadata, headers option or header class name
                    disabled = ts.getData($header[0], c.headers[column], 'filter') === 'false';
                } else {
                    // only class names and header options - keep this for compatibility with tablesorter v2.0.5
                    disabled = (c.headers[column] && c.headers[column].hasOwnProperty('filter') && c.headers[column].filter === false) ||
                        $header.hasClass('filter-false');
                }
                if (buildSelect) {
                    buildFilter = $('<select>').appendTo( c.$filters.eq(column) );
                } else {
                    if (wo.filter_formatter && $.isFunction(wo.filter_formatter[column])) {
                        buildFilter = wo.filter_formatter[column]( c.$filters.eq(column), column );
                        // no element returned, so lets go find it
                        if (buildFilter && buildFilter.length === 0) {
                            buildFilter = c.$filters.eq(column).children('input');
                        }
                        // element not in DOM, so lets attach it
                        if ( buildFilter && (buildFilter.parent().length === 0 ||
                            (buildFilter.parent().length && buildFilter.parent()[0] !== c.$filters[column])) ) {
                            c.$filters.eq(column).append(buildFilter);
                        }
                    } else {
                        buildFilter = $('<input type="search">').appendTo( c.$filters.eq(column) );
                    }
                    if (buildFilter) {
                        buildFilter.attr('placeholder', $header.data('placeholder') || $header.attr('data-placeholder') || wo.filter_placeholder.search || '');
                    }
                }
                if (buildFilter) {
                    // add filter class name
                    name = ( $.isArray(wo.filter_cssFilter) ?
                            (typeof wo.filter_cssFilter[column] !== 'undefined' ? wo.filter_cssFilter[column] || '' : '') :
                            wo.filter_cssFilter ) || '';
                    buildFilter.addClass( ts.css.filter + ' ' + name ).attr('data-column', column);
                    if (disabled) {
                        buildFilter.attr('placeholder', '').addClass('disabled')[0].disabled = true; // disabled!
                    }
                }
            }
        },
        bindSearch: function(table, $el, internal) {
            table = $(table)[0];
            $el = $($el); // allow passing a selector string
            if (!$el.length) { return; }
            var c = table.config,
                wo = c.widgetOptions,
                $ext = wo.filter_$externalFilters;
            if (internal !== true) {
                // save anyMatch element
                wo.filter_$anyMatch = $el.filter('[data-column="all"]');
                if ($ext && $ext.length) {
                    wo.filter_$externalFilters = wo.filter_$externalFilters.add( $el );
                } else {
                    wo.filter_$externalFilters = $el;
                }
                // update values (external filters added after table initialization)
                ts.setFilters(table, c.$table.data('lastSearch') || [], internal === false);
            }
            $el
            // use data attribute instead of jQuery data since the head is cloned without including the data/binding
                .attr('data-lastSearchTime', new Date().getTime())
                .unbind('keyup search change '.split(' ').join(c.namespace + 'filter '))
                // include change for select - fixes #473
                .bind('keyup search change '.split(' ').join(c.namespace + 'filter '), function(event) {
                    $(this).attr('data-lastSearchTime', new Date().getTime());
                    // emulate what webkit does.... escape clears the filter
                    if (event.which === 27) {
                        this.value = '';
                        // liveSearch can contain a min value length; ignore arrow and meta keys, but allow backspace
                    } else if ( (typeof wo.filter_liveSearch === 'number' && this.value.length < wo.filter_liveSearch && this.value !== '') ||
                        ( event.type === 'keyup' && ( (event.which < 32 && event.which !== 8 && wo.filter_liveSearch === true && event.which !== 13) ||
                        ( event.which >= 37 && event.which <= 40 ) || (event.which !== 13 && wo.filter_liveSearch === false) ) ) ) {
                        return;
                    }
                    // true flag tells getFilters to skip newest timed input
                    ts.filter.searching( table, true, true );
                });
            c.$table.bind('filterReset', function(){
                $el.val('');
            });
        },
        checkFilters: function(table, filter, skipFirst) {
            var c = table.config,
                wo = c.widgetOptions,
                filterArray = $.isArray(filter),
                filters = (filterArray) ? filter : ts.getFilters(table, true),
                combinedFilters = (filters || []).join(''); // combined filter values
            // add filter array back into inputs
            if (filterArray) {
                ts.setFilters( table, filters, false, skipFirst !== true );
            }
            if (wo.filter_hideFilters) {
                // show/hide filter row as needed
                c.$table.find('.' + ts.css.filterRow).trigger( combinedFilters === '' ? 'mouseleave' : 'mouseenter' );
            }
            // return if the last search is the same; but filter === false when updating the search
            // see example-widget-filter.html filter toggle buttons
            if (c.lastCombinedFilter === combinedFilters && filter !== false) {
                return;
            } else if (filter === false) {
                // force filter refresh
                c.lastCombinedFilter = null;
            }
            c.$table.trigger('filterStart', [filters]);
            if (c.showProcessing) {
                // give it time for the processing icon to kick in
                setTimeout(function() {
                    ts.filter.findRows(table, filters, combinedFilters);
                    return false;
                }, 30);
            } else {
                ts.filter.findRows(table, filters, combinedFilters);
                return false;
            }
        },
        hideFilters: function(table, c) {
            var $filterRow, $filterRow2, timer;
            c.$table
                .find('.' + ts.css.filterRow)
                .addClass('hideme')
                .bind('mouseenter mouseleave', function(e) {
                    // save event object - http://bugs.jquery.com/ticket/12140
                    var event = e;
                    $filterRow = $(this);
                    clearTimeout(timer);
                    timer = setTimeout(function() {
                        if ( /enter|over/.test(event.type) ) {
                            $filterRow.removeClass('hideme');
                        } else {
                            // don't hide if input has focus
                            // $(':focus') needs jQuery 1.6+
                            if ( $(document.activeElement).closest('tr')[0] !== $filterRow[0] ) {
                                // don't hide row if any filter has a value
                                if (c.lastCombinedFilter === '') {
                                    $filterRow.addClass('hideme');
                                }
                            }
                        }
                    }, 200);
                })
                .find('input, select').bind('focus blur', function(e) {
                $filterRow2 = $(this).closest('tr');
                clearTimeout(timer);
                var event = e;
                timer = setTimeout(function() {
                    // don't hide row if any filter has a value
                    if (ts.getFilters(table).join('') === '') {
                        $filterRow2[ event.type === 'focus' ? 'removeClass' : 'addClass']('hideme');
                    }
                }, 200);
            });
        },
        findRows: function(table, filters, combinedFilters) {
            if (table.config.lastCombinedFilter === combinedFilters) { return; }
            var cached, len, $rows, cacheIndex, rowIndex, tbodyIndex, $tbody, $cells, columnIndex,
                childRow, childRowText, exact, iExact, iFilter, lastSearch, matches, result,
                searchFiltered, filterMatched, showRow, time,
                anyMatch, iAnyMatch, rowArray, rowText, iRowText, rowCache,
                c = table.config,
                wo = c.widgetOptions,
                columns = c.columns,
                $tbodies = c.$table.children('tbody'), // target all tbodies #568
            // anyMatch really screws up with these types of filters
                anyMatchNotAllowedTypes = [ 'range', 'notMatch',  'operators' ],
            // parse columns after formatter, in case the class is added at that point
                parsed = c.$headers.map(function(columnIndex) {
                    return c.parsers && c.parsers[columnIndex] && c.parsers[columnIndex].parsed || ( ts.getData ?
                        ts.getData(c.$headers.filter('[data-column="' + columnIndex + '"]:last'), c.headers[columnIndex], 'filter') === 'parsed' :
                            $(this).hasClass('filter-parsed') );
                }).get();
            if (c.debug) { time = new Date(); }
            for (tbodyIndex = 0; tbodyIndex < $tbodies.length; tbodyIndex++ ) {
                if ($tbodies.eq(tbodyIndex).hasClass(c.cssInfoBlock || ts.css.info)) { continue; } // ignore info blocks, issue #264
                $tbody = ts.processTbody(table, $tbodies.eq(tbodyIndex), true);
                // skip child rows & widget added (removable) rows - fixes #448 thanks to @hempel!
                // $rows = $tbody.children('tr').not(c.selectorRemove);
                columnIndex = c.columns;
                // convert stored rows into a jQuery object
                $rows = true ? $( $.map(c.cache[tbodyIndex].normalized, function(el){ return el[columnIndex].$row.get(); }) ) : $tbody.children('tr').not(c.selectorRemove);
                len = $rows.length;
                if (combinedFilters === '' || wo.filter_serversideFiltering) {
                    $rows.removeClass(wo.filter_filteredRow).not('.' + c.cssChildRow).show();
                } else {
                    // optimize searching only through already filtered rows - see #313
                    searchFiltered = true;
                    lastSearch = c.lastSearch || c.$table.data('lastSearch') || [];
                    $.each(filters, function(indx, val) {
                        // check for changes from beginning of filter; but ignore if there is a logical "or" in the string
                        searchFiltered = (val || '').indexOf(lastSearch[indx]) === 0 && searchFiltered && !/(\s+or\s+|\|)/g.test(val || '');
                    });
                    // can't search when all rows are hidden - this happens when looking for exact matches
                    if (searchFiltered && $rows.not('.' + wo.filter_filteredRow).length === 0) { searchFiltered = false; }
                    if ((wo.filter_$anyMatch && wo.filter_$anyMatch.length) || filters[c.columns]) {
                        anyMatch = wo.filter_$anyMatch && wo.filter_$anyMatch.val() || filters[c.columns] || '';
                        if (c.sortLocaleCompare) {
                            // replace accents
                            anyMatch = ts.replaceAccents(anyMatch);
                        }
                        iAnyMatch = anyMatch.toLowerCase();
                    }
                    // loop through the rows
                    cacheIndex = 0;
                    for (rowIndex = 0; rowIndex < len; rowIndex++) {
                        childRow = $rows[rowIndex].className;
                        // skip child rows & already filtered rows
                        if ( ts.filter.regex.child.test(childRow) || (searchFiltered && ts.filter.regex.filtered.test(childRow)) ) { continue; }
                        showRow = true;
                        // *** nextAll/nextUntil not supported by Zepto! ***
                        childRow = $rows.eq(rowIndex).nextUntil('tr:not(.' + c.cssChildRow + ')');
                        // so, if "table.config.widgetOptions.filter_childRows" is true and there is
                        // a match anywhere in the child row, then it will make the row visible
                        // checked here so the option can be changed dynamically
                        childRowText = (childRow.length && wo.filter_childRows) ? childRow.text() : '';
                        childRowText = wo.filter_ignoreCase ? childRowText.toLocaleLowerCase() : childRowText;
                        $cells = $rows.eq(rowIndex).children();

                        if (anyMatch) {
                            rowArray = $cells.map(function(i){
                                var txt;
                                if (parsed[i]) {
                                    txt = c.cache[tbodyIndex].normalized[cacheIndex][i];
                                } else {
                                    txt = wo.filter_ignoreCase ? $(this).text().toLowerCase() : $(this).text();
                                    if (c.sortLocaleCompare) {
                                        txt = ts.replaceAccents(txt);
                                    }
                                }
                                return txt;
                            }).get();
                            rowText = rowArray.join(' ');
                            iRowText = rowText.toLowerCase();
                            rowCache = c.cache[tbodyIndex].normalized[cacheIndex].slice(0,-1).join(' ');
                            filterMatched = null;
                            $.each(ts.filter.types, function(type, typeFunction) {
                                if ($.inArray(type, anyMatchNotAllowedTypes) < 0) {
                                    matches = typeFunction( anyMatch, iAnyMatch, rowText, iRowText, rowCache, columns, table, wo, parsed, rowArray );
                                    if (matches !== null) {
                                        filterMatched = matches;
                                        return false;
                                    }
                                }
                            });
                            if (filterMatched !== null) {
                                showRow = filterMatched;
                            } else {
                                showRow = (iRowText + childRowText).indexOf(iAnyMatch) >= 0;
                            }
                        }

                        for (columnIndex = 0; columnIndex < columns; columnIndex++) {
                            // ignore if filter is empty or disabled
                            if (filters[columnIndex]) {
                                cached = c.cache[tbodyIndex].normalized[cacheIndex][columnIndex];
                                // check if column data should be from the cell or from parsed data
                                if (wo.filter_useParsedData || parsed[columnIndex]) {
                                    exact = cached;
                                } else {
                                    // using older or original tablesorter
                                    exact = $.trim($cells.eq(columnIndex).text());
                                    exact = c.sortLocaleCompare ? ts.replaceAccents(exact) : exact; // issue #405
                                }
                                iExact = !ts.filter.regex.type.test(typeof exact) && wo.filter_ignoreCase ? exact.toLocaleLowerCase() : exact;
                                result = showRow; // if showRow is true, show that row

                                // replace accents - see #357
                                filters[columnIndex] = c.sortLocaleCompare ? ts.replaceAccents(filters[columnIndex]) : filters[columnIndex];
                                // val = case insensitive, filters[columnIndex] = case sensitive
                                iFilter = wo.filter_ignoreCase ? (filters[columnIndex] || '').toLocaleLowerCase() : filters[columnIndex];
                                if (wo.filter_functions && wo.filter_functions[columnIndex]) {
                                    if (wo.filter_functions[columnIndex] === true) {
                                        // default selector; no "filter-select" class
                                        result = (c.$headers.filter('[data-column="' + columnIndex + '"]:last').hasClass('filter-match')) ?
                                        iExact.search(iFilter) >= 0 : filters[columnIndex] === exact;
                                    } else if (typeof wo.filter_functions[columnIndex] === 'function') {
                                        // filter callback( exact cell content, parser normalized content, filter input value, column index, jQuery row object )
                                        result = wo.filter_functions[columnIndex](exact, cached, filters[columnIndex], columnIndex, $rows.eq(rowIndex));
                                    } else if (typeof wo.filter_functions[columnIndex][filters[columnIndex]] === 'function') {
                                        // selector option function
                                        result = wo.filter_functions[columnIndex][filters[columnIndex]](exact, cached, filters[columnIndex], columnIndex, $rows.eq(rowIndex));
                                    }
                                } else {
                                    filterMatched = null;
                                    // cycle through the different filters
                                    // filters return a boolean or null if nothing matches
                                    $.each(ts.filter.types, function(type, typeFunction) {
                                        matches = typeFunction( filters[columnIndex], iFilter, exact, iExact, cached, columnIndex, table, wo, parsed );
                                        if (matches !== null) {
                                            filterMatched = matches;
                                            return false;
                                        }
                                    });
                                    if (filterMatched !== null) {
                                        result = filterMatched;
                                        // Look for match, and add child row data for matching
                                    } else {
                                        exact = (iExact + childRowText).indexOf(iFilter);
                                        result = ( (!wo.filter_startsWith && exact >= 0) || (wo.filter_startsWith && exact === 0) );
                                    }
                                }
                                showRow = (result) ? showRow : false;
                            }
                        }
                        $rows.eq(rowIndex)
                            .toggle(showRow)
                            .toggleClass(wo.filter_filteredRow, !showRow);
                        if (childRow.length) {
                            childRow.toggleClass(wo.filter_filteredRow, !showRow);
                        }
                        cacheIndex++;
                    }
                }
                ts.processTbody(table, $tbody, false);
            }
            c.lastCombinedFilter = combinedFilters; // save last search
            c.lastSearch = filters;
            c.$table.data('lastSearch', filters);
            if (wo.filter_saveFilters && ts.storage) {
                ts.storage( table, 'tablesorter-filters', filters );
            }
            if (c.debug) {
                ts.benchmark("Completed filter widget search", time);
            }
            c.$table.trigger('filterEnd');
            setTimeout(function(){
                c.$table.trigger('applyWidgets'); // make sure zebra widget is applied
            }, 0);
        },
        getOptionSource: function(table, column, onlyAvail) {
            var c = table.config,
                wo = c.widgetOptions,
                arry = false,
                source = wo.filter_selectSource;

            // filter select source option
            if ($.isFunction(source)) {
                // OVERALL source
                arry = source(table, column, onlyAvail);
            } else if ($.type(source) === 'object' && source.hasOwnProperty(column)) {
                // custom select source function for a SPECIFIC COLUMN
                arry = source[column](table, column, onlyAvail);
            }
            if (arry === false) {
                // fall back to original method
                arry = ts.filter.getOptions(table, column, onlyAvail);
            }

            // get unique elements and sort the list
            // if $.tablesorter.sortText exists (not in the original tablesorter),
            // then natural sort the list otherwise use a basic sort
            arry = $.grep(arry, function(value, indx) {
                return $.inArray(value, arry) === indx;
            });
            return (ts.sortNatural) ? arry.sort(function(a, b) { return ts.sortNatural(a, b); }) : arry.sort(true);
        },
        getOptions: function(table, column, onlyAvail) {
            var rowIndex, tbodyIndex, len, row, cache, cell,
                c = table.config,
                wo = c.widgetOptions,
                $tbodies = c.$table.children('tbody'),
                arry = [];
            for (tbodyIndex = 0; tbodyIndex < $tbodies.length; tbodyIndex++ ) {
                if (!$tbodies.eq(tbodyIndex).hasClass(c.cssInfoBlock)) {
                    cache = c.cache[tbodyIndex];
                    len = c.cache[tbodyIndex].normalized.length;
                    // loop through the rows
                    for (rowIndex = 0; rowIndex < len; rowIndex++) {
                        // get cached row from cache.row (old) or row data object (new; last item in normalized array)
                        row = cache.row ? cache.row[rowIndex] : cache.normalized[rowIndex][c.columns].$row[0];
                        // check if has class filtered
                        if (onlyAvail && row.className.match(wo.filter_filteredRow)) { continue; }
                        // get non-normalized cell content
                        if (wo.filter_useParsedData) {
                            arry.push( '' + cache.normalized[rowIndex][column] );
                        } else {
                            cell = row.cells[column];
                            if (cell) {
                                arry.push( $.trim( cell.textContent || cell.innerText || $(cell).text() ) );
                            }
                        }
                    }
                }
            }
            return arry;
        },
        buildSelect: function(table, column, updating, onlyAvail) {
            if (!table.config.cache || $.isEmptyObject(table.config.cache)) { return; }
            column = parseInt(column, 10);
            var indx, txt, $filters,
                c = table.config,
                wo = c.widgetOptions,
                node = c.$headers.filter('[data-column="' + column + '"]:last'),
            // t.data('placeholder') won't work in jQuery older than 1.4.3
                options = '<option value="">' + ( node.data('placeholder') || node.attr('data-placeholder') || wo.filter_placeholder.select || '' ) + '</option>',
                arry = ts.filter.getOptionSource(table, column, onlyAvail),
            // Get curent filter value
                currentValue = c.$table.find('thead').find('select.' + ts.css.filter + '[data-column="' + column + '"]').val();

            // build option list
            for (indx = 0; indx < arry.length; indx++) {
                txt = arry[indx].replace(/\"/g, "&quot;");
                // replace quotes - fixes #242 & ignore empty strings - see http://stackoverflow.com/q/14990971/145346
                options += arry[indx] !== '' ? '<option value="' + txt + '"' + (currentValue === txt ? ' selected="selected"' : '') +
                '>' + arry[indx] + '</option>' : '';
            }
            // update all selects in the same column (clone thead in sticky headers & any external selects) - fixes 473
            $filters = ( c.$filters ? c.$filters : c.$table.children('thead') ).find('.' + ts.css.filter);
            if (wo.filter_$externalFilters) {
                $filters = $filters && $filters.length ? $filters.add(wo.filter_$externalFilters) : wo.filter_$externalFilters;
            }
            $filters.filter('select[data-column="' + column + '"]')[ updating ? 'html' : 'append' ](options);
        },
        buildDefault: function(table, updating) {
            var columnIndex, $header,
                c = table.config,
                wo = c.widgetOptions,
                columns = c.columns;
            // build default select dropdown
            for (columnIndex = 0; columnIndex < columns; columnIndex++) {
                $header = c.$headers.filter('[data-column="' + columnIndex + '"]:last');
                // look for the filter-select class; build/update it if found
                if (($header.hasClass('filter-select') || wo.filter_functions && wo.filter_functions[columnIndex] === true) &&
                    !$header.hasClass('filter-false')) {
                    if (!wo.filter_functions) { wo.filter_functions = {}; }
                    wo.filter_functions[columnIndex] = true; // make sure this select gets processed by filter_functions
                    ts.filter.buildSelect(table, columnIndex, updating, $header.hasClass(wo.filter_onlyAvail));
                }
            }
        },
        searching: function(table, filter, skipFirst) {
            if (typeof filter === 'undefined' || filter === true) {
                var wo = table.config.widgetOptions;
                // delay filtering
                clearTimeout(wo.searchTimer);
                wo.searchTimer = setTimeout(function() {
                    ts.filter.checkFilters(table, filter, skipFirst );
                }, wo.filter_liveSearch ? wo.filter_searchDelay : 10);
            } else {
                // skip delay
                ts.filter.checkFilters(table, filter, skipFirst);
            }
        }
    };

    ts.getFilters = function(table, getRaw, setFilters, skipFirst) {
        var i, $filters, $column,
            filters = false,
            c = table ? $(table)[0].config : '',
            wo = c ? c.widgetOptions : '';
        if (getRaw !== true && wo && !wo.filter_columnFilters) {
            return $(table).data('lastSearch');
        }
        if (c) {
            if (c.$filters) {
                $filters = c.$filters.find('.' + ts.css.filter);
            }
            if (wo.filter_$externalFilters) {
                $filters = $filters && $filters.length ? $filters.add(wo.filter_$externalFilters) : wo.filter_$externalFilters;
            }
            if ($filters && $filters.length) {
                filters = setFilters || [];
                for (i = 0; i < c.columns + 1; i++) {
                    $column = $filters.filter('[data-column="' + (i === c.columns ? 'all' : i) + '"]');
                    if ($column.length) {
                        // move the latest search to the first slot in the array
                        $column = $column.sort(function(a, b){
                            return $(b).attr('data-lastSearchTime') - $(a).attr('data-lastSearchTime');
                        });
                        if ($.isArray(setFilters)) {
                            // skip first (latest input) to maintain cursor position while typing
                            (skipFirst ? $column.slice(1) : $column).val( setFilters[i] ).trigger('change.tsfilter');
                        } else {
                            filters[i] = $column.val() || '';
                            // don't change the first... it will move the cursor
                            $column.slice(1).val( filters[i] );
                        }
                        // save any match input dynamically
                        if (i === c.columns && $column.length) {
                            wo.filter_$anyMatch = $column;
                        }
                    }
                }
            }
        }
        if (filters.length === 0) {
            filters = false;
        }
        return filters;
    };

    ts.setFilters = function(table, filter, apply, skipFirst) {
        var c = table ? $(table)[0].config : '',
            valid = ts.getFilters(table, true, filter, skipFirst);
        if (c && apply) {
            // ensure new set filters are applied, even if the search is the same
            c.lastCombinedFilter = null;
            ts.filter.searching(c.$table[0], filter, skipFirst);
            c.$table.trigger('filterFomatterUpdate');
        }
        return !!valid;
    };

// Widget: Sticky headers
// based on this awesome article:
// http://css-tricks.com/13465-persistent-headers/
// and https://github.com/jmosbech/StickyTableHeaders by Jonas Mosbech
// **************************
    ts.addWidget({
        id: "stickyHeaders",
        priority: 60, // sticky widget must be initialized after the filter widget!
        options: {
            stickyHeaders : '',       // extra class name added to the sticky header row
            stickyHeaders_attachTo : null, // jQuery selector or object to attach sticky header to
            stickyHeaders_offset : 0, // number or jquery selector targeting the position:fixed element
            stickyHeaders_cloneId : '-sticky', // added to table ID, if it exists
            stickyHeaders_addResizeEvent : true, // trigger "resize" event on headers
            stickyHeaders_includeCaption : true, // if false and a caption exist, it won't be included in the sticky header
            stickyHeaders_zIndex : 2 // The zIndex of the stickyHeaders, allows the user to adjust this to their needs
        },
        format: function(table, c, wo) {
            // filter widget doesn't initialize on an empty table. Fixes #449
            if ( c.$table.hasClass('hasStickyHeaders') || ($.inArray('filter', c.widgets) >= 0 && !c.$table.hasClass('hasFilters')) ) {
                return;
            }
            var $cell,
                $table = c.$table,
                $attach = $(wo.stickyHeaders_attachTo),
                $thead = $table.children('thead:first'),
                $win = $attach.length ? $attach : $(window),
                $header = $thead.children('tr').not('.sticky-false').children(),
                innerHeader = '.' + ts.css.headerIn,
                $tfoot = $table.find('tfoot'),
                $stickyOffset = isNaN(wo.stickyHeaders_offset) ? $(wo.stickyHeaders_offset) : '',
                stickyOffset = $attach.length ? 0 : $stickyOffset.length ?
                $stickyOffset.height() || 0 : parseInt(wo.stickyHeaders_offset, 10) || 0,
                $stickyTable = wo.$sticky = $table.clone()
                    .addClass('containsStickyHeaders')
                    .css({
                        position   : $attach.length ? 'absolute' : 'fixed',
                        margin     : 0,
                        top        : stickyOffset,
                        left       : 0,
                        visibility : 'hidden',
                        zIndex     : wo.stickyHeaders_zIndex ? wo.stickyHeaders_zIndex : 2
                    }),
                $stickyThead = $stickyTable.children('thead:first').addClass(ts.css.sticky + ' ' + wo.stickyHeaders),
                $stickyCells,
                laststate = '',
                spacing = 0,
                nonwkie = $table.css('border-collapse') !== 'collapse' && !/(webkit|msie)/i.test(navigator.userAgent),
                resizeHeader = function() {
                    stickyOffset = $stickyOffset.length ? $stickyOffset.height() || 0 : parseInt(wo.stickyHeaders_offset, 10) || 0;
                    spacing = 0;
                    // yes, I dislike browser sniffing, but it really is needed here :(
                    // webkit automatically compensates for border spacing
                    if (nonwkie) {
                        // Firefox & Opera use the border-spacing
                        // update border-spacing here because of demos that switch themes
                        spacing = parseInt($header.eq(0).css('border-left-width'), 10) * 2;
                    }
                    $stickyTable.css({
                        left : $attach.length ? (parseInt($attach.css('padding-left'), 10) || 0) + parseInt(c.$table.css('padding-left'), 10) +
                        parseInt(c.$table.css('margin-left'), 10) + parseInt($table.css('border-left-width'), 10) :
                        $thead.offset().left - $win.scrollLeft() - spacing,
                        width: $table.width()
                    });
                    $stickyCells.filter(':visible').each(function(i) {
                        var $cell = $header.filter(':visible').eq(i),
                        // some wibbly-wobbly... timey-wimey... stuff, to make columns line up in Firefox
                            offset = nonwkie && $(this).attr('data-column') === ( '' + parseInt(c.columns/2, 10) ) ? 1 : 0;
                        $(this)
                            .css({
                                width: $cell.width() - spacing,
                                height: $cell.height()
                            })
                            .find(innerHeader).width( $cell.find(innerHeader).width() - offset );
                    });
                };
            // fix clone ID, if it exists - fixes #271
            if ($stickyTable.attr('id')) { $stickyTable[0].id += wo.stickyHeaders_cloneId; }
            // clear out cloned table, except for sticky header
            // include caption & filter row (fixes #126 & #249) - don't remove cells to get correct cell indexing
            $stickyTable.find('thead:gt(0), tr.sticky-false').hide();
            $stickyTable.find('tbody, tfoot').remove();
            if (!wo.stickyHeaders_includeCaption) {
                $stickyTable.find('caption').remove();
            } else {
                $stickyTable.find('caption').css( 'margin-left', '-1px' );
            }
            // issue #172 - find td/th in sticky header
            $stickyCells = $stickyThead.children().children();
            $stickyTable.css({ height:0, width:0, padding:0, margin:0, border:0 });
            // remove resizable block
            $stickyCells.find('.' + ts.css.resizer).remove();
            // update sticky header class names to match real header after sorting
            $table
                .addClass('hasStickyHeaders')
                .bind('sortEnd.tsSticky', function() {
                    $header.filter(':visible').each(function(indx) {
                        $cell = $stickyCells.filter(':visible').eq(indx)
                            .attr('class', $(this).attr('class'))
                            // remove processing icon
                            .removeClass(ts.css.processing + ' ' + c.cssProcessing);
                        if (c.cssIcon) {
                            $cell
                                .find('.' + ts.css.icon)
                                .attr('class', $(this).find('.' + ts.css.icon).attr('class'));
                        }
                    });
                })
                .bind('pagerComplete.tsSticky', function() {
                    resizeHeader();
                });

            ts.bindEvents(table, $stickyThead.children().children('.tablesorter-header'));

            // add stickyheaders AFTER the table. If the table is selected by ID, the original one (first) will be returned.
            $table.after( $stickyTable );
            // make it sticky!
            $win.bind('scroll.tsSticky resize.tsSticky', function(event) {
                if (!$table.is(':visible')) { return; } // fixes #278
                var prefix = 'tablesorter-sticky-',
                    offset = $table.offset(),
                    captionHeight = (wo.stickyHeaders_includeCaption ? 0 : $table.find('caption').outerHeight(true)),
                    scrollTop = ($attach.length ? $attach.offset().top : $win.scrollTop()) + stickyOffset - captionHeight,
                    tableHeight = $table.height() - ($stickyTable.height() + ($tfoot.height() || 0)),
                    isVisible = (scrollTop > offset.top) && (scrollTop < offset.top + tableHeight) ? 'visible' : 'hidden',
                    cssSettings = { visibility : isVisible };
                if ($attach.length) {
                    cssSettings.top = $attach.scrollTop();
                } else {
                    // adjust when scrolling horizontally - fixes issue #143
                    cssSettings.left = $thead.offset().left - $win.scrollLeft() - spacing;
                }
                $stickyTable
                    .removeClass(prefix + 'visible ' + prefix + 'hidden')
                    .addClass(prefix + isVisible)
                    .css(cssSettings);
                if (isVisible !== laststate || event.type === 'resize') {
                    // make sure the column widths match
                    resizeHeader();
                    laststate = isVisible;
                }
            });
            if (wo.stickyHeaders_addResizeEvent) {
                ts.addHeaderResizeEvent(table);
            }

            // look for filter widget
            if ($table.hasClass('hasFilters')) {
                // scroll table into view after filtering, if sticky header is active - #482
                $table.bind('filterEnd', function() {
                    // $(':focus') needs jQuery 1.6+
                    var $td = $(document.activeElement).closest('td'),
                        column = $td.parent().children().index($td);
                    // only scroll if sticky header is active
                    if ($stickyTable.hasClass(ts.css.stickyVis)) {
                        // scroll to original table (not sticky clone)
                        window.scrollTo(0, $table.position().top);
                        // give same input/select focus
                        if (column >= 0) {
                            c.$filters.eq(column).find('a, select, input').filter(':visible').focus();
                        }
                    }
                });
                ts.filter.bindSearch( $table, $stickyCells.find('.' + ts.css.filter) );
            }

            $table.trigger('stickyHeadersInit');

        },
        remove: function(table, c, wo) {
            c.$table
                .removeClass('hasStickyHeaders')
                .unbind('sortEnd.tsSticky pagerComplete.tsSticky')
                .find('.' + ts.css.sticky).remove();
            if (wo.$sticky && wo.$sticky.length) { wo.$sticky.remove(); } // remove cloned table
            // don't unbind if any table on the page still has stickyheaders applied
            if (!$('.hasStickyHeaders').length) {
                $(window).unbind('scroll.tsSticky resize.tsSticky');
            }
            ts.addHeaderResizeEvent(table, false);
        }
    });

// Add Column resizing widget
// this widget saves the column widths if
// $.tablesorter.storage function is included
// **************************
    ts.addWidget({
        id: "resizable",
        priority: 40,
        options: {
            resizable : true,
            resizable_addLastColumn : false,
            resizable_widths : []
        },
        format: function(table, c, wo) {
            if (c.$table.hasClass('hasResizable')) { return; }
            c.$table.addClass('hasResizable');
            ts.resizableReset(table, true); // set default widths
            var $rows, $columns, $column, column,
                storedSizes = {},
                $table = c.$table,
                mouseXPosition = 0,
                $target = null,
                $next = null,
                fullWidth = Math.abs($table.parent().width() - $table.width()) < 20,
                stopResize = function() {
                    if (ts.storage && $target && $next) {
                        storedSizes = {};
                        storedSizes[$target.index()] = $target.width();
                        storedSizes[$next.index()] = $next.width();
                        $target.width( storedSizes[$target.index()] );
                        $next.width( storedSizes[$next.index()] );
                        if (wo.resizable !== false) {
                            // save all column widths
                            ts.storage(table, 'tablesorter-resizable', c.$headers.map(function(){ return $(this).width(); }).get() );
                        }
                    }
                    mouseXPosition = 0;
                    $target = $next = null;
                    $(window).trigger('resize'); // will update stickyHeaders, just in case
                };
            storedSizes = (ts.storage && wo.resizable !== false) ? ts.storage(table, 'tablesorter-resizable') : {};
            // process only if table ID or url match
            if (storedSizes) {
                for (column in storedSizes) {
                    if (!isNaN(column) && column < c.$headers.length) {
                        c.$headers.eq(column).width(storedSizes[column]); // set saved resizable widths
                    }
                }
            }
            $rows = $table.children('thead:first').children('tr');
            // add resizable-false class name to headers (across rows as needed)
            $rows.children().each(function() {
                var canResize,
                    $column = $(this);
                column = $column.attr('data-column');
                canResize = ts.getData( $column, c.headers[column], 'resizable') === "false";
                $rows.children().filter('[data-column="' + column + '"]')[canResize ? 'addClass' : 'removeClass']('resizable-false');
            });
            // add wrapper inside each cell to allow for positioning of the resizable target block
            $rows.each(function() {
                $column = $(this).children().not('.resizable-false');
                if (!$(this).find('.' + ts.css.wrapper).length) {
                    // Firefox needs this inner div to position the resizer correctly
                    $column.wrapInner('<div class="' + ts.css.wrapper + '" style="position:relative;height:100%;width:100%"></div>');
                }
                // don't include the last column of the row
                if (!wo.resizable_addLastColumn) { $column = $column.slice(0,-1); }
                $columns = $columns ? $columns.add($column) : $column;
            });
            $columns
                .each(function() {
                    var $column = $(this),
                        padding = parseInt($column.css('padding-right'), 10) + 10; // 10 is 1/2 of the 20px wide resizer grip
                    $column
                        .find('.' + ts.css.wrapper)
                        .append('<div class="' + ts.css.resizer + '" style="cursor:w-resize;position:absolute;z-index:1;right:-' +
                            padding + 'px;top:0;height:100%;width:20px;"></div>');
                })
                .bind('mousemove.tsresize', function(event) {
                    // ignore mousemove if no mousedown
                    if (mouseXPosition === 0 || !$target) { return; }
                    // resize columns
                    var leftEdge = event.pageX - mouseXPosition,
                        targetWidth = $target.width();
                    $target.width( targetWidth + leftEdge );
                    if ($target.width() !== targetWidth && fullWidth) {
                        $next.width( $next.width() - leftEdge );
                    }
                    mouseXPosition = event.pageX;
                })
                .bind('mouseup.tsresize', function() {
                    stopResize();
                })
                .find('.' + ts.css.resizer + ',.' + ts.css.grip)
                .bind('mousedown', function(event) {
                    // save header cell and mouse position; closest() not supported by jQuery v1.2.6
                    $target = $(event.target).closest('th');
                    var $header = c.$headers.filter('[data-column="' + $target.attr('data-column') + '"]');
                    if ($header.length > 1) { $target = $target.add($header); }
                    // if table is not as wide as it's parent, then resize the table
                    $next = event.shiftKey ? $target.parent().find('th').not('.resizable-false').filter(':last') : $target.nextAll(':not(.resizable-false)').eq(0);
                    mouseXPosition = event.pageX;
                });
            $table.find('thead:first')
                .bind('mouseup.tsresize mouseleave.tsresize', function() {
                    stopResize();
                })
                // right click to reset columns to default widths
                .bind('contextmenu.tsresize', function() {
                    ts.resizableReset(table);
                    // $.isEmptyObject() needs jQuery 1.4+; allow right click if already reset
                    var allowClick = $.isEmptyObject ? $.isEmptyObject(storedSizes) : true;
                    storedSizes = {};
                    return allowClick;
                });
        },
        remove: function(table, c) {
            c.$table
                .removeClass('hasResizable')
                .children('thead')
                .unbind('mouseup.tsresize mouseleave.tsresize contextmenu.tsresize')
                .children('tr').children()
                .unbind('mousemove.tsresize mouseup.tsresize')
                // don't remove "tablesorter-wrapper" as uitheme uses it too
                .find('.' + ts.css.resizer + ',.' + ts.css.grip).remove();
            ts.resizableReset(table);
        }
    });
    ts.resizableReset = function(table, nosave) {
        $(table).each(function(){
            var $t,
                c = this.config,
                wo = c && c.widgetOptions;
            if (table && c) {
                c.$headers.each(function(i){
                    $t = $(this);
                    if (wo.resizable_widths[i]) {
                        $t.css('width', wo.resizable_widths[i]);
                    } else if (!$t.hasClass('resizable-false')) {
                        // don't clear the width of any column that is not resizable
                        $t.css('width','');
                    }
                });
                if (ts.storage && !nosave) { ts.storage(this, 'tablesorter-resizable', {}); }
            }
        });
    };

// Save table sort widget
// this widget saves the last sort only if the
// saveSort widget option is true AND the
// $.tablesorter.storage function is included
// **************************
    ts.addWidget({
        id: 'saveSort',
        priority: 20,
        options: {
            saveSort : true
        },
        init: function(table, thisWidget, c, wo) {
            // run widget format before all other widgets are applied to the table
            thisWidget.format(table, c, wo, true);
        },
        format: function(table, c, wo, init) {
            var stored, time,
                $table = c.$table,
                saveSort = wo.saveSort !== false, // make saveSort active/inactive; default to true
                sortList = { "sortList" : c.sortList };
            if (c.debug) {
                time = new Date();
            }
            if ($table.hasClass('hasSaveSort')) {
                if (saveSort && table.hasInitialized && ts.storage) {
                    ts.storage( table, 'tablesorter-savesort', sortList );
                    if (c.debug) {
                        ts.benchmark('saveSort widget: Saving last sort: ' + c.sortList, time);
                    }
                }
            } else {
                // set table sort on initial run of the widget
                $table.addClass('hasSaveSort');
                sortList = '';
                // get data
                if (ts.storage) {
                    stored = ts.storage( table, 'tablesorter-savesort' );
                    sortList = (stored && stored.hasOwnProperty('sortList') && $.isArray(stored.sortList)) ? stored.sortList : '';
                    if (c.debug) {
                        ts.benchmark('saveSort: Last sort loaded: "' + sortList + '"', time);
                    }
                    $table.bind('saveSortReset', function(event) {
                        event.stopPropagation();
                        ts.storage( table, 'tablesorter-savesort', '' );
                    });
                }
                // init is true when widget init is run, this will run this widget before all other widgets have initialized
                // this method allows using this widget in the original tablesorter plugin; but then it will run all widgets twice.
                if (init && sortList && sortList.length > 0) {
                    c.sortList = sortList;
                } else if (table.hasInitialized && sortList && sortList.length > 0) {
                    // update sort change
                    $table.trigger('sorton', [sortList]);
                }
            }
        },
        remove: function(table) {
            // clear storage
            if (ts.storage) { ts.storage( table, 'tablesorter-savesort', '' ); }
        }
    });

})(jQuery);
/*!
 * tablesorter pager plugin
 * updated 4/23/2014 (v2.16.0)
 */
/*jshint browser:true, jquery:true, unused:false */
;(function($) {
    "use strict";
    /*jshint supernew:true */
    var ts = $.tablesorter;

    $.extend({ tablesorterPager: new function() {

        this.defaults = {
            // target the pager markup
            container: null,

            // use this format: "http://mydatabase.com?page={page}&size={size}&{sortList:col}&{filterList:fcol}"
            // where {page} is replaced by the page number, {size} is replaced by the number of records to show,
            // {sortList:col} adds the sortList to the url into a "col" array, and {filterList:fcol} adds
            // the filterList to the url into an "fcol" array.
            // So a sortList = [[2,0],[3,0]] becomes "&col[2]=0&col[3]=0" in the url
            // and a filterList = [[2,Blue],[3,13]] becomes "&fcol[2]=Blue&fcol[3]=13" in the url
            ajaxUrl: null,

            // modify the url after all processing has been applied
            customAjaxUrl: function(table, url) { return url; },

            // modify the $.ajax object to allow complete control over your ajax requests
            ajaxObject: {
                dataType: 'json'
            },

            // set this to false if you want to block ajax loading on init
            processAjaxOnInit: true,

            // process ajax so that the following information is returned:
            // [ total_rows (number), rows (array of arrays), headers (array; optional) ]
            // example:
            // [
            //   100,  // total rows
            //   [
            //     [ "row1cell1", "row1cell2", ... "row1cellN" ],
            //     [ "row2cell1", "row2cell2", ... "row2cellN" ],
            //     ...
            //     [ "rowNcell1", "rowNcell2", ... "rowNcellN" ]
            //   ],
            //   [ "header1", "header2", ... "headerN" ] // optional
            // ]
            ajaxProcessing: function(ajax){ return [ 0, [], null ]; },

            // output default: '{page}/{totalPages}'
            // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
            output: '{startRow} to {endRow} of {totalRows} rows', // '{page}/{totalPages}'

            // apply disabled classname to the pager arrows when the rows at either extreme is visible
            updateArrows: true,

            // starting page of the pager (zero based index)
            page: 0,

            // reset pager after filtering; set to desired page #
            // set to false to not change page at filter start
            pageReset: 0,

            // Number of visible rows
            size: 10,

            // Save pager page & size if the storage script is loaded (requires $.tablesorter.storage in jquery.tablesorter.widgets.js)
            savePages: true,

            // defines custom storage key
            storageKey: 'tablesorter-pager',

            // if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
            // table row set to a height to compensate; default is false
            fixedHeight: false,

            // count child rows towards the set page size? (set true if it is a visible table row within the pager)
            // if true, child row(s) may not appear to be attached to its parent row, may be split across pages or
            // may distort the table if rowspan or cellspans are included.
            countChildRows: false,

            // remove rows from the table to speed up the sort of large tables.
            // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
            removeRows: false, // removing rows in larger tables speeds up the sort

            // css class names of pager arrows
            cssFirst: '.first', // go to first page arrow
            cssPrev: '.prev', // previous page arrow
            cssNext: '.next', // next page arrow
            cssLast: '.last', // go to last page arrow
            cssGoto: '.gotoPage', // go to page selector - select dropdown that sets the current page
            cssPageDisplay: '.pagedisplay', // location of where the "output" is displayed
            cssPageSize: '.pagesize', // page size selector - select dropdown that sets the "size" option
            cssErrorRow: 'tablesorter-errorRow', // error information row

            // class added to arrows when at the extremes (i.e. prev/first arrows are "disabled" when on the first page)
            cssDisabled: 'disabled', // Note there is no period "." in front of this class name

            // stuff not set by the user
            totalRows: 0,
            totalPages: 0,
            filteredRows: 0,
            filteredPages: 0,
            ajaxCounter: 0,
            currentFilters: [],
            startRow: 0,
            endRow: 0,
            $size: null,
            last: {}

        };

        var $this = this,

        // hide arrows at extremes
            pagerArrows = function(p, disable) {
                var a = 'addClass',
                    r = 'removeClass',
                    d = p.cssDisabled,
                    dis = !!disable,
                    first = ( dis || p.page === 0 ),
                    tp = Math.min( p.totalPages, p.filteredPages ),
                    last = ( dis || (p.page === tp - 1) || p.totalPages === 0 );
                if ( p.updateArrows ) {
                    p.$container.find(p.cssFirst + ',' + p.cssPrev)[ first ? a : r ](d).attr('aria-disabled', first);
                    p.$container.find(p.cssNext + ',' + p.cssLast)[ last ? a : r ](d).attr('aria-disabled', last);
                }
            },

            updatePageDisplay = function(table, p, completed) {
                var i, pg, s, out, regex,
                    c = table.config,
                    f = c.$table.hasClass('hasFilters') && !p.ajaxUrl,
                    t = [],
                    sz = p.size || 10; // don't allow dividing by zero
                t = [ (c.widgetOptions && c.widgetOptions.filter_filteredRow || 'filtered'), c.selectorRemove ];
                if (p.countChildRows) { t.push(c.cssChildRow); }
                regex = new RegExp( '(' + t.join('|') + ')' );
                p.totalPages = Math.ceil( p.totalRows / sz ); // needed for "pageSize" method
                p.filteredRows = (f) ? 0 : p.totalRows;
                p.filteredPages = p.totalPages;
                if (f) {
                    $.each(c.cache[0].normalized, function(i, el) {
                        p.filteredRows += p.regexRows.test(el[c.columns].$row[0].className) ? 0 : 1;
                    });
                    p.filteredPages = Math.ceil( p.filteredRows / sz ) || 0;
                }
                if ( Math.min( p.totalPages, p.filteredPages ) >= 0 ) {
                    t = (p.size * p.page > p.filteredRows);
                    p.startRow = (t) ? 1 : (p.filteredRows === 0 ? 0 : p.size * p.page + 1);
                    p.page = (t) ? 0 : p.page;
                    p.endRow = Math.min( p.filteredRows, p.totalRows, p.size * ( p.page + 1 ) );
                    out = p.$container.find(p.cssPageDisplay);
                    // form the output string (can now get a new output string from the server)
                    s = ( p.ajaxData && p.ajaxData.output ? p.ajaxData.output || p.output : p.output )
                    // {page} = one-based index; {page+#} = zero based index +/- value
                        .replace(/\{page([\-+]\d+)?\}/gi, function(m,n){
                            return p.totalPages ? p.page + (n ? parseInt(n, 10) : 1) : 0;
                        })
                        // {totalPages}, {extra}, {extra:0} (array) or {extra : key} (object)
                        .replace(/\{\w+(\s*:\s*\w+)?\}/gi, function(m){
                            var str = m.replace(/[{}\s]/g,''),
                                extra = str.split(':'),
                                data = p.ajaxData,
                            // return zero for default page/row numbers
                                deflt = /(rows?|pages?)$/i.test(str) ? 0 : '';
                            return extra.length > 1 && data && data[extra[0]] ? data[extra[0]][extra[1]] : p[str] || (data ? data[str] : deflt) || deflt;
                        });
                    if (out.length) {
                        out[ (out[0].tagName === 'INPUT') ? 'val' : 'html' ](s);
                        if ( p.$goto.length ) {
                            t = '';
                            pg = Math.min( p.totalPages, p.filteredPages );
                            for ( i = 1; i <= pg; i++ ) {
                                t += '<option>' + i + '</option>';
                            }
                            p.$goto.html(t).val( p.page + 1 );
                        }
                    }
                }
                pagerArrows(p);
                if (p.initialized && completed !== false) {
                    c.$table.trigger('pagerComplete', p);
                    // save pager info to storage
                    if (p.savePages && ts.storage) {
                        ts.storage(table, p.storageKey, {
                            page : p.page,
                            size : p.size
                        });
                    }
                }
            },

            fixHeight = function(table, p) {
                var d, h,
                    c = table.config,
                    $b = c.$tbodies.eq(0);
                if (p.fixedHeight) {
                    $b.find('tr.pagerSavedHeightSpacer').remove();
                    h = $.data(table, 'pagerSavedHeight');
                    if (h) {
                        d = h - $b.height();
                        if ( d > 5 && $.data(table, 'pagerLastSize') === p.size && $b.children('tr:visible').length < p.size ) {
                            $b.append('<tr class="pagerSavedHeightSpacer ' + c.selectorRemove.replace(/(tr)?\./g,'') + '" style="height:' + d + 'px;"></tr>');
                        }
                    }
                }
            },

            changeHeight = function(table, p) {
                var $b = table.config.$tbodies.eq(0);
                $b.find('tr.pagerSavedHeightSpacer').remove();
                $.data(table, 'pagerSavedHeight', $b.height());
                fixHeight(table, p);
                $.data(table, 'pagerLastSize', p.size);
            },

            hideRows = function(table, p){
                if (!p.ajaxUrl) {
                    var i,
                        lastIndex = 0,
                        c = table.config,
                        rows = c.$tbodies.eq(0).children(),
                        l = rows.length,
                        s = ( p.page * p.size ),
                        e =  s + p.size,
                        f = c.widgetOptions && c.widgetOptions.filter_filteredRow || 'filtered',
                        j = 0; // size counter
                    for ( i = 0; i < l; i++ ){
                        if ( !rows[i].className.match(f) ) {
                            if (j === s && rows[i].className.match(c.cssChildRow)) {
                                // hide child rows @ start of pager (if already visible)
                                rows[i].style.display = 'none';
                            } else {
                                rows[i].style.display = ( j >= s && j < e ) ? '' : 'none';
                                // don't count child rows
                                j += rows[i].className.match(c.cssChildRow + '|' + c.selectorRemove.slice(1)) && !p.countChildRows ? 0 : 1;
                                if ( j === e && rows[i].style.display !== 'none' && rows[i].className.match(ts.css.cssHasChild) ) {
                                    lastIndex = i;
                                }
                            }
                        }
                    }
                    // add any attached child rows to last row of pager. Fixes part of issue #396
                    if ( lastIndex > 0 && rows[lastIndex].className.match(ts.css.cssHasChild) ) {
                        while ( ++lastIndex < l && rows[lastIndex].className.match(c.cssChildRow) ) {
                            rows[lastIndex].style.display = '';
                        }
                    }
                }
            },

            hideRowsSetup = function(table, p){
                p.size = parseInt( p.$size.val(), 10 ) || p.size;
                $.data(table, 'pagerLastSize', p.size);
                pagerArrows(p);
                if ( !p.removeRows ) {
                    hideRows(table, p);
                    $(table).bind('sortEnd.pager filterEnd.pager', function(){
                        hideRows(table, p);
                    });
                }
            },

            renderAjax = function(data, table, p, xhr, exception){
                // process data
                if ( typeof(p.ajaxProcessing) === "function" ) {
                    // ajaxProcessing result: [ total, rows, headers ]
                    var i, j, hsh, $f, $sh, t, th, d, l, rr_count,
                        c = table.config,
                        $t = c.$table,
                        tds = '',
                        result = p.ajaxProcessing(data, table) || [ 0, [] ],
                        hl = $t.find('thead th').length;

                    // Clean up any previous error.
                    ts.showError(table);

                    if ( exception ) {
                        if (c.debug) {
                            ts.log('Ajax Error', xhr, exception);
                        }
                        ts.showError(table,
                            xhr.status === 0 ? 'Not connected, verify Network' :
                                xhr.status === 404 ? 'Requested page not found [404]' :
                                    xhr.status === 500 ? 'Internal Server Error [500]' :
                                        exception === 'parsererror' ? 'Requested JSON parse failed' :
                                            exception === 'timeout' ? 'Time out error' :
                                                exception === 'abort' ? 'Ajax Request aborted' :
                                                'Uncaught error: ' + xhr.statusText + ' [' + xhr.status + ']' );
                        c.$tbodies.eq(0).empty();
                        p.totalRows = 0;
                    } else {
                        // process ajax object
                        if (!$.isArray(result)) {
                            p.ajaxData = result;
                            p.totalRows = result.total;
                            th = result.headers;
                            d = result.rows;
                        } else {
                            // allow [ total, rows, headers ]  or [ rows, total, headers ]
                            t = isNaN(result[0]) && !isNaN(result[1]);
                            // ensure a zero returned row count doesn't fail the logical ||
                            rr_count = result[t ? 1 : 0];
                            p.totalRows = isNaN(rr_count) ? p.totalRows || 0 : rr_count;
                            d = p.totalRows === 0 ? [""] : result[t ? 0 : 1] || []; // row data
                            th = result[2]; // headers
                        }
                        l = d.length;
                        if (d instanceof jQuery) {
                            if (p.processAjaxOnInit) {
                                // append jQuery object
                                c.$tbodies.eq(0).empty().append(d);
                            }
                        } else if (l) {
                            // build table from array
                            for ( i = 0; i < l; i++ ) {
                                tds += '<tr>';
                                for ( j = 0; j < d[i].length; j++ ) {
                                    // build tbody cells; watch for data containing HTML markup - see #434
                                    tds += /^\s*<td/.test(d[i][j]) ? $.trim(d[i][j]) : '<td>' + d[i][j] + '</td>';
                                }
                                tds += '</tr>';
                            }
                            // add rows to first tbody
                            if (p.processAjaxOnInit) {
                                c.$tbodies.eq(0).html( tds );
                            }
                        }
                        p.processAjaxOnInit = true;
                        // only add new header text if the length matches
                        if ( th && th.length === hl ) {
                            hsh = $t.hasClass('hasStickyHeaders');
                            $sh = hsh ? c.widgetOptions.$sticky.children('thead:first').children().children() : '';
                            $f = $t.find('tfoot tr:first').children();
                            // don't change td headers (may contain pager)
                            c.$headers.filter('th').each(function(j){
                                var $t = $(this), icn;
                                // add new test within the first span it finds, or just in the header
                                if ( $t.find('.' + ts.css.icon).length ) {
                                    icn = $t.find('.' + ts.css.icon).clone(true);
                                    $t.find('.tablesorter-header-inner').html( th[j] ).append(icn);
                                    if ( hsh && $sh.length ) {
                                        icn = $sh.eq(j).find('.' + ts.css.icon).clone(true);
                                        $sh.eq(j).find('.tablesorter-header-inner').html( th[j] ).append(icn);
                                    }
                                } else {
                                    $t.find('.tablesorter-header-inner').html( th[j] );
                                    if (hsh && $sh.length) {
                                        $sh.eq(j).find('.tablesorter-header-inner').html( th[j] );
                                    }
                                }
                                $f.eq(j).html( th[j] );
                            });
                        }
                    }
                    if (c.showProcessing) {
                        ts.isProcessing(table); // remove loading icon
                    }
                    // make sure last pager settings are saved, prevents multiple server side calls with
                    // the same parameters
                    p.totalPages = Math.ceil( p.totalRows / ( p.size || 10 ) );
                    p.last.totalRows = p.totalRows;
                    p.last.currentFilters = p.currentFilters;
                    p.last.sortList = (c.sortList || []).join(',');
                    updatePageDisplay(table, p);
                    fixHeight(table, p);
                    $t.trigger('updateCache', [function(){
                        if (p.initialized) {
                            // apply widgets after table has rendered
                            $t
                                .trigger('applyWidgets')
                                .trigger('pagerChange', p);
                        }
                    }]);

                }
                if (!p.initialized) {
                    p.initialized = true;
                    $(table)
                        .trigger('applyWidgets')
                        .trigger('pagerInitialized', p);
                }
            },

            getAjax = function(table, p){
                var url = getAjaxUrl(table, p),
                    $doc = $(document),
                    counter,
                    c = table.config;
                if ( url !== '' ) {
                    if (c.showProcessing) {
                        ts.isProcessing(table, true); // show loading icon
                    }
                    $doc.bind('ajaxError.pager', function(e, xhr, settings, exception) {
                        renderAjax(null, table, p, xhr, exception);
                        $doc.unbind('ajaxError.pager');
                    });

                    counter = ++p.ajaxCounter;

                    p.ajaxObject.url = url; // from the ajaxUrl option and modified by customAjaxUrl
                    p.ajaxObject.success = function(data) {
                        // Refuse to process old ajax commands that were overwritten by new ones - see #443
                        if (counter < p.ajaxCounter){
                            return;
                        }
                        renderAjax(data, table, p);
                        $doc.unbind('ajaxError.pager');
                        if (typeof p.oldAjaxSuccess === 'function') {
                            p.oldAjaxSuccess(data);
                        }
                    };
                    if (c.debug) {
                        ts.log('ajax initialized', p.ajaxObject);
                    }
                    $.ajax(p.ajaxObject);
                }
            },

            getAjaxUrl = function(table, p) {
                var c = table.config,
                    url = (p.ajaxUrl) ? p.ajaxUrl
                        // allow using "{page+1}" in the url string to switch to a non-zero based index
                        .replace(/\{page([\-+]\d+)?\}/, function(s,n){ return p.page + (n ? parseInt(n, 10) : 0); })
                        .replace(/\{size\}/g, p.size) : '',
                    sl = c.sortList,
                    fl = p.currentFilters || $(table).data('lastSearch') || [],
                    sortCol = url.match(/\{\s*sort(?:List)?\s*:\s*(\w*)\s*\}/),
                    filterCol = url.match(/\{\s*filter(?:List)?\s*:\s*(\w*)\s*\}/),
                    arry = [];
                if (sortCol) {
                    sortCol = sortCol[1];
                    $.each(sl, function(i,v){
                        arry.push(sortCol + '[' + v[0] + ']=' + v[1]);
                    });
                    // if the arry is empty, just add the col parameter... "&{sortList:col}" becomes "&col"
                    url = url.replace(/\{\s*sort(?:List)?\s*:\s*(\w*)\s*\}/g, arry.length ? arry.join('&') : sortCol );
                    arry = [];
                }
                if (filterCol) {
                    filterCol = filterCol[1];
                    $.each(fl, function(i,v){
                        if (v) {
                            arry.push(filterCol + '[' + i + ']=' + encodeURIComponent(v));
                        }
                    });
                    // if the arry is empty, just add the fcol parameter... "&{filterList:fcol}" becomes "&fcol"
                    url = url.replace(/\{\s*filter(?:List)?\s*:\s*(\w*)\s*\}/g, arry.length ? arry.join('&') : filterCol );
                    p.currentFilters = fl;
                }
                if ( typeof(p.customAjaxUrl) === "function" ) {
                    url = p.customAjaxUrl(table, url);
                }
                if (c.debug) {
                    ts.log('Pager ajax url: ' + url);
                }
                return url;
            },

            renderTable = function(table, rows, p) {
                var $tb, index, count, added,
                    $t = $(table),
                    c = table.config,
                    f = c.$table.hasClass('hasFilters'),
                    l = rows && rows.length || 0, // rows may be undefined
                    s = ( p.page * p.size ),
                    e = p.size;
                if ( l < 1 ) { return; } // empty table, abort!
                if ( p.page >= p.totalPages ) {
                    // lets not render the table more than once
                    moveToLastPage(table, p);
                }
                p.isDisabled = false; // needed because sorting will change the page and re-enable the pager
                if (p.initialized) { $t.trigger('pagerChange', p); }

                if ( !p.removeRows ) {
                    hideRows(table, p);
                } else {
                    ts.clearTableBody(table);
                    $tb = ts.processTbody(table, c.$tbodies.eq(0), true);
                    // not filtered, start from the calculated starting point (s)
                    // if filtered, start from zero
                    index = f ? 0 : s;
                    count = f ? 0 : s;
                    added = 0;
                    while (added < e && index < rows.length) {
                        if (!f || !/filtered/.test(rows[index][0].className)){
                            count++;
                            if (count > s && added <= e) {
                                added++;
                                $tb.append(rows[index]);
                            }
                        }
                        index++;
                    }
                    ts.processTbody(table, $tb, false);
                }
                updatePageDisplay(table, p);
                if ( !p.isDisabled ) { fixHeight(table, p); }
                $t.trigger('applyWidgets');
                if (table.isUpdating) {
                    $t.trigger("updateComplete", table);
                }
            },

            showAllRows = function(table, p){
                if ( p.ajax ) {
                    pagerArrows(p, true);
                } else {
                    p.isDisabled = true;
                    $.data(table, 'pagerLastPage', p.page);
                    $.data(table, 'pagerLastSize', p.size);
                    p.page = 0;
                    p.size = p.totalRows;
                    p.totalPages = 1;
                    $(table)
                        .addClass('pagerDisabled')
                        .removeAttr('aria-describedby')
                        .find('tr.pagerSavedHeightSpacer').remove();
                    renderTable(table, table.config.rowsCopy, p);
                    if (table.config.debug) {
                        ts.log('pager disabled');
                    }
                }
                // disable size selector
                p.$size.add(p.$goto).each(function(){
                    $(this).attr('aria-disabled', 'true').addClass(p.cssDisabled)[0].disabled = true;
                });
            },

            moveToPage = function(table, p, pageMoved) {
                if ( p.isDisabled ) { return; }
                var c = table.config,
                    $t = $(table),
                    l = p.last,
                    pg = Math.min( p.totalPages, p.filteredPages );
                if ( p.page < 0 ) { p.page = 0; }
                if ( p.page > ( pg - 1 ) && pg !== 0 ) { p.page = pg - 1; }
                // fixes issue where one currentFilter is [] and the other is ['','',''],
                // making the next if comparison think the filters are different (joined by commas). Fixes #202.
                l.currentFilters = (l.currentFilters || []).join('') === '' ? [] : l.currentFilters;
                p.currentFilters = (p.currentFilters || []).join('') === '' ? [] : p.currentFilters;
                // don't allow rendering multiple times on the same page/size/totalRows/filters/sorts
                if ( l.page === p.page && l.size === p.size && l.totalRows === p.totalRows &&
                    (l.currentFilters || []).join(',') === (p.currentFilters || []).join(',') &&
                    l.sortList === (c.sortList || []).join(',') ) { return; }
                if (c.debug) {
                    ts.log('Pager changing to page ' + p.page);
                }
                p.last = {
                    page : p.page,
                    size : p.size,
                    // fixes #408; modify sortList otherwise it auto-updates
                    sortList : (c.sortList || []).join(','),
                    totalRows : p.totalRows,
                    currentFilters : p.currentFilters || []
                };
                if (p.ajax) {
                    getAjax(table, p);
                } else if (!p.ajax) {
                    renderTable(table, c.rowsCopy, p);
                }
                $.data(table, 'pagerLastPage', p.page);
                if (p.initialized && pageMoved !== false) {
                    $t
                        .trigger('pageMoved', p)
                        .trigger('applyWidgets');
                    if (table.isUpdating) {
                        $t.trigger('updateComplete');
                    }
                }
            },

            setPageSize = function(table, size, p) {
                p.size = size || p.size || 10;
                p.$size.val(p.size);
                $.data(table, 'pagerLastPage', p.page);
                $.data(table, 'pagerLastSize', p.size);
                p.totalPages = Math.ceil( p.totalRows / p.size );
                p.filteredPages = Math.ceil( p.filteredRows / p.size );
                moveToPage(table, p);
            },

            moveToFirstPage = function(table, p) {
                p.page = 0;
                moveToPage(table, p);
            },

            moveToLastPage = function(table, p) {
                p.page = ( Math.min( p.totalPages, p.filteredPages ) - 1 );
                moveToPage(table, p);
            },

            moveToNextPage = function(table, p) {
                p.page++;
                if ( p.page >= ( Math.min( p.totalPages, p.filteredPages ) - 1 ) ) {
                    p.page = ( Math.min( p.totalPages, p.filteredPages ) - 1 );
                }
                moveToPage(table, p);
            },

            moveToPrevPage = function(table, p) {
                p.page--;
                if ( p.page <= 0 ) {
                    p.page = 0;
                }
                moveToPage(table, p);
            },

            destroyPager = function(table, p){
                showAllRows(table, p);
                p.$container.hide(); // hide pager
                table.config.appender = null; // remove pager appender function
                p.initialized = false;
                delete table.config.rowsCopy;
                $(table).unbind('destroy.pager sortEnd.pager filterEnd.pager enable.pager disable.pager');
                if (ts.storage) {
                    ts.storage(table, p.storageKey, '');
                }
            },

            enablePager = function(table, p, triggered){
                var info,
                    c = table.config;
                p.$size.add(p.$goto).removeClass(p.cssDisabled).removeAttr('disabled').attr('aria-disabled', 'false');
                p.isDisabled = false;
                p.page = $.data(table, 'pagerLastPage') || p.page || 0;
                p.size = $.data(table, 'pagerLastSize') || parseInt(p.$size.find('option[selected]').val(), 10) || p.size || 10;
                p.$size.val(p.size); // set page size
                p.totalPages = Math.ceil( Math.min( p.totalRows, p.filteredRows ) / p.size );
                // if table id exists, include page display with aria info
                if ( table.id ) {
                    info = table.id + '_pager_info';
                    p.$container.find(p.cssPageDisplay).attr('id', info);
                    c.$table.attr('aria-describedby', info);
                }
                if ( triggered ) {
                    c.$table.trigger('updateRows');
                    setPageSize(table, p.size, p);
                    hideRowsSetup(table, p);
                    fixHeight(table, p);
                    if (c.debug) {
                        ts.log('pager enabled');
                    }
                }
            };

        $this.appender = function(table, rows) {
            var c = table.config,
                p = c.pager;
            if ( !p.ajax ) {
                c.rowsCopy = rows;
                p.totalRows = p.countChildRows ? c.$tbodies.eq(0).children().length : rows.length;
                p.size = $.data(table, 'pagerLastSize') || p.size || 10;
                p.totalPages = Math.ceil( p.totalRows / p.size );
                renderTable(table, rows, p);
                // update display here in case all rows are removed
                updatePageDisplay(table, p, false);
            }
        };

        $this.construct = function(settings) {
            return this.each(function() {
                // check if tablesorter has initialized
                if (!(this.config && this.hasInitialized)) { return; }
                var t, ctrls, fxn,
                    table = this,
                    c = table.config,
                    wo = c.widgetOptions,
                    p = c.pager = $.extend( true, {}, $.tablesorterPager.defaults, settings ),
                    $t = c.$table,
                // added in case the pager is reinitialized after being destroyed.
                    pager = p.$container = $(p.container).addClass('tablesorter-pager').show();
                if (c.debug) {
                    ts.log('Pager initializing');
                }
                p.oldAjaxSuccess = p.oldAjaxSuccess || p.ajaxObject.success;
                c.appender = $this.appender;
                if (ts.filter && $.inArray('filter', c.widgets) >= 0) {
                    // get any default filter settings (data-value attribute) fixes #388
                    p.currentFilters = c.$table.data('lastSearch') || ts.filter.setDefaults(table, c, c.widgetOptions) || [];
                    // set, but don't apply current filters
                    ts.setFilters(table, p.currentFilters, false);
                }
                if (p.savePages && ts.storage) {
                    t = ts.storage(table, p.storageKey) || {}; // fixes #387
                    p.page = isNaN(t.page) ? p.page : t.page;
                    p.size = ( isNaN(t.size) ? p.size : t.size ) || 10;
                    $.data(table, 'pagerLastSize', p.size);
                }

                // skipped rows
                p.regexRows = new RegExp('(' + (wo.filter_filteredRow || 'filtered') + '|' + c.selectorRemove.substring(1) + '|' + c.cssChildRow + ')');

                $t
                    .unbind('filterStart filterEnd sortEnd disable enable destroy update updateRows updateAll addRows pageSize '.split(' ').join('.pager '))
                    .bind('filterStart.pager', function(e, filters) {
                        p.currentFilters = filters;
                        // don't change page is filters are the same (pager updating, etc)
                        if (p.pageReset !== false && (c.lastCombinedFilter || '') !== (filters || []).join('')) {
                            p.page = p.pageReset; // fixes #456 & #565
                        }
                    })
                    // update pager after filter widget completes
                    .bind('filterEnd.pager sortEnd.pager', function() {
                        if (p.initialized) {
                            // update page display first, so we update p.filteredPages
                            updatePageDisplay(table, p, false);
                            moveToPage(table, p, false);
                            fixHeight(table, p);
                        }
                    })
                    .bind('disable.pager', function(e){
                        e.stopPropagation();
                        showAllRows(table, p);
                    })
                    .bind('enable.pager', function(e){
                        e.stopPropagation();
                        enablePager(table, p, true);
                    })
                    .bind('destroy.pager', function(e){
                        e.stopPropagation();
                        destroyPager(table, p);
                    })
                    .bind('update updateRows updateAll addRows '.split(' ').join('.pager '), function(e){
                        e.stopPropagation();
                        hideRows(table, p);
                    })
                    .bind('pageSize.pager', function(e,v){
                        e.stopPropagation();
                        setPageSize(table, parseInt(v, 10) || 10, p);
                        hideRows(table, p);
                        updatePageDisplay(table, p, false);
                        if (p.$size.length) { p.$size.val(p.size); } // twice?
                    })
                    .bind('pageSet.pager', function(e,v){
                        e.stopPropagation();
                        p.page = (parseInt(v, 10) || 1) - 1;
                        if (p.$goto.length) { p.$goto.val(p.size); } // twice?
                        moveToPage(table, p);
                        updatePageDisplay(table, p, false);
                    });

                // clicked controls
                ctrls = [ p.cssFirst, p.cssPrev, p.cssNext, p.cssLast ];
                fxn = [ moveToFirstPage, moveToPrevPage, moveToNextPage, moveToLastPage ];
                pager.find(ctrls.join(','))
                    .attr("tabindex", 0)
                    .unbind('click.pager')
                    .bind('click.pager', function(e){
                        e.stopPropagation();
                        var i, $t = $(this), l = ctrls.length;
                        if ( !$t.hasClass(p.cssDisabled) ) {
                            for (i = 0; i < l; i++) {
                                if ($t.is(ctrls[i])) {
                                    fxn[i](table, p);
                                    break;
                                }
                            }
                        }
                    });

                // goto selector
                p.$goto = pager.find(p.cssGoto);
                if ( p.$goto.length ) {
                    p.$goto
                        .unbind('change')
                        .bind('change', function(){
                            p.page = $(this).val() - 1;
                            moveToPage(table, p);
                            updatePageDisplay(table, p, false);
                        });
                }

                // page size selector
                p.$size = pager.find(p.cssPageSize);
                if ( p.$size.length ) {
                    p.$size.unbind('change.pager').bind('change.pager', function() {
                        p.$size.val( $(this).val() ); // in case there are more than one pagers
                        if ( !$(this).hasClass(p.cssDisabled) ) {
                            setPageSize(table, parseInt( $(this).val(), 10 ), p);
                            changeHeight(table, p);
                        }
                        return false;
                    });
                }

                // clear initialized flag
                p.initialized = false;
                // before initialization event
                $t.trigger('pagerBeforeInitialized', p);

                enablePager(table, p, false);

                if ( typeof(p.ajaxUrl) === 'string' ) {
                    // ajax pager; interact with database
                    p.ajax = true;
                    //When filtering with ajax, allow only custom filtering function, disable default filtering since it will be done server side.
                    c.widgetOptions.filter_serversideFiltering = true;
                    c.serverSideSorting = true;
                    moveToPage(table, p);
                } else {
                    p.ajax = false;
                    // Regular pager; all rows stored in memory
                    $(this).trigger("appendCache", true);
                    hideRowsSetup(table, p);
                }

                changeHeight(table, p);

                // pager initialized
                if (!p.ajax) {
                    p.initialized = true;
                    $(table).trigger('pagerInitialized', p);
                }
            });
        };

    }() });

    // see #486
    ts.showError = function(table, message){
        $(table).each(function(){
            var $row,
                c = this.config,
                errorRow = c.pager && c.pager.cssErrorRow || c.widgetOptions.pager_css && c.widgetOptions.pager_css.errorRow || 'tablesorter-errorRow';
            if (c) {
                if (typeof message === 'undefined') {
                    c.$table.find('thead').find(c.selectorRemove).remove();
                } else {
                    $row = ( /tr\>/.test(message) ? $(message) : $('<tr><td colspan="' + c.columns + '">' + message + '</td></tr>') )
                        .click(function(){
                            $(this).remove();
                        })
                        // add error row to thead instead of tbody, or clicking on the header will result in a parser error
                        .appendTo( c.$table.find('thead:first') )
                        .addClass( errorRow + ' ' + c.selectorRemove.replace(/^[.#]/, '') )
                        .attr({
                            role : 'alert',
                            'aria-live' : 'assertive'
                        });
                }
            }
        });
    };

// extend plugin scope
    $.fn.extend({
        tablesorterPager: $.tablesorterPager.construct
    });

})(jQuery);