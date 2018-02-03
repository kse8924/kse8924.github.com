<?
######################################################################################################################################################
//VIEW3 BOARD 1.0
######################################################################################################################################################
define('_VIEW3BOARD_', TRUE);
@include_once														"../view3.php";
######################################################################################################################################################
//list
$end_path = "";
$end_page_path = $view3_rand.$end_path;

//수정
$path_action_edit = view3_link("||idx||page||board||select||search||skin","action_edit&skin=root","",$end_path);//등록 클릭시 링크
$path_save = view3_link("||idx||page||select||search","list","",$end_path);//등록 클릭시 링크
$path_save_01 = view3_link("||page||select||search","write","",$end_path);//등록 클릭시 링크

$path_clear = view3_link("||page||select||search","list","",$end_path);
$path_list = view3_link("||idx||view_page","list","",$end_path);//목록 클릭시 링크
if(!strcmp($view3_sca_new,"")){$view3_sca_new = $view3_sca;}else{$view3_sca_new=$view3_sca_new;}
$path_list_01 = view3_link("||idx||view_page||sca||sca_new","list&sca=".$view3_sca_new,"",$end_path);//목록 클릭시 링크

$path_write = view3_link("||select||search||idx","write&select=".$view3_select."&search=".$view3_search,"",$end_path);
$path_write_01 = view3_link("||select||search","write&select=".$view3_select."&search=".$view3_search,"",$end_path);

$path_action = view3_link("||idx||page||select||search||skin","action&skin=root","",$end_path);//등록 클릭시 링크
$path_edit = view3_link("","edit","",$end_path);//등록 클릭시 링크

$path_next = view3_link("||page||now_date||type||select||search","list&select=".$view3_select."&search=".$view3_search,"no");
$path_next_01 = view3_link("||page||now_date||type||select||search","view&select=".$view3_select."&search=".$view3_search,"no");
$path_next_02 = view3_link("||idx||view_page||temp_idx||now_date||type||select||search","view&select=".$view3_select."&search=".$view3_search,"no");
$path_next_03 = view3_link("||idx||view_page||now_date||type||select||search","list&select=".$view3_select."&search=".$view3_search,"no");

$path_delete = view3_link("||idx||page||select||search||skin","delete&skin=root","",$end_path);//등록 클릭시 링크
$path_drop = view3_link("||idx||page||select||search","list","",$end_path);//등록 클릭시 링크
######################################################################################################################################################
$admin_idx = "10";//관리자페이지만

$board_idx = "11";//보드 총괄 셋팅 (관리자 권한)

$html_idx = "12";//유저게시판
$franchise_idx = "13";
$company_idx = "14";
$m_idx = "15";
######################################################################################################################################################
if(!strcmp($view3_sca,"")){
	$temp_next_sca = "";
}else{
	$temp_next_sca = " and view3_sca='".$view3_sca."'";
}
$board_sql = "select * from ".TABLE_LEFT."board where view3_setup='".$html_idx."' and view3_link='".$page_insik."'".$temp_next_sca." order by view3_sca asc";
$out_board_sql=@mysql_query($board_sql);
$board_list                             = @mysql_fetch_assoc($out_board_sql);
$group_sql = "select * from ".TABLE_LEFT."group where view3_setup='".$html_idx."' and view3_idx='".$board_list['view3_group_idx']."'";
$out_group_sql=@mysql_query($group_sql);
$group_list                             = @mysql_fetch_assoc($out_group_sql);

$bbs_sql = "select * from ".TABLE_LEFT.$board." where view3_idx='".$view3_idx."'";
$out_bbs_sql=@mysql_query($bbs_sql);
$bbs_list                             = @mysql_fetch_assoc($out_bbs_sql);

$gnb_index = $group_list['view3_order_css'];//새로변경
$minor_index = $board_list['view3_order_css'];//새로변경

$is_sub = true;

