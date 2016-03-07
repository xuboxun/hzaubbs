<?php if (!defined('THINK_PATH')) exit();?><!-- 项目开始日期：2016-02-26  -->
<!-- 作者：黄一凡              -->
<!-- 版本：1.0                 -->
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<title>讨论区</title>
	<link rel="stylesheet" href="/hzaubbs/Public/front/css/basic.css">
	<link rel="stylesheet" href="/hzaubbs/Public/front/css/main.css">
	<script src="/hzaubbs/Public/front/js/jquery.min.js"></script>
</head>
<body>
	<div id="wrapper">
		<!-- 头部导航栏 -->
		<header id="tophead">
	<h1>讨论区</h1>
	<nav id="top-nav">
		<ul id="top-nav-ul">
			<li><a href="/hzaubbs/index.php/Home/Index/index">大厅</a></li>
			<li><a href="/hzaubbs/index.php/Home/Index/forum">部落</a></li>
			<li><a href="javascript:history.go(-1);">返回</a></li>
			<li class="li-state douser"><a href="<?php echo ($nav["url"]); ?>" class="douser"><?php echo ($nav["state"]); ?> <?php echo ($nav["i"]); ?></a>
				<div id="loged"> 
					<span class="org_bot_cor"></span>
					<span class="emem"></span>
					<ul>
						<li><a href="/hzaubbs/index.php/Home/Person/person">个人中心</a></li>
						<li><a href="">系统通知</a></li>
						<li><a href="../Login/do_logout">退出登陆</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</nav>
	<button class="nav-button">
		<span></span>
		<span></span>
		<span></span>
	</button>
	<script>
		$(function(){
			$(".douser").click(function(){
				if("<?php echo ($nav["state"]); ?>"!="登陆"){
					if($("#loged").is(':hidden')){
						$("#loged").show();
					}else{
						$("#loged").hide();
					}
				}
			});
			$(document).not($('.douser')).click(function(){
				if($("#loged").is(':visible')){
					$("#loged").hide();
				}
				// alert("sadsa");
			});
			$('.douser').on("click", function(e) {
			    e.stopPropagation();
			});
			$(".nav-button").click(function(){
				if($("#top-nav").is(":hidden")){
					$(".nav-button").css("background","lightblue");
					$("#top-nav").slideDown("slow");
				}else{
					$("#top-nav").slideUp();
					$(".nav-button").css("background","#eee");
				}
				
			})
		})
	</script>
</header>
		<!-- 中间内容区 -->
		<div id="main">
			<section class="content">
				<header class="content-header"></header>
				<?php if(is_array($topic)): $i = 0; $__LIST__ = $topic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$topic): $mod = ($i % 2 );++$i;?><!-- start title 分块小主题区域 -->
					<article class="content-topic <?php echo ($topic["class"]); ?>">
						<img src="/hzaubbs/Public/upload/head-img/hyf.jpg" alt="" class="head-img"/>
						<section class="content-article">
							<header class="title">
								<a href="/hzaubbs/index.php/Home/Index/topic?id=<?php echo ($topic["topicid"]); ?>"><?php echo ($topic["topicname"]); ?></a>
								<i class="topic-class"><?php echo ($topic["class"]); ?></i>
							</header>
							<div class="real-content">
								<pre><?php echo ($topic["content"]); ?></pre>
							</div>
							<div class="about-title">
								<span><i>·</i><a href=""><?php echo ($topic["author"]); ?></a></span>
								<span><i>·</i><?php echo ($topic["time"]); ?></span>
							</div>
						</section>
						<section class="content-dowhat">
							<span><a href="javascript:;" onclick="zan(<?php echo ($topic["topicid"]); ?>);">点赞</a><i id="zanid<?php echo ($topic["topicid"]); ?>" style="font-style:normal;"><?php echo ($topic["zan"]); ?></i></span> 
							<span><a href="javascript:;" onclick="pinlun();">评论</a><i id="zanid<?php echo ($topic["topicid"]); ?>" style="font-style:normal;"><?php echo ($topic["resnum"]); ?></i></span>
							<!-- <span><a href="javascript:;" onclick="zan();">回复</a>26</span> -->
						</section>
					</article>
					<script>
						if($(".topic-class").html()=="悬赏贴"){
							$(this).parent().parent().parent().addClass("reward");
						}
						function zan(id){
							$.post('/hzaubbs/index.php/Home/Index/zan',{
								topicid:id
							},function(zannum){
								if(zannum=="游客"){
									alert("请登录\n\n您当前是游客身份，不支持点赞和评论");
									window.location.href="/hzaubbs/index.php/Home/Login/login";
								}else{
									if(zannum==$("#zanid"+id).html()){
										alert("您已经点赞过此消息");
									}else{
										$("#zanid"+id).html(zannum);
									}
								}
							})
							
						}
						function pinlun(){
							alert("评论");
						}
					</script>
					<!-- end title --><?php endforeach; endif; else: echo "" ;endif; ?>
				<footer class="content-footer"></footer>
			</section>
			<section class="information">
				
			</section>
		</div>
		<!-- 尾部 -->
		<footer id="bottom-footer">
	<h1>&copy;2016 讨论区 <i>designed by</i> <a href="http://www.52feidian.com/" target="_blanket">沸点工作室</a></h1>
</footer>
	</div>

</body>
</html>