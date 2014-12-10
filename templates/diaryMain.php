<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/static/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/style.css">

    <!--[if lt IE 9]>
    <script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button
        type="button"
        class="navbar-toggle collapsed"
        data-toggle="collapse"
        data-target="#navbar"
        aria-expanded="false"
        aria-controls="navbar"
      >
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"><a href="/">Home</a></li>
        <span class="icon-bar js_write">Write</span>
      </button>
      <a class="navbar-brand" href="/">4 Line Diary</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Home</a></li>
        <li><a href="javascript:void(0);" class="js_write">Write</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>


<div class="container">

<div class="contents">
  <b>表示月:</b> <input type="month" id="js_select_month" value="<?=date('Y-m');?>">
  <button id="js_select_button" class="btn">表示</button>
</div>

<div class="contents">

  <div id="write_diary_form">

  <form method="post" action="/write/" role="form" id="js_diary_form" class="form-horizontal hide">
    <h2>Write</h2>

    <div class="form-group">
      <label for="inputSelectDate" class="col-sm-1 control-label">日付</label>
      <div class="col-sm-4">
        <input type="date" name="selectDate" class="form-control" id="inputSelectDate" placeholder="2014-03-11" value="<?=date('Y-m-d');?>">
      </div>
    </div>

    <div class="form-group">
      <label for="inputFact" class="col-sm-1 control-label">事実</label>
      <div class="col-sm-10">
        <input type="text" name="fact" class="form-control" id="inputFact" placeholder="事実">
      </div>
    </div>
    <div class="form-group">
      <label for="inputDiscover" class="col-sm-1 control-label">発見</label>
      <div class="col-sm-10">
        <input type="text" name="discover" class="form-control" id="inputDiscover" placeholder="発見">
      </div>
    </div>
    <div class="form-group">
      <label for="inputLesson" class="col-sm-1 control-label">教訓</label>
      <div class="col-sm-10">
        <input type="text" name="lesson" class="form-control" id="inputLesson" placeholder="教訓">
      </div>
    </div>
    <div class="form-group">
      <label for="inputDeclaration" class="col-sm-1 control-label">宣言</label>
      <div class="col-sm-10">
        <input type="text" name="declaration" class="form-control" id="inputDeclaration" placeholder="宣言">
      </div>
    </div>
    <div class="col-sm-offset-1 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </form>

  </div>

</div>


<div class="contents">
  <div id="diary_space"></div>
</div><!-- /contents -->

</div><!-- /container -->

<script src="/static/js/jquery-2.1.1.min.js"></script>
<script src="/static/js/mustache.min.js"></script>
<script src="/static/dist/js/bootstrap.min.js"></script>
<script src="/static/js/app.js"></script>

<script id="diary_template" type="text/x-mustache-template">
<h2>{{year}}年{{month}}月</h2>

{{#diary}}
<h3>{{day}}日 ({{js_day}})</h3>
<div class="row">
  <div class="col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> 事実
      </div>
      <div class="panel-body">{{cnt_fact}}</div>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 発見
      </div>
      <div class="panel-body">{{cnt_discover}}</div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 教訓
      </div>
      <div class="panel-body">{{cnt_lesson}}</div>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 宣言
      </div>
      <div class="panel-body">{{cnt_declaration}}</div>
    </div>
  </div>
</div>
<!--
<table class="table">
  <tr> <th>事実</th><td>{{cnt_fact}}</td> </tr>
  <tr> <th>発見</th><td>{{cnt_discover}}</td> </tr>
  <tr> <th>教訓</th><td>{{cnt_lesson}}</td> </tr>
  <tr> <th>宣言</th><td>{{cnt_declaration}}</td> </tr>
</table>
-->
{{/diary}}
</script>

</body>
</html>
