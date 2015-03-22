$("#enviar").click( function() {
 $.post( $("#cadastrar").attr("action"), 
         $("#cadastrar :input").serializeArray(), 
         function(info){ $("#resultado").html(info); 
   });
 clearInput();
});
 
$("#cadastrar").submit( function() {
  return false;	
});
 
function clearInput() {
	$("#cadastrar :input").each( function() {
	   $(this).val('');
	});
}