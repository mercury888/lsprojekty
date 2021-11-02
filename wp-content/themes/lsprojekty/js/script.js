$ = jQuery;
var loadmore = true;
var count = 2;
var advamce_count = 2;
$(document).ready(function(){
	$(document).on('click','.select_garage',function(){
		if($(this).prop("checked") == true){
			$(this).val(1);
		}
		else if($(this).prop("checked") == false){
			$(this).val(0);
		}
	});
});

$(document).on('click','.property-page .loadmore',function(){

	var total = $('.property-page .total_posts').attr('catalog-count');

	if (count > total){
		$(".additional_content").LoadingOverlay("hide");
		$(".additional_content").hide();
		return false;
	}else{
		$(".additional_content").LoadingOverlay("show");
		if( loadmore ){

			loadmore = false;
			var data = {
				action : "loadmore_property_res",
				page_no : count
			}

			$.ajax({
				url: ajax_url,
				type:'POST',
				data: data,
				success: function (response) {
					console.log(response)
					for(var i = 0 ;  i < response.length ; i++) {
						var html  = "<li id=property-"+ response.res[i].id +" class='property catalog-content cell-4 text-center'>";
							 html += " <div class='inner-content position-relative'> ";
								if(response.res[i].poster){
									html += " <div class='inbanner image-src'> ";
										html += "  <a href=" + response.res[i].permalink + ">";
											html += " <img src=" + response.res[i].poster + " alt=" + response.res[i].title + " />";
											html += " <div class='hover-block'>";
												html += " <div class='content-block'>";
													if(response.res[i].property_living_area){
														html += "<div class='d-flex justify-content-between'>"

																html += "<p>";
																	html += '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
																		html +='<path d="M14 4.36293V2H11.6641V2.55598H4.33588V2H2V4.36293H2.68702V11.6371H2V14H4.33588V13.3514H11.6641V14H14V11.6371H13.313V4.36293H14ZM3.64885 7.28185L7.31298 3.57529H9.41985L3.64885 9.3668V7.28185ZM4.33588 4.36293V3.52896H6.67176L3.64885 6.58687V4.36293H4.33588ZM3.64885 10.0618L10.0611 3.57529H11.6641V4.08494L4.19847 11.6371H3.64885V10.0618ZM12.3511 8.90347L8.96183 12.332H6.85496L12.3511 6.7722V8.90347ZM11.6641 11.6371V12.3784H9.60305L12.3511 9.59846V11.6834H11.6641V11.6371ZM12.3511 6.12355L6.21374 12.3784H4.33588V12.1467L12.0305 4.36293H12.3969V6.12355H12.3511Z" fill="white"/>';
																	html += '</svg>';
																	html += 'ObytnÁ plocha';
																html += "</p>";
																html += "<p>";
																	html += response.res[i].property_living_area + 'm<sup>2</sup>';
																html += "</p>";

														html += " </div>";
													}else{
														html += "";
													}
													if(response.res[i].property_usable_area){
														html += "<div class='d-flex justify-content-between'>"

																html += "<p>";
																	html += '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
																		html +='<path d="M12.7917 10.9166H11.2292L12.5313 12.2708H3.78129V3.46867L5.08337 4.82284V3.20825L3.20837 1.33325L1.33337 3.20825V4.82284L2.63546 3.46867V13.3645H12.5313L11.2292 14.6666H12.7917L14.6667 12.7916L12.7917 10.9166Z" fill="white"/><path d="M9.09375 1.95825H7.84375V3.052H9.09375V1.95825Z" fill="white"/><path d="M11.5417 1.95825H10.2917V3.052H11.5417V1.95825Z" fill="white"/><path d="M6.59375 1.95825H5.34375V3.052H6.59375V1.95825Z" fill="white"/><path d="M13.8855 3.10409V1.95825H12.7917V3.10409H13.3126H13.8855Z" fill="white"/><path d="M13.8855 9.14575H12.7917V10.3437H13.8855V9.14575Z" fill="white"/><path d="M13.8855 4.302H12.7917V5.49992H13.8855V4.302Z" fill="white"/><path d="M13.8855 6.75H12.7917V7.94792H13.8855V6.75Z" fill="white"/>';
																	html += '</svg>';
																	html += 'ÚŽItkovÁ plocha';
																html += "</p>";
																html += "<p>";
																	html += response.res[i].property_usable_area + 'm<sup>2</sup>';
																html += "</p>";

														html += " </div>";
													}else{
														html += "";
													}
													if(response.res[i].property_built_up_area){
														html += "<div class='d-flex justify-content-between'>"

																html += "<p>";
																	html += '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
																		html +='<path d="M14 12.9077H12.9076V14.0001H14V12.9077Z" fill="white"/><path d="M11.8152 12.9077H10.7228V14.0001H11.8152V12.9077Z" fill="white"/><path d="M3.02382 4.11621H1.9314V5.20863H3.02382V4.11621Z" fill="white"/><path d="M3.02382 1.9314H1.9314V3.02382H3.02382V1.9314Z" fill="white"/><path d="M5.20863 1.9314H4.11621V3.02382H5.20863V1.9314Z" fill="white"/><path d="M9.63039 1.9314H8.53796V3.02382H9.63039V1.9314Z" fill="white"/><path d="M7.44545 1.9314H6.35303V3.02382H7.44545V1.9314Z" fill="white"/><path d="M11.8152 1.9314H10.7228V3.02382H11.8152V1.9314Z" fill="white"/><path d="M14 1.9314H12.9076V3.02382H14V1.9314Z" fill="white"/><path d="M14 6.35303H12.9076V7.44545H14V6.35303Z" fill="white"/><path d="M14 4.11621H12.9076V5.20863H14V4.11621Z" fill="white"/><path d="M14 8.53809H12.9076V9.63051H14V8.53809Z" fill="white"/><path d="M14 10.7227H12.9076V11.8151H14V10.7227Z" fill="white"/><path d="M1.9314 6.35303V7.44545V8.53787V9.6303V10.7227V11.8151V12.9076V14H3.02382H4.11624H5.20866H6.30109H7.39351H8.48593H9.57835V6.35303H1.9314ZM8.53795 12.9076H7.44553H6.35311H5.20866H4.11624H3.02382V11.8151V10.7227V9.6303V8.53787V7.44545H8.53795V12.9076Z" fill="white"/>';
																	html += '</svg>';
																	html += 'ZastavanÁ plocha';
																html += "</p>";
																html += "<p>";
																	html += response.res[i].property_built_up_area + 'm<sup>2</sup>';
																html += "</p>";

														html += " </div>";
													}else{
														html += "";
													}
												html += " </div>";
												html += "<div class='top-content'>"
													html += "<h3 class='mb-0 text-white'>ZObraziŤ Detail</h3>";
													html += "<span class='half-circle spin circle'></span>";
												html += " </div>";
											html += " </div>";
										html += "  </a>";
									html += " </div>";
								}
								html += "<div class='description'>";
										html += "<h3>";
											html += "<a href="+response.res[i].permalink+"> "+response.res[i].title+" </a>";
										html += "</h3>";
										html += "<div class='d-flex justify-content-center info'>";
											if(response.res[i].number_of_people){
												html += "<p>";
													html += '<svg width="16" height="16" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">';
														html +='<path d="M9.95074 10.0307C10.57 11.0041 10.9016 12.1378 10.9 13.3L9.95074 10.0307ZM9.95074 10.0307C10.3482 9.87882 10.7715 9.80013 11.2 9.80013C11.8144 9.80012 12.4179 9.96184 12.95 10.269C13.4821 10.5762 13.9239 11.018 14.2311 11.5501C14.5383 12.0821 14.7 12.6857 14.7 13.3V13.6H10.8929C10.8976 13.5009 10.9 13.4012 10.9 13.3008L9.95074 10.0307ZM6.70005 5.30002C6.70005 5.80394 6.49987 6.28721 6.14355 6.64353C5.78723 6.99985 5.30396 7.20002 4.80005 7.20002C4.29614 7.20002 3.81286 6.99985 3.45655 6.64353C3.10023 6.28721 2.90005 5.80394 2.90005 5.30002C2.90005 4.79611 3.10023 4.31284 3.45655 3.95652C3.81287 3.6002 4.29614 3.40002 4.80005 3.40002C5.30396 3.40002 5.78723 3.6002 6.14355 3.95652C6.49987 4.31284 6.70005 4.79611 6.70005 5.30002ZM13.1 5.30002C13.1 5.54954 13.0509 5.7966 12.9554 6.02712C12.8599 6.25764 12.72 6.4671 12.5436 6.64353C12.3671 6.81996 12.1577 6.95991 11.9271 7.0554C11.6966 7.15088 11.4496 7.20003 11.2 7.20002C10.9505 7.20003 10.7035 7.15088 10.4729 7.0554C10.2424 6.95991 10.033 6.81996 9.85655 6.64353C9.68011 6.4671 9.54016 6.25764 9.44468 6.02712C9.34919 5.7966 9.30005 5.54954 9.30005 5.30002C9.30005 4.79611 9.50023 4.31284 9.85655 3.95652C10.2129 3.6002 10.6961 3.40002 11.2 3.40002C11.704 3.40002 12.1872 3.6002 12.5436 3.95652C12.8999 4.31284 13.1 4.79611 13.1 5.30002ZM4.80005 9.80002C5.72831 9.80002 6.61855 10.1688 7.27492 10.8252C7.9313 11.4815 8.30005 12.3718 8.30005 13.3V13.6H1.30005V13.3C1.30005 12.3718 1.6688 11.4815 2.32518 10.8252C2.98155 10.1688 3.87179 9.80002 4.80005 9.80002Z" stroke="#9CA3AF"/>';
													html += '</svg>';
													html += '<span>';
														html += response.res[i].number_of_people + ' osôb';
													html += '</span>';
												html += "</p>";
											}else{
												html += "";
											}

											if(response.res[i].property_number_of_rooms){
												html += "<p class='pl-20'>";
													html += '<svg width="16" height="16" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">';
														html +='<path d="M15.1192 6.0952C14.784 5.81004 14.3805 5.63641 13.9553 5.55738C13.7349 3.83814 12.2782 2.5 10.5 2.5H5.49999C3.72166 2.5 2.26487 3.83842 2.04465 5.55791C1.6199 5.63695 1.21605 5.81028 0.880842 6.0952C0.321297 6.57127 0 7.26561 0 7.99999C0 8.63378 0.240733 9.23825 0.677729 9.70166C0.88574 9.92237 0.999985 10.2583 0.999985 10.6479V13C0.999985 13.2763 1.22361 13.5 1.49998 13.5H2.99999V14.5H3.99997V13.5H12V14.5H13V13.5H14.5C14.7764 13.5 15 13.2763 15 13V10.6479C15 10.2583 15.1142 9.92237 15.3222 9.70166C15.7592 9.23829 16 8.63378 16 7.99999C16 7.26561 15.6787 6.57127 15.1192 6.0952ZM5.50002 3.49998H10.5C11.7303 3.49998 12.75 4.3952 12.9563 5.56735C11.8342 5.81795 11 6.8805 11 8.10692V9.5H4.99999V8.10692C4.99999 6.88072 4.166 5.81834 3.04375 5.56749C3.24995 4.39538 4.26967 3.49998 5.50002 3.49998ZM14.5947 9.01612C14.2114 9.42284 14 10.0024 14 10.6479V12.5H2V10.6479C2 10.0024 1.78859 9.42284 1.40529 9.01612C1.14404 8.73876 1.00002 8.37793 1.00002 8.00002C1.00002 7.55958 1.19288 7.1426 1.52883 6.85694C1.87014 6.56691 2.30764 6.44972 2.75539 6.52098C3.46485 6.63622 4.00001 7.31835 4.00001 8.10692V9.5V10.5H12V9.5V8.10692C12 7.31835 12.5352 6.63622 13.2442 6.52098C13.6953 6.44677 14.1294 6.56592 14.4712 6.85694C14.8072 7.14257 15 7.55958 15 8.00002C15 8.37793 14.856 8.73876 14.5947 9.01612Z" fill="#657395"/><path d="M14.3133 7.89313C14.5086 8.0884 14.5086 8.40498 14.3133 8.60025C14.118 8.79552 13.8015 8.79552 13.6062 8.60025C13.4109 8.40498 13.4109 8.0884 13.6062 7.89313C13.8015 7.6979 14.118 7.6979 14.3133 7.89313Z" fill="#657395"/><path d="M2.9229 7.89313C3.11817 8.0884 3.11817 8.40498 2.9229 8.60025C2.72763 8.79552 2.41106 8.79552 2.21579 8.60025C2.02052 8.40498 2.02052 8.0884 2.21579 7.89313C2.41106 7.6979 2.72763 7.6979 2.9229 7.89313Z" fill="#657395"/>';
													html += '</svg>';
													html += '<span>';
														html += response.res[i].property_number_of_rooms + ' izieb';
													html += '</span>';
												html += "</p>";
											}else{
												html += "";
											}
										html += " </div>";
								html += " </div>";
							html += " </div>";
					html += "</li>";

						$('#ajax_filter_search_results').append(html);
						loadmore = true;
					}
					$(".additional_content").LoadingOverlay("hide");
				}
			});
			count++;
		}
	}

});

