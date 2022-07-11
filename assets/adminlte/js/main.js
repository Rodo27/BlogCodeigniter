$(".img-post").click(function(){
	//window.open($(this).attr("src"), 'popUpWindow', "height =" + this.naturalHeight + ", width =" + this.naturalWidth + ",resizable=yes,toolbar=yes,menubar=no");

	$('.test-popup-link').magnificPopup({
	  type: 'image',
	  //src : $(this).attr('src')
	  // other options
	})

	//console.log($(this).attr('src'))

})

