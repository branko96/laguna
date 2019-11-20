var start = new Date();

var ruta = 'https://'+window.location.host;

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY');
    }
});

var vm=new Vue({
    el: '#app',
    components: { vuejsDatepicker },
    data: {
        toros:0,
        vacas:0,
        terneros:0,
        terneras:0,
        novillos:0,
        vaquillona:0,
        vaca_vieja:0,
        caballos:0,
        use_utc:true,
        filtro_establecimiento:1,
        edit_tarea_establecimiento:1,
        id_establ_destino:1,
        cant_toros:0,
        cant_vacas:0,
        cant_terneros:0,
        cant_terneras:0,
        cant_novillos:0,
        cant_vaquillonas:0,
        cant_vacas_viejas:0,
        cant_caballos:0,
        hectarea_origen:'',
        hectarea_destino:'',
        hectareas_origen:[],
        hectareas_destino:[],
        categoria:1,
        fecha:start.toISOString().split('T')[0],
        establecimientos:[],
        tareas:[],
        vista_alta_tarea:false,
        vista_edicion_tarea:false,
        autoshow_calendario:true,
        nueva_tarea_nombre:'',
        nueva_tarea_desc:'',
        edit_tarea_id:0,
        edit_tarea_nombre:'',
        edit_tarea_desc:'',
        nombre_estab_elegido:'Laguna del Monte',
        DatePickerFormat: 'yyyy-MM-dd',
        language:{
            language: 'Japanese',
            months: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
            monthsAbbr: ['En', 'Febr', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            days: ['Lun', 'Mar', 'Miérc', 'Jue', 'Viernes', 'Sáb', 'Dom'],
            rtl: false,
            ymd: 'yyyy-MM-dd',
            yearSuffix: ''
        }
    },
    methods:{
        change_fecha(event){
            this.fecha = this.fixDate(event);
            this.traer_tareas();
        },
        mouseout_hectarea($event){
            $($event.target).attr("fill","#4a90d6");
        },
        ver_hectarea($event,nombre){
            //console.log(nombre);
            $($event.target).attr("fill","#101055");
            MyApiClient.get("/BACKEND/apis/hectareas/Traer_por_hectarea.php?procedencia="+this.filtro_establecimiento+"&hectarea="+nombre)
                .then((rta) =>{
                    //console.log(rta);
                    if (rta.data.id_respuesta == "1") {
                        this.toros=rta.data.mensaje.toros;
                        this.vacas=rta.data.mensaje.vacas;
                        this.terneros=rta.data.mensaje.terneros;
                        this.terneras=rta.data.mensaje.terneras;
                        this.novillos=rta.data.mensaje.novillos;
                        this.vaquillona=rta.data.mensaje.vaquillona;
                        this.vaca_vieja=rta.data.mensaje.vaca_vieja;
                        this.caballos=rta.data.mensaje.caballos;
                    }else{
                        this.toros=0;
                        this.vacas=0;
                        this.terneros=0;
                        this.terneras=0;
                        this.novillos=0;
                        this.vaquillona=0;
                        this.vaca_vieja=0;
                        this.caballos=0;
                    }

                });


        },
        abrir_modal_pasajes(hectarea_elegida){
          $("#modal_movimientos").modal("show");
          this.hectarea_origen=hectarea_elegida;
          this.cant_toros=this.toros;
          this.cant_vacas=this.vacas;
            this.cant_terneras=this.terneras;
            this.cant_terneros=this.terneros;
            this.cant_novillos=this.novillos;
            this.cant_vaquillonas=this.vaquillona;
            this.cant_vacas_viejas=this.vaca_vieja;
            this.cant_caballos=this.caballos;
        },
        fixDate(date) {
            /*var fech=new Date(date);
            console.log(fech);
            console.log(date.toISOString().split('T')[0]);
            return fech.toISOString().split('T')[0];*/
            console.log(moment(date).add(1, 'days').format('YYYY-MM-DD'));
            return moment(date).add(1, 'days').format('YYYY-MM-DD');
        },
        abrir_alta_tareas(){
            this.vista_alta_tarea=!this.vista_alta_tarea;
            this.vista_edicion_tarea=false;
        },
        abrir_edicion_tareas(id_tarea,desc,nombre,estab){
            this.edit_tarea_id=id_tarea;
            this.edit_tarea_desc=desc;
            this.edit_tarea_nombre=nombre;
            this.edit_tarea_establecimiento=estab;
            this.vista_edicion_tarea=true;
            this.vista_alta_tarea=false;
        },
        cerrar_alta(){
            this.vista_alta_tarea=false;
            this.nueva_tarea_nombre="";
            this.nueva_tarea_desc="";
        },
        cerrar_edicion(){
            this.vista_edicion_tarea=false;
            this.edit_tarea_id=0;
            this.edit_tarea_desc="";
            this.edit_tarea_nombre="";
            this.edit_tarea_establecimiento=1;
        },
        change_establecimiento(){
            let estab=parseInt(this.filtro_establecimiento);
            var establecimiento_eleg=this.establecimientos.filter(function (el) {
                return el.id == estab;
            });
            $("#estab1").hide();
            $("#estab2").hide();
            $("#estab3").hide();
            $("#estab4").hide();
            //console.log(establecimiento_eleg);
            if (establecimiento_eleg.length>0){
                this.nombre_estab_elegido=establecimiento_eleg[0].nombre;
                var id_establecimiento=establecimiento_eleg[0].id;
                switch (id_establecimiento) {
                    case "1":
                        $("#estab1").show();
                        break;
                    case "2":
                        $("#estab2").show();
                        break;
                    case "3":
                        $("#estab3").show();
                        break;
                    case "4":
                        $("#estab4").show();
                        break;
                }
            }
            this.traer_hectareas_origen();
            this.traer_tareas();
        },
        movimiento(){
            let cant= this.categoria == 1 ? this.cant_vacas : this.cant_toros;
            if (cant >0) {
                let movimiento_obj = {
                    cantidad: cant,
                    origen: this.hectarea_origen,
                    destino: this.hectarea_destino,
                    categoria: this.categoria
                };
                var form_data = new FormData();
                for (var key in movimiento_obj) {
                    form_data.append(key, movimiento_obj[key]);
                }
                MyApiClient.post("/BACKEND/apis/movimientos/alta_movimiento.php", form_data)
                    .then((rta) => {
                        //console.log(rta);
                        if (rta.data.id_respuesta == "1") {
                            $("#modal_movimientos").modal("hide");
                            this.cant_vacas = 0;
                            this.cant_toros = 0;
                            this.hectarea_destino = '';
                            this.hectarea_origen = '';
                            this.categoria = 1;
                            $.notify({
                                message: rta.data.mensaje
                            }, {
                                type: 'success',
                                z_index: 2000,
                                placement: {
                                    from: "top",
                                    align: "center"
                                }
                            });
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
            }else{
                $.notify({
                    message: "No dispone de la cantidad necesaria para el pasaje"
                }, {
                    type: 'danger',
                    z_index: 2000,
                    placement: {
                        from: "top",
                        align: "center"
                    }
                });
            }
        },
        alta_tarea(){
            let alta_tarea_obj={id_establecimiento:this.filtro_establecimiento,fecha:this.fecha,nombre:this.nueva_tarea_nombre,descrip:this.nueva_tarea_desc};
            var form_data = new FormData();
            for ( var key in alta_tarea_obj) {
                form_data.append(key, alta_tarea_obj[key]);
            }
            MyApiClient.post("/BACKEND/apis/tareas/alta_tarea.php",form_data)
                .then((rta) =>{
                    //console.log(rta);
                    if (rta.data.id_respuesta == "1") {
                        this.traer_tareas();
                        this.nueva_tarea_nombre="";
                        this.nueva_tarea_desc="";
                        this.vista_alta_tarea=false;
                        $.notify({
                            message: rta.data.mensaje
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
        editar_tarea(){
            let editar_tarea_obj={id:this.edit_tarea_id,id_establecimiento:this.edit_tarea_establecimiento,nombre:this.edit_tarea_nombre,descrip:this.edit_tarea_desc};
            var form_data = new FormData();
            for ( var key in editar_tarea_obj) {
                form_data.append(key, editar_tarea_obj[key]);
            }
            MyApiClient.post("/BACKEND/apis/tareas/edit_tarea.php",form_data)
                .then((rta) =>{
                    //console.log(rta);
                    if (rta.data.id_respuesta == "1") {
                        this.traer_tareas();
                        this.edit_tarea_nombre="";
                        this.edit_tarea_desc="";
                        this.edit_tarea_establecimiento=1;
                        this.vista_edicion_tarea=false;
                        $.notify({
                            message: rta.data.mensaje
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
        eliminar_tarea(id_tarea){
            MyApiClient.get("/BACKEND/apis/tareas/baja_tarea.php?id_tareas="+id_tarea)
                .then((rta) =>{
                    //console.log(rta);
                    if (rta.data.id_respuesta == "1") {
                        this.traer_tareas();
                        $.notify({
                            message: rta.data.mensaje
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
        traer_tareas(){
            MyApiClient.get("/BACKEND/apis/tareas/Traer_tarea.php?fecha="+this.fecha+"&id_establecimiento="+this.filtro_establecimiento)
                .then((rta) =>{
                    //console.log(rta);
                    if (rta.data.id_respuesta == "1") {
                        this.tareas=rta.data.mensaje;
                    }else{
                        this.tareas=[];
                    }

                });
        },
        traer_hectareas_origen(){
            MyApiClient.get("/BACKEND/apis/hectareas/Traer_por_hectarea_id.php?id_establecimiento="+this.filtro_establecimiento)
                .then((rta) =>{
                    //console.log(rta);
                    if (rta.data.id_respuesta == "1") {
                        this.hectareas_origen=rta.data.mensaje.hectareas;
                    }else{
                        this.hectareas_origen=[];
                    }

                });
        },
        traer_hectareas_destino(){
            MyApiClient.get("/BACKEND/apis/hectareas/Traer_por_hectarea_id.php?id_establecimiento="+this.id_establ_destino)
                .then((rta) =>{
                    //console.log(rta);
                    if (rta.data.id_respuesta == "1") {
                        this.hectareas_destino=rta.data.mensaje.hectareas;
                    }else{
                        this.hectareas_destino=[];
                    }

                });
        }
    },
    updated () {
        $(this.$refs.sel1).selectpicker('refresh');
        $(this.$refs.sel2).selectpicker('refresh');
    },
    mounted(){
        this.traer_establecimientos();
        this.traer_tareas();
        this.traer_hectareas_origen();
        this.traer_hectareas_destino();
        $("#estab2").hide();
        $("#estab3").hide();
        $("#estab4").hide();
    }
});

$(function(){
    $("#select_estab").selectpicker();
    $("#edit_estab").selectpicker();
    $('.dropdown').on('hide.bs.dropdown', function() {
        //console.log("activado");
        $('.bootstrap-select.open').removeClass('open');
    });
    /*$('#air_datepicker').datepicker({
        timepicker: false,
        language: 'es',
        startDate: start
    });*/
});
