var ruta = 'https://'+window.location.host;

var obj_hectarea_base={
	id:0,
	numero:'12',
	id_establecimiento:0,
	total_toros:0,
	total_vacas:0,
	total_terneras:0,
	total_terneros:0,
	total_novillos:0,
	total_vaca_vieja:0,
	total_vaquillona:0,
	total_caballos:0
};

// const MyApiClient = axios.create({
//   baseURL: 'http://localhost:80/laguna/',
//   headers: {'X-Custom-Header': 'foobar'}
// });

var vm=new Vue({
	el: '#app',

	data: {
		filtro_establecimiento:1,
		hectarea_editar:obj_hectarea_base,
		hectareas: [],
		nuev_hectarea:obj_hectarea_base,
		showModal:false,
		establecimientos:[],
		animales:[],
	},
	methods:{
		change_establecimiento(){
        this.traer_hectareas_xidestab();


		},
		change_animal(){

				var estab = document.getElementById("select_estab").value;
			var animal = document.getElementById("select_animal").value;
				MyApiClient.get("/BACKEND/apis/hectareas/FiltrarHectXAnimal.php?animal="+animal+"&id_establecimiento="+estab)
					.then((rta) => {
						//console.log(rta);
						if (rta.data.id_respuesta == "1") {
							this.hectareas= rta.data.mensaje.hectareas;
						} else {

							this.hectareas = [];
						}

					});

		},
		// http://localhost/laguna/BACKEND/apis/hectareas/FiltrarHectXAnimal.php?animal=2&id_establecimiento=1
		traer_hectareas_xidestab(){
			var estab = document.getElementById("select_estab").value;
			MyApiClient.get("/BACKEND/apis/hectareas/Traer_por_hectarea_id.php?id_establecimiento="+estab)
				.then((rta) => {
					//console.log(rta);
					if (rta.data.id_respuesta == "1") {
						this.hectareas= rta.data.mensaje.hectareas;
					} else {

						this.hectareas = [];
					}

				});
		},
		traer_hectareas_xidestab2(){
			var estab = document.getElementById("select_estab").value;
			MyApiClient.get("/BACKEND/apis/hectareas/Traer_por_hectarea_id.php?id_establecimiento="+1)
				.then((rta) => {
					//console.log(rta);
					if (rta.data.id_respuesta == "1") {
						this.hectareas = rta.data.mensaje.hectareas;
					} else {

						this.hectareas = [];
					}

				});
		},

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
		traer_animales(){
			MyApiClient.get("/BACKEND/apis/hectareas/Traer_animales.php")
				.then((rta) =>{
					//console.log(rta);
					if (rta.data.id_respuesta == "1") {
						this.animales=rta.data.mensaje;
					}else{
						this.animales=[];
					}

				});
		},

	},
	updated () {
		$(this.$refs.sel1).selectpicker('refresh');
	},
	mounted(){
		//this.traer_caravanas();

		this.traer_establecimientos();
		this.traer_animales();
		this.traer_hectareas_xidestab2();

	}
});

$(function(){
	$("#abrir_modal").click(function(){

	});
});
