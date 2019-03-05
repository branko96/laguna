var ruta = 'https://'+window.location.host;

var obj_caravana_base={id:"0",fecha:moment(String(new Date())).format('DD-MM-YYYY'),num_fact:"0",cabezas:"38",kg:"15354.6",peso_x_kg:"1557.78",bruto:"0",iva:"",neto:"0",retencion:"0"};

const MyApiClient = axios.create({
  baseURL: 'http://localhost:80/laguna/',
  headers: {'X-Custom-Header': 'foobar'}
});
var vm=new Vue({
	el: '#app',
	data: {
		venta_editar:obj_caravana_base,
		ventas: [],
		nuev_venta:obj_caravana_base,
		showModal:false,
		nueva_venta_ver:false,
		ver_edicion:false
	},
	methods:{
		habilitar_edicion(venta){
			this.ver_edicion=true;
			this.venta_editar=venta;
		},
		habilitar_nueva_venta(){
			this.nueva_venta_ver=true;

		},
		nueva_venta(){
			var form_data = new FormData();
			for ( var key in this.nuev_venta ) {
			    form_data.append(key, this.nuev_venta[key]);
			}
			MyApiClient.post("/BACKEND/apis/ventas/alta_venta.php",form_data)
			.then((respuesta) =>{
					console.log(respuesta);
					if (respuesta.data.id_respuesta == "1") {
						this.traer_ventas();
						vm.nuev_venta=obj_caravana_base;
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
						vm.nuev_venta={id:"1",fecha:"2019-03-05",num_fact:"0",cabezas:"38",kg:"15354.6",peso_x_kg:"1557.78",bruto:"0",iva:"",neto:"0",retencion:"0"};
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
		editar_venta(){
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
						vm.traer_ventas();
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
			MyApiClient.get("/BACKEND/apis/caravanas/baja_caravana.php?id_ventas="+id_emp)
				.then((respuesta) =>{
						console.log(respuesta);
						if (respuesta.data.id_respuesta=="1") {
							this.traer_ventas();
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
		ver_venta(venta){
			MyApiClient.get("/BACKEND/apis/ventas/VerVenta.php?id_ventas="+venta.id)
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
		traer_ventas(){
			MyApiClient.get("/BACKEND/apis/ventas/Traer_ventas.php")
				.then((rta) =>{
						//console.log(rta);
						if (rta.data.id_respuesta == "1") {
							this.ventas=rta.data.mensaje;
						}else{
							this.ventas=[];
						}

				});
		}
	},
	mounted(){
		this.traer_ventas();
	}
});

$(function(){
	$("#abrir_modal").click(function(){

	});
});