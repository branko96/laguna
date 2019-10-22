var ruta = 'https://'+window.location.host;

var obj_caravana_base={id:0,codigo:'',descripcion: '',peso:'',sexo:'',categoria:'',procedencia:'',hectarea:''};

// const MyApiClient = axios.create({
//   baseURL: 'http://localhost:80/laguna/',
//   headers: {'X-Custom-Header': 'foobar'}
// });
var vm=new Vue({
	el: '#app',
	data: {
		caravana_editar:obj_caravana_base,
		caravanas: [],
		nuev_caravana:obj_caravana_base,
		showModal:false,
		establecimientos:[]
	},
	methods:{
		nueva_caravana(){
			var form_data = new FormData();
			for ( var key in this.nuev_caravana ) {
			    form_data.append(key, this.nuev_caravana[key]);
			}
			MyApiClient.post("/BACKEND/apis/caravanas/alta_caravana.php",form_data)
			.then((respuesta) =>{
					console.log(respuesta);
					if (respuesta.data.id_respuesta == "1") {
						this.traer_caravanas();
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
						vm.nuev_caravana={id:0,codigo:'',descripcion: '',peso:'',sexo:'',categoria:'',procedencia:'',hectarea:''};
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
		editar_caravana(){
			var form_data = new FormData();
			for ( var key in this.caravana_editar ) {
			    form_data.append(key, this.caravana_editar[key]);
			}
			MyApiClient.post("/BACKEND/apis/caravanas/edit_caravana.php",form_data)
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
						vm.caravana_editar={id:0,codigo:'',descripcion: '',peso:'',sexo:'',categoria:'',procedencia:''};
						vm.traer_caravanas();
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
		eliminar_caravana(id_emp){
			MyApiClient.get("/BACKEND/apis/caravanas/baja_caravana.php?id_caravana="+id_emp)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta=="1") {
							this.traer_caravanas();
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
			this.ver_caravana(caravana);
		},
		ver_caravana(caravana){
			MyApiClient.get("/BACKEND/apis/caravanas/VerCaravana.php?id_caravana="+caravana.id)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta=="1") {
							this.caravana_editar=respuesta.data.mensaje;
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
		traer_caravanas(){
			MyApiClient.get("/BACKEND/apis/caravanas/Traer_caravanas.php")
				.then((rta) =>{
						//console.log(rta);
						if (rta.data.id_respuesta == "1") {
							this.caravanas=rta.data.mensaje;
						}else{
							this.caravanas=[];
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
		this.traer_caravanas();
		this.traer_establecimientos();
	}
});

$(function(){
	$("#abrir_modal").click(function(){

	});
});
