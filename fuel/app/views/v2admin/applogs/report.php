<?php echo Asset::js(['admin/Chart.min.js']); ?>
<script>
var newopts = {
      animation:false,
      inGraphDataShow : true,
      datasetFill : true,
      canvasBorders : true,
      canvasBordersWidth : 0,
      canvasBordersColor : "black",
      legend : false,
      legendFontFamily : "'Arial'",
      legendFontSize : 12,
      legendFontStyle : "normal",
      legendFontColor : "#666",
      legendBlockSize : 12,
      legendBorders : false,
      legendBordersWidth : 1,
      legendBordersColors : "#666",
      yAxisLeft : true,
      yAxisRight : false,
      xAxisBottom : true,
      xAxisTop : false,
      yAxisUnit : "数量",
      yAxisUnitFontFamily : "'Arial'",
      yAxisUnitFontSize : 8,
      yAxisUnitFontStyle : "normal",
      yAxisUnitFontColor : "#666",
      annotateDisplay : false, 
      spaceTop : 0,
      spaceBottom : 0,
      spaceLeft : 0,
      spaceRight : 0,
      logarithmic: false,
      rotateLabels : "smart",
      xAxisSpaceOver : 0,
      xAxisSpaceUnder : 0,
      xAxisLabelSpaceAfter : 0,
      xAxisLabelSpaceBefore : 0,
      legendBordersSpaceBefore : 0,
      legendBordersSpaceAfter : 0,
      footNoteSpaceBefore : 0,
      footNoteSpaceAfter : 0, 
      dynamicDisplay :false,
      startAngle : 0,
      scaleLabel: "<%=value%>",
      scaleFontSize : 10,
      scaleOverride: true,
      scaleSteps: 10,
      scaleStartValue:0
}
</script>
<div style="margin: 10px">
    <div class="row">
        <div class="col-md-12">
            <h4 style="border-left: 3px solid #428bca;padding-left: 10px; margin-left: 30px">下载APP分类排名（历史）</h4>
            <div class="row" style="padding:10px">
                <canvas id="member" height="300" width="1152"></canvas>
                <?php
                    $max = 0;
                    $count = DB::select('title', DB::expr('count(id) as count'))
                              ->from('awardlog')
                              ->group_by('package')
                              ->order_by('count', 'desc')
                              ->order_by('count')
                              ->as_assoc()->execute();
                    $datas = [];
                    $apps = [];
                    foreach($count->as_array() as $app){
                        $datas[] = $app['title'];
                        $number = $app['count'];
                        $apps[] = $number;
                        $max = $max < $number ? $number : $max;
                    }
                ?>
                <script>
                    var max = <?php echo $max;?>;
                    var lineChartData = {
                        labels : <?php echo json_encode($datas);?>,
                        datasets : [
                            {
                                fillColor : "rgba(151,187,205,0.5)",
                                strokeColor : "rgba(151,187,205,1)",
                                pointColor : "rgba(151,187,205,1)",
                                pointStrokeColor : "#fff",
                                data : <?php echo json_encode($apps);?> 
                            }
                        ]
                        
                    }
                newopts.scaleStepWidth = Math.ceil(max/newopts.scaleSteps);
                var myLine = new Chart(document.getElementById("member").getContext("2d")).Bar(lineChartData, newopts);
                </script>
            </div>
        </div>
     </div>
     <div class="row">
        <div class="col-md-12">
            <h4 style="border-left: 3px solid #428bca;padding-left: 10px; margin-left: 30px">APP下载分类排名(近一周)</h4>
            <div class="row" style="padding:10px">
                <canvas id="order" height="300" width="1152"></canvas>
                <?php
                    $d = 7;
                    $date = date('Y-m-d', time() - $d * 86400);
                    $count = DB::select('title', DB::expr('count(id) as count'))
                              ->from('awardlog')
                              ->where('created_at', '>=',strtotime($date))
                              ->where('created_at', '<', strtotime($date)+$d * 86400)
                              ->group_by('package')
                              ->order_by('count', 'desc')
                              ->order_by('count')
                              ->as_assoc()->execute();
                    $ids = [];
                    $logs = [];
                    $max = 0;
                    foreach($count->as_array() as $app) {
                        
                        $ids[] = $app['title'];
                        $number = $app['count'];
                        $logs[] = $number;
                        $max = $max < $number ? $number : $max;
                    }
                ?>
                <script>
                    var max = <?php echo $max?>;
                    var orderData = {
                        labels : <?php echo json_encode($ids);?>,
                        datasets : [
                            {
                                fillColor : "rgba(151,187,205,0.5)",
                                strokeColor : "rgba(151,187,205,1)",
                                pointColor : "rgba(151,187,205,1)",
                                pointStrokeColor : "#fff",
                                data : <?php echo json_encode($logs);?> 
                            }
                        ]
                        
                    }
                newopts.scaleStepWidth = Math.ceil(max/newopts.scaleSteps);
                var orderLine = new Chart(document.getElementById("order").getContext("2d")).Bar(orderData, newopts);
                </script>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="border-left: 3px solid #428bca;padding-left: 10px; margin-left: 30px">用户激活APP量(近1个月)</h4>
            <div class="row" style="padding:10px">
                <canvas id="sell" height="300" width="1152"></canvas>
                <?php
                    $d = 30;
                    $dates = [];
                    for($i = 0; $i < $d; $i++) {
                        $dates[] = date('Y-m-d', time() - $i * 86400);
                    }
                    $dates = array_reverse($dates);
                    $apps = [];
                    $max = 0;
                    foreach($dates as $date) {
                        $count = DB::select('id')
                                   ->from('awardlog')
                                   ->where('created_at', '>=', strtotime($date))
                                   ->where('created_at', '<', strtotime($date)+86400)
                                   ->as_assoc()->execute()->count();
                        $number = $count;
                        $apps[] = $count ? $number : 0;
                        $max = $max < $number ? $number : $max;
                    }
                ?>
                <script>
                    var max = <?php echo $max?>;
                    var sellData = {
                        labels : <?php echo json_encode($dates);?>,
                        datasets : [
                            {
                                fillColor : "rgba(151,187,205,0.5)",
                                strokeColor : "rgba(151,187,205,1)",
                                pointColor : "rgba(151,187,205,1)",
                                pointStrokeColor : "#fff",
                                data : <?php echo json_encode($apps);?> 
                            }
                        ]
                        
                    }
                newopts.scaleStepWidth = Math.ceil(max/newopts.scaleSteps);
                var sellLine = new Chart(document.getElementById("sell").getContext("2d")).Line(sellData, newopts);
                </script>

            </div>
        </div>
    </div>

</div>
