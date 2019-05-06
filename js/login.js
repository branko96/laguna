var ruta = 'https://'+window.location.host;

let obj_empleado_base={id:0,nombre:'',apellido: '',dni:'',cuil:'',cod_postal:'',puesto:'',sueldo:0.0,fecha_inicio:'',fecha_fin:null};

// const MyApiClient = axios.create({
//   baseURL: 'http://localhost:80/laguna/',
//   headers: {'X-Custom-Header': 'foobar'}
// });
var vm=new Vue({
    el: '#app',
    data: {
        nuevo_usuario:{nombre:'',usuario:'',contraseña:'',recontraseña:'' },
        login:{us:'',pass:''}

    },
    methods: {
        nuevo_user() {
            var form_data = new FormData();
            for (var key in this.nuevo_usuario) {
                form_data.append(key, this.nuevo_usuario[key]);
            }
            MyApiClient.post("/BACKEND/apis/empleados/alta_empleado.php", form_data)
                .then((respuesta) => {
                    console.log(respuesta);
                    if (respuesta.data.id_respuesta == "1") {
                        vm.traer_empleados();
                        vm.nuevo_emp = {
                            id: 0,
                            nombre: '',
                            apellido: '',
                            dni: '',
                            cuil: '',
                            cod_postal: '',
                            puesto: '',
                            sueldo: 0.0,
                            fecha_inicio: '',
                            fecha_fin: ''
                        };
                        $.notify({
                            message: respuesta.data.mensaje
                        }, {
                            z_index: 2000,
                            type: 'success',
                            placement: {
                                from: "top",
                                align: "center"
                            }
                        });
                        setTimeout(function () {
                            $("#modal_nuevo_user").modal("hide");
                        }, 500);
                    } else {
                        $.notify({
                            message: respuesta.data.mensaje
                        }, {
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
        loguear() {
            var form_data = new FormData();
            for (var key in this.login) {
                form_data.append(key, this.login[key]);
            }
            // if ((this.logiin.us == '') || (this.login.pass == '')) {
            //     notif({
            //         msg: 'Ingrese Usuario y Contraseña',
            //         type: "danger",
            //         position: "center"
            //     }
            //     );
            // } else {
                MyApiClient.post("/BACKEND/apis/usuarios/LoginUsuario.php", form_data)
                    .then((respuesta) => {
                        console.log(respuesta);
                        if (respuesta.data.codigo == 1) {
                            MyApiClient.post("/BACKEND/apis/usuarios/SetearSesion.php",respuesta.data)
                                .then((respuesta) =>{console.log(respuesta);})
                                    $.notify({
                                message:'Bienvenido '+ respuesta.data.mensaje.nombre,
                            }, {
                                type: 'success',
                                z_index: 2000,
                                placement: {
                                    from: "top",
                                    align: "center"
                                }
                            });
                            setTimeout(function(){window.location.href="index.php"},2000)
                        } else {
                            $.notify({
                                message:respuesta.data.mensaje,
                            }, {
                                type: 'danger',
                                z_index: 2000,
                                placement: {
                                    from: "top",
                                    align: "center"
                                }
                            });

                        }
                         });

        }


    },
    mounted(){

    }

}
);