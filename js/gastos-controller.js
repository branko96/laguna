var ruta = 'https://'+window.location.host;

var obj_gasto_base={id_gasto:0,fecha:'',cantidad:0,id_categoria:'',detalle: '',valor:0,id_establecimiento:'','tipo_recibo':''};

// const MyApiClient = axios.create({
//   baseURL: 'http://localhost:80/laguna/',
//   headers: {'X-Custom-Header': 'foobar'}
// });
var vm=new Vue({
	el: '#app',
	data: {
		gasto_editar:obj_gasto_base,
		gastos: [],
		nuev_gasto:obj_gasto_base,
		showModal:false,
		establecimientos:[],
		categorias:[],
        filtro_estab:0,
        filtro_cat:0
	},
	methods:{
		nuevo_gasto(){
			var form_data = new FormData();
			for ( var key in this.nuev_gasto ) {
			    form_data.append(key, this.nuev_gasto[key]);
			}
			MyApiClient.post("/BACKEND/apis/gastos/alta_gasto.php",form_data)
			.then((respuesta) =>{
					console.log(respuesta);
					if (respuesta.data.id_respuesta == "1") {
						this.traer_gastos();
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
						vm.nuev_gasto={id:0,fecha:'',id_categoria:'',cantidad:0,detalle: '',valor:0,id_establecimiento:'','tipo_recibo':''};
						setTimeout(function(){$("#modal_nuevo_gasto").modal("hide");},500);
						
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
		editar_gasto(){
			var form_data = new FormData();
			for ( var key in this.gasto_editar ) {
			    form_data.append(key, this.gasto_editar[key]);
			}
			MyApiClient.post("/BACKEND/apis/gastos/edit_gasto.php",form_data)
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
						vm.gasto_editar={id:0,fecha:'',id_categoria:'',cantidad:0,detalle: '',valor:0,id_establecimiento:'','tipo_recibo':''};
						vm.traer_gastos();
						setTimeout(function(){$("#modal_editar_gasto").modal("hide");},500);

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
		eliminar_gasto(id_gasto){
			MyApiClient.get("/BACKEND/apis/gastos/baja_gasto.php?id_gasto="+id_gasto)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta=="1") {
							this.traer_gastos();
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
		modal_editar:function(gasto){
			$("#modal_editar_gasto").modal("show");
			this.ver_caravana(gasto);
		},
		ver_caravana(gasto){
			MyApiClient.get("/BACKEND/apis/gastos/VerGasto.php?id_gasto="+gasto.id)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta=="1") {
							this.gasto_editar=respuesta.data.mensaje;
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
		traer_gastos(){
			MyApiClient.get("/BACKEND/apis/gastos/Traer_gastos.php?categoria="+this.filtro_cat+"establecimiento="+this.filtro_estab)
				.then((rta) =>{
						//console.log(rta);
						if (rta.data.id_respuesta == "1") {
							this.gastos=rta.data.mensaje;
						}else{
							this.gastos=[];
						}

				});
		},
		traer_categorias(){
			MyApiClient.get("/BACKEND/apis/gastos/Traer_categorias.php")
				.then((rta) =>{
						//console.log(rta);
						if (rta.data.id_respuesta == "1") {
							this.categorias=rta.data.mensaje;
						}else{
							this.categorias=[];
						}

				});
		},
		traer_establecimientos(){
			MyApiClient.get("/BACKEND/apis/gastos/Traer_establecimientos.php")
				.then((rta) =>{
						//console.log(rta);
						if (rta.data.id_respuesta == "1") {
							this.establecimientos=rta.data.mensaje;
						}else{
							this.establecimientos=[];
						}

				});
		}
	},
	mounted(){
		this.traer_gastos();
		this.traer_categorias();
		this.traer_establecimientos();
	}
});

$(function(){
	$("#abrir_modal").click(function(){

	});
});