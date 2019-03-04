var ruta = 'https://'+window.location.host;


const MyApiClient = axios.create({
  baseURL: 'http://localhost:80/laguna/',
  headers: {'X-Custom-Header': 'foobar'}
});
var vm=new Vue({
	el: '#app',
	data: {
		empleado_editar:{id:0,nombre:'',apellido: '',dni:'',cuil:'',cod_postal:'',puesto:'',sueldo:0.0,fecha_inicio:'',fecha_fin:''},
		empleados: [],
		nuevo_emp:{id:0,nombre:'',apellido: '',dni:'',cuil:'',cod_postal:'',puesto:'',sueldo:null,fecha_inicio:'',fecha_fin:''},
		showModal:false
	},
	methods:{
		nuevo_empleado(){
			var form_data = new FormData();
			for ( var key in this.nuevo_emp ) {
			    form_data.append(key, this.nuevo_emp[key]);
			}
			MyApiClient.post("/BACKEND/apis/empleados/alta_empleado.php",form_data)
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
		editar_empleado(){
			var form_data = new FormData();
			for ( var key in this.empleado_editar ) {
			    form_data.append(key, this.empleado_editar[key]);
			}
			MyApiClient.post("/BACKEND/apis/empleados/edit_empleado.php",form_data)
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
		eliminar_empleado(id_emp){
			MyApiClient.get("/BACKEND/apis/empleados/baja_empleado.php?id_empleado="+id_emp)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta="1") {
							this.traer_empleados();
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
		modal_editar:function(empleado){
			$("#modal_editar_user").modal("show");
			this.ver_empleado(empleado);
		},
		ver_empleado(empleado){
			MyApiClient.get("/BACKEND/apis/empleados/VerEmpleado.php?id_empleado=1")
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta="1") {
							this.empleado_editar=respuesta.data.mensaje;
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
		traer_empleados(){
			MyApiClient.get("/BACKEND/apis/empleados/Traer_empleados.php")
				.then((respuesta) =>{
						//console.log(respuesta);
						if (respuesta.data.id_respuesta == "1") {
							this.empleados=respuesta.data.mensaje;
						}else{
							this.empleados=[];
						}

				});
		}
	},
	mounted(){
		this.traer_empleados();
	}
});

$(function(){
	$("#abrir_modal").click(function(){

	});
});