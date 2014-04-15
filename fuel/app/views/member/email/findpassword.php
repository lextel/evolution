<table width="80%" border="0" style="" cellpadding="3" cellspacing="10">
        <tbody>
            <tr >
                <td style="border-bottom: 1px solid #aae;margin-bottom: 10px;" ><a href="http://www.llt.com/"><img src="<?php echo \Uri::create('assets/images/logo.png');?>" alt="乐乐淘首页"></a></td>
            </tr>
            <tr>
                <td>亲爱的&nbsp;<?php echo \Html::mail_to($email);?>:</td>
            </tr>
            <tr>
                <td style="text-indent: 2em">您好！感谢您使用乐乐淘邮箱找回密码功能。</td>
            </tr>
            <tr>
                <td style="text-indent: 2em">请点击下面的按钮，完成乐乐淘找回密码。
                </td>
            </tr>
            <tr>
                <td>
                <?php echo \Html::anchor($href, "乐乐淘密码找回", ['style'=>'margin-left: 2em; width: 120px; height: 24px; text-decoration: none;
                     display: inline-block;text-indent: 0; background: #eee;text-align: center;line-height: 22px;color:#000;']);?>
                </td>
            </tr>
            <tr>
                <td style="text-indent: 2em">如果上面的按钮不能点击或点击后没有反应，你还可以把以下链接复制到浏览器地址栏中访问完成找回密码。</td>
            </tr>
            <tr>
                <td><?php echo \Html::anchor($href, $href, ['style'=>'color: #004EFF;text-decoration: none;']);?></td>
            </tr>
            <tr>
                <td style="color: #999">此邮件由系统自动发送，请勿回复</td>
            </tr>
            <tr>
                <td  style="border-top: 1px solid #aae;">感谢你对乐乐淘（ <a href="http://www.lltao.com">http://www.lltao.com</a> ）的支持，祝你好运<br/>客服热线：400-123-123</td>
            </tr>
        </tbody>
</table>