$('.mpfcl input[type=checkbox]').change(function(){
	var myval = [];
	var parent = $(this).parents('.mpfcl');
	$("input[type=checkbox]:checked", parent).each(function(){
	    myval.push($(this).val());
	});
	var relate = parent.data('relate');
	$(relate).val(myval).trigger('change');
});
$('#rpf-btn').click(function(){
	$('select').each(function(){
		$(this).trigger('change');
		$(this).next().find('.select2-selection__rendered li').remove();
	});
});

var mafs = $("#my-ajax-filter-search");
var mafsForm = mafs.find("form");
mafsForm.submit(function(e){
    e.preventDefault();

	advamce_count = 2;
	$('.additional_content .advance-loadmore').removeClass('advance-loadmore').addClass('loadmore');

	var count = 1;

	$("#ajax_filter_search_results").LoadingOverlay("show");

	if(mafsForm.find("#rooms").val().length !== 0) {
		var rooms = mafsForm.find("#rooms").val();
	}
	if(mafsForm.find("#area").val().length !== 0) {
		var area = mafsForm.find("#area").val();
	}
	if(mafsForm.find("#floors").val().length !== 0) {
		var floors = mafsForm.find("#floors").val();
	}
	if(mafsForm.find("#garage").val().length !== 0) {
		var garage = mafsForm.find("#garage").val();
	}

	var data = {
		action : "my_ajax_filter_search",
		rooms : rooms,
		area : area,
		floors : floors,
		garage : garage,
		page_no : count
	}

	//console.log(data);return false;
	$.ajax({
        url : ajax_url,
        data : data,
        success : function(response) {
            $('#ajax_filter_search_results').empty();
            if(response.res) {
				$('.additional_content .loadmore').removeClass('loadmore').addClass('advance-loadmore').show();
				$('.additional_content .advance-loadmore').addClass('advance-loadmore').show();
                for(var i = 0 ;  i < response.res.length ; i++) {
					var html  = "<li id=property-"+ response.res[i].id +" class='property catalog-content cell-4 text-center'>";
							 html += " <div class='inner-content position-relative'> ";
								if(response.res[i].poster){
									html += " <div class='inbanner image-src'> ";
										html += "  <a href=" + response.res[i].permalink + ">";
											html += " <img src=" + response.res[i].poster + " alt=" + response.res[i].title + " />";
											html += " <div class='hover-block'>";
												html += " <div class='content-block'>";
													if(response.res[i].property_living_area){
														html += "<div class='d-flex justify-content-between'>"

																html += "<p>";
																	html += '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
																		html +='<path d="M14 4.36293V2H11.6641V2.55598H4.33588V2H2V4.36293H2.68702V11.6371H2V14H4.33588V13.3514H11.6641V14H14V11.6371H13.313V4.36293H14ZM3.64885 7.28185L7.31298 3.57529H9.41985L3.64885 9.3668V7.28185ZM4.33588 4.36293V3.52896H6.67176L3.64885 6.58687V4.36293H4.33588ZM3.64885 10.0618L10.0611 3.57529H11.6641V4.08494L4.19847 11.6371H3.64885V10.0618ZM12.3511 8.90347L8.96183 12.332H6.85496L12.3511 6.7722V8.90347ZM11.6641 11.6371V12.3784H9.60305L12.3511 9.59846V11.6834H11.6641V11.6371ZM12.3511 6.12355L6.21374 12.3784H4.33588V12.1467L12.0305 4.36293H12.3969V6.12355H12.3511Z" fill="white"/>';
																	html += '</svg>';
																	html += 'ObytnÁ plocha';
																html += "</p>";
																html += "<p>";
																	html += response.res[i].property_living_area + 'm<sup>2</sup>';
																html += "</p>";

														html += " </div>";
													}else{
														html += "";
													}
													if(response.res[i].property_usable_area){
														html += "<div class='d-flex justify-content-between'>"

																html += "<p>";
																	html += '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
																		html +='<path d="M12.7917 10.9166H11.2292L12.5313 12.2708H3.78129V3.46867L5.08337 4.82284V3.20825L3.20837 1.33325L1.33337 3.20825V4.82284L2.63546 3.46867V13.3645H12.5313L11.2292 14.6666H12.7917L14.6667 12.7916L12.7917 10.9166Z" fill="white"/><path d="M9.09375 1.95825H7.84375V3.052H9.09375V1.95825Z" fill="white"/><path d="M11.5417 1.95825H10.2917V3.052H11.5417V1.95825Z" fill="white"/><path d="M6.59375 1.95825H5.34375V3.052H6.59375V1.95825Z" fill="white"/><path d="M13.8855 3.10409V1.95825H12.7917V3.10409H13.3126H13.8855Z" fill="white"/><path d="M13.8855 9.14575H12.7917V10.3437H13.8855V9.14575Z" fill="white"/><path d="M13.8855 4.302H12.7917V5.49992H13.8855V4.302Z" fill="white"/><path d="M13.8855 6.75H12.7917V7.94792H13.8855V6.75Z" fill="white"/>';
																	html += '</svg>';
																	html += 'ÚŽItkovÁ plocha';
																html += "</p>";
																html += "<p>";
																	html += response.res[i].property_usable_area + 'm<sup>2</sup>';
																html += "</p>";

														html += " </div>";
													}else{
														html += "";
													}
													if(response.res[i].property_built_up_area){
														html += "<div class='d-flex justify-content-between'>"

																html += "<p>";
																	html += '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
																		html +='<path d="M14 12.9077H12.9076V14.0001H14V12.9077Z" fill="white"/><path d="M11.8152 12.9077H10.7228V14.0001H11.8152V12.9077Z" fill="white"/><path d="M3.02382 4.11621H1.9314V5.20863H3.02382V4.11621Z" fill="white"/><path d="M3.02382 1.9314H1.9314V3.02382H3.02382V1.9314Z" fill="white"/><path d="M5.20863 1.9314H4.11621V3.02382H5.20863V1.9314Z" fill="white"/><path d="M9.63039 1.9314H8.53796V3.02382H9.63039V1.9314Z" fill="white"/><path d="M7.44545 1.9314H6.35303V3.02382H7.44545V1.9314Z" fill="white"/><path d="M11.8152 1.9314H10.7228V3.02382H11.8152V1.9314Z" fill="white"/><path d="M14 1.9314H12.9076V3.02382H14V1.9314Z" fill="white"/><path d="M14 6.35303H12.9076V7.44545H14V6.35303Z" fill="white"/><path d="M14 4.11621H12.9076V5.20863H14V4.11621Z" fill="white"/><path d="M14 8.53809H12.9076V9.63051H14V8.53809Z" fill="white"/><path d="M14 10.7227H12.9076V11.8151H14V10.7227Z" fill="white"/><path d="M1.9314 6.35303V7.44545V8.53787V9.6303V10.7227V11.8151V12.9076V14H3.02382H4.11624H5.20866H6.30109H7.39351H8.48593H9.57835V6.35303H1.9314ZM8.53795 12.9076H7.44553H6.35311H5.20866H4.11624H3.02382V11.8151V10.7227V9.6303V8.53787V7.44545H8.53795V12.9076Z" fill="white"/>';
																	html += '</svg>';
																	html += 'ZastavanÁ plocha';
																html += "</p>";
																html += "<p>";
																	html += response.res[i].property_built_up_area + 'm<sup>2</sup>';
																html += "</p>";

														html += " </div>";
													}else{
														html += "";
													}
												html += " </div>";
												html += "<div class='top-content'>"
													html += "<h3 class='mb-0 text-white'>ZObraziŤ Detail</h3>";
													html += "<span class='half-circle spin circle'></span>";
												html += " </div>";
											html += " </div>";
										html += "  </a>";
									html += " </div>";
								}
								html += "<div class='description'>";
										html += "<h3>";
											html += "<a href="+response.res[i].permalink+"> "+response.res[i].title+" </a>";
										html += "</h3>";
										html += "<div class='d-flex justify-content-center info'>";
											if(response.res[i].number_of_people){
												html += "<p>";
													html += '<svg width="16" height="16" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">';
														html +='<path d="M9.95074 10.0307C10.57 11.0041 10.9016 12.1378 10.9 13.3L9.95074 10.0307ZM9.95074 10.0307C10.3482 9.87882 10.7715 9.80013 11.2 9.80013C11.8144 9.80012 12.4179 9.96184 12.95 10.269C13.4821 10.5762 13.9239 11.018 14.2311 11.5501C14.5383 12.0821 14.7 12.6857 14.7 13.3V13.6H10.8929C10.8976 13.5009 10.9 13.4012 10.9 13.3008L9.95074 10.0307ZM6.70005 5.30002C6.70005 5.80394 6.49987 6.28721 6.14355 6.64353C5.78723 6.99985 5.30396 7.20002 4.80005 7.20002C4.29614 7.20002 3.81286 6.99985 3.45655 6.64353C3.10023 6.28721 2.90005 5.80394 2.90005 5.30002C2.90005 4.79611 3.10023 4.31284 3.45655 3.95652C3.81287 3.6002 4.29614 3.40002 4.80005 3.40002C5.30396 3.40002 5.78723 3.6002 6.14355 3.95652C6.49987 4.31284 6.70005 4.79611 6.70005 5.30002ZM13.1 5.30002C13.1 5.54954 13.0509 5.7966 12.9554 6.02712C12.8599 6.25764 12.72 6.4671 12.5436 6.64353C12.3671 6.81996 12.1577 6.95991 11.9271 7.0554C11.6966 7.15088 11.4496 7.20003 11.2 7.20002C10.9505 7.20003 10.7035 7.15088 10.4729 7.0554C10.2424 6.95991 10.033 6.81996 9.85655 6.64353C9.68011 6.4671 9.54016 6.25764 9.44468 6.02712C9.34919 5.7966 9.30005 5.54954 9.30005 5.30002C9.30005 4.79611 9.50023 4.31284 9.85655 3.95652C10.2129 3.6002 10.6961 3.40002 11.2 3.40002C11.704 3.40002 12.1872 3.6002 12.5436 3.95652C12.8999 4.31284 13.1 4.79611 13.1 5.30002ZM4.80005 9.80002C5.72831 9.80002 6.61855 10.1688 7.27492 10.8252C7.9313 11.4815 8.30005 12.3718 8.30005 13.3V13.6H1.30005V13.3C1.30005 12.3718 1.6688 11.4815 2.32518 10.8252C2.98155 10.1688 3.87179 9.80002 4.80005 9.80002Z" stroke="#9CA3AF"/>';
													html += '</svg>';
													html += '<span>';
														html += response.res[i].number_of_people + ' osôb';
													html += '</span>';
												html += "</p>";
											}else{
												html += "";
											}

											if(response.res[i].property_number_of_rooms){
												html += "<p class='pl-20'>";
													html += '<svg width="16" height="16" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">';
														html +='<path d="M15.1192 6.0952C14.784 5.81004 14.3805 5.63641 13.9553 5.55738C13.7349 3.83814 12.2782 2.5 10.5 2.5H5.49999C3.72166 2.5 2.26487 3.83842 2.04465 5.55791C1.6199 5.63695 1.21605 5.81028 0.880842 6.0952C0.321297 6.57127 0 7.26561 0 7.99999C0 8.63378 0.240733 9.23825 0.677729 9.70166C0.88574 9.92237 0.999985 10.2583 0.999985 10.6479V13C0.999985 13.2763 1.22361 13.5 1.49998 13.5H2.99999V14.5H3.99997V13.5H12V14.5H13V13.5H14.5C14.7764 13.5 15 13.2763 15 13V10.6479C15 10.2583 15.1142 9.92237 15.3222 9.70166C15.7592 9.23829 16 8.63378 16 7.99999C16 7.26561 15.6787 6.57127 15.1192 6.0952ZM5.50002 3.49998H10.5C11.7303 3.49998 12.75 4.3952 12.9563 5.56735C11.8342 5.81795 11 6.8805 11 8.10692V9.5H4.99999V8.10692C4.99999 6.88072 4.166 5.81834 3.04375 5.56749C3.24995 4.39538 4.26967 3.49998 5.50002 3.49998ZM14.5947 9.01612C14.2114 9.42284 14 10.0024 14 10.6479V12.5H2V10.6479C2 10.0024 1.78859 9.42284 1.40529 9.01612C1.14404 8.73876 1.00002 8.37793 1.00002 8.00002C1.00002 7.55958 1.19288 7.1426 1.52883 6.85694C1.87014 6.56691 2.30764 6.44972 2.75539 6.52098C3.46485 6.63622 4.00001 7.31835 4.00001 8.10692V9.5V10.5H12V9.5V8.10692C12 7.31835 12.5352 6.63622 13.2442 6.52098C13.6953 6.44677 14.1294 6.56592 14.4712 6.85694C14.8072 7.14257 15 7.55958 15 8.00002C15 8.37793 14.856 8.73876 14.5947 9.01612Z" fill="#657395"/><path d="M14.3133 7.89313C14.5086 8.0884 14.5086 8.40498 14.3133 8.60025C14.118 8.79552 13.8015 8.79552 13.6062 8.60025C13.4109 8.40498 13.4109 8.0884 13.6062 7.89313C13.8015 7.6979 14.118 7.6979 14.3133 7.89313Z" fill="#657395"/><path d="M2.9229 7.89313C3.11817 8.0884 3.11817 8.40498 2.9229 8.60025C2.72763 8.79552 2.41106 8.79552 2.21579 8.60025C2.02052 8.40498 2.02052 8.0884 2.21579 7.89313C2.41106 7.6979 2.72763 7.6979 2.9229 7.89313Z" fill="#657395"/>';
													html += '</svg>';
													html += '<span>';
														html += response.res[i].property_number_of_rooms + ' izieb';
													html += '</span>';
												html += "</p>";
											}else{
												html += "";
											}
										html += " </div>";
								html += " </div>";
							html += " </div>";
					html += "</li>";
                     $('.property-page .total_posts').attr('catalog-count',response.page_count);
					 $('#ajax_filter_search_results').append(html);
					 $('.my-ajax-filter-search-cus').removeClass('open-sidefilter');
						
					 count++;
                }
				$("#ajax_filter_search_results").LoadingOverlay("hide");
            } else if( response == 0) {
                var html  = "No matching found.";
                $('#ajax_filter_search_results').append(html);
				$("#ajax_filter_search_results").LoadingOverlay("hide");
				$('.my-ajax-filter-search-cus').removeClass('open-sidefilter');
            }else{
				var html  = "No matching found.";
                $('#ajax_filter_search_results').append(html);
				$("#ajax_filter_search_results").LoadingOverlay("hide");
				$('.my-ajax-filter-search-cus').removeClass('open-sidefilter');
			} 
        }
    });

// we will add codes above this line later
});

