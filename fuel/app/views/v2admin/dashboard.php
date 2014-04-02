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
        <div class="col-md-6">
            <h4 style="border-left: 3px solid #428bca;padding-left: 10px; margin-left: 30px">会员注册统计(一周)</h4>
            <div class="row" style="padding:10px">
                <canvas id="member" height="300" width="576"></canvas>
                <?php
                    $d = 7;
                    $dates = [];
                    for($i = 0; $i < $d; $i++) {
                        $dates[] = date('Y-m-d', time() - $i * 86400);
                    }
                    $dates = array_reverse($dates);
                    $regs = [];
                    $max = 0;
                    foreach($dates as $date) {
                        $count = Model_Member::count(['where' => [['created_at', '>=', strtotime($date)], ['created_at', '<', strtotime($date) + 86400], 'type' => 0]]);

                        $regs[] = $count;
                        $max = $max < $count ? $count : $max;
                    }
                
                ?>
                <script>
                    var max = <?php echo $max;?>;
                    var lineChartData = {
                        labels : <?php echo json_encode($dates);?>,
                        datasets : [
                            {
                                fillColor : "rgba(151,187,205,0.5)",
                                strokeColor : "rgba(151,187,205,1)",
                                pointColor : "rgba(151,187,205,1)",
                                pointStrokeColor : "#fff",
                                data : <?php echo json_encode($regs);?> 
                            }
                        ]
                        
                    }
                newopts.scaleStepWidth = Math.ceil(max/newopts.scaleSteps);
                var myLine = new Chart(document.getElementById("member").getContext("2d")).Line(lineChartData, newopts);
                </script>
            </div>
        </div>
        <div class="col-md-6">
            <h4 style="border-left: 3px solid #428bca;padding-left: 10px; margin-left: 30px">会员订单统计(一周)</h4>
            <div class="row" style="padding:10px">
                <canvas id="order" height="300" width="576"></canvas>
                <?php
                    $d = 7;
                    $dates = [];
                    for($i = 0; $i < $d; $i++) {
                        $dates[] = date('Y-m-d', time() - $i * 86400);
                    }
                    $dates = array_reverse($dates);
                    $orders = [];
                    $members = DB::select('id')->from('members')->where('type', '=', 1)->as_assoc()->execute();
                    $ids = [0];
                    foreach($members->as_array() as $member) {
                        $ids[] = $member['id'];
                    }
                    $orders = [];
                    $max = 0;
                    foreach($dates as $date) {
                        $count = DB::select(DB::expr('COUNT(DISTINCT id) as count'))
                                   ->from('orders')
                                   ->where('created_at', '>=', strtotime($date))
                                   ->where('created_at', '<', strtotime($date)+86400)
                                   ->where('id', 'not in', $ids)
                                   ->as_assoc()->execute();

                        $number = $count->as_array()[0]['count'];
                        $orders[] = $number;
                        $max = $max < $number ? $number : $max;
                    }
                ?>
                <script>
                    var max = <?php echo $max?>;
                    var orderData = {
                        labels : <?php echo json_encode($dates);?>,
                        datasets : [
                            {
                                fillColor : "rgba(151,187,205,0.5)",
                                strokeColor : "rgba(151,187,205,1)",
                                pointColor : "rgba(151,187,205,1)",
                                pointStrokeColor : "#fff",
                                data : <?php echo json_encode($orders);?> 
                            }
                        ]
                        
                    }
                newopts.scaleStepWidth = Math.ceil(max/newopts.scaleSteps);
                var orderLine = new Chart(document.getElementById("order").getContext("2d")).Line(orderData, newopts);
                </script>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="border-left: 3px solid #428bca;padding-left: 10px; margin-left: 30px">元宝消费统计(半个月)</h4>
            <div class="row" style="padding:10px">
                <canvas id="sell" height="300" width="1152"></canvas>
                <?php
                    $d = 15;
                    $dates = [];
                    for($i = 0; $i < $d; $i++) {
                        $dates[] = date('Y-m-d', time() - $i * 86400);
                    }
                    $dates = array_reverse($dates);
                    $orders = [];
                    $members = DB::select('id')->from('members')->where('type', '=', 1)->as_assoc()->execute();
                    $ids = [0];
                    foreach($members->as_array() as $member) {
                        $ids[] = $member['id'];
                    }
                    $orders = [];
                    $max = 0;
                    foreach($dates as $date) {
                        $count = DB::select(DB::expr('SUM(code_count) as count'))
                                   ->from('orders')
                                   ->where('created_at', '>=', strtotime($date))
                                   ->where('created_at', '<', strtotime($date)+86400)
                                   ->where('id', 'not in', $ids)
                                   ->as_assoc()->execute();

                        $number = $count->as_array()[0]['count'];
                        $orders[] = $number;
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
                                data : <?php echo json_encode($orders);?> 
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
