var ruta = 'https://'+window.location.host;


const MyApiClient = axios.create({
  baseURL: 'http://localhost:80/laguna/',
  headers: {'X-Custom-Header': 'foobar'}
});
var vm=new Vue({
	el: '#app',
	data: {
		empleado_editar:{id:0,nombre:'',apellido: '',dni:'',cuil:'',cod_postal:'',puesto:'',sueldo:0.0,fecha_inicio:'',fecha_fin:''},
		empleados: [
			{id:1,nombre:'Branko',apellido: 'Ottavianelli',dni:'39412217',cuil:'20-39412217-4',cod_postal:'8000',puesto:'peon',sueldo:22.500,fecha_inicio:'20-9-2018',fecha_fin:''},
			{id:2,nombre:'Federico',apellido: 'Osovnikar',dni:'39412131',cuil:'20-39412131-4',cod_postal:'8000',puesto:'peon',sueldo:24.500,fecha_inicio:'20-2-2018',fecha_fin:''}
		],
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
						}

				});
		}
	}
});

$(function(){
	$("#abrir_modal").click(function(){

	});
});