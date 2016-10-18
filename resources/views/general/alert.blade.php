<style type="text/css">
	.notificationbox{
		pointer-events: none;
		position: fixed;
		left: 50px;
		bottom: 10px;
		/*width: 100vh;*/
		z-index: 5000;
		display: table-cell;
  		vertical-align: bottom;
  		min-width: 350px;
	}
	#notificationcontent{
		overflow: auto;
	}

	.notification{
		pointer-events: all;
		min-width: 100px;
		max-width: 100vh;		
	}
</style>



<script type="text/javascript">
	var notifyBox = [];
	var notifyCount = 0;
	var notiId = 'notify';

	function createNotification(id,clas1,clas2,header,body){
		var s = '<div id="'+id+'" class="notification"><div class="alert ' + clas1 + ' alert-dismissible"><button type="button" class="close" id="btn'+id+'">×</button><h4><i class="icon fa '+clas2+'"></i> '+header+'</h4>'
			+ body +'</div></div>';
		return s;
	}

	function setCount(id){
		max = 0;
		for (var i = notifyBox.length - 1; i >= 0; i--) {
			if (notifyBox[i] > max) {
				max = notifyBox[i];
			}
		}
		notifyCount = max;
	}

	function removeNotiCount(ind){
		var temp = [];
		for (var i = notifyBox.length - 1; i >= 0 ; i--) {
			if (notifyBox[i] != ind) {
				temp.push(notifyBox.pop());
			}
			else{
				notifyBox.pop();

				break;
			}
		}
		notifyBox = notifyBox.concat(temp);
	}

	function showAlert(clas1,clas2,header,body,time = 0){
		if ($('#notificationbox').length<=0) {
			$('body').append('<div id="notificationbox" class="notificationbox"><div id="notificationcontent"></div></div>');
		}
		notifyCount++;
		notifyBox.push(notifyCount);
		var num = notifyCount;
		var id= notiId + num;
		var element = createNotification(id,clas1,clas2,header,body);
		$('#notificationcontent').append(element);
		$('#btn'+id).on('click', function(event) {
			$('#'+id).hide(400, function() {
					removeNotiCount(num);
					$('#'+id).remove();
					setCount(num);
				});
		});
		if (time>0) {
			var t = setTimeout(function(){
				$('#'+id).fadeOut(3000, function() {
					removeNotiCount(num);
					$('#'+id).remove();
					setCount(num);
				});
			}, 3000);
			$('#'+id).on('mouseenter',function(event){
				$('#'+id).stop();
				$('#'+id).fadeIn(0, function() {
					
				});
			});
			$('#'+id).on('mouseleave',function(event){
				$('#'+id).fadeOut(3000, function() {
					removeNotiCount(num);
					$('#'+id).remove();
					setCount(num);
				});
			});
		}
		

		$('#'+id).fadeIn(400, function() {
			
		});
		return notifyCount;
	}

	function hideAlert(nID,time){
		return setTimeout(function(){
				$('#'+nID).fadeOut(3000, function() {
					
				});
			}, 3000);
	}

	function showAlertI(header,body,time = 3000){
		return showAlert('alert-info','fa-info',header,body,time);
	}

	function showAlertD(header,body,time = 0){
		return showAlert('alert-danger','fa-ban',header,body,time);
	}

	function showAlertW(header,body,time =0){
		return showAlert('alert-warning','fa-warning',header,body,time);
	}

	function showAlertS(header,body,time = 3000){
		return showAlert('alert-success','fa-check',header,body,time);
	}
</script>