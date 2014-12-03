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
        <span class="icon-bar js_write">書く</span>
      </button>
      <a class="navbar-brand" href="/">4 Line Diary</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Home</a></li>
        <li><a href="javascript:void(0);" class="js_write">書く</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>


<div class="container">

<div class="contents">
    <b>日記表示月:</b> <input type="month" id="js_select_month">
    <button id="js_select_button" class="btn">表示</button>
</div>

<div class="contents">

<div id="write_diary_form">

<form method="post" action="/write/" role="form" id="js_diary_form" class="form-horizontal hide">
  <h2>Write</h2>

  <div class="form-group">
    <label for="inputSelectDate" class="col-sm-1 control-label">日付</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="inputSelectDate" placeholder="2014-03-11" value="<?=date('Y-m-d');?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputFact" class="col-sm-1 control-label">事実</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputFact" placeholder="事実">
    </div>
  </div>
  <div class="form-group">
    <label for="inputDiscover" class="col-sm-1 control-label">発見</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputDiscover" placeholder="発見">
    </div>
  </div>
  <div class="form-group">
    <label for="inputLesson" class="col-sm-1 control-label">教訓</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputLesson" placeholder="教訓">
    </div>
  </div>
  <div class="form-group">
    <label for="inputDeclaration" class="col-sm-1 control-label">宣言</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputDeclaration" placeholder="宣言">
    </div>
  </div>
  <div class="col-sm-offset-1 col-sm-10">
    <button type="submit" class="btn btn-default">Submit</button>
  </div>
</form>

</div>

</div>


<div class="contents">

<h2><?=date('Y年m月', strtotime($month));?></h2>

<? foreach ( $contents as $cont ) : ?>
  <h3>
      <?=date('j', strtotime($cont['target_date']));?>日
      (<?=$day[(int)date('w', strtotime($cont['target_date']))];?>)
  </h3>

  <table class="table">
    <tr>
      <th>事実</th><td><?=$cont['cnt_fact'];?></td>
    </tr>
    <tr>
      <th>発見</th><td><?=$cont['cnt_discover'];?></td>
    </tr>
    <tr>
      <th>教訓</th><td><?=$cont['cnt_lesson'];?></td>
    </tr>
    <tr>
      <th>宣言</th><td><?=$cont['cnt_declaration'];?></td>
    </tr>
  </table>
<? endforeach; ?>
</div><!-- /contents -->

</div><!-- /container -->

<script src="/static/js/jquery-2.1.1.min.js"></script>
<script src="/static/js/underscore-min.js"></script>
<script src="/static/dist/js/bootstrap.min.js"></script>
<script src="/static/js/backbone-min.js"></script>
<script src="/static/js/app.js"></script>


</body>
</html>
