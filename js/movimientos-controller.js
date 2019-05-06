var ruta = 'https://'+window.location.host;

var obj_movimiento_base={id_mov:0,cantidad:'',fecha_mov: '',id_caravana:'',tipo_mov:''};

// const MyApiClient = axios.create({
//   baseURL: 'http://localhost:80/laguna/',
//   headers: {'X-Custom-Header': 'foobar'}
// });
var vm=new Vue({
	el: '#app',
	data: {
		movimiento_editar:{id_mov:0,cantidad:'',fecha_mov: '',id_caravana:'',tipo_mov:''},
		movimientos: [],
		nuev_movimiento:obj_movimiento_base,
		showModal:false
	},
	methods:{
		nuevo_movimiento(){
			var form_data = new FormData();
			for ( var key in this.nuev_movimiento ) {
			    form_data.append(key, this.nuev_movimiento[key]);
			}
			MyApiClient.post("/BACKEND/apis/movimientos/alta_movimiento.php",form_data)
			.then((respuesta) =>{
					console.log(respuesta);
					if (respuesta.data.id_respuesta == "1") {
						this.traer_movimientos();
						//vm.nuev_caravana=obj_caravana_base;
						$.notify({
							message: respuesta.data.mensaje
						},{
							z_index: 2000,
							type: 'success',
							placement: {
								from: "top",
								align: "center"
							}
						});
						vm.nuev_movimiento={id:0,codigo:'',fecha: '',cantidad:'',tipo:''};
						setTimeout(function(){$("#modal_nuevo_movimiento").modal("hide");},500);
						
					}else{
						$.notify({
							message: respuesta.data.mensaje
						},{
							type: 'danger',
							z_index: 2000,
							placement: {
								from: "top",
								align: "center"
							}
						});
					}

			});
		},
		editar_movimiento(){
			var form_data = new FormData();
			for ( var key in this.movimiento_editar ) {
			    form_data.append(key, this.movimiento_editar[key]);
			}
			MyApiClient.post("/BACKEND/apis/movimientos/edit_movimiento.php",form_data)
			.then((respuesta) =>{
					console.log(respuesta);
					if (respuesta.data.id_respuesta=="1") {
						$.notify({
							message: respuesta.data.mensaje
						},{
							type: 'success',
							z_index: 2000,
							placement: {
								from: "top",
								align: "center"
							}
						});
						vm.movimiento_editar={id:0,codigo:'',Fecha: '',cantidad:'',tipo:''};
						vm.traer_movimientos();
						setTimeout(function(){$("#modal_editar_movimiento").modal("hide");},500);

					}else{
						$.notify({
							message: respuesta.data.mensaje
						},{
							type: 'danger',
							z_index: 2000,
							placement: {
								from: "top",
								align: "center"
							}
						});
					}

			});
		},
		eliminar_movimiento(id_emp){
			MyApiClient.get("/BACKEND/apis/movimientos/baja_movimiento.php?id_mov="+id_emp)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta=="1") {
							this.traer_movimientos();
							$.notify({
								message: respuesta.data.mensaje 
							},{
								type: 'success',
								z_index: 2000,
								placement: {
									from: "top",
									align: "center"
								}
							});
						}else{
							$.notify({
								message: respuesta.data.mensaje 
							},{
								type: 'danger',
								z_index: 2000,
								placement: {
									from: "top",
									align: "center"
								}
							});
						}

				});
			

		},
		modal_editar:function(movimiento){
			$("#modal_editar_movimiento").modal("show");
			this.ver_movimiento(movimiento);
		},
		ver_movimiento(movimiento){
			MyApiClient.get("/BACKEND/apis/movimientos/VerMovimiento.php?id_mov="+movimiento.id)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta=="1") {
							this.movimiento_editar=respuesta.data.mensaje;
						}else{
							$.notify({
								message: respuesta.data.mensaje 
							},{
								type: 'danger',
								z_index: 2000,
								placement: {
									from: "top",
									align: "center"
								}
							});
						}


				});
		},
		traer_movimientos(){
			MyApiClient.get("/BACKEND/apis/movimientos/Traer_movimientos.php")
				.then((rta) =>{
						//console.log(rta);
						if (rta.data.id_respuesta == "1") {
							this.movimientos=rta.data.mensaje;
						}else{
							this.movimientos=[];
						}

				});
		}
	},
	mounted(){
		this.traer_movimientos();
	}
});

$(function(){
	$("#abrir_modal").click(function(){

	});
});