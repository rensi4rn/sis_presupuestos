<?php
/**
*@package pXP
*@file gen-DetalleTipoCentroCosto.php
*@author  (gvelasquez)
*@date 03-10-2016 15:47:23
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
  ISSUE            FECHA:          AUTOR       DESCRIPCION
 #42  ENDETR    17/07/2020        JJA          Interface que muestre la información de "tipo centro de costo" con todos los parámetros
 #44  ENDETR    23/07/2020        JJA          Mejoras en reporte tipo centro de costo de presupuesto
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.DetalleTipoCentroCosto=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		var me = this;
		console.log('?',me);
		this.maestro=config.maestro;
		//llama al constructor de la clase padre
	    this.Atributos=[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					fieldLabel: 'id_tipo_cc',
					name: 'id_tipo_cc'
			},
			type:'Field',
			grid: false,
			form:true 
		},
		{
			config:{
				name: 'ceco',
				fieldLabel: 'Ceco',
				allowBlank: true,
				anchor: '200%',
				gwidth: 200,
				maxLength:4,
                renderer: function (value, p, record, rowIndex, colIndex){

                   var espacion_blanco="";
                   var duplicar="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                   var nivel = record.data.nivel==null?0:record.data.nivel;
                   var espacion_blanco = duplicar.repeat(nivel);

                   if(record.data.nivel ==1){
                        return  String.format('<div style="vertical-align:middle;text-align:left;"> '+espacion_blanco+' <img src="../../../lib/imagenes/a_form_edit.png"> '+ record.data.ceco+' </div>');
                   }
                   else{       
	                   	if(record.data.nivel){
	                        return  String.format('<div style="vertical-align:middle;text-align:left;"> '+espacion_blanco+' <img src="../../../lib/imagenes/a_form.png"> '+ record.data.ceco+' </div>');
	                   	}
                        
                   }
                }
			},
				type:'Field',
				filters:{pfiltro:'ceco',type:'string'},
				id_grupo:1,
				grid:true,
				form:false,
				bottom_filter: true,
		},
		{
			config:{
				name: 'fecha_inicio',
				fieldLabel: 'Fecha inicio',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4,
				format: 'd/m/Y', 
				renderer:function (value,p,record){return value?value.dateFormat('d/m/Y'):''}
			},
			type:'DateField',
			filters:{pfiltro:'fecha_inicio',type:'date'},
			id_grupo:1,
			grid:true,
			form:false
		},
		{
			config:{
				name: 'fecha_final',
				fieldLabel: 'Fecha final',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4,
                format: 'd/m/Y', 
				renderer:function (value,p,record){return value?value.dateFormat('d/m/Y'):''}
			},
				type:'DateField',
				filters:{pfiltro:'fecha_final',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'gestion',
				fieldLabel: 'Gestion',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'NumberField', //#44
				filters:{pfiltro:'gestion',type:'numeric'}, //#44
				id_grupo:1,
				grid:true,
				form:false
		},
		{ //#44
			config:{
				name: 'nombre_programa',
				fieldLabel: 'Programa',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'tcc.nombre_programa',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{ //#44
			config:{
				name: 'nombre_proyecto',
				fieldLabel: 'Proyecto',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'tcc.nombre_proyecto',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{ //#44
			config:{
				name: 'nombre_actividad',
				fieldLabel: 'Actividad',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'tcc.nombre_actividad',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{ //#44
			config:{
				name: 'nombre_regional',
				fieldLabel: 'Regional',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'tcc.nombre_regional',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{ //#44
			config:{
				name: 'nombre_financiador',
				fieldLabel: 'Financiador',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'tcc.nombre_financiador',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'operativo',
				fieldLabel: 'Operativo',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'operativo',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'nivel',
				fieldLabel: 'Nivel',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'NumberField',
				filters:{pfiltro:'tcc.nivel',type:'numeric'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'formulacion_egreso_mb',
				fieldLabel: 'Formulacion egreso mb',
				allowBlank: true,
				anchor: '100%',
				gwidth: 80,
				maxLength:4,
				renderer:function (value,p,record){
						if(record.data.tipo_reg != 'summary'){
							return  String.format('{0}', Ext.util.Format.number(value,'0,000.00'));
						}
						else{
							return  String.format('<b><font size=2 >{0}</font><b>', Ext.util.Format.number(value,'0,000.00'));
						}
				}
			},
				type:'NumberField',
				filters:{pfiltro:'vpe.egreso_mb',type:'numeric'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'formulacion_ingreso_mb',
				fieldLabel: 'Formulacion ingreso mb',
				allowBlank: true,
				anchor: '100%',
				gwidth: 80,
				maxLength:4,
				renderer:function (value,p,record){
						if(record.data.tipo_reg != 'summary'){
							return  String.format('{0}', Ext.util.Format.number(value,'0,000.00'));
						}
						else{
							return  String.format('<b><font size=2 >{0}</font><b>', Ext.util.Format.number(value,'0,000.00'));
						}
				}
			},
				type:'NumberField',
				filters:{pfiltro:'vpe.ingreso_mb',type:'numeric'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'tipo_nodo',
				fieldLabel: 'Tipo nodo',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'tcc.movimiento',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'mov_ingreso',
				fieldLabel: 'Mov. ingreso',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4,
			},
				type:'Field',
				filters:{pfiltro:'mov_ingreso',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'mov_egreso',
				fieldLabel: 'Mov. egreso',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'mov_egreso',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'control_partida',
				fieldLabel: 'Control partida',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'control_partida',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'control_techo',
				fieldLabel: 'Control techo',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'control_techo',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'sueldo_planta',
				fieldLabel: 'Sueldo planta',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'sueldo_planta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'sueldo_obradet',
				fieldLabel: 'Sueldo obradet',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'sueldo_obradet',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usuario_reg',
				fieldLabel: 'Usuario reg',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'ur.cuenta',type:'string'},//#44
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usuario_mod',
				fieldLabel: 'Usuario mod',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'um.cuenta',type:'string'}, //#44
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha_reg',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4,
			    format: 'd/m/Y', 
				renderer:function (value,p,record){return value?value.dateFormat('d/m/Y'):''}
			},
				type:'DateField',
				filters:{pfiltro:'tcc.fecha_reg',type:'date'},//#44
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_mod',
				fieldLabel: 'Fecha mod',
				allowBlank: true,
				anchor: '100%',
				gwidth: 70,
				maxLength:4,
			    format: 'd/m/Y', 
				renderer:function (value,p,record){return value?value.dateFormat('d/m/Y'):''}
			},
				type:'DateField',
				filters:{pfiltro:'tcc.fecha_mod',type:'date'},//#44
				id_grupo:1,
				grid:true,
				form:false
		}

		];     
		Phx.vista.DetalleTipoCentroCosto.superclass.constructor.call(this,config);
			
		this.init();
	},
				
	tam_pag:50,	
	title:'Detalle tipo Centro de costo',
	ActList:'../../sis_presupuestos/control/PartidaEjecucion/listarTipoCentroCosto',
	id_store:'id_tipo_cc',
	fields: [

        {name:'id_tipo_cc', type: 'numeric'},
		{name:'ceco', type: 'string'},
		{name:'fecha_inicio', type: 'date',dateFormat:'Y-m-d'},//#44
		{name:'fecha_final', type: 'date',dateFormat:'Y-m-d'},//#44

		{name:'operativo', type: 'string'},
		{name:'nivel', type: 'numeric'},
		{name:'formulacion_egreso_mb', type: 'numeric'},
		{name:'formulacion_ingreso_mb', type: 'numeric'},
		{name:'tipo_nodo', type: 'string'},
		{name:'mov_ingreso', type: 'string'},
		{name:'mov_egreso', type: 'string'},
		{name:'control_partida', type: 'string'},
		{name:'control_techo', type: 'string'},
		{name:'sueldo_planta', type: 'string'},
		{name:'sueldo_obradet', type: 'string'},
		{name:'usuario_reg', type: 'string'},
		{name:'usuario_mod', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d'},//#44
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d'},//#44
		{name:'gestion', type: 'numeric'},//#44

		{name:'nombre_programa', type: 'string'}, //#44
		{name:'nombre_proyecto', type: 'string'}, //#44
		{name:'nombre_actividad', type: 'string'}, //#44
		{name:'nombre_regional', type: 'string'}, //#44
		{name:'nombre_financiador', type: 'string'}, //#44
		
		
	],

	sortInfo:{
		field: 'order',
		direction: 'asc'
	},

	loadValoresIniciales:function(){
		Phx.vista.DetalleTipoCentroCosto.superclass.loadValoresIniciales.call(this);
		//this.getComponente('id_int_comprobante').setValue(this.maestro.id_int_comprobante);
	},
	onReloadPage:function(param){
		//Se obtiene la gestión en función de la fecha del comprobante para filtrar partidas, cuentas, etc.
		var me = this;
		this.initFiltro(param);
	},

	initFiltro: function(param){
		this.store.baseParams=param;
		this.load( { params: { start:0, limit: this.tam_pag } });
	},

	bdel:false,
	bsave:false,
	bedit:false,
	bnew:false
	}
)
</script>
		
		