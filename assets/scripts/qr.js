function openQRCamera(node) {
	console.log("fasfsf");
  var reader = new FileReader();
  reader.onload = function() {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
      } else {
        node.parentNode.previousElementSibling.value = res;
	   console.log("1:"+ res);
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
  //Passing Data
	  $.ajax({
		  url: base_url + "batch/edit_batch/",
		  type: "POST",
		  dataType: "JSON",
		  success: function(data) {
			  console.log("Success");

			    console.log("2:"+ node.files[0]);
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
			  alert('Error get data from ajax');
		  }
	  });
 }
