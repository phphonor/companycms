/**
 +----------------------------------------------------------
 * 下拉菜单
 +----------------------------------------------------------
 */
$(function(){
	   /* 主导航 */
    $("#mainNav ul li").hover(function(){
        $(this).addClass("hover");
        $('ul:first',this).css('display', 'block');
    }, function(){
        $(this).removeClass("hover");
        $('ul:first',this).css('display', 'none');
    });
	   /* 顶部导航 */
    $("ul.topNav li.parent").hover(function(){
        $(this).addClass("hover");
        $('ul:first',this).css('display', 'block');
    }, function(){
        $(this).removeClass("hover");
        $('ul:first',this).css('display', 'none');
    });
});

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
 * 搜索框的鼠标交互事件
 +----------------------------------------------------------
 */
function formClick(name, text) {
    var obj = name;
    if (typeof(name) == "string") obj = document.getElementById(id);
    if (obj.value == text) {
        obj.value = "";
    }
    obj.onblur = function() {
        if (obj.value == "") {
            obj.value = text;
        }
    }
}

/**
 +----------------------------------------------------------
 * 收藏本站
 +----------------------------------------------------------
 */
function AddFavorite(url, title) {
    try {
        window.external.addFavorite(url, title)
    } catch(e) {
        try {
            window.sidebar.addPanel(title, url, "")
        } catch(e) {
            alert("加入收藏失败，请使用Ctrl+D进行添加")
        }
    }
}

/**
 +----------------------------------------------------------
 * 在线客服
 +----------------------------------------------------------
 */
$(document).ready(function(e) {
	   // 右侧滚动
    $("#onlineService").css("right", "0px");
				
	   // 弹出窗口
    var button_toggle = true;
    $(".onlineIcon").live("mouseover",
    function() {
        button_toggle = false;
        $("#pop").show();
    }).live("mouseout",
    function() {
        button_toggle = true;
        hideRightTip()
    });
    $("#pop").live("mouseover",
    function() {
        button_toggle = false;
        $(this).show()
    }).live("mouseout",
    function() {
        button_toggle = true;
        hideRightTip()
    });
    function hideRightTip() {
        setTimeout(function() {
            if (button_toggle) $("#pop").hide()
        },
        500)
    }
				
	   // 返回顶部
    $(".goTop").live("click",
    function() {
        var _this = $(this);
        $('html,body').animate({
            scrollTop: 0
        },
        500,
        function() {
            _this.hide()
        })
    });
    $(window).scroll(function() {
        var htmlTop = $(document).scrollTop();
        if (htmlTop > 0) {
            $(".goTop").show()
        } else {
            $(".goTop").hide()
        }
    })
});