// Advance Search

$(document).on('click','.property-page .advance-loadmore',function(e){

    e.preventDefault();

	var total = $('.property-page .total_posts').attr('catalog-count');

	$(".advance-loadmore").LoadingOverlay("show");

	if (advamce_count > total){
		$(".advance-loadmore").LoadingOverlay("hide");
		$(".advance-loadmore").hide();
		return false;
	}else{
		var mafs = $("#my-ajax-filter-search");
		var mafsForm = mafs.find("form");


		if($("#my-ajax-filter-search #rooms").val()) {
			if($("#my-ajax-filter-search #rooms").val() != ''){
				var rooms = $("#my-ajax-filter-search #rooms").val();
			}else{
				var rooms = '';
			}
		}

		if($("#my-ajax-filter-search #area").val()) {
			if( $( "#my-ajax-filter-search #area").val() != ''){
				var area = $("#my-ajax-filter-search #area").val();
			}else{
				var area =  '';
			}
		}

		if($("#my-ajax-filter-search #floors").val()) {
			if( $( "#my-ajax-filter-search #floors").val() != ''){
				var floors =  $("#my-ajax-filter-search #floors").val();
			}else{
				var floors =  '';
			}
		}

		if($( "#my-ajax-filter-search #garage").val() ) {
			if( $( "#my-ajax-filter-search #garage").val() != ''){
				var garage = $("#my-ajax-filter-search #garage").val();
			}else{
				var garage = '';
			}
		}

		var data = {
			action : "my_ajax_filter_search",
			rooms : rooms,
			area : area,
			floors : floors,
			garage : garage,
			page_no : advamce_count
		}


		$.ajax({
			url : ajax_url,
			data : data,
			success : function(response) {
				if(response.res) {
					for(var i = 0 ;  i < response.res.length ; i++) {
						var html  = "<li id=property-"+ response.res[i].id +" class='property catalog-content cell-4 text-center'>";
							 html += " <div class='inner-content position-relative'> ";
								if(response.res[i].poster){
									html += " <div class='inbanner image-src'> ";
										html += "  <a href=" + response.res[i].permalink + ">";
											html += " <img src=" + response.res[i].poster + " alt=" + response.res[i].title + " />";
											html += " <div class='hover-block'>";
												html += " <div class='content-block'>";
													if(response.res[i].property_living_area){
														html += "<div class='d-flex justify-content-between'>"

																html += "<p>";
																	html += '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
																		html +='<path d="M14 4.36293V2H11.6641V2.55598H4.33588V2H2V4.36293H2.68702V11.6371H2V14H4.33588V13.3514H11.6641V14H14V11.6371H13.313V4.36293H14ZM3.64885 7.28185L7.31298 3.57529H9.41985L3.64885 9.3668V7.28185ZM4.33588 4.36293V3.52896H6.67176L3.64885 6.58687V4.36293H4.33588ZM3.64885 10.0618L10.0611 3.57529H11.6641V4.08494L4.19847 11.6371H3.64885V10.0618ZM12.3511 8.90347L8.96183 12.332H6.85496L12.3511 6.7722V8.90347ZM11.6641 11.6371V12.3784H9.60305L12.3511 9.59846V11.6834H11.6641V11.6371ZM12.3511 6.12355L6.21374 12.3784H4.33588V12.1467L12.0305 4.36293H12.3969V6.12355H12.3511Z" fill="white"/>';
																	html += '</svg>';
																	html += 'ObytnÁ plocha';
																html += "</p>";
																html += "<p>";
																	html += response.res[i].property_living_area + 'm<sup>2</sup>';
																html += "</p>";

														html += " </div>";
													}else{
														html += "";
													}
													if(response.res[i].property_usable_area){
														html += "<div class='d-flex justify-content-between'>"

																html += "<p>";
																	html += '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
																		html +='<path d="M12.7917 10.9166H11.2292L12.5313 12.2708H3.78129V3.46867L5.08337 4.82284V3.20825L3.20837 1.33325L1.33337 3.20825V4.82284L2.63546 3.46867V13.3645H12.5313L11.2292 14.6666H12.7917L14.6667 12.7916L12.7917 10.9166Z" fill="white"/><path d="M9.09375 1.95825H7.84375V3.052H9.09375V1.95825Z" fill="white"/><path d="M11.5417 1.95825H10.2917V3.052H11.5417V1.95825Z" fill="white"/><path d="M6.59375 1.95825H5.34375V3.052H6.59375V1.95825Z" fill="white"/><path d="M13.8855 3.10409V1.95825H12.7917V3.10409H13.3126H13.8855Z" fill="white"/><path d="M13.8855 9.14575H12.7917V10.3437H13.8855V9.14575Z" fill="white"/><path d="M13.8855 4.302H12.7917V5.49992H13.8855V4.302Z" fill="white"/><path d="M13.8855 6.75H12.7917V7.94792H13.8855V6.75Z" fill="white"/>';
																	html += '</svg>';
																	html += 'ÚŽItkovÁ plocha';
																html += "</p>";
																html += "<p>";
																	html += response.res[i].property_usable_area + 'm<sup>2</sup>';
																html += "</p>";

														html += " </div>";
													}else{
														html += "";
													}
													if(response.res[i].property_built_up_area){
														html += "<div class='d-flex justify-content-between'>"

																html += "<p>";
																	html += '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
																		html +='<path d="M14 12.9077H12.9076V14.0001H14V12.9077Z" fill="white"/><path d="M11.8152 12.9077H10.7228V14.0001H11.8152V12.9077Z" fill="white"/><path d="M3.02382 4.11621H1.9314V5.20863H3.02382V4.11621Z" fill="white"/><path d="M3.02382 1.9314H1.9314V3.02382H3.02382V1.9314Z" fill="white"/><path d="M5.20863 1.9314H4.11621V3.02382H5.20863V1.9314Z" fill="white"/><path d="M9.63039 1.9314H8.53796V3.02382H9.63039V1.9314Z" fill="white"/><path d="M7.44545 1.9314H6.35303V3.02382H7.44545V1.9314Z" fill="white"/><path d="M11.8152 1.9314H10.7228V3.02382H11.8152V1.9314Z" fill="white"/><path d="M14 1.9314H12.9076V3.02382H14V1.9314Z" fill="white"/><path d="M14 6.35303H12.9076V7.44545H14V6.35303Z" fill="white"/><path d="M14 4.11621H12.9076V5.20863H14V4.11621Z" fill="white"/><path d="M14 8.53809H12.9076V9.63051H14V8.53809Z" fill="white"/><path d="M14 10.7227H12.9076V11.8151H14V10.7227Z" fill="white"/><path d="M1.9314 6.35303V7.44545V8.53787V9.6303V10.7227V11.8151V12.9076V14H3.02382H4.11624H5.20866H6.30109H7.39351H8.48593H9.57835V6.35303H1.9314ZM8.53795 12.9076H7.44553H6.35311H5.20866H4.11624H3.02382V11.8151V10.7227V9.6303V8.53787V7.44545H8.53795V12.9076Z" fill="white"/>';
																	html += '</svg>';
																	html += 'ZastavanÁ plocha';
																html += "</p>";
																html += "<p>";
																	html += response.res[i].property_built_up_area + 'm<sup>2</sup>';
																html += "</p>";

														html += " </div>";
													}else{
														html += "";
													}
												html += " </div>";
												html += "<div class='top-content'>"
													html += "<h3 class='mb-0 text-white'>ZObraziŤ Detail</h3>";
													html += "<span class='half-circle spin circle'></span>";
												html += " </div>";
											html += " </div>";
										html += "  </a>";
									html += " </div>";
								}
								html += "<div class='description'>";
										html += "<h3>";
											html += "<a href="+response.res[i].permalink+"> "+response.res[i].title+" </a>";
										html += "</h3>";
										html += "<div class='d-flex justify-content-center info'>";
											if(response.res[i].number_of_people){
												html += "<p>";
													html += '<svg width="16" height="16" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">';
														html +='<path d="M9.95074 10.0307C10.57 11.0041 10.9016 12.1378 10.9 13.3L9.95074 10.0307ZM9.95074 10.0307C10.3482 9.87882 10.7715 9.80013 11.2 9.80013C11.8144 9.80012 12.4179 9.96184 12.95 10.269C13.4821 10.5762 13.9239 11.018 14.2311 11.5501C14.5383 12.0821 14.7 12.6857 14.7 13.3V13.6H10.8929C10.8976 13.5009 10.9 13.4012 10.9 13.3008L9.95074 10.0307ZM6.70005 5.30002C6.70005 5.80394 6.49987 6.28721 6.14355 6.64353C5.78723 6.99985 5.30396 7.20002 4.80005 7.20002C4.29614 7.20002 3.81286 6.99985 3.45655 6.64353C3.10023 6.28721 2.90005 5.80394 2.90005 5.30002C2.90005 4.79611 3.10023 4.31284 3.45655 3.95652C3.81287 3.6002 4.29614 3.40002 4.80005 3.40002C5.30396 3.40002 5.78723 3.6002 6.14355 3.95652C6.49987 4.31284 6.70005 4.79611 6.70005 5.30002ZM13.1 5.30002C13.1 5.54954 13.0509 5.7966 12.9554 6.02712C12.8599 6.25764 12.72 6.4671 12.5436 6.64353C12.3671 6.81996 12.1577 6.95991 11.9271 7.0554C11.6966 7.15088 11.4496 7.20003 11.2 7.20002C10.9505 7.20003 10.7035 7.15088 10.4729 7.0554C10.2424 6.95991 10.033 6.81996 9.85655 6.64353C9.68011 6.4671 9.54016 6.25764 9.44468 6.02712C9.34919 5.7966 9.30005 5.54954 9.30005 5.30002C9.30005 4.79611 9.50023 4.31284 9.85655 3.95652C10.2129 3.6002 10.6961 3.40002 11.2 3.40002C11.704 3.40002 12.1872 3.6002 12.5436 3.95652C12.8999 4.31284 13.1 4.79611 13.1 5.30002ZM4.80005 9.80002C5.72831 9.80002 6.61855 10.1688 7.27492 10.8252C7.9313 11.4815 8.30005 12.3718 8.30005 13.3V13.6H1.30005V13.3C1.30005 12.3718 1.6688 11.4815 2.32518 10.8252C2.98155 10.1688 3.87179 9.80002 4.80005 9.80002Z" stroke="#9CA3AF"/>';
													html += '</svg>';
													html += '<span>';
														html += response.res[i].number_of_people + ' osôb';
													html += '</span>';
												html += "</p>";
											}else{
												html += "";
											}

											if(response.res[i].property_number_of_rooms){
												html += "<p class='pl-20'>";
													html += '<svg width="16" height="16" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">';
														html +='<path d="M15.1192 6.0952C14.784 5.81004 14.3805 5.63641 13.9553 5.55738C13.7349 3.83814 12.2782 2.5 10.5 2.5H5.49999C3.72166 2.5 2.26487 3.83842 2.04465 5.55791C1.6199 5.63695 1.21605 5.81028 0.880842 6.0952C0.321297 6.57127 0 7.26561 0 7.99999C0 8.63378 0.240733 9.23825 0.677729 9.70166C0.88574 9.92237 0.999985 10.2583 0.999985 10.6479V13C0.999985 13.2763 1.22361 13.5 1.49998 13.5H2.99999V14.5H3.99997V13.5H12V14.5H13V13.5H14.5C14.7764 13.5 15 13.2763 15 13V10.6479C15 10.2583 15.1142 9.92237 15.3222 9.70166C15.7592 9.23829 16 8.63378 16 7.99999C16 7.26561 15.6787 6.57127 15.1192 6.0952ZM5.50002 3.49998H10.5C11.7303 3.49998 12.75 4.3952 12.9563 5.56735C11.8342 5.81795 11 6.8805 11 8.10692V9.5H4.99999V8.10692C4.99999 6.88072 4.166 5.81834 3.04375 5.56749C3.24995 4.39538 4.26967 3.49998 5.50002 3.49998ZM14.5947 9.01612C14.2114 9.42284 14 10.0024 14 10.6479V12.5H2V10.6479C2 10.0024 1.78859 9.42284 1.40529 9.01612C1.14404 8.73876 1.00002 8.37793 1.00002 8.00002C1.00002 7.55958 1.19288 7.1426 1.52883 6.85694C1.87014 6.56691 2.30764 6.44972 2.75539 6.52098C3.46485 6.63622 4.00001 7.31835 4.00001 8.10692V9.5V10.5H12V9.5V8.10692C12 7.31835 12.5352 6.63622 13.2442 6.52098C13.6953 6.44677 14.1294 6.56592 14.4712 6.85694C14.8072 7.14257 15 7.55958 15 8.00002C15 8.37793 14.856 8.73876 14.5947 9.01612Z" fill="#657395"/><path d="M14.3133 7.89313C14.5086 8.0884 14.5086 8.40498 14.3133 8.60025C14.118 8.79552 13.8015 8.79552 13.6062 8.60025C13.4109 8.40498 13.4109 8.0884 13.6062 7.89313C13.8015 7.6979 14.118 7.6979 14.3133 7.89313Z" fill="#657395"/><path d="M2.9229 7.89313C3.11817 8.0884 3.11817 8.40498 2.9229 8.60025C2.72763 8.79552 2.41106 8.79552 2.21579 8.60025C2.02052 8.40498 2.02052 8.0884 2.21579 7.89313C2.41106 7.6979 2.72763 7.6979 2.9229 7.89313Z" fill="#657395"/>';
													html += '</svg>';
													html += '<span>';
														html += response.res[i].property_number_of_rooms + ' izieb';
													html += '</span>';
												html += "</p>";
											}else{
												html += "";
											}
										html += " </div>";
								html += " </div>";
							html += " </div>";
					html += "</li>";

					 $('.property-page .total_posts').attr('catalog-count',response.page_count);
					 $('#ajax_filter_search_results').append(html);
					 $(".advance-loadmore").LoadingOverlay("hide");
					 advamce_count++;
					}
				} else if( response == 0) {
					var html  = "No matching movies found. Try a different filter or search keyword";
					$('#ajax_filter_search_results').append(html);
					$(".advance-loadmore").LoadingOverlay("hide");
				}else{
					var html  = "No matching catalogs found. Try a different filter Option";
					$('#ajax_filter_search_results').append(html);
					$(".advance-loadmore").LoadingOverlay("hide");
				}
			}
		});
	}
// we will add codes above this line later
});
