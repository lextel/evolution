
<div class="content-inner">
    <!--晒单开始-->
    <div class="show-box">
        <div class="toggles">
           <?php echo Html::anchor('u/posts', '已晒单', ['class'=>'first-child']); ?>
           <?php echo Html::anchor('u/noposts', '未晒单', ['class'=>'last-child active']); ?>
        </div>

        <div class="show-c">

            <table>
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>商品图片</th>
                        <th>商品信息</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($noposts as $post) { ?>
                    <tr>
                        
                        <td>1</td>
                        <td><div class="img-box"><a href=""><img src="img/54359.jpg" alt=""/></a></div></td>
                        <td>
                            <div class="text-title">（第539期）苹果Iphone 5s 16G版 3G手机</div>
                            <div class="number">幸运乐拍码：10000121</div>
                            <div class="datetime">揭晓时间：2013-12-33 10:00:00</div>
                        </td>
                        <td><a href="" class=" btn btn-default btn-sx">晒单</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <ul class="show-form" style="display:none">
                    <?php echo Form::open(['action' => 'u/post/add', 'method' => 'post']);?>
                    <li>
                        <label for="">标题</label>
                        <input name="title" type="text"/><span></span>
                        <label for="" class="error"></label>
                    </li>
                    <li>
                        <label for="" class="body-label">正文</label>
                        <textarea name="desc" id="" cols="70" rows="6"></textarea>
                        <label for="" class="error"></label>
                    </li>
                    <li>
                        <label for="" class="body-label">图片</label>
                        <dl>
                            <dd class="img-box">
                                <img src="img/54359.jpg" alt=""/>
                                <button class="delete"></button>
                            </dd>
                            <dd class="img-box">
                                <img src="img/54359.jpg" alt=""/>
                                <button class="delete"></button>
                            </dd>
                            <dd class="img-box">
                                <img src="img/54359.jpg" alt=""/>
                                <button class="delete"></button>
                            </dd>
                        </dl>
                        <button class="btn btn-default">上传图片</button>
                        <label for="" class="error"></label>
                    </li>
                    <li>
                        <input id="postid" name="postid" type="hidden" />
                    </li>
                    <li><button class="btn btn-red tj">发布</button></li>
                    <?php echo Form::close();?>
                </ul>
                <br />
            <?php echo Pagination::instance('postspage')->render(); ?>
        </div>
    </div>
    <!--获晒单结束-->
</div>