$h2_title_kr = $group_list['view3_title_01'];
$h2_title_kr_old = $group_list['view3_title_01'];

$h2_title_sub = $board_list['view3_title_01'];

$top_img_alt = $board_list['view3_top_img_alt'];
$view3_table = TABLE_LEFT.$board_list['view3_link'];
if(!strcmp($_REQUEST["skin"],"")){
	$view3_skin                                             = $board_list['view3_skin_board'];
	$skin                                                   = str_replace("view3_","",$board_list['view3_skin_board']);
}else{
	$view3_skin                                             = "view3_".$_REQUEST["skin"];
	$skin                                                   = $_REQUEST["skin"];
}
if(!strcmp($board_list['view3_sca'],"")){
	$next_sca = "";
	$write_sca = "";
}else{
	$next_sca = " and view3_sca='".$board_list['view3_sca']."'";
	$write_sca = $board_list['view3_sca'];
}
if(!strcmp($board,"")){
	$page_id                                                    = PATH_PAGE_NAME;
}else{
	$page_id                                                    = $skin;
}
######################################################################################################################################################
$temp_link_list = "";
$temp_left_link = "";
$temp_left_title = "";
$temp_title = "";
$temp_check = "";
$left_link = "";
$left_title = "";
$main_link = "";
$main_title = "";
$right_link = "";
$right_title = "";
$html_sub_i = "1";
$html_sub_sql = "select * from ".TABLE_LEFT."board where view3_group_idx='".$group_list['view3_idx']."' and view3_setup='".$html_idx."' and view3_use = '1' order by view3_order asc";
$out_html_sub_sql = @mysql_query($html_sub_sql);
$total_sub_data = @mysql_num_rows($out_html_sub_sql);
while($html_sub_list                             = @mysql_fetch_assoc($out_html_sub_sql)){
	if(!strcmp($html_sub_list['view3_sca'],"")){
		$next_url = "";
	}else{
		$next_url = "&sca=".$html_sub_list['view3_sca'];
	}
	$temp_left_link = $temp_link_list;
	$temp_left_title = $temp_title;
	if(!strcmp($html_sub_list['view3_style'],"html")){
		$temp_link_list = $root."/".$html_sub_list['view3_style']."/".$html_sub_list['view3_link']."?language=".$language.$next_url;
	}else if(!strcmp($html_sub_list['view3_style'],"board")){
		$temp_link_list = $root."/board/index.php?language=".$language."&board=".$html_sub_list['view3_link'].$next_url;
	}
	$temp_title = $html_sub_list["view3_title_01"];
	if(!strcmp($html_sub_list['view3_order_css'],$minor_index)){
		$left_link = $temp_left_link;
		$left_title = $temp_left_title;
		$main_link = $temp_link_list;
		$main_title = $temp_title;
		$temp_check = "ok";
		if(!strcmp($total_sub_data,$html_sub_i)){
			$right_link = "";
		}
	}else if(!strcmp($temp_check,"ok")){
		$right_link = $temp_link_list;
		$right_title = $temp_title;
		$temp_check = "";
	}
	$html_sub_i++;
}
######################################################################################################################################################
$sitename_sql_query = "SELECT view3_title_01 FROM `".TABLE_LEFT."group` WHERE view3_group = 'bbs'";
$sitename_result = @mysql_query($sitename_sql_query);
$sitename_list = @mysql_fetch_assoc($sitename_result);
$sitename = $sitename_list['view3_title_01'];
$og_image_arr = explode('||', $bbs_list['view3_file']);
if($view3_type == 'view') {
	$title_ko = $bbs_list['view3_title_01'];
	$desc = cut(view3_html($bbs_list['view3_command_01']), 100);
	for($i=0; $i<count($og_image_arr); $i++) {
		if($og_image_arr[$i] != '') {
			$og_image = HOST_URL.'/upload/'.$board.$og_image_arr[$i];
			break;
		}
	}
} else {
	$title_ko = str_replace('<br />', '&nbsp;', html_entity_decode($board_list['view3_title_01']));
	$desc = $board_list['view3_description'];
}
if(!$og_image) {
	$og_image = HOST_URL.'/img/common/bi.png';
}
######################################################################################################################################################
$request_root = $root;
$time = time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="<?=$desc ? $desc : $sitename?>" />
<meta name="keywords" content="" />
<meta name="author" content="<?=$sitename?>" />
<meta property="og:title" content="<?=$title_ko ? $title_ko.' | '.$sitename : $sitename?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=urlencode('http://'.$_SERVER[SERVER_NAME].$_SERVER[REQUEST_URI])?>" />
<meta property="og:image" content="<?=$og_image?>" />
<meta property="og:description" content="<?=$desc ? $desc : $sitename?>" />
<meta property="og:locale" content="ko_KR" />
<meta name="viewport" content="width=1260" />
<title><?=$title_ko ? $title_ko.' | '.$sitename : $sitename?></title>
<link rel="shortcut icon" href="<?=$root?>/img/favicon.ico" />
<link rel="stylesheet" href="<?=$root?>/css/style.css?<?=$time?>" />
<link rel="stylesheet" href="<?=$root?>/css/sub.css?<?=$time?>" />
<?
if(!$board) {
	if(file_exists(ROOT_INC.'/css/'.$page_id.'.css')) {
		echo '<link rel="stylesheet" href="'.$root.'/css/'.$page_id.'.css?'.$time.'">'.PHP_EOL;
	}
} else {
	echo '<link rel="stylesheet" href="'.$root.'/css/board.css?'.$time.'">'.PHP_EOL;
	if(file_exists(BOARD_INC.'/'.$view3_skin.'/css/skin.css')) {
		echo '<link rel="stylesheet" href="'.BOARD.'/'.$view3_skin.'/css/skin.css?'.$time.'">'.PHP_EOL;
	}
}
?>
<script type="text/javascript">
var CONST_REQUEST_ROOT = '<?=$request_root?>';
var CONST_ROOT = '<?=$root?>';
var CONST_BOARD = '<?=$board?>';
var CONST_SKIN_PATH = '<?=BOARD.'/'.$view3_skin?>';
var CONST_TAB = '<?=$view3_tab?>';
var CONST_GNB_INDEX = '<?=$gnb_index?>';
var CONST_LNB_INDEX = '<?=$minor_index?>';
var CONST_ORDER = '<?=$board_list['view3_order']?>';
</script>
<script type="text/javascript" src="<?=$root?>/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?=$root?>/js/common.js?<?=$time?>"></script>
<script type="text/javascript" src="<?=$root?>/js/sub.js?<?=$time?>"></script>
<script type="text/javascript" src="<?=$root?>/freebest/inquiry.js?<?=$time?>"></script>
<?
if($board && $view3_type == 'view') {
?>
<script type="text/javascript">
(function($) {
	doc.ready(function() {
		$('body').on('click', '.social-fb-share-btn', function(e) {
			window.open($(this).attr('href'), '', 'width=680, height=480, left=200, top=100');
			e.preventDefault();
		});
		$('body').on('click', '.social-bl-share-btn', function(e) {
			window.open($(this).attr('href'), '', 'width=574, height=604, left=200, top=100');
			e.preventDefault();
		});
		$('body').on('click', '.social-ks-share-btn', function(e) {
			window.open($(this).attr('href'), '', 'width=480, height=450, left=200, top=100');
			e.preventDefault();
		});
	});
}(jQuery));
</script>
<?
}
?>
</head>
<body>

<!-- 건너뛰기 링크 시작 -->
<dl id="skiptoContent">
	<dt>바로가기 메뉴</dt>
	<dd><a href="#navigation" class="skip">네비게이션 바로가기</a></dd>
	<dd><a href="#content" class="skip">본문 바로가기</a></dd>
</dl>
<!-- //건너뛰기 링크 끝 -->