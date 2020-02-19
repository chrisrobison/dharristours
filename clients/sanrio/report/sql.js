Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};
if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function(what, i) {
        i = i || 0;
        var L = this.length;
        while (i < L) {
            if(this[i] === what) return i;
            ++i;
        }
        return -1;
    };
}

(function($){
    $.fn.disableSelection = function() {
        return this
                 .attr('unselectable', 'on')
                 .css('user-select', 'none')
                 .on('selectstart', false);
    };
})(jQuery);

// SELECT
// FROM
// WHERE
// ORDER BY
// GROUP BY
// HAVING
(function($) {
   var simple = {
      query: {
         SELECT: [],
         FROM: [],
         WHERE: [],
         ORDERBY: [],
         GROUPBY: [],
         HAVING: []
      },
      links: {}
   },
      tblcvs = $("#tables-canvas"),
      queryparts = ['SELECT', 'FROM', 'INNER JOIN', 'LEFT OUTER JOIN', 'RIGHT OUTER JOIN', 'ON', 'WHERE', 'ORDER BY','GROUP BY','HAVING'];

   window.simple = simple;

   function init() {
      // $("body").disableSelection();
      $("#tables").droppable({
         accept: ".table",
         activeClass: "state-active",
         hoverClass: "state-hover",
         drop: function(e, ui) {
            addTable(e, ui);
         }
      })
      .on("click", ".fielditem", function(e) {
         var fieldname = $(this).attr('rel');
         if (fieldname) fieldname.replace(/\-/g, '.');

         if ($(this).is(":checked")) {
            simple.query.SELECT.push(fieldname);
            addQueryField(fieldname);
         } else {
            simple.query.SELECT.remove(fieldname);
            removeQueryField(fieldname.replace(/\./, '-'));
         }

         updateSQL(simple.query);
      })
      .on("scroll", ".fieldlist", function() {
         // updateLines(tblcvs, $("tr.field"));
         updateLinks();
      });

      $.getJSON("/files/report/ctl.php?db=Sanrio&x=get-reports", function(data) {
         var items = [ '<li class="nav-header">Reports</li>' ], html;
         $.each(data, function(key, val) {
            var el = '<li class="nav-report draggable" id="Report_' + val.ReportID + '"><span class="toggle closed"></span><span class="report-title">' + val.Report + "</span>", matches, i, key, def, tmp;
            
            matches = val.Query.match(/\$\$([^\$]+)\$\$/g);
            
            if (matches && matches.length) {
               el += "<ul class='variables' style='display:none'>";
               for (i = 0; i < matches.length; i++) {
                  tmp = matches[i].match(/\$\$(.+?)\$\$/);
                  if (tmp.length) {
                     key = tmp[1].replace(/:.*/, '');
                     def = tmp[1].match(/:/) ? tmp[1].replace(/^.+?:/, '') : '';

                     el += "<li class='keyval'><label>" + key + "</label> <input type='text' id='var_" + key + "' value='" + def + "' class='variable report-" + val.ReportID + "'></li>";
                  }
               }
               el += "<li class='frmbtn'><button class='btn-" + val.ReportID + "'>&#9654; Run Report</button></li></ul>";

            }

            el += '</li>';
            items.push(el);
         });
         
         html = items.join('');
         // $('<ul/>', { 'class': 'dbs', html: items.join('') })
         
         $(html).appendTo($("ul.nav-list"));
         $('.nav').on('click', 'li.nav-report span.toggle, li.nav-report span.report-title', function(e) {
               // $(this).toggleClass("open").toggleClass("closed");
               if (!$("ul", $(this).parent()).length) {
                  var id = $(this).parent().attr('id').replace(/^Report_/, '');
                  runReport(id);
               } else {
                  $("ul", $(this).parent()).toggle();
                  $(".toggle", $(this).parent()).toggleClass('open').toggleClass('closed');
               }
            })
         .on('dblclick', 'li.table', function(e) {
            
            if (!$(this).next("ul").length) {
               var ui = { draggable: $(this) };
               addTable(e, ui);
               // getData('get-column-list', $(this).parent().attr('id'), 'column', $(this), $(this).attr('id'));
            } else {
               $(this).next("ul").toggle();
               $(this).parent().toggleClass("open").toggleClass("closed");
            }

         });
         
         $(".frmbtn button").click(function(e) {
            var rid = $(this).attr('class').replace(/btn\-/, ''), out = {};
            
            $(".report-" + rid).each(function() {
               var key = $(this).attr('id').replace(/^var_/, ''), val = $(this).val();
               out[key] = val;
            });

            runReport(rid, out);
            e.preventDefault();
            e.stopPropagation();
            return false;
         });
      });
      
      $("#current-user").html(decodeURIComponent(document.cookie.match(/name=([^;]*)/)[1]).replace(/\+/g, ' '));
      $(".tabs").tabs();
   }
   
   function runReport(id, param) {
      var out = { vars: param, 
                  db: 'Sanrio',
                  x: 'get-report',
                  id: id
                };
      $("#report").html("<span class='droptgt'>Loading...</span>");
      $("#loading").show();

      $.getJSON("/files/report/ctl.php", out, function(data) {
         var report = data[0];
         $("#query").html(report.Query); 
         $("#template").html(report.Template); 
         $("#report-name").html(report.Report); 
         $("#report").load("/files/report/report.php", out, function(e) {
            tableToGrid("#report-table");
            $("#report-table").jqGrid("setGridHeight", "422px");
            $("#loading").hide();
         });
      });
   }

   function addTable(e, ui) {
      var tbl = ui.draggable.attr('id'),
          db = ui.draggable.parent().attr('id');

      simple.query.FROM.push(tbl);

      updateSQL(simple.query);
      $(".dragging").detach();

      $.getJSON("/files/report/ctl.php?x=get-columns&db=" + db + "&tbl=" + tbl, function(data) {
         console.dir(data);
         var tblhtml = buildFieldTable(db, tbl, data);
         $("#tables").append($("<div/>").addClass('fieldlist').append($("<label>"+tbl+"</label>")).append($("<div/>").addClass("fieldWrap").append($(tblhtml))));
         $(".fieldlist").draggable({
            handle:"label", 
            stack:".fieldlist",
            drag: function() {
               // updateLines(tblcvs, $("tr.field"));
               updateLinks();
            }
         });
         $(".field.draggable")
            .draggable({
               appendTo: ".container-fluid", 
               containment:"window", 
               scroll: false, 
               zIndex: 9999, 
               helper: function(event) {
                  var dragel = $(this).clone(),
                      did = dragel.attr('id').replace(/^field_/, '');
                  dragel.attr('id', 'drag_' + did).attr('rel', did);
                  return $("<div class='red dragging fieldlist'/>").css({height: "2em"}).append($("<table class='fieldtable'/>").append(dragel) );
               },
               drag: function() {
                  // updateLines(tblcvs, $("tr.field"));
                  updateLinks();
               },
               stop: function(e, ui) {
                  $(".dragging").detach();
               }
            })
            .droppable({accept:".field.draggable", drop:linkFields});
      // getData('get-column-list', ui.draggable.parent().attr('id'), 'column', $("#tables"), ui.draggable[0].id);
      });

   }

   function updateSQL(obj) {
      var mysql = "", key, field;
      
      for (key in obj) {
         if (obj.hasOwnProperty(key)) {
            if (obj[key].length || key.match(/SELECT|FROM/)) {
               mysql += key;

               if (obj[key].length) {
                  for (var f=0; f < obj[key].length; f++) {
                     obj[key][f] = obj[key][f].replace(/\-/g, '.');
                  }
               } 
               mysql += "\n\t" + (obj[key].join(', ') || "*") + "\n";
            }
         }
      }
      $("#mysql").html(mysql);
      return mysql;
   }

   function parseSQL(sql) {
      var i, out, re, matches;
      if (!sql) sql = $("#mysql").html();

      sql = sql.replace(/\n\t/g, '');
      
      re = new RegEx("(" + queryparts.join('|') + ")(.+?)(" + queryparts.join('|') + ")", "g");
      matches = sql.match(re);
      console.dir(matches);
      for (i=0; i<matches.length; i++) { 
         debugger;
      }
   }

   function addLink(src, tgt) {
      var endpointOptions = { isSource:true, isTarget:true, radius:2 },
          div1Endpoint = jsPlumb.addEndpoint(src, { anchor:"Continuous", radius:2 }, { isSource:true });  
          div2Endpoint = jsPlumb.addEndpoint(tgt, { anchor:"Continuous", radius:2 }, { isTarget:true });  
      jsPlumb.connect({ 
          source:div1Endpoint,
          target:div2Endpoint,
          connector: "Straight",
          paintStyle:{ lineWidth:4, strokeStyle:'#0099cc' },
          container: $("#tables"),
          endpoint:[ "Dot", { radius:5, hoverClass:"myEndpointHover" }, {cssClass: "endpointClass" }],
          overlays: [
             [ "Arrow", { width:20, length:30, location:.50 }, {cssClass: "arrowClass"} ],
             [ "Label", { cssClass:"labelClass", label: src.attr('id') } ] 
          ]
      }); 
   }
   function updateLinks() {
      jsPlumb.repaintEverything();
   }

   function buildFieldTable(db, tbl, data) {
      var items = [], id, html;
      if (data) {
         $.each(data, function(key, val) {
            var chkbox = "<input type='checkbox' class='fielditem' rel='" + db + "-" + tbl + "-" + key + "' id='field-" + db + "-" + tbl + "-" + key + "'>";
            var out = '<tr id="field_' + db + '-' + tbl + '-' + key + '" class="field draggable"><td>' + chkbox + '</td><td>' + key + "</td><td>" + val["type"] + "</td></tr>";
            items.push(out);
         });
         id = db;
         id += (tbl) ? '-' + tbl : '';
         id += "_clone";
         html = items.join('');
         return '<table class="fieldtable" id="'+id+'">' + html + '</table>';
      }
   }

   function getData(action, db, cls, tgt, tbl) {
      var url = "/files/report/ctl.php?x=" + action;
      if (db) {
         url += "&db=" + db;
         cls = "table";
         txt = "Tables";
      } else {
         cls = "db closed";
         txt = "Databases";
      }
      if (tbl) {
         url += "&tbl=" + tbl;
         cls = "column";
         txt = "Fields";
      }
      console.log("Fetching "+url);
      $.getJSON(url, function(data) {
         console.dir(data);
         var items = ['<li class="nav-header">' + txt + '</li>'];
         if (data) {
            $.each(data, function(key, val) {
               var out = '<li class="draggable ' + cls + '" id="' + val + '">';
               if ((typeof val == "object") && (val != null)) {
                  out += dump(val);
               } else {
                  out += val;
               }
               out += "</li>";
               items.push(out);
            });
            var id = db;
            id += (tbl) ? '-' + tbl : '';
            $('<ul/>', {
               'class': cls + ' ' + db + ' ' + tbl,
               'id': id,
               html: items.join('')
            }).insertAfter(tgt);
            $(".draggable").draggable({
               appendTo: ".container-fluid", containment:"window", 
               helper:function(e) {
                  var dragel = $(this).clone(),
                      did = dragel.attr('id').replace(/^/, '');
                  
                  dragel.attr('id', 'drag_' + did).attr('rel', did);
                  return $("<div class='dragging fieldlist'/>").css({height: "2em"}).append($("<table class='fieldtable'/>").append(dragel) );
               }, 
               scroll: false, 
               zIndex: 9999 
            });
         }
      });
   }

   function fetch(url) {
      $.getJSON(url, function(data) {
         console.dir(data);
         
      });

   }

   function addQueryField(who) {
      var show = who.replace(/^.*\./, '');
      show = show.replace(/\-/g, '.');
      $("#queryfields tbody").append($("<tr>").append($("<td class='center'><a href='#up' class='btn actionbtn'>&#9650;</a><a href='#down' class='btn actionbtn'>&#9660</a><a href='#remove' class='btn actionbtn'>&#9003;</a></td><td class='center' style='width:2em'><input type='checkbox' class='queryfieldcheck'></td><td>"+show+"</td><td></td><td></td><td></td><td></td><td></td>")).attr('id', 'query_'+who));
   }

   function removeQueryField(who) {
      $("query_" + who).parent().remove($("query_" + who));
   }
   
   function linkFields(e, ui) {
      var from = ui.draggable.attr('id').replace(/^field_/, ''), 
          to = $(this).attr('id').replace(/^field_/, ''),
          fel = $("#field_" + from),
          oldrel = fel.attr('rel') || "";

      fel.attr("rel", oldrel + " " + to);

      if (!simple.links[from]) simple.links[from] = [];
      simple.links[from].push(to);
      simple.query.WHERE.push(from + "=" + to);
      addLink(ui.draggable, $(this));
      updateLinks();
      updateSQL(simple.query);
      // updateLines(tblcvs, $("tr.field"));
   }

   function updateLines(canvasJq, blkEls) {
      try {
         if (canvasJq) {
            var canvasEl = canvasJq[0];
            if (canvasEl) {
               canvasEl.width = canvasJq.width();
               canvasEl.height = canvasJq.height();

               var cOffset = canvasJq.offset(), ctx = canvasEl.getContext("2d");

               ctx.clearRect(0, 0, canvasEl.width, canvasEl.height);
               ctx.beginPath();
            }         
            related = {};
            
            $(blkEls).each(function(){
               var obj = $(this), objID = obj.attr("id").replace(/(drag|field)_/, "");
               
               if (obj.attr("rel")) {
                  var srcOffset = obj.offset(), links = obj.attr("rel").split(/ /);
                  
                  for (var l in links) {
                     if (links.hasOwnProperty(l)) {
                        if (!related[links[l]]) related[links[l]] = {};
                        if (!related[objID]) related[objID] = {};
          
                        if (!related[links[l]][objID] && !related[objID][links[l]] ) {
                           var tgtEl = $("#field_"+links[l]);

                           if (tgtEl.length) {
                              var src, tgt, tgtOffset = tgtEl.offset();
                              
                              src = { 
                                       left: (srcOffset.left - cOffset.left) + (obj.width() / 2), 
                                       top: (srcOffset.top - cOffset.top) + obj.height(),
                                       cx: (((tgtOffset.left - cOffset.left) - (srcOffset.left - cOffset.left)) * .25),
                                       cy: (((tgtOffset.top - cOffset.top) - (srcOffset.top - cOffset.top)) * .25)
                                    };
                              tgt = { 
                                       left: (tgtOffset.left - cOffset.left) + (tgtEl.width() / 2),
                                       top: (tgtOffset.top - cOffset.top) + tgtEl.height(),
                                       cx: -(((tgtOffset.left - cOffset.left) - src.left) * .25),
                                       cy: -(((tgtOffset.top - cOffset.top) - src.top) * .25)
                                    };
                              ctx.moveTo(src.left, src.top);
                              ctx.bezierCurveTo(src.left + src.cx, src.top + src.cy, tgt.left + tgt.cx, tgt.top + tgt.cy, tgt.left, tgt.top);
                              // ctx.moveTo(srcOffset.left - cOffset.left, srcOffset.top - cOffset.top);
                              // ctx.lineTo(tgtOffset.left - cOffset.left, tgtOffset.top - cOffset.top);
                           }
                           related[links[l]][objID] = 1;
                        }
                     }
                  }
               }
            });
            ctx.lineWidth = 3;
            ctx.strokeStyle = "#09d";
            ctx.shadowOffsetX = 3;
            ctx.shadowOffsetY = 3;
            ctx.shadowBlur = 4;
            ctx.shadowColor = "rgba(0,0,0,.35)";

            ctx.stroke();
            ctx.closePath();
         }
      } catch(err) {
         debugger;
         // do some error handling here for Christ's sake
      }
   }

   init();

})(jQuery);
