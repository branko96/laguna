var ruta = 'https://'+window.location.host;

var obj_hectarea_base={id:0,codigo:'',descripcion: '',peso:'',sexo:'',categoria:'',procedencia:'',hectarea:'',cantidad:0};

// const MyApiClient = axios.create({
//   baseURL: 'http://localhost:80/laguna/',
//   headers: {'X-Custom-Header': 'foobar'}
// });
var vm=new Vue({
	el: '#app',
	data: {
		hectarea_editar:obj_hectarea_base,
		hectareas: [],
		nuev_hectarea:obj_hectarea_base,
		showModal:false,
		establecimientos:[]
	},
	methods:{
		nueva_hectarea(){
			var form_data = new FormData();
			for ( var key in this.nuev_hectarea ) {
			    form_data.append(key, this.nuev_hectarea[key]);
			}
			MyApiClient.post("/BACKEND/apis/hectareas/alta_hectarea.php",form_data)
			.then((respuesta) =>{
					console.log(respuesta);
					if (respuesta.data.id_respuesta == "1") {
						this.traer_hectareas();
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
						vm.nuev_hectarea={id:0,codigo:'',descripcion: '',peso:'',sexo:'',categoria:'',procedencia:'',hectarea:'',cantidad:0};
						setTimeout(function(){$("#modal_nueva_caravana").modal("hide");},500);
						
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
		editar_hectarea(){
			var form_data = new FormData();
			for ( var key in this.hectarea_editar ) {
			    form_data.append(key, this.hectarea_editar[key]);
			}
			MyApiClient.post("/BACKEND/apis/hectareas/edit_hectarea.php",form_data)
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
						vm.hectarea_editar={id:0,codigo:'',descripcion: '',peso:'',sexo:'',categoria:'',procedencia:'',hectarea:'',cantidad:0};
						vm.traer_hectareas();
						setTimeout(function(){$("#modal_editar_caravana").modal("hide");},500);

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
		eliminar_hectarea(id_emp){
			MyApiClient.get("/BACKEND/apis/hectareas/baja_hectarea.php?id="+id_emp)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta=="1") {
							this.traer_hectareas();
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
		modal_editar:function(caravana){
			$("#modal_editar_caravana").modal("show");
			this.ver_hectarea(caravana);
		},
		ver_hectarea(caravana){
			MyApiClient.get("/BACKEND/apis/hectareas/VerHectarea.php?id="+caravana.id)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta=="1") {
							this.hectarea_editar=respuesta.data.mensaje;
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
		traer_hectareas(){
			MyApiClient.get("/BACKEND/apis/hectareas/Traer_hectareas.php")
				.then((rta) =>{
						//console.log(rta);
						if (rta.data.id_respuesta == "1") {
							this.hectareas=rta.data.mensaje;
						}else{
							this.hectareas=[];
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
		},
	},
	mounted(){
		this.traer_hectareas();
		this.traer_establecimientos();
	}
});

$(function(){
	$("#abrir_modal").click(function(){

	});
});
