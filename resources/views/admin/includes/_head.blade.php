  <title>Administration IAEC</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description"
      content="Able Pro is trending dashboard template made using Bootstrap 5 design framework. Able Pro is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
  <meta name="keywords"
      content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
  <meta name="author" content="Phoenixcoded">

  <!-- [Favicon] icon -->
  <link rel="icon" href="{{ asset('../assets/images/favicon.svg') }}" type="image/x-icon"> <!-- [Font] Family -->
  <link rel="stylesheet" href="{{ asset('../assets/fonts/inter/inter.css') }}" id="main-font-link" />
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="{{ asset('../assets/fonts/tabler-icons.min.css') }}">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="{{ asset('../assets/fonts/feather.css') }}">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="{{ asset('../assets/fonts/fontawesome.css') }}">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="{{ asset('../assets/fonts/material.css') }}">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="{{ asset('../assets/css/style.css') }}" id="main-style-link">
  <link rel="stylesheet" href="{{ asset('../assets/css/style-preset.css') }}">
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>
  <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
          dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'G-14K1GBX9FG');
  </script>
  <!-- WiserNotify -->
  <script>
      !(function() {
          if (window.t4hto4) console.log('WiserNotify pixel installed multiple time in this page');
          else {
              window.t4hto4 = !0;
              var t = document,
                  e = window,
                  n = function() {
                      var e = t.createElement('script');
                      (e.type = 'text/javascript'),
                      (e.async = !0),
                      (e.src = 'https://pt.wisernotify.com/pixel.js?ti=1jclj6jkfc4hhry'),
                      document.body.appendChild(e);
                  };
              'complete' === t.readyState ? n() : window.attachEvent ? e.attachEvent('onload', n) : e
                  .addEventListener('load', n, !1);
          }
      })();
  </script>
  <!-- Microsoft clarity -->
  <script type="text/javascript">
      (function(c, l, a, r, i, t, y) {
          c[a] =
              c[a] ||
              function() {
                  (c[a].q = c[a].q || []).push(arguments);
              };
          t = l.createElement(r);
          t.async = 1;
          t.src = 'https://www.clarity.ms/tag/' + i;
          y = l.getElementsByTagName(r)[0];
          y.parentNode.insertBefore(t, y);
      })(window, document, 'clarity', 'script', 'gkn6wuhrtb');
  </script>
   <script>
      // [ DOM/jquery ]
      var total, pageTotal;
      var table = $('#dom-jqry').DataTable();
      // [ column Rendering ]
      $('#colum-render').DataTable({
        columnDefs: [
          {
            render: function (data, type, row) {
              return data + ' (' + row[3] + ')';
            },
            targets: 0
          },
          {
            visible: false,
            targets: [3]
          }
        ]
      });
      // [ Multiple Table Control Elements ]
      $('#multi-table').DataTable({
        dom: '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
      });
      // [ Complex Headers With Column Visibility ]
      $('#complex-header').DataTable({
        columnDefs: [
          {
            visible: false,
            targets: -1
          }
        ]
      });
      // [ Language file ]
      $('#lang-file').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json'
        }
      });
      // [ Setting Defaults ]
      $('#setting-default').DataTable();
      // [ Row Grouping ]
      var table1 = $('#row-grouping').DataTable({
        columnDefs: [
          {
            visible: false,
            targets: 2
          }
        ],
        order: [[2, 'asc']],
        displayLength: 25,
        drawCallback: function (settings) {
          var api = this.api();
          var rows = api
            .rows({
              page: 'current'
            })
            .nodes();
          var last = null;

          api
            .column(2, {
              page: 'current'
            })
            .data()
            .each(function (group, i) {
              if (last !== group) {
                $(rows)
                  .eq(i)
                  .before('<tr class="group"><td colspan="5">' + group + '</td></tr>');

                last = group;
              }
            });
        }
      });
      // [ Order by the grouping ]
      $('#row-grouping tbody').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
          table.order([2, 'desc']).draw();
        } else {
          table.order([2, 'asc']).draw();
        }
      });
      // [ Footer callback ]
      $('#footer-callback').DataTable({
        footerCallback: function (row, data, start, end, display) {
          var api = this.api(),
            data;

          // Remove the formatting to get integer data for summation
          var intVal = function (i) {
            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
          };

          // Total over all pages
          total = api
            .column(4)
            .data()
            .reduce(function (a, b) {
              return intVal(a) + intVal(b);
            }, 0);

          // Total over this page
          pageTotal = api
            .column(4, {
              page: 'current'
            })
            .data()
            .reduce(function (a, b) {
              return intVal(a) + intVal(b);
            }, 0);

          // Update footer
          $(api.column(4).footer()).html('$' + pageTotal + ' ( $' + total + ' total)');
        }
      });
      // [ Custom Toolbar Elements ]
      $('#c-tool-ele').DataTable({
        dom: '<"toolbar">frtip'
      });
      // [ Custom Toolbar Elements ]
      $('div.toolbar').html('<b>Custom tool bar! Text/images etc.</b>');
      // [ custom callback ]
      $('#row-callback').DataTable({
        createdRow: function (row, data, index) {
          if (data[5].replace(/[\$,]/g, '') * 1 > 150000) {
            $('td', row).eq(5).addClass('highlight');
          }
        }
      });
    </script>
