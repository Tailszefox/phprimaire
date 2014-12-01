$(document).ready(function(){
		
		// Animation des boutons sur passage
		$('.bouton').hover(
			function(){
				$(this).animate({
						backgroundColor: "#BBBBFF",
						color: "#000000",
						MozBorderRadiusTopleft: '100px',
						MozBorderRadiusTopright: '100px',
						MozBorderRadiusBottomleft: '100px',
						MozBorderRadiusBottomright: '100px',
						BorderRadiusTopleft: '100px',
						BorderRadiusTopright: '100px',
						BorderRadiusBottomleft: '100px',
						BorderRadiusBottomright: '100px',
			}, 500)},
				
				function(){
					$(this).animate({
							backgroundColor: "#FFFFFF",
							color: "#000000",
							MozBorderRadiusTopleft: '25px',
							MozBorderRadiusTopright: '25px',
							MozBorderRadiusBottomleft: '25px',
							MozBorderRadiusBottomright: '25px',
							BorderRadiusTopleft: '25px',
							BorderRadiusTopright: '25px',
							BorderRadiusBottomleft: '25px',
							BorderRadiusBottomright: '25px',
					}, 250)
				});
		
		// Changement de page sur clic
		$('#liens').click(function(){
				window.location = 'liens.php';
		});
		
		$('#photos').click(function(){
				window.location = 'photos.php';
		});
		
		$('#rendus').click(function(){
				window.location = 'rendus.php';
		});
		
		$('#quizz').click(function(){
				window.location = 'quizz.php';
		});
		
		$('#notes').click(function(){
				window.location = 'notes.php';
		});
		
		$('#gestion').click(function(){
				window.location = 'gestion.php';
		});
		
		$('#administration').click(function(){
				window.location = 'administration.php';
		});
});
