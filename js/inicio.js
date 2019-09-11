var start = new Date();

var ruta = 'https://'+window.location.host;

var vm=new Vue({
    el: '#app',
    data: {
        filtro_establecimiento:1,
        establecimientos:[],
        nombre_estab_elegido:'Laguna del Monte'
    },
    methods:{
        change_establecimiento(){
            let estab=this.filtro_establecimiento;
            var establecimiento_eleg=this.establecimientos.filter(function (el) {
                return el.id == estab;

            });
            //console.log(establecimiento_eleg);
            if (establecimiento_eleg.length>0){
                this.nombre_estab_elegido=establecimiento_eleg[0].nombre;
            }
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
        }
    },
    updated () {
        $(this.$refs.sel1).selectpicker('refresh');
    },
    mounted(){
        this.traer_establecimientos();
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