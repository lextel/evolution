<table width="690" border="0" style="margin: 0 auto" cellpadding="3" cellspacing="10">
        <tbody>
            <tr >
                <td style="border-bottom: 2px solid #eeeeee;margin-bottom: 10px;" ><a href="http://www.llt.com/"><img src="http://192.168.3.10/assets/images/logo.png" alt="乐乐淘首页"></a></td>
            </tr>
            <tr>
                <td>亲爱的<?php echo \Html::mail_to($email);?></td>
            </tr>
            <tr>
                <td>您好！感谢您注册乐乐淘。</td>
            </tr>
            <tr>
                <td>请点击下面的按钮，完成邮箱验证。
                <?php echo \Html::anchor($href, "邮箱验证", ['style'=>'width: 120px; height: 24px; background: #d2d2d2;text-align: center;line-height: 22px']);?>
                </td>
            </tr>
            <tr>
                <td><p style="text-indent: 2em">如果上面的按钮不能点击或点击后没有反应，你还可以把以下链接复制到浏览器地址栏中访问完重设密码。</p></td>
            </tr>
            <tr>
                <td><?php echo \Html::anchor($href, $href, ['style'=>'#004EFF']);?></td>
            </tr>
            <tr>
                <td>此邮件由系统自动发送，请勿回复</td>
            </tr>
            <tr>
                <td  style="border-top: 2px solid #eeeeee;">感谢你对乐乐淘（ <a href="">http://www.llt.com</a> ）的支持，祝你好运<br/>客服热线：400-123-123</td>
            </tr>
        </tbody>
</table>
