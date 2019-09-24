var start = new Date();

var ruta = 'https://'+window.location.host;

var vm=new Vue({
    el: '#app',
    components: { vuejsDatepicker },
    data: {
        filtro_establecimiento:1,
        edit_tarea_establecimiento:1,
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
        fixDate(date) {
            /*var fech=new Date(date);
            console.log(fech);
            console.log(date.toISOString().split('T')[0]);
            return fech.toISOString().split('T')[0];*/
            console.log(moment(date).format('YYYY-MM-DD'));
            return moment(date).format('YYYY-MM-DD');
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
            MyApiClient.get("/BACKEND/apis/tareas/Traer_tarea.php")
                .then((rta) =>{
                    //console.log(rta);
                    if (rta.data.id_respuesta == "1") {
                        this.tareas=rta.data.mensaje;
                    }else{
                        this.tareas=[];
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