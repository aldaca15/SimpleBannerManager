<?php
$userJWT = ( isset($_POST["userJWT"]) && trim($_POST["userJWT"]) != '' ) ? trim ($_POST["userJWT"]) : '';
if($userJWT == '') {
	header("Location: ../");
	die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ali Adame - aliadame.com">

  <title>Simple Banner Manager - by AliAdame (GitHub@aldaca15)</title>

  <!-- Bootstrap core CSS -->
  <link href="../../simple-sidebar/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../bootstrap-cloudinary/css/cloudinary.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../simple-sidebar/css/simple-sidebar.css" rel="stylesheet">
  <script type="text/javascript">
	var token = token || {};
	token.JWT = '<?php echo $userJWT; ?>';

	var fileUpload = {};
	fileUpload.original = null;
	fileUpload.new = null;
	const cloudName = 'yourCloudinaryAccount';
	const unsignedUploadPreset = 'yourUnsignedPreset';
	var debugMode = false;
  </script>
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Banners admin </div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">Panel</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Show/hide sidebar</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Options
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../">Log out</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <h1 class="mt-4">Banners</h1>
        <p>Click on 'Change content' to modify banner image/destination</p>
        <div id="banners"></div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

	<!-- The Modal -->
	<div class="modal" id="newMediaModal">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">New banner's media</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
			<form id="mediaRegistrationForm" method="#" action="/adcampaigns/api/public/media/newMedia">
				<input id="idBanner" name="idBanner" type="hidden" value="">
				<input type="hidden" name="resource" id="cloudinaryLoadedImg">
				<div class="form-group">
						<label>destinationURL</label>
						<input id="" name="destinationURL" type="text" value="#" placeholder="https://feeling.com.mx" class="form-control">
				</div>
				<div class="form-group">
						<div class="galleryFileUpload"></div>
						<button id="" type="button" class="btn btn-wd btn-success btn-outline addFilePayment" data-url="">
								<span class="btn-label">
										<!-- <i class="fa fa-upload"></i> --> <!-- /In case you want font-awesome -->
								</span><span class="addFilePaymentLbl">Image upload</span>
						</button>
				</div>
				<div class="form-group">
						<label>width</label>
						<input id="width" name="width" type="number" placeholder="" class="form-control">
				</div>
				<div class="form-group">
						<label>height</label>
						<input id="height" name="height" type="number" placeholder="" class="form-control">
				</div>
			</form>
	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer">
			<button id="saveNewMedia" class="btn btn-primary" type="button">Save</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>

	    </div>
	  </div>
	</div>

  <!-- Bootstrap core JavaScript -->
  <script src="../../simple-sidebar/vendor/jquery/jquery.min.js"></script>
  <script src="../../simple-sidebar/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../bootstrap-cloudinary/js/bootstrap-cloudinary.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

	$(document).on('click', '.launchModal', function (e) {
        e.preventDefault();
				var idBanner = $(this).attr('data-id');
				$("#idBanner").val(idBanner);
        $("#newMediaModal").modal('show');
        if(debugMode) {
					alert(idBanner);
        }
        e.stopImmediatePropagation();
    });

	$(document).on("click","#saveNewMedia",function(event) {
        event.preventDefault();
        var formNewMediaRegistration = $('#mediaRegistrationForm');
        $.ajax({
            type: "POST",
            url: formNewMediaRegistration.attr('action'),
            data: formNewMediaRegistration.serialize(),
            beforeSend: function(request){
                request.setRequestHeader('app-token', token.JWT);
						},
            success: function(response) {
                console.log(response);
                if(response != null && response.hasOwnProperty("response") && response.response) {
                    $("#newMediaModal").modal("hide");
										getAllBanners();
      					} else {
                    alert("Error, try again.");
      					}
            },
            error: function(response) {
                debugger;
                if(response.hasOwnProperty("status") && response.status === 401) {
                    alert("Error, unauthorized");
                } else if(response.hasOwnProperty("status") && response.status === 500) {
                    alert("Error 500");
                } else if(response.hasOwnProperty("status") && response.status === 422
                    && !response.hasOwnProperty("response") || !response.response) {
                    debugger;
                    var dataResponse = response.responseJSON;
                    var keys = Object.keys(dataResponse);

                    var html = '';
                    for(var i=0;i<keys.length;i++){
                        var key = keys[i];
                        html += dataResponse[key];
                        html += '\n';
                    }
                    alert(html);
                } else {
                    alert("Report error by telling how to replay it.");
      					}
                console.log(response);
            },
        });
        event.stopImmediatePropagation();
    });

	function getAllBanners() {
		$.ajax({
			type: "GET",
			url: "../../api/public/media/listAll/",
			beforeSend: function(request){
				request.setRequestHeader('app-token', token.JWT);
			},
			success: function(response) {
				debugger;
				$("#banners").html("");
				$.each(response.data, function(result,info) {
					console.log(info);
					var element = '<div>Banner: '+info.idBanner+' | Views: '+info.viewCount+' </br><button class="btn btn-sm btn-success launchModal" data-id="'+info.idBanner+'">Change content</button></br>Preview:</br><iframe marginwidth="0" marginheight="0" src="../../display/?banner='+info.idBanner+'" frameborder="0" scrolling="no" style="width:'+info.width+'px;height:'+info.height+'px"></iframe></div></hr>';
					$("#banners").append(element);
				});
			},
			error: function(response) {
				debugger;
				if(response.hasOwnProperty("status") && response.status === 401) {
					alert("Error, unauthorized");
				} else {
					alert("Error, debugging needed");
				}
				console.log(response);
			}
		});
	}
	getAllBanners();

	$(document).on("change","#cloudinaryLoadedImg",function(e) {
        e.preventDefault();
				var loadedObj = $(this);
				debugger;
        var $loadedImg = loadedObj.val();
				var $loadedIW = loadedObj.attr("data-imgw");
				var $loadedIH = loadedObj.attr("data-imgh");
				$("#width").val($loadedIW);
				$("#height").val($loadedIH);
        if(typeof $loadedImg == 'undefined' || $loadedImg == "null" || $loadedImg.length == 0) {
            $(".addFilePayment").attr("data-url", "");
            $(".addFilePaymentLbl").text("Image upload").parent().addClass("btn-outline");
            return false;
        }
        $(".addFilePayment").attr("data-url", $loadedImg);
        $(".addFilePaymentLbl").text("Open image").parent().removeClass("btn-outline");

        e.stopImmediatePropagation();
    });

	$(document).on("click",".addFilePayment",function(e) {
        e.preventDefault();
        fileUpload.original = null;
        var imgURL = $(this).attr('data-url');

        cloudinaryModal("Upload files", "Alright",
          "Drag and drop files to upload or use selection button within the dashed area", "Select", true);

        //$("#travelerImg-rModal").modal("show");
        fileUpload.original = imgURL;
        fileUpload.new = null;

        $(".fileDisplay").empty("");
        if(typeof imgURL !== 'undefined' && fileUpload != null && fileUpload.original !== "null" && imgURL.length > 0) {
            var dispFileHTML = '';
            var ext = fileUpload.original.split('.');

            ext = ext[(ext.length-1)];
            var imageReg = /[\/.](gif|jpg|jpeg|tiff|png)$/i;
            if(imageReg.test(fileUpload.original)) {
                dispFileHTML = '<img class="img-responsive ifadeIn" style="max-width: 100%; opacity: 1;" onload="this.style.opacity=\'1\';" src="'+fileUpload.original+'"/>';
            } else {
                dispFileHTML = document.createElement('a');
                var linkText = document.createTextNode(fileUpload.original.substring(0, 40).concat("..."));
                dispFileHTML.appendChild(linkText);
                dispFileHTML.title = fileUpload.original;
                dispFileHTML.href = fileUpload.original;
                dispFileHTML.target = "_blank";
            }
            setTimeout(function(){
                $(".fileDisplay").append(dispFileHTML);
            },750);
        }

        e.stopImmediatePropagation();
    });

  </script>

</body>

</html>
