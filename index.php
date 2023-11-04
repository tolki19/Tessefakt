<?php $url=(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on'?'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?><!DOCTYPE html>
<html lang="de">
	<head>
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
		<meta name="robots" content="noindex,nofollow">
		<meta name="Language" content="de">
		<meta http-equiv="Content-Language" content="de">
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<meta charset="utf-8">
		<script src="<?=$url;?>assets/js/element.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/tessefakt.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/_entity.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/_header.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/_main.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/_footer.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/action/_action.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/action/order.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/action/order_variant.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/action/search.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/dialog/dialog.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/dialog/header.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/dialog/main.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/dialog/footer.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/page/page.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/page/header.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/page/main.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/entity/page/footer.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/_element.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/_block.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/b.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/blockquote.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/em.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/fieldset.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/figcaption.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/form.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/h1.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/h2.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/h3.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/h4.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/h5.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/h6.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/i.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/li.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/p.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/span.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/table.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/tbody.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/td.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/tfoot.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/th.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/thead.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/tr.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/block/ul.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/_button.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/_display.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/_form.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/_handles.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/_label.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/_pan.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/a.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/button.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/input.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/password.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/select/_display.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/select/_handles.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/select/_label.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/select/_pan.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/form/select/select.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/text/_text.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/text/mscript.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/element/text/text.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/gadget/_gadget.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/gadget/multiselectable.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/gadget/singleselectable.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/gadget/sort.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/icon/icon.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/render.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/pages/pages.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/pages/header.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/pages/main.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/dialogs/dialogs.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/app/app.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/app/menu.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/display/_display.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/display/a.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/display/label.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/display/menu.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/subject/menu.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/subject/action.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/subject/dialog.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/subject/group.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/render/navigation/subject/page.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/request/request.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/service/_service.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/service/couriers.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/service/request.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/service/requestchange.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/service/unselect.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/collection/_collection.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/collection/field.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/collection/set.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/collection/table.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/controller/_controller.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/controller/bucket.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/controller/collections.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/controller/couriers.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/controller/data.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/controller/sequences.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/controller/water.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/courier/_courier.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/courier/array.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/courier/object.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/courier/string.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/sequence/_sequence.js"></script>
		<script src="<?=$url;?>assets/js/tessefakt/water/sequence/table.js"></script>
		<script>window.addEventListener('load',function(e){new cTessefakt({uri:'<?=$url;?>'});},true);</script>
		<link rel="stylesheet" href="<?=$url;?>assets/css/desktop/standard.css">
	</head>
	<body>
	</body>
</html>