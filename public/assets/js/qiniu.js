/**
 * 七牛上传
 *
 * @param f
 * @param token string
 * 
 * @return 
 */
function Qiniu_upload(f, token) {
    var formURL = 'http://up.qiniu.com/';
    var host = QINIU_HOST;//"http://lltao.qiniudn.com/";
    var form_data = new FormData();
    var d = new Date();
    var filename = f.name.split('.')[1];
    var key = arguments[2] || '';
    var path = arguments[3] || 'upload/';
    if (key == ''){
        var name = md5(f+d.getTime());
        key = path  + name[0] + '/' + name[1] + '/' + name +'.'+filename;
    }
    form_data.append("file", f);            
    form_data.append("key", key);
    form_data.append('x:album', host + key);
    form_data.append('token', token);
    var xhr = $.ajax({
        url: formURL,
        type: 'POST',
        data:  form_data,
        dataType: 'JSON',
        mimeType:"multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,       
        });

    return xhr;   
}
