<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?=@$this->pageTitle?></title>
    <meta name="description" content="<?=@$this->pageDescription?>">
    <meta name="keywords" content="<?=@$this->pageKeywords?>">
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="/theme/basecamp/application.css" media="all" rel="stylesheet"
            type="text/css">
    <!--[if lt IE 9]>
    <script language="javascript" type="text/javascript" src="/js/excanvas.min.js?<?=$cacheBuster?>"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="/js/jquery-1.5.1.min.js?<?=$cacheBuster?>"></script>
    <script language="javascript" type="text/javascript" src="/js/jquery.jqplot.min.js?<?=$cacheBuster?>"></script>
    <script type="text/javascript" src="/js/plugins/jqplot.dateAxisRenderer.min.js?<?=$cacheBuster?>"></script>
    <script type="text/javascript" src="/js/plugins/jqplot.cursor.min.js?<?=$cacheBuster?>"></script>
    <link rel="stylesheet" type="text/css" href="/css/jquery.jqplot.css?<?=$cacheBuster?>"/>
</head>
<!--[if IE]>
<style type="text/css">
    * html body {
        width: expression( document.documentElement.clientWidth < 900 ? '900px' : '100%' );
    }
    body {
        behavior: url(/css/csshover.htc);
    }
</style>
<![endif]-->
</head>
<body class="theme-basecamp controller-<?=$this->controllerName?> action-<?=$this->actionName?>">
<div id="wrapper">
    <div id="wrapper2">
        <div id="top-menu">
            <div id="account">
                <ul>
                    <? IF (!@$this->isLoggedIn): ?>
                    <li>
                        <a href="/account/login" class="login">Sign in</a>
                    </li>
                    <li>
                        <a href="/account/register" class="register">Register</a>
                    </li>
                    <? ELSE: ?>
                    <li>
                        <a href="/clusters" class="clusters">Clusters</a>
                    </li>
                    <li><a href="/account/logout" class="logout">Sign out</a></li>
                    <? ENDIF; ?>
                </ul>
            </div>
            <? IF (@$this->isLoggedIn): ?>
            <div id="loggedas">Logged in as <a href="#"><?=$this->email?></a></div>
            <? ENDIF; ?>
            <ul>
                <li>
                    <a href="/"
                            class="home">Home</a>
                </li>
                <li><a href="http://blog.monitoringrocks.com"
                        class="help">Help</a>
                </li>
            </ul>
        </div>
        <div id="header">
            <? IF (@$this->hasSearch === true): ?>
            <div id="quick-search">
                <!--
                <form action="/search"
                        method="get">
                    <a href="/search" accesskey="4">Search</a>:
                    <input accesskey="f" class="small" id="q" name="q"
                            size="20" type="text">
                </form>
                -->
                <select onchange="if (this.value != '') { window.location = this.value; }">
                    <option value="">Switch cluster...</option>
                    <option value="" disabled="disabled">---</option>
                    <? FOREACH ($this->clusters as $clusterItem): ?>
                    <option value="/dashboard/view/<?=$clusterItem['key']?>"><?=$clusterItem['label']?></option>
                    <? ENDFOREACH; ?>
                </select>
            </div>
            <? ENDIF; ?>
            <h1>monitoring rocks</h1>
            <? IF (isset($this->menu)): ?>
            <div id="main-menu">
                <ul>
                    <? FOREACH ($this->menu as $menuItem): ?>
                    <li><a href="<?=$menuItem['url']?>" class="dummy1<?=(@$menuItem['selected']===true)?' selected':''?>"><?=$menuItem['label']?></a></li>
                    <? ENDFOREACH; ?>
                </ul>
            </div>
            <? ENDIF; ?>
        </div>

        <div class="<?=(@$this->sidebar !='')?'':'no'?>sidebar" id="main">
            <div id="sidebar"><?=@$this->sidebar?></div>
            <div id="content">

                <? IF (isset($this->contextMenu)): ?>
                <div class="contextual">
                    <?php
                        $contextMenuItems = array();
                        foreach($this->contextMenu as $contextMenuItem) {
                            $contextMenuItems[] =
                                '<a href="' . $contextMenuItem['url']. '"'
                                . '>' . $contextMenuItem['label']. '</a>';
                        }
                        echo implode(' | ',$contextMenuItems);
                    ?>
                </div>
                <? ENDIF ?>

               <? IF (isset($this->flashError)): ?><div class="flash error"><?=@$this->flashError?></div><? ENDIF ?>