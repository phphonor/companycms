/**
 +----------------------------------------------------------
 * 刷新验证码
 +----------------------------------------------------------
 */
function refreshimage()
{
  var cap =document.getElementById("captcha");
  cap.src=cap.src+'?';
}

/**
 +----------------------------------------------------------
 * 无组件刷新局部内容
 +----------------------------------------------------------
 */
function dou_callback(page, name, value, target)
{
	$.ajax({
		type: "GET",
		url: page,
		data: name + "=" + value,
		dataType: "html",
		success: function(html){$("#" + target).html(html);}
	});
}

/**
 +----------------------------------------------------------
 * 表单全选
 +----------------------------------------------------------
 */
function selectcheckbox(form)
{
	for(var i = 0;i < form.elements.length; i++) 
	{
		var e = form.elements[i];
		if(e.name != 'chkall' && e.disabled != true) e.checked = form.chkall.checked;
	}
}
