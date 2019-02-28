var ruta = 'https://'+window.location.host;


const MyApiClient = axios.create({
  baseURL: 'http://localhost:80/laguna/',
  headers: {'X-Custom-Header': 'foobar'}
});
var vm=new Vue({
	el: '#app',
	data: {
		caravana_editar:{id:0,codigo:'',descripcion: '',peso:'',sexo:'',categoria:'',procedencia:''},
		caravanas: [],
		nuev_caravana:{codigo:'',descripcion: '',peso:'',sexo:'',categoria:'',procedencia:''},
		showModal:false
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
					if (respuesta.data.id_respuesta="1") {
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
					if (respuesta.data.id_respuesta="1") {
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
		eliminar_caravana(id_emp){
			MyApiClient.get("/BACKEND/apis/caravanas/baja_caravana.php?id_caravana="+id_emp)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta="1") {
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
			$("#modal_editar_user").modal("show");
			this.ver_caravana(caravana);
		},
		ver_caravana(caravana){
			MyApiClient.get("/BACKEND/apis/caravanas/VerCaravana.php?id_caravana="+caravana.id)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta="1") {
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
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta="1") {
							this.caravanas=respuesta.data.mensaje;
						}else{
							this.caravanas=[];
						}

				});
		}
	},
	mounted(){
		this.traer_caravanas();
	}
});

$(function(){
	$("#abrir_modal").click(function(){

	});
});