<table>
<tr>
<td>亲爱的用户<?php echo \Html::mail_to($email);?></td>
</tr>
</table>
<table>
<tr>
<td>您好！感谢您注册乐乐淘。</td>
</tr>
<tr>
<td>请点击下面的按钮，完成邮箱验证。</td>
</tr>
<tr>
<td><?php echo \Html::anchor($href, "邮箱验证");?></td>
</tr>
</table>
<table>
<tr>
<td>如果上面按钮不能点击或点击后没有反应，您还可以将以下链接复制到浏览器地址栏中访问完成验证。</td>
</tr>
<tr>
<td><?php echo \Html::anchor($href, $href);?></td>
</tr>
</table>
