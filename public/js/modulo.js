var Modulo = function(){
	this.cambioArchivo = function(){
		var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    	input.trigger('fileselect', [numFiles, label]);
	}
	this.archivoSeleccionado = function(event,numFiles,label){
		var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          }
	}
	this.procesarComando = function(){
		var data = new FormData();
		var textarea = $('#entrada_comandos').val().trim();
		if(textarea != ''){
			data.append('comandos',textarea);
		}
		$.each($('#archivo_comandos')[0].files, function(i, file) {
		    data.append('archivo', file);
		});
		
		if($('#archivo_comandos')[0].files.length == 0 && textarea == ''){
			$('#resultados_comandos').val('Introduzca comandos por favor');
			setTimeout(function(){ $('#resultados_comandos').val(''); }, 3000);
			return false;
		}

		$.ajax({
		    url : 'procesar',
		    data : data,
		    processData: false,
	  		contentType: false,
		    type : 'POST',
		    dataType : 'text',
		    success : function(result) {
		        $("#resultados_comandos").val(result);
		    },
		    error : function(xhr, status) {
		        alert('Disculpe, existió un problema');
		    }
		});
	}
}
var modulo = new Modulo();
$(function(){
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	$(document).on('change', ':file', modulo.cambioArchivo);
	$(':file').on('fileselect',modulo.archivoSeleccionado);
	$("#formulario_comandos").on("click","#procesar_comandos",modulo.procesarComando);
	$("body").on("click","#resetear",function(){
		location.reload();
	});
});