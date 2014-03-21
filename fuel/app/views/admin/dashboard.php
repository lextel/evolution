<?php echo Asset::js(['admin/Chart.min.js']); ?>
<div style="margin: 10px">
    <div class="row">
        <div class="col-md-6">
            <h4 style="border-left: 3px solid #428bca;padding-left: 10px; margin-left: 30px">会员注册统计(一周)</h4>
            <div class="row" style="padding:10px">
                <canvas id="member" height="200" width="576"></canvas>
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
                    var steps = 10;
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
                var myLine = new Chart(document.getElementById("member").getContext("2d")).Line(lineChartData,{animation: false, scaleOverride: true, scaleSteps: steps, scaleStepWidth: Math.ceil(max / steps), scaleStartValue:0});
                </script>
            </div>
        </div>
        <div class="col-md-6">
            <h4 style="border-left: 3px solid #428bca;padding-left: 10px; margin-left: 30px">会员订单统计(一周)</h4>
            <div class="row" style="padding:10px">
                <canvas id="order" height="200" width="576"></canvas>
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
                var max = <?php echo $max;?>;
                var orderLine = new Chart(document.getElementById("order").getContext("2d")).Line(orderData, {animation: false, scaleOverride: true, scaleSteps: steps, scaleStepWidth: Math.ceil(max / steps), scaleStartValue:0});
                </script>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="border-left: 3px solid #428bca;padding-left: 10px; margin-left: 30px">元宝消费统计(半个月)</h4>
            <div class="row" style="padding:10px">
                <canvas id="sell" height="200" width="1152"></canvas>
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
                var max = <?php echo $max;?>;
                var sellLine = new Chart(document.getElementById("sell").getContext("2d")).Line(sellData, {animation: false, scaleOverride: true, scaleSteps: steps, scaleStepWidth: Math.ceil(max / steps), scaleStartValue:0});
                </script>

            </div>
        </div>
    </div>

</div>
