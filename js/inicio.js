var start = new Date();

var ruta = 'https://'+window.location.host;

var vm=new Vue({
    el: '#app',
    data: {
        filtro_establecimiento:1,
        establecimientos:[],
        tareas:[],
        alta_tarea:false,
        nueva_tarea_nombre:'',
        nueva_tarea_desc:'',
        nombre_estab_elegido:'Laguna del Monte'
    },
    methods:{
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
    $('.dropdown').on('hide.bs.dropdown', function() {
        //console.log("activado");
        $('.bootstrap-select.open').removeClass('open');
    });
    $('#air_datepicker').datepicker({
        timepicker: false,
        language: 'es',
        startDate: start
    });
});