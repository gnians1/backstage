$(document).ready(function () {
    //用户登录
    $("#submit").click(function () {
        if (!$('input[name=email]').val()) {
            layer.msg('请填写邮箱', {icon: 5, anim: 6, time: 2000});
            return false;
        }
        if (!$('input[name=password]').val()) {
            layer.msg('请填写密码', {icon: 5, anim: 6, time: 2000});
            return false;
        }
        $.ajax({
            url: '/admin/handle',
            type: 'POST',
            data: $('form').serialize(),
            dataType: 'JSON',
            success: function (res) {
                if (res.code == '200') {
                    layer.msg('登录成功', {icon: 6, time: 2000}, function () {
                        window.location.href = res.url;
                    });
                } else {
                    layer.msg(res.msg, {icon: 5, anim: 6})
                }
            }
        });
    });


    //用户注册
    $("#added").click(function () {
        $.ajax({
            url: '/admin/added',
            type: 'post',
            data: $('form').serialize(),
            dataType: 'JSON',
            success: function (res) {
                if (res.code != '200') {
                    layer.msg(res.msg, {icon: 5, anim: 6, time: 2000});
                } else {
                    //注册成功
                    layer.msg(res.msg, {icon: 6, time: 2000}, function () {
                        window.history.back();
                    });
                }
            }
        });
    });

    //发送忘记密码邮件
    $("#sendEmail").click(function () {
        if (!$('input[name=email]').val()) {
            layer.msg('请填写注册时的邮箱', {icon: 5, anim: 6, time: 2000});
            return false;
        }
        var loads = layer.load();
        $.ajax({
            url: '/admin/forget',
            type: 'post',
            data: $('form').serialize(),
            dataType: 'JSON',
            success: function (res) {
                layer.close(loads);
                if (res.code == '200') {
                    //发送成功
                    layer.msg(res.msg, {icon: 6, time: 1000}, function () {
                        $('input[name=email]').addClass('hidden');
                        $('#sendEmail').addClass('hidden');
                        $('input[name=vscode]').removeClass('hidden');
                        $('#reset').removeClass('hidden');

                    });
                } else {
                    layer.msg(res.msg, {icon: 5, anim: 6, time: 1000});
                }
            }
        });
    });


    //重置密码
    $('#reset').click(function () {
        if (!$('input[name=vscode]').val()) {
            layer.msg('请填写验证码', {icon: 5, anim: 6, time: 1000});
            return false;
        }
        var loads = layer.load();
        console.log($('form').serialize());
        $.ajax({
           url:'/admin/resetpassword',
           type:'post',
           dataType:'JSON',
           data:$('form').serialize(),
            success:function (res) {
                layer.close(loads);
                if(res.code == 200){
                    layer.msg(res.msg, {icon: 6, time: 3000}, function () {
                        window.location.href='logins';
                    });
                }else{
                    layer.msg(res.msg, {icon: 5, anim: 6, time: 2000});
                }
            }
        });
    });
});