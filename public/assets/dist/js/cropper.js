

function dataURLtoFile(dataurl, filename) {
    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[arr.length - 1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);
    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], filename, {type:mime});
}


$(document).ready(function(){
	var $modal = $('#modal-image');
	var image = document.getElementById('sample_image');
	var final_image = document.getElementById('final_image');
	var file_image = document.getElementById('file_image');
	var cropper;

	$('#image_select').change(function(event){
        debugger;
    	var files = event.target.files;
        var img = new Image();
    	var done = function (url) {
			img.onload = function () {
                debugger;
				var offScreenCanvas = document.createElement('canvas');
                var offScreenCtx = offScreenCanvas.getContext('2d');
                offScreenCanvas.width = img.width;
                offScreenCanvas.height = img.height;
                offScreenCtx.drawImage(img, 0, 0);

                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                var maxWidth = 1000; // Set the desired maximum width
                var scale = 1;

                if (img.width > maxWidth) {
                scale = maxWidth / img.width;
                canvas.width = img.width * scale;
                canvas.height = img.height * scale;
                ctx.drawImage(offScreenCanvas, 0, 0, canvas.width, canvas.height);
                } else {
                // If the image is smaller than the desired maximum width, keep the original size
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(offScreenCanvas, 0, 0);
                }

                var resizedImage = canvas.toDataURL('image/png'); // or 'image/png'
			    image.src = resizedImage;

			}
			img.src = url;
      		$modal.modal('show');
    	};

    	if (files && files.length > 0)
    	{
			reader = new FileReader();
			reader.onload = function (event) {

				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
    	}
	});

	$modal.on('shown.bs.modal', function() {

    	cropper = new Cropper(image, {
			aspectRatio: 16/9,
			viewMode: 1,
			dragMode: 'move',
			// autoCropArea: 0.8,
			restore: false,
			guides: false,
			center: false,
			highlight: false,
			cropBoxMovable: false,
			cropBoxResizable: true,
			toggleDragModeOnDblclick: false,
			movable: true,
			background:false,
            autoCropArea: 1,
            responsive: true,

    	});

	}).on('hidden.bs.modal', function() {
   		cropper.destroy();
   		cropper = null;
	});



	$("#crop").click(function(){
        debugger;
    	canvas = cropper.getCroppedCanvas({
			width: 600,
			height: 800,
    	});

    	canvas.toBlob(function(blob) {
        	var reader = new FileReader();
         	reader.readAsDataURL(blob);
         	reader.onloadend = function() {
            	var base64data = reader.result;

                final_image.src = base64data;
                file_image.value = base64data;
				cropper.destroy();
				cropper = null;
                $modal.modal('hide');
         	}
    	});
    });

});